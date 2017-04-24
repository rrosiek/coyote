<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreCorrespondence;
use App\Jobs\ProcessCorrespondence;
use App\Mail\PreviewCorrespondence;
use App\Models\Correspondence as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Correspondence extends Controller
{
    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Correspondence';
        $messages = Model::orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.correspondence.index', compact('title', 'messages'));
    }
 
    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Member E-Mail';
        $subtitle = 'Correspondence';
        $msg = new Model();
        $user = Auth::user();
        // $images = Uploads::where('image')->all();

        return view(
            'admin.correspondence.create',
            compact('title', 'subtitle', 'msg', 'user')
        );
    }
    
    /**
     * @param  \App\Http\Requests\StoreOrUpdateEvent $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCorrespondence $request)
    {
        if ($request->has('preview')) {
            Mail::to(Auth::user()->email)
                ->queue(new PreviewCorrespondence($request->only('subject', 'body')));

            return back()
                ->withInput()
                ->with('successMsg', 'You should receive a preview copy of the email at your address shortly.');
        }

        $msg = new Model($request->only('subject', 'body'));
        $msg->author()->associate(Auth::user());
        $msg->save();

        dispatch(new ProcessCorrespondence($msg));

        return redirect()
            ->route('correspondence.index')
            ->with('successMsg', 'Message has been queued successfully.  Refresh this page to view the delivery stats');
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function handleMailHook(Request $request)
    {
        if (!$this->verifyMailHook($request->all()))
            return response(null, 406);

        $msg = Model::find($request->message_id);

        if (!$msg) return response(null, 406);

        if ($request->event === 'delivered') {
            $msg->deliveries++;
            $msg->save();
        } elseif ($request->event === 'opened') {
            $msg->opens++;
            $msg->save();
        } elseif ($request->event === 'dropped') {
            $failures = json_decode($msg->failures);
            array_push($failures, $request->only(
                'recipient',
                    'domain',
                    'reason',
                    'code',
                    'description',
                    'timestamp'
            ));
            $msg->failures = json_encode($failures);
            $msg->save();

            $user = User::where('email', $request->recipient)->first();
            $user->subscribed = false;
            $user->email_failed = $request->description;
            $user->save();
        } else {
            return response(null, 406);
        }

        return response(null, 200);
    }

    /**
     * @param  array $params
     * @return bool
     */
    private function verifyMailHook($params)
    {
        if (abs(time() - $params['timestamp']) > 15)
            return false;

        return hash_hmac(
            'sha256',
            $params['timestamp'] . $params['token'],
            env('MAILGUN_SECRET')
        ) === $params['signature'];
    }
}

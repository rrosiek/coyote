<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreCorrespondence;
use App\Jobs\ProcessCorrespondence;
use App\Models\Correspondence as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $msg = new Model($request->only('subject', 'body'));
        $msg->author()->associate(Auth::user());
        $msg->save();

        dispatch(new ProcessCorrespondence($msg));

        return redirect()
            ->route('correspondence.index')
            ->with('successMsg', 'Message has been queued successfully.  Refresh this page to view the delivery stats');
    }

    /**
     * @param  \App\Http\Requests\StoreOrUpdateEvent $request
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // From Mailgun request:

        // private function verify($apiKey, $token, $timestamp, $signature)
        // {
            //check if the timestamp is fresh
            // if (abs(time() - $timestamp) > 15) {
            //     return false;
            // }

            //returns true if signature is valid
            // return hash_hmac('sha256', $timestamp.$token, $apiKey) === $signature;
        // }

        // disable failed emails
        // update correspondence row
    }

    /**
     * @param  \App\Http\Requests\StoreCorrespondence $request
     * @return \Illuminate\Http\Response
     */
    public function preview(StoreCorrespondence $request)
    {
        //
    }
}

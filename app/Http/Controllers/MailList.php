<?php
namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\StoreMailList;
use App\Http\Requests\UpdateMailList;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Mailgun\Mailgun;

class MailList extends Controller
{
    /**
     * @var \Mailgun\Mailgun
     */
    protected $mgClient;

    public function __construct()
    {
        $this->middleware('email.mailgun')->only('store');
        $this->middleware('email.textarea')->only('store');

        $this->mgClient = new Mailgun(env('MAILGUN_INBOUND_KEY'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Mailing Lists';
        $subtitle = 'Admin';
        $lists = $this->mgClient->get('lists/pages')->http_response_body->items;

        return view('admin.maillists.index', compact('title', 'subtitle', 'lists'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'New Mailing List';
        $subtitle = 'Admin';

        return view('admin.maillists.create', compact('title', 'subtitle'));
    }

    /**
     * @param  \App\Http\Requests\StoreMailList $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMailList $request)
    {
        try {
            $this->mgClient->post('lists', [
                'address' => $request->address,
                'name' => $request->name,
                'access_level' => $request->access_level,
            ]);
        } catch (Exception $e) {
            dd($e);
            return back()->withInput()->withErrors();
        }

        return redirect()
            ->route('maillists.index')
            ->with('successMsg', sprintf('Mailing list %s has been successfully added.', $request->name));
    }

    /**
     * @param  string $address
     * @return \Illuminate\Http\Response
     */
    public function edit($address)
    {
        $title = 'Update List Members';
        $subtitle = 'Admin';
        $members = $this->mgClient->get(
            "lists/$address/members/pages",
            ['subscribed' => 'yes']
        )->http_response_body->items;

        return view('admin.maillists.edit', compact('title', 'subtitle', 'members'));
    }

    /**
     * @param  \App\Http\Requests\UpdateMailList $request
     * @param  string $address
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMailList $request, $address)
    {
        try {
            $this->mgClient->post("lists/$address/members", [
                'address' => 'bar@example.com',
                'subscribed' => true,
            ]);
        } catch (Exception $e) {
            return back()->withInput()->withErrors();
        }

        return redirect()
            ->route('maillists.edit')
            ->with('successMsg', sprintf('Address %s has been successfully added.', $request->address));

    }

    /**
     * @param  string $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($address)
    {
    }
}

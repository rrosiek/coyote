<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\StoreMailList;
use App\Http\Requests\UpdateMailList;
use Illuminate\Http\Request;
use Mailgun\Mailgun;

class MailList extends Controller
{
    /**
     * @var \Mailgun\Mailgun
     */
    protected $mgClient;

    public function __construct()
    {
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
            $address = $request->address . '@' . env('MAILGUN_INBOUND_DOMAIN');

            $this->mgClient->post('lists', [
                'address' => $address,
                'name' => $request->name,
                'access_level' => $request->access_level,
            ]);
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('errorMsg', $e->getMessage());
        }

        return redirect()
            ->route('maillists.index')
            ->with('successMsg', sprintf('Mailing list %s has been successfully added.', $request->name));
    }

    /**
     * @param  string $maillist
     * @return \Illuminate\Http\Response
     */
    public function edit($maillist)
    {
        $title = 'Update List Members';
        $subtitle = 'Admin';
        $members = $this->mgClient->get(
            "lists/$maillist/members/pages",
            ['subscribed' => 'yes']
        )->http_response_body->items;

        return view('admin.maillists.edit', compact('title', 'subtitle', 'maillist', 'members'));
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  string $maillist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $maillist)
    {
        try {
            $emails = collect(explode("\n", $request->members))->map(function ($email) {
                return trim($email);
            })->filter(function ($email) {
                return filter_var($email, FILTER_VALIDATE_EMAIL);
            })->values()->toJson();

            $this->mgClient->post(
                "lists/$maillist/members.json",
                ['members' => $emails]
            );
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('errorMsg', $e->getMessage());
        }

        return redirect()
            ->route('maillists.edit', $maillist)
            ->with('successMsg', 'List members have been successfully added.');

    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  string $maillist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $maillist)
    {
        // We can delete both the entire list and a member
        if ($request->has('_address'))
            return $this->destroyMember($maillist, $request->_address);

        try {
            $this->mgClient->delete("lists/$maillist");
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('errorMsg', $e->getMessage());
        }

        return redirect()
            ->route('maillists.index')
            ->with('successMsg', sprintf('Mailing list %s has been successfully removed.', $maillist));
    }

    /**
     * @param  string $maillist
     * @param  string $address
     */
    
    private function destroyMember($maillist, $address)
    {
        try {
            $this->mgClient->delete("lists/$maillist/members/$address");
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('errorMsg', $e->getMessage());
        }

        return redirect()
            ->route('maillists.edit', $maillist)
            ->with('successMsg', sprintf('Address %s has been successfully removed.', $address));
    }
}

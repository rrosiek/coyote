<?php
namespace App\Http\Controllers;

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

        return view('admin.maillists.create', compact('title'));
    }

    /**
     * @param  \App\Http\Requests\StoreMailList $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMailList $request)
    {
    }

    /**
     * @param  string $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($address)
    {
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Payment as Model;
use Illuminate\Http\Request;

class Payment extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payments', ['title' => 'Payments']);
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'paid';
    }
}

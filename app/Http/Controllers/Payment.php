<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayment;
use App\Mail\PaymentInvoiced;
use App\Mail\PaymentReceived;
use App\Models\Payment as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\Stripe;

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
     * @param  \App\Http\Requests\StorePayment $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayment $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        Charge::create([
            'amount' => $request->payment,
            'currency' => 'usd',
            'description' => $request->product,
            'source' => $request->token,
        ]);

        $payment = Model::create([
            'email' => $request->email,
            'name' => $request->name,
            'zip' => $request->zip,
            'product' => $request->product,
            'amount' => $request->payment,
            'cc_brand' => $request->brand,
            'cc_lastfour' => $request->lastFour,
            'token' => $request->token,
        ]);

        Mail::to($request->email)->queue(new PaymentInvoiced($payment));
        Mail::to(env('MAIL_FINANCE'))->queue(new PaymentReceived($payment));

        return response(null, 200);
    }
}

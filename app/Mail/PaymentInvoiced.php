<?php
namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentInvoiced extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\Payment $payment
     */
    public $payment;

    /**
     * @param  \App\Models\Payment $payment
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invoice for ' . $this->payment->product)->markdown('emails.payments.invoice');
    }
}

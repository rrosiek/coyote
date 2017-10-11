<?php

namespace App\Mail;

use App\Models\Correspondence;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCorrespondence extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\Correspondence
     */
    public $msg;

    /**
     * @param  \App\Models\Correspondence $msg
     * @return void
     */
    public function __construct(Correspondence $msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return $this
     */
    public function build()
    {
        $this->withSwiftMessage(function ($message) {
            $header = '{"message_id":' . $this->msg->id . '}';
            $message->getHeaders()->addTextHeader('X-Mailgun-Variables', $header);
        });

        return $this->from($this->msg->author->email)
            ->subject($this->msg->subject)
            ->view('emails.correspondence');
    }
}

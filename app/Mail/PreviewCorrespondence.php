<?php
namespace App\Mail;

use App\Models\Correspondence;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreviewCorrespondence extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    public $payload;

    /**
     * @param  array $payload
     * @return void
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->payload['subject'])->view('emails.preview');
    }
}

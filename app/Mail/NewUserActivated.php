<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserActivated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\User $user
     */
    public $user;

    /**
     * @param  \App\Models\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Site Registration Activated')->markdown('emails.users.activated');
    }
}

<?php
namespace App\Listeners;

use App\Mail\ActivateNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class UserRegistered
{
    /**
     * @param  \Illuminate\Auth\Events\Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Mail::to(env('MAIL_WEBADMIN'))->send(new ActivateNewUser($event->user));
    }
}

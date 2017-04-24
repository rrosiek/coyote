<?php
namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserSaving
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\User
     */
    public $user;

    /**
     * @param  \App\Models\User
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}

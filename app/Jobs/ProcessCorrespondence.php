<?php
namespace App\Jobs;

use App\Mail\SendCorrespondence;
use App\Models\Correspondence;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ProcessCorrespondence implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Correspondence
     */
    protected $msg;

    /**
     * @param  \App\Models\Correspondence $msg
     * @return void
     */
    public function __construct(Correspondence $msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return void
     */
    public function handle()
    {
        $recipients = User::where([
            ['active', true],
            ['subscribed', true],
        ])->pluck('email');

        foreach ($recipients as $r)
            Mail::to($r)->send(new SendCorrespondence($this->msg));
    }
}

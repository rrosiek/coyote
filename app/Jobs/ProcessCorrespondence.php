<?php
namespace App\Jobs;

use App\Mail\SendCorrespondence;
use App\Models\Correspondence;
use App\Models\User;
use Carbon\Carbon;
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
        $when = Carbon::now()->addSeconds(15);
        $recipients = User::where([
            ['active', true],
            ['subscribed', true],
        ])->pluck('email');

        foreach ($recipients as $r) {
            Mail::to($r)->later($when, new SendCorrespondence($this->msg));
            $when->addSeconds(5);
        }
    }
}

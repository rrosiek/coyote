<?php
namespace App\Listeners;

use App\Mail\ActivateNewUser;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class UserRegistered implements ShouldQueue
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param  \Illuminate\Auth\Events\Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Mail::to(env('MAIL_WEBADMIN'))->send(new ActivateNewUser($event->user));

        $response = $this->client->request('GET', env('GEOCODE_URL'), [
            'query' => ['address' => $event->user->fullAddress]
        ]);

        $geoData = json_decode($response->getBody());

        if ($geoData->status == 'OK') {
            $event->user->latitude = $geoData->results[0]->geometry->location->lat;
            $event->user->longitude = $geoData->results[0]->geometry->location->lng;

            $event->user->save();
        }
    }
}

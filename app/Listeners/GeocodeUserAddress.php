<?php
namespace App\Listeners;

use App\Events\UserSaving;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeocodeUserAddress implements ShouldQueue
{
    use InteractsWithQueue;

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
     * @param  \App\Events\UserSaving  $event
     * @return void
     */
    public function handle(UserSaving $event)
    {
        $current = User::find($event->user->id);

        if ($current->fullAddress !== $event->user->fullAddress) {
            $coords = $this->getCoords($event->user->fullAddress);

            $event->user->latitude = $coords['lat'];
            $event->user->longitude = $coords['lng'];
        }
    }

    /**
     * @param  string $address
     * @return array
     */
    private function getCoords($address)
    {
        $blank = ['lat' => 0, 'lng' => 0];

        try {
            $response = $this->client->request('GET', env('GEOCODE_URL'), [
                'query' => ['address' => $address, 'key' => env('GOOGLE_KEY')]
            ]);
        } catch (TransferException $e) {
            return $blank;
        }

        $geoData = json_decode($response->getBody());

        if ($geoData->status == 'OK') {
            return [
                'lat' => $geoData->results[0]->geometry->location->lat,
                'lng' => $geoData->results[0]->geometry->location->lng,
            ];
        } else {
            return $blank;
        }
    }
}

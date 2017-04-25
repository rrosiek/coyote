<?php
namespace App\Listeners;

use App\Events\UserSaved;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeocodeUserAddress implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @param  \App\Events\UserSaved  $event
     * @return void
     */
    public function handle(UserSaved $event)
    {
        $coords = $this->getCoords($event->user->fullAddress);

        $event->user->latitude = $coords['lat'];
        $event->user->longitude = $coords['lng'];
        $event->user->save();
    }

    /**
     * @param  string $address
     * @return array
     */
    private function getCoords($address)
    {
        $client = new Client();
        $blank = ['lat' => 0, 'lng' => 0];

        try {
            $response = $client->request('GET', env('GEOCODE_URL'), [
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

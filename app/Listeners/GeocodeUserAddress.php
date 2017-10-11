<?php

namespace App\Listeners;

use App\Events\UserSaved;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeocodeUserAddress implements ShouldQueue
{
    /**
     * @param  \App\Events\UserSaved  $event
     * @return void
     */
    public function handle(UserSaved $event)
    {
        $coords = $this->getCoords($event->user->fullAddress);

        User::where('id', $event->user->id)->update([
            'latitude' => $coords['lat'],
            'longitude' => $coords['lng'],
        ]);
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
                'query' => ['address' => $address, 'key' => env('GOOGLE_SERVER_KEY')]
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

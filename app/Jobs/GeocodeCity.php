<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class GeocodeCity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $city;
    /**
     * Create a new job instance.
     */
    public function __construct($city)
    {
        $this->city = $city;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $location = $this->getLocation($this->city);
        $this->city->lat = $location['lat'];
        $this->city->lon = $location['lon'];
        $this->city->save();
    }

    private function getLocation($city) {
        $googleApiKey = env('GOOGLE_KEY');

        //beru sa len Slovenske obce/mesta
        $response = Http::get("https://maps.googleapis.com/maps/api/geocode/json?address=$city->name,Slovakia&key=$googleApiKey");
        $responseBody = json_decode($response->body());

        $lat = $responseBody->results[0]->geometry->location->lat;
        $lon = $responseBody->results[0]->geometry->location->lng;

        return array(
            'lat' => $lat,
            'lon' => $lon,
        );
    }
}

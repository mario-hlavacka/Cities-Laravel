<?php

namespace App\Console\Commands;

use App\Jobs\GeocodeCity;
use App\Models\City;
use Illuminate\Console\Command;

class GeocodeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:geocode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds latitude and longitude to the cities which doesn\'t have both of these attributes filled.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cities = City::whereNull('lat')->orWhereNull('lon')->get();

        foreach ($cities as $city) {
            GeocodeCity::dispatch($city);
        }
    }
}

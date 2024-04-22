<?php

namespace App\Console\Commands;

use App\Jobs\ParseAllSubdistricts;
use Illuminate\Console\Command;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses and imports data of all cities from certain region page into a database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!file_exists('public/coat-of-arms-images')) {
            $dirCreated = mkdir('public/coat-of-arms-images');
            if(!$dirCreated) {
                throw new \Exception('Failed to create directory for coats of arms');
            }
        }

        ParseAllSubdistricts::dispatch('https://www.e-obce.sk/kraj/NR.html');
    }


}

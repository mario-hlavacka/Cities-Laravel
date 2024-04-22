<?php

namespace App\Jobs;

use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use KubAT\PhpSimple\HtmlDomParser;

class ParseCity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $cityUrl;
    /**
     * Create a new job instance.
     */
    public function __construct($cityUrl)
    {
        $this->cityUrl = $cityUrl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $dom = HtmlDomParser::file_get_html( $this->cityUrl );
        $values = $dom->find("div#telo.telo table tr td table tr td table tr td");

        $name = substr(strstr($values[16]->text(), " "), 1);

        if($this->cityExists($name)) {
            return;
        }

        $mayorName = $values[50]->text();
        $cityHallAddress = "{$values[28]->text()}, {$values[31]->text()}";
        $phone = trim($values[23]->text(), " ");
        $fax = $values[27]->text();
        $email = explode(" ", $values[30]->text())[0];
        $webAddress = $values[33]->text();
        $coatOfArmsSrc = $dom->find("img[src^='https://www.e-obce.sk/erb/']")[0]->src;

        $city = new City();
        $city->name = $name;
        $city->mayor_name = $mayorName;
        $city->city_hall_address = $cityHallAddress;
        $city->phone = $phone;
        $city->fax = $fax;
        $city->email = $email;
        $city->web_address = $webAddress;

        $srcParts = explode('/', $coatOfArmsSrc);
        $filename = end($srcParts);
        $path = '/coat-of-arms-images/'.$filename;

        DownloadImage::dispatch($coatOfArmsSrc, $path);

        $city->coat_of_arms_path = $path;
        $city->save();
    }

    private function cityExists($cityName): bool
    {
        return count(City::where('name', '=', "{$cityName}")->get()) >= 1;
    }
}

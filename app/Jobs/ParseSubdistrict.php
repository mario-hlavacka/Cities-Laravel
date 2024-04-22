<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use KubAT\PhpSimple\HtmlDomParser;

class ParseSubdistrict implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subdistrictUrl;
    /**
     * Create a new job instance.
     */
    public function __construct($subdistrictUrl)
    {
        $this->subdistrictUrl = $subdistrictUrl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $dom = HtmlDomParser::file_get_html( $this->subdistrictUrl );
        $elems = $dom->find("a[href^='https://www.e-obce.sk/obec/']");

        foreach ($elems as $elem) {
            $urlSegments = explode('/', $elem->href);
            if(count($urlSegments) != 6) {
                continue;
            }

            $cityUrl = $elem->href;
            ParseCity::dispatch($cityUrl);
        }
    }
}

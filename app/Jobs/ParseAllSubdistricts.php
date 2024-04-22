<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use KubAT\PhpSimple\HtmlDomParser;

class ParseAllSubdistricts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $url;
    /**
     * Create a new job instance.
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $dom = HtmlDomParser::file_get_html( $this->url );
        $elems = $dom->find('a.okreslink');

        foreach ($elems as $elem) {
            $subdistrictUrl = $elem->href;
            ParseSubdistrict::dispatch($subdistrictUrl);
        }
    }
}

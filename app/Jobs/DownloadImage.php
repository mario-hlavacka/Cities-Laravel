<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DownloadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $imageUrl;
    public $path;
    /**
     * Create a new job instance.
     */
    public function __construct($imageUrl, $path)
    {
        $this->imageUrl = $imageUrl;
        $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $publicPath = 'public/'.$this->path;

        $fileSaved = file_put_contents($publicPath, file_get_contents($this->imageUrl));
        if(!$fileSaved) {
            throw new \Exception('Failed to save file');
        }
    }
}

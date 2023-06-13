<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\DownloadFileJob;
use App\Jobs\GetGzFileJob;
class DownloadFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DownloadFileJob::dispatch('https://challenges.coode.sh/food/data/json/index.txt',
                                '/openFood/products.txt'
        );

        GetGzFileJob::dispatch('https://challenges.coode.sh/food/data/json/',
                             '/var/www/html/storage/app/openFood/products.txt'
        );
    }
}

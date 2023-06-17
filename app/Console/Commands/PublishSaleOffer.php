<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use App\Jobs\PublishSaleOffer as PublishSaleOfferJob;

class PublishSaleOffer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:sale_offer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert sales offer in database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dispatch(new PublishSaleOfferJob());
        return Command::SUCCESS;
    }
}

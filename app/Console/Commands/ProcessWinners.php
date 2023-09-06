<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Auction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class ProcessWinners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process-winner';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process winners for auctions';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
{
    // Get products with active status, past end date, and no winner
    $products = Product::where('status', 'active')
        ->where('enddate', '<=', now())
        ->whereNull('winner')
        ->get();

    foreach ($products as $product) {
        try {
            // Use database transactions to ensure data consistency
            DB::beginTransaction();

            // Check if a winner has already been selected for this product
            if ($product->winner !== null) {
                Log::info("Winner has already been selected for Product_ID: {$product->Product_ID}");
                continue; // Skip to the next product
            }

            $winnerBid = $product->bids->sortByDesc('bid_price')->first();

            if ($winnerBid) {
                // Update product details
                $product->winner = $winnerBid->bidder_id;
                $product->winning_bid = $winnerBid->bid_price;
                $product->bidcount = $product->bids->count();
                $product->save();

                // Insert data into the auctions table
                Auction::create([
                    'sellername' => $product->user->username,
                    'Winner_ID' => $winnerBid->bidder_id,
                    'Product_ID' => $product->Product_ID,
                    'Win_Price' => $winnerBid->bid_price,
                    'Start_Date' => $product->startdate,
                    'End_Date' => $product->enddate,
                ]);

                // Commit the transaction
                DB::commit();

                // Log the winner processing
                Log::info("Winner processed for Product_ID: {$product->Product_ID}");
            }
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();

            // Log the exception
            Log::error($e);
        }
    }
}

}

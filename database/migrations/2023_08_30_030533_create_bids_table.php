<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id('bid_id'); // Primary key
            $table->unsignedBigInteger('product_id'); // Foreign key referencing "products" table
            $table->unsignedBigInteger('bidder_id'); // Foreign key referencing "users" table
            $table->decimal('bid_price', 10, 2);
            $table->timestamp('bid_time');
            $table->timestamps();

            // Define foreign key relationships
            $table->foreign('product_id')->references('Product_ID')->on('products');
            $table->foreign('bidder_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};

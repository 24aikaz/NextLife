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
        Schema::create('auctions', function (Blueprint $table) {
            $table->id('Auction_ID'); // Primary key
            $table->string('sellername'); 
            $table->unsignedBigInteger('Winner_ID')->nullable();
            $table->unsignedBigInteger('Product_ID'); // Foreign key referencing "products" table
            $table->decimal('Win_Price', 10, 2);
            $table->timestamp('Start_Date')->nullable();
            $table->timestamp('End_Date')->nullable();
            $table->timestamps();
        
            // Define foreign key relationships
            $table->foreign('Product_ID')->references('Product_ID')->on('products');
            $table->foreign('Winner_ID')->references('id')->on('users'); // Replace 'users' with your user table name
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('Transaction_ID');
            $table->unsignedBigInteger('Product_ID');
            $table->unsignedBigInteger('Bidder_ID');
            $table->unsignedBigInteger('Seller_ID');
            $table->decimal('Price', 10, 2);
            $table->string('Payment_Method');
            $table->string('Seller_Address');
            $table->string('Bidder_Address');

            // Defining foreign key constraints
            $table->foreign('Product_ID')->references('Product_ID')->on('products');
            $table->foreign('Seller_ID')->references('seller_id')->on('products');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
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
        Schema::create('products', function (Blueprint $table) {
            $table->id('Product_ID'); // Primary key
            $table->string('image')->nullable();
            $table->string('pname');
            $table->text('pdesc');
            $table->decimal('startprice', 10, 2);
            $table->decimal('currentprice', 10, 2);
            $table->enum('status', ['Active', 'Inactive']);
            $table->enum('category', ['Mobiles', 'Wearables', 'Computers and Accessories', 'Cameras', 'Phones', 'Kitchen', 'Home Decor', 'Miscellaneous']);
            $table->unsignedInteger('bidcount')->default(0);
            $table->timestamp('startdate')->nullable();
            $table->timestamp('enddate')->nullable();
            $table->string('winner')->nullable();
            $table->decimal('winning_bid', 10, 2)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
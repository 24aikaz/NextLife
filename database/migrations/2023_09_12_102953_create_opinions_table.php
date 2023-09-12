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
        Schema::create('opinions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key reference
            $table->enum('feedback_type', ['suggestion', 'rating', 'problem']);
            $table->enum('categories', ['user interface', 'auction experience', 'payment process', 'communication', 'other'])->nullable();
            $table->unsignedTinyInteger('stars');
            $table->enum('frequency', ['once', 'often', 'always'])->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();

            
            $table->foreign('user_id')->references('id')->on('users');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opinions');
    }
};

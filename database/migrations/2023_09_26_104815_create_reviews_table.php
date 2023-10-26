<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('BuyerID')->index();
            $table->foreign('BuyerID')->references('id')->on('users');
            $table->unsignedBigInteger('SellerID')->index();
            $table->foreign('SellerID')->references('id')->on('users');
            $table->integer('Rate');
            $table->text('Description'); // Use text for the description.
            $table->timestamps(); // Add timestamps for created_at and updated_at columns.
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

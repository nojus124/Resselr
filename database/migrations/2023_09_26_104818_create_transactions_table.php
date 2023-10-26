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
        Schema::disableForeignKeyConstraints();

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('BuyerID')->index();
            $table->foreign('BuyerID')->references('id')->on('users');
            $table->unsignedBigInteger('SellerID')->index();
            $table->foreign('SellerID')->references('id')->on('users');
            $table->unsignedBigInteger('ItemID')->index();
            $table->foreign('ItemID')->references('id')->on('items');
            $table->date('TransactionDate');
            $table->string('TransactionStatus', 50);
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

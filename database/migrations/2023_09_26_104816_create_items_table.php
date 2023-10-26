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

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('SellerID')->index();
            $table->foreign('SellerID')->references('id')->on('users');
            $table->unsignedBigInteger('CategoryID')->index();
            $table->foreign('CategoryID')->references('id')->on('categories');
            $table->string('ItemName', 50);
            $table->text('Description');
            $table->decimal('Price', 8, 2)->nullable()->default(null);
            $table->unsignedBigInteger('Condition')->index()->default(0);
            $table->foreign('Condition')->references('id')->on('itemconditions');
            $table->char('Location', 50)->nullable()->default(null);
            $table->date('UploadDate');
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
        Schema::dropIfExists('items');
    }
};

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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('CategoryName', 25);
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);
        });
        DB::table('categories')->insert([
            ['CategoryName' => 'Transport', 'created_at' => '2023-09-12 20:45:57', 'updated_at' => '2023-09-12 20:45:58'],
            ['CategoryName' => 'Real estate', 'created_at' => '2023-09-12 20:45:59', 'updated_at' => '2023-09-12 20:46:00'],
            ['CategoryName' => 'Jobs, services', 'created_at' => '2023-09-12 20:46:01', 'updated_at' => '2023-09-12 20:46:01'],
            ['CategoryName' => 'Household', 'created_at' => '2023-09-12 20:46:02', 'updated_at' => '2023-09-12 20:46:02'],
            ['CategoryName' => 'Computers', 'created_at' => '2023-09-12 20:46:03', 'updated_at' => '2023-09-12 20:46:03'],
            ['CategoryName' => 'Communication', 'created_at' => '2023-09-12 20:46:04', 'updated_at' => '2023-09-12 20:46:04'],
            ['CategoryName' => 'Electronics', 'created_at' => '2023-09-12 20:46:05', 'updated_at' => '2023-09-12 20:46:05'],
            ['CategoryName' => 'Entertainment', 'created_at' => '2023-09-12 20:46:05', 'updated_at' => '2023-09-12 20:46:06'],
            ['CategoryName' => 'Clothing, footwear', 'created_at' => '2023-09-12 20:46:06', 'updated_at' => '2023-09-12 20:46:07'],
            ['CategoryName' => 'For parents', 'created_at' => '2023-09-12 20:46:07', 'updated_at' => '2023-09-12 20:46:08'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName', 25)->nullable()->default(null);
            $table->string('LastName', 25)->nullable()->default(null);
            $table->string('Email', 25)->nullable()->default(null);
            $table->string('Password', 72)->nullable()->default(null);
            $table->string('PhoneNumber', 25)->nullable()->default(null);
            $table->date('DateOfBirth')->nullable()->default(null);
            $table->string('City', 25)->nullable()->default(null);
            $table->string('Street', 25)->nullable()->default(null);
            $table->string('StreetNumber', 25)->nullable()->default(null);
            $table->string('Remember_token', 25)->nullable()->default(null);
            $table->string('ApiToken', 40)->nullable()->default(null);
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

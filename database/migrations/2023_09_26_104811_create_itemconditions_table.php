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
        Schema::create('itemconditions', function (Blueprint $table) {
            $table->id();
            $table->string('Condition')->nullable();
        });
        DB::table('itemconditions')->insert([
            ['id' => 1, 'Condition' => 'New'],
            ['id' => 2, 'Condition' => 'Used'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itemconditions');
    }
};

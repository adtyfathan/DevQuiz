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
        Schema::table('player_answer', function (Blueprint $table) {
            $table->boolean('is_correct')->default(false)->after('answer');
            $table->integer('point')->default(0)->after('is_correct');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('player_answer', function (Blueprint $table) {
            //
        });
    }
};
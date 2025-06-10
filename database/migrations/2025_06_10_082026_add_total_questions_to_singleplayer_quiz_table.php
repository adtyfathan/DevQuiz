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
        Schema::table('singleplayer_quiz', function (Blueprint $table) {
            $table->integer('total_questions')->after('difficulty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('singleplayer_quiz', function (Blueprint $table) {
            //
        });
    }
};
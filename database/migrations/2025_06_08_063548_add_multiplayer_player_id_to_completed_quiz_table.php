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
        Schema::table('completed_quiz', function (Blueprint $table) {
            $table->unsignedBigInteger('multiplayer_player_id')->nullable()->after('user_id');
            $table->foreign('multiplayer_player_id')
                ->references('id')
                ->on('multiplayer_player')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('completed_quiz', function (Blueprint $table) {
            //
        });
    }
};
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
        Schema::create('player_answer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('multiplayer_quiz_id')->nullable();
            $table->unsignedBigInteger('singleplayer_quiz_id')->nullable();
            $table->enum('quiz_type', ['multiplayer', 'singleplayer']);
            $table->string('answer');
            $table->foreign('player_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('question_id')
                ->references('id')
                ->on('questions')
                ->onDelete('cascade');
            $table->foreign('multiplayer_quiz_id')
                ->references('id')
                ->on('multiplayer_quiz')
                ->onDelete('cascade');
            $table->foreign('singleplayer_quiz_id')
                ->references('id')
                ->on('singleplayer_quiz')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_answer');
    }
};
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
        Schema::create('multiplayer_quiz', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('host_id');
            $table->foreign('host_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string("category");
            $table->enum("difficulty", ['easy', 'medium', 'hard']);
            $table->integer('total_questions');
            $table->char('lobby_code', 6);
            $table->string('lobby_name');
            $table->text('lobby_description')->nullable();
            $table->enum('status', ['waiting', 'in_progress', 'finished']);
            $table->boolean('show_score')->default(true);
            $table->boolean('show_review')->default(true);
            $table->boolean('allow_multiple_attempt')->default(false);
            $table->integer('question_duration')->default(15);
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiplayer_quiz');
    }
};
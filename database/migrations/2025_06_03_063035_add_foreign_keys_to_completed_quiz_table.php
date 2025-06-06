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
            $table->enum('quiz_type', ['multiplayer', 'singleplayer'])
                ->after('id');
            $table->unsignedBigInteger('multiplayer_quiz_id')->nullable()->after('user_id');
            $table->foreign('multiplayer_quiz_id')
                ->references('id')
                ->on('multiplayer_quiz')
                ->onDelete('cascade');

            $table->unsignedBigInteger('singleplayer_quiz_id')->nullable()->after('multiplayer_quiz_id');
            $table->foreign('singleplayer_quiz_id')
                ->references('id')
                ->on('singleplayer_quiz')
                ->onDelete('cascade');

            $table->integer('true_answer_count')->default(0)->after('score');
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
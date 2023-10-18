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
        Schema::create('games_hist', function (Blueprint $table) {

            // Keys
            $table->uuid('id')->primary();
            $table->unsignedInteger('game_id');

            // Status
            $table->string('status', 50);

            // Odds
            $table->string('odds', 20)->nullable();
            $table->unsignedMediumInteger('favorite_team')->nullable();
            $table->tinyInteger('spread')->nullable();
            $table->unsignedTinyInteger('over_under')->nullable();

            // Scores
            $table->unsignedTinyInteger('away_score')->default(0);
            $table->unsignedTinyInteger('home_score')->default(0);

            // Stamps
            $table->timestamps();

            // Indices
            $table->index('game_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games_hist');
    }
};

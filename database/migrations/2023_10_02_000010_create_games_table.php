<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {

            // IDs
            $table->unsignedInteger('id')->primary();

            // Lookups
            $table->uuid('calendar_id');
            $table->uuid('week_id');

            // Deets
            $table->timestamp('start_date');
            $table->string('name');
            $table->string('short_name', 25);
            $table->string('game_type')->nullable();
            $table->unsignedTinyInteger('game_type_id')->nullable();

            // Booleans
            $table->boolean('neutral')->default(false);
            $table->boolean('conference_play')->default(false);

            // Teams & Scores
            $table->unsignedMediumInteger('home_team')->nullable();
            $table->unsignedTinyInteger('home_rank')->default(99);
            $table->unsignedTinyInteger('home_score')->default(0);
            $table->json('home_lines')->nullable();
            $table->json('home_records')->nullable();
            $table->float('home_prob', 4, 1)->nullable();

            $table->unsignedMediumInteger('away_team')->nullable();
            $table->unsignedTinyInteger('away_rank')->default(99);
            $table->unsignedTinyInteger('away_score')->default(0);
            $table->json('away_lines')->nullable();
            $table->json('away_records')->nullable();
            $table->float('away_prob', 4, 1)->nullable();

            // Odds
            $table->string('odds', 20)->nullable();
            $table->unsignedMediumInteger('favorite_team')->nullable();
            $table->float('spread', 4, 1)->nullable();
            $table->float('over_under', 4, 1)->nullable();

            // JSONs (Easier for unpredictable meta)
            $table->json('teams');
            $table->json('venue')->nullable();
            $table->unsignedMediumInteger('attendance')->default(0);
            $table->json('notes')->nullable();
            $table->json('situation')->nullable();
            $table->json('leaders')->nullable();
            $table->json('broadcasts')->nullable();

            // Status & Clock
            $table->string('status', 50);
            $table->string('status_desc', 50);
            $table->string('status_detail', 50);
            $table->string('status_detail_short', 25);
            $table->unsignedMediumInteger('clock');
            $table->string('clock_display', 10);
            $table->unsignedTinyInteger('period');
            $table->boolean('completed')->default(false);

            $table->timestamps();

            // Indices
            $table->index('calendar_id');
            $table->index('week_id');
            $table->index('status_desc');
            $table->index('home_team');
            $table->index('away_team');
            $table->index('favorite_team');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
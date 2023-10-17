<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {

            // IDs
            $table->uuid('id')->primary();
            $table->string('poll', 10);

            // Lookups
            $table->uuid('calendar_id');
            $table->uuid('week_id');

            $table->unsignedMediumInteger('team_id');

            $table->unsignedTinyInteger('rank');
            $table->unsignedTinyInteger('previous_rank');
            $table->unsignedMediumInteger('points');
            $table->unsignedSmallInteger('votes');
            $table->string('trend', 10);
            $table->string('record', 10);

            $table->index('poll');
            $table->index('calendar_id');
            $table->index('week_id');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rankings');
    }
}
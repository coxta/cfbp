<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conference_id')->nullable()->constrained();
            $table->foreignId('division_id')->nullable()->constrained();
            $table->string('slug', 50)->unique('slug');
            $table->string('location', 50)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('nickname', 50)->nullable();
            $table->string('abbreviation', 10)->nullable();
            $table->string('display_name', 50)->nullable();
            $table->string('short_display_name', 50)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('alt_color', 50)->nullable();
            $table->string('logo', 100)->nullable();
            $table->unsignedTinyInteger('wins')->default(0);
            $table->unsignedTinyInteger('losses')->default(0);
            $table->unsignedTinyInteger('conference_wins')->default(0);
            $table->unsignedTinyInteger('conference_losses')->default(0);
            $table->string('conference_standing', 100)->nullable();
            $table->json('stats')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
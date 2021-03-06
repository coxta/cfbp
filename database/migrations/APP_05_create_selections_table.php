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
        Schema::create('selections', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->uuid('contest_id');
            $table->unsignedInteger('game_id')->constrained();
            $table->unsignedMediumInteger('favorite_id');
            $table->float('spread', 4, 1);
            $table->unsignedTinyInteger('points');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('archived')->storedAs('IF(deleted_at IS NULL, 0, 1)')->nullable();

            $table->foreign('game_id')->references('id')->on('games')->constrained();
            $table->foreign('contest_id')->references('id')->on('contests')->constrained();
            $table->foreign('favorite_id')->references('id')->on('teams')->constrained();

            $table->unique(['contest_id','game_id','deleted_at']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selections');
    }
};

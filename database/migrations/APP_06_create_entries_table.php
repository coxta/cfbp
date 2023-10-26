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
        Schema::create('entries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('contest_id');
            $table->uuid('member_id');
            $table->string('name', 50);
            $table->unsignedMediumInteger('tiebreaker');
            $table->timestamps();

            $table->foreign('contest_id')->references('id')->on('contests')->constrained()->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->constrained()->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};

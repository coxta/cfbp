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
        Schema::create('weeks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('calendar_id');
            $table->string('name');
            $table->unsignedTinyInteger('number');
            $table->string('description');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->timestamps();
            $table->index('calendar_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weeks');
    }
};

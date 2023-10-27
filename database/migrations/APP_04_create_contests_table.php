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
        Schema::create('contests', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->uuid('group_id');
            $table->uuid('week_id');
            $table->uuid('type_id');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('archived')->storedAs('IF(deleted_at IS NULL, 0, 1)')->nullable();

            $table->foreign('group_id')->references('id')->on('groups')->constrained();
            $table->foreign('week_id')->references('id')->on('weeks')->constrained();
            $table->foreign('type_id')->references('id')->on('record_types')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contests');
    }
};

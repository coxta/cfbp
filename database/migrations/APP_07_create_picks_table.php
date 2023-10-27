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
        Schema::create('picks', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->uuid('entry_id');
            $table->uuid('selection_id');
            $table->unsignedMediumInteger('pick');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('archived')->storedAs('IF(deleted_at IS NULL, 0, 1)')->nullable();

            $table->foreign('entry_id')->references('id')->on('entries')->constrained();
            $table->foreign('selection_id')->references('id')->on('selections')->constrained();

            $table->unique(['entry_id','selection_id','deleted_at']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picks');
    }
};

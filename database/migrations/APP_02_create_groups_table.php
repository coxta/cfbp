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
        Schema::create('groups', function (Blueprint $table) {
            
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->uuid('type_id');
            $table->uuid('user_id');
            $table->json('options')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('archived')->storedAs('IF(deleted_at IS NULL, 0, 1)')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->constrained();
            $table->foreign('type_id')->references('id')->on('record_types')->constrained();

            $table->unique(['name','deleted_at']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};

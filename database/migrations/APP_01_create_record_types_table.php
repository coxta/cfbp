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
        Schema::create('record_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 50);
            $table->string('model', 50);
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('archived')->storedAs('IF(deleted_at IS NULL, 0, 1)')->nullable();

            $table->unique(['model','name','deleted_at']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_types');
    }
};

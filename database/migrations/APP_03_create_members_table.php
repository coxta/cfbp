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
        Schema::create('members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('group_id');
            $table->uuid('user_id');
            $table->uuid('type_id');
            $table->decimal('balance', 8, 2)->default(0);
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->constrained()->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->constrained();
            $table->foreign('type_id')->references('id')->on('record_types')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

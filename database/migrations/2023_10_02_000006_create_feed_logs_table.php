<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('feed_id');
            $table->uuid('job_id')->nullable();
            $table->timestamp('started_at', 0)->nullable();
            $table->timestamp('completed_at', 0)->nullable();
            $table->string('disposition', 25)->default('Queued');
            $table->longText('exception')->nullable();
            $table->timestamps();

            $table->index('feed_id');
            $table->index('job_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feed_logs');
    }
}
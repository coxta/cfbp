<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->integer('espn_id')->unique()->unsigned();
            $table->string('article_type', 20);
            $table->string('link');
            $table->string('image')->nullable();
            $table->integer('game_id')->nullable()->unsigned();
            $table->string('headline');
            $table->text('description')->nullable();
            $table->longText('story')->nullable();
            $table->json('teams')->nullable();
            $table->timestamp('published', 0);
            $table->timestamps();

            $table->index('espn_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');            

            $table->integer('popularity')->unsigned()->nullable();
            $table->integer('vote_count')->unsigned()->nullable();
            $table->boolean('video')->nullable();
            $table->string('poster_path', 255)->nullable();
            $table->boolean('adult')->nullable();
            $table->string('backdrop_path', 255)->nullable();
            $table->string('original_language')->nullable();
            $table->string('original_title')->nullable();
            $table->string('genre_ids', 255)->nullable();
            $table->string('title')->nullable();
            $table->integer('vote_average')->unsigned()->nullable();
            $table->string('overview', 10000)->nullable();
            $table->date('release_date')->nullable();
            $table->string('movie_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserMovieInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserMovie', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->json('fav_movie_list')->nullable();
            $table->json('watch_list')->nullable();
            $table->json('rate_list')->nullable();
            $table->json('comment_list')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UserMovie');
    }
}

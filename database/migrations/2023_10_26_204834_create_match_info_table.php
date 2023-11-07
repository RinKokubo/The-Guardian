<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('opponent_id');
            $table->string('user_role');
            $table->string('comunication');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('game_id')->references('id')->on('game_information');
            $table->foreign('opponent_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_info');
    }
}

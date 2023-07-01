<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('attacker_select_id');
            $table->string('user_name');
            $table->integer('user_card1_score');
            $table->integer('user_card2_score');
            $table->integer('user_card3_score');
            $table->integer('user_card4_score');
            $table->integer('user_card5_score');
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('game_information');
            $table->foreign('attacker_select_id')->references('id')->on('attacker_cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_scores');
    }
}

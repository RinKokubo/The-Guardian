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
        Schema::create('card_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('attacker_select_id');
            $table->integer('defender_card1_score');
            $table->integer('defender_card2_score');
            $table->integer('defender_card3_score');
            $table->integer('defender_card4_score');
            $table->integer('defender_card5_score');
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('game_information');
            $table->foreign('attacker_select_id')->references('id')->on('attacker_cards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_information');
    }
};

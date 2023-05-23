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
        Schema::create('game_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attacker_card1_id');
            $table->unsignedBigInteger('attacker_card2_id');
            $table->unsignedBigInteger('attacker_card3_id');
            $table->unsignedBigInteger('defender_card1_id');
            $table->unsignedBigInteger('defender_card2_id');
            $table->unsignedBigInteger('defender_card3_id');
            $table->unsignedBigInteger('defender_card4_id');
            $table->unsignedBigInteger('defender_card5_id');
            $table->timestamps();

            $table->foreign('attacker_card1_id')->references('id')->on('attacker_cards');
            $table->foreign('attacker_card2_id')->references('id')->on('attacker_cards');
            $table->foreign('attacker_card3_id')->references('id')->on('attacker_cards');
            $table->foreign('defender_card1_id')->references('id')->on('defender_cards');
            $table->foreign('defender_card2_id')->references('id')->on('defender_cards');
            $table->foreign('defender_card3_id')->references('id')->on('defender_cards');
            $table->foreign('defender_card4_id')->references('id')->on('defender_cards');
            $table->foreign('defender_card5_id')->references('id')->on('defender_cards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_information');
    }
};

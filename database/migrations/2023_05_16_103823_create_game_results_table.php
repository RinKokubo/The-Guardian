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
        Schema::create('game_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attacker_id');
            $table->unsignedBigInteger('defender_id');
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('attacker_select_id');
            $table->boolean('defender_select_1');
            $table->boolean('defender_select_2');
            $table->boolean('defender_select_3');
            $table->boolean('defender_select_4');
            $table->boolean('defender_select_5');
            $table->integer('attacker_score');
            $table->integer('defender_score');
            $table->timestamps();

            $table->foreign('attacker_id')->references('id')->on('users');
            $table->foreign('defender_id')->references('id')->on('users');
            $table->foreign('game_id')->references('id')->on('game_information');
            $table->foreign('attacker_select_id')->references('id')->on('attacker_cards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_results');
    }
};

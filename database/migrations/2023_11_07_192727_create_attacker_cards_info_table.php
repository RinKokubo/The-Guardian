<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttackerCardsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attacker_cards_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attacker_card_id');
            $table->text('attacker_card_info');
            $table->timestamps();

            $table->foreign('attacker_card_id')->references('id')->on('attacker_cards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attacker_cards_info');
    }
}

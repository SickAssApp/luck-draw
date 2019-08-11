<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrawWinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draw_winners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_prize');
            $table->string('second_prize_one');
            $table->string('second_prize_two');
            $table->string('third_prize_one');
            $table->string('third_prize_two');
            $table->string('third_prize_three');
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
        Schema::dropIfExists('draw_winners');
    }
}

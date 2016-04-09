<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function($table) {
            $table->increments('id');
            
            $table->integer('game_id')->unsigned();
            $table->integer('payout')->unsigned();
            $table->foreign('game_id')->references('id')->on('games');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function($table) {
            $table->dropForeign('matches_game_id_foreign');
        });
        Schema::drop('matches');
    }
}

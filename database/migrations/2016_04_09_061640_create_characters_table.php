<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function($table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('game_id')->unsigned();
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
        Schema::table('characters', function($table) {
            $table->dropForeign('characters_game_id_foreign');
        });
        Schema::drop('characters');
    }
}

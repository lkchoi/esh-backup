<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function($table) {
            $table->increments('id');
            $table->enum('type', [
                'MOBA', // multiplayer online battle arena
                'TCG',  // trading card game
                'FPS',  // first-person shooter
                'RTS',  // real-time strategy
                'FGC',  // fighting game community
            ]);
            $table->string('name');
            $table->string('abbreviation');
            $table->string('slug');

            // character, hero, race, team, side
            $table->string('character_term')->default('character')->nullable();

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
        Schema::drop('games');
    }
}

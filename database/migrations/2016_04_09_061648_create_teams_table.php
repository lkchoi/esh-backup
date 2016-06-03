<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function ($table) {
            $table->increments('id');

            // slugify team name
            $table->string('name');
            $table->string('slug');

            $table->integer('match_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('result')->unsigned();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function($table) {
            $table->dropForeign('teams_match_id_foreign');
            $table->dropForeign('teams_user_id_foreign');
        });
        Schema::drop('teams');
    }
}

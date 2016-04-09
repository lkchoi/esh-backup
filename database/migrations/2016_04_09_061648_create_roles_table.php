<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function ($table) {
            $table->increments('id');

            $table->integer('match_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('character_id')->unsigned();
            $table->integer('result')->unsigned();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('character_id')->references('id')->on('characters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function($table) {
            $table->dropForeign('roles_match_id_foreign');
            $table->dropForeign('roles_user_id_foreign');
            $table->dropForeign('roles_character_id_foreign');
        });
        Schema::drop('roles');
    }
}

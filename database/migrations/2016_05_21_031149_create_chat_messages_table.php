<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function(Blueprint $table) {

            // fields
            $table->increments('id');
            $table->text('content');
            $table->integer('channel_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // indexes
            $table->foreign('channel_id')->references('id')->on('chat_channels');
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

        Schema::table('chat_messages', function(Blueprint $table) {
            $table->dropForeign('chat_messages_channel_id_foreign');
            $table->dropForeign('chat_messages_user_id_foreign');
        });

        Schema::drop('chat_messages');
    }
}

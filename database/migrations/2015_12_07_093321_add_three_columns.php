<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThreeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tweets', function (Blueprint $table) {
            $table->integer('id_sendTweetMsg');
            $table->longText('reply_msg');
            $table->integer('reply_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Tweets', function (Blueprint $table) {
            $table->dropColumn('id_sendTweetMsg');
            $table->dropColumn('reply_msg');
            $table->dropColumn('reply_id');
        });
    }
}

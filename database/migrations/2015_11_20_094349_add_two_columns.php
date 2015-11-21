<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sendTweet_msg', function($table){
            $table->string('email')->unique();
            $table->text('tweet_msg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sendTweet_msg', function($table){
            $table->dropColumn('email');
            $table->dropColumn('tweet_msg');
        });
    }
}

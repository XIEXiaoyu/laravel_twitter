<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteEmailUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sendTweet_msg', function (Blueprint $table) {
            $table->dropUnique('sendtweet_msg_email_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sendTweet_msg', function (Blueprint $table) {
            $table->unique('email');
        });
    }
}

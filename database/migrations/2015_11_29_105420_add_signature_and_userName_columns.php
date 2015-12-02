<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSignatureAndUserNameColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userInfo', function (Blueprint $table) {
            $table->string('user_name');
            $table->longText('signature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userInfo', function (Blueprint $table) {
            $table->dropColumn('user_name');
            $table->dropColumn('signatue');
        });
    }
}

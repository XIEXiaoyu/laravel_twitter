<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThreeNewColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userInfo', function($table){
            $table->string('email')->unique();
            $table->string('password', 255);
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userInfo', function($table){
            $table->dropColumn('email');
            $table->dropColumn('password');
            $table->dropColumn('name');
        });
    }
}

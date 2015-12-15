<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->char('name');
            $table->char('user_name')->unique;
            $table->text('signature');
            $table->string('pro_img_path')->default('/asset/img/default_profile.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        dropColumn('id');
        dropColumn('email');
        dropColumn('password');
        dropColumn('name');
        dropColumn('user_name');
        dropColumn('signature');
        dropColumn('pro_img_path');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('attendance_id')->unsigned()->index();
            $table->text('message');
            $table->string('mailed_status');
            $table->string('read_status');
            // timestamp = date created

            $table->rememberToken();
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
        Schema::drop('notifications', function (Blueprint $table) {
            $table->dropForeign('notifications_user_id_foreign');            
        });
    }
}

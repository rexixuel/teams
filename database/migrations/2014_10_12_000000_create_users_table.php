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
            $table->string('first_name');
            $table->string('last_name');
            // comment out. use raw query for mediumblob
            // $table->binary('photo');
            $table->integer('emp_number')->unsigned()->unique();
            $table->integer('role')->unsigned()->index();
            $table->integer('job_description_id')->unsigned();
            $table->integer('job_class_id')->unsigned();
            $table->integer('supervisor_id')->unsigned()->nullable();
            $table->integer('num_lates')->unsigned();
            $table->decimal('rem_vl', 6, 4);
            $table->decimal('rem_sl', 6, 4);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // mediumblob for photos

        DB::statement("ALTER TABLE users ADD photo MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

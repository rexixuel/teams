<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){                    
            $table->foreign('job_description_id')->references('id')->on('job_descriptions');
            $table->foreign('job_class_id')->references('id')->on('job_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign('users_job_description_id_foreign');
            $table->dropForeign('users_job_class_id_foreign');
        });            
    }
}

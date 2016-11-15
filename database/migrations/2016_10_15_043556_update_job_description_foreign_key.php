<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateJobDescriptionForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_descriptions', function(Blueprint $table){        
            $table->foreign('job_class_id')->references('id')->on('job_classes')->onDelete('cascade');        //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_descriptions', function(Blueprint $table){
            $table->dropForeign('job_descriptions_job_class_id_foreign');
        });            
    }
}

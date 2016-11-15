<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateJobClassesBenefitForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_classes', function(Blueprint $table){        
            $table->foreign('benefit_id')->references('id')->on('benefits');        //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_classes', function(Blueprint $table){
            $table->dropForeign('job_classes_benefit_id_foreign');
        });            
    }
}

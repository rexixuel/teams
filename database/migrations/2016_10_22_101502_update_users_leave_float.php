<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersLeaveFloat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('users', function(Blueprint $table){        
        //     $table->dropColumn('rem_vl');
        //     $table->dropColumn('rem_sl');
        //     // $table->float('rem_vl');
        //     // $table->float('rem_sl');
        // });

        // Schema::table('leaves', function(Blueprint $table){        
        //     $table->dropColumn('num_days');
        //     // $table->float('num_days')->unsigned();
        // });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function(Blueprint $table){        
        //     $table->dropColumn('num_days');            
        //     // $table->integer('rem_vl');
        //     // $table->integer('rem_sl');
        // });

        // Schema::table('leaves', function(Blueprint $table){        
        //     $table->dropColumn('num_days');            
        //     // $table->integer('num_days')->unsigned();
        // });                
    }
}

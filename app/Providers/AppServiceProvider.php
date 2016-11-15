<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Leave;
use App\Holiday;
use App\Weekend;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {     

     Validator::extend('is_start_holiday', function($attribute, $value, $parameters, $validator) {
            $maxStartDate = 0;

            $table = new Holiday;            

            $maxStartDate = $table->where('start_date','<=',Carbon::parse($value))->max('start_date');
            $tableFirst = $table->where('start_date','=',$maxStartDate)->first();
                        
            $weekend = new Weekend;

            $weekendDay = Carbon::parse($value)->format('l');
            $weekendCount = $weekend->where('day','=',$weekendDay)->where('weekend','=',1)->count();

            if(!empty($weekendCount))
            {
                return false;
            }
            elseif(!empty($tableFirst)){

                if ($tableFirst->end_date >= Carbon::parse($value)){
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }     
            
        });

     Validator::extend('is_end_holiday', function($attribute, $value, $parameters, $validator) {
            $param1 = $parameters[0];

            $table = new Holiday;
            
            $numOfStartDateConflict = $table->where('start_date','<=',Carbon::parse($value))->where('start_date','>',Carbon::parse($param1) )->count();

            $weekend = new Weekend;

            $weekendDay = Carbon::parse($value)->format('l');
            $weekendCount = $weekend->where('day','=',$weekendDay)->where('weekend','=',1)->count();
            
            if(!empty($weekendCount))
            {
                return false;
            }                        
            if ($numOfStartDateConflict > 0){
                return false;
            }else{
                return true;
            }
            
        });     

     Validator::extend('is_unique_range', function($attribute, $value, $parameters, $validator) {
            $maxStartDate = 0;
            $tableName = $parameters[0];
                // $maxStartDate = Leave::where('start_date','<=',Carbon::parse($value))->max('start_date');
                // $tableFirst = Leave::where('start_date','=',$maxStartDate)->first();

            if($tableName == 'Leave')
            {
                $table = new Leave;
                $table = $table->where('status','!=','Rejected')->where('status','!=','Revoked');
            }
            elseif($tableName == 'Holiday')
            {
                $table = new Holiday;
            }
            
            $maxStartDate = $table->where('start_date','<=',Carbon::parse($value))->max('start_date');

            $tableFirst = $table->where('start_date','=',$maxStartDate)->first();                        

            // echo 'max start: '.$maxStartDate.'<br />';
            // echo 'request start: '.Carbon::parse($value).'<br />';
            // echo 'end date: '.$leaves->end_date.'<br />';
            // dd($leaves);
            if(!empty($tableFirst)){

                if ($tableFirst->end_date >= Carbon::parse($value)){
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }     
            
            // return $leaves->end_date >= Carbon::parse($value);
        });

     Validator::extend('is_unique_end_range', function($attribute, $value, $parameters, $validator) {

            $param1 = $parameters[0];
            $tableName = $parameters[1];

            if($tableName == 'Leave')
            {
                $table = new Leave;
                $table = $table->where('status','!=','Rejected')->where('status','!=','Revoked');
            }
            elseif($tableName == 'Holiday')
            {
                $table = new Holiday;
            }

            $numOfStartDateConflict = $table->where('start_date','<=',Carbon::parse($value))->where('start_date','>',Carbon::parse($param1) )->count();
            // dd($numOfStartDateConflict);     
            if ($numOfStartDateConflict > 0){
                return false;
            }else{
                return true;
            }
            
            // return $leaves->end_date >= Carbon::parse($value);
        });     
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    public function students(){
    	return $this->belongsTo('App\Student','student_id','id');
    }

    public function replys(){
      return $this->hasMany('App\Reaply','problem_id','id');
    }
}

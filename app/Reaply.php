<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaply extends Model
{
  public function problems(){
    return $this->hasMany('App\Problem','problem_id','id');
  }

  public function students(){
    return $this->belongsTo('App\Student','student_id','id');
  }
}

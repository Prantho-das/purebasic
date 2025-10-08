<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelexam extends Model
{
    public function modeltest(){
      return $this->belongsTo('App\Modeltest','modeltest_id','id');
    }
}

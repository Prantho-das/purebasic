<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function modeltest(){
      return $this->hasMany('App\Modeltest','subject','id');
    }
}

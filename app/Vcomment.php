<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vcomment extends Model
{
  public function videos(){
    return $this->belongsTo('App\Video');
  }

  public function visitor(){
    return $this->belongsTo('App\Visitor');
  }
}

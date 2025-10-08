<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LectureSheet extends Model
{

  public function chapter()
  {
      return $this->belongsTo('App\Chapter','cp_id','id');
  }


  public function batch()
  {
      return $this->hasMany('App\LectureBatch','lecture_id');
  }



}

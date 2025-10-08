<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
  public function user(){
    return $this->belongsTo('App\User');
  }

  public function favorite_to_video_visitor(){
    return $this->belongsToMany('App\Video')->withTimestamps();
  }
  public function vcomment(){
      return $this->hasMany('App\Vcomment');
  }

}

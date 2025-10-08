<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public function favorite_posts(){
    	return $this->belongsToMany('App\Post')->withTimestamps();
    	
    }

    public function comment(){
        return $this->hasMany('App\Comment');
    }
}

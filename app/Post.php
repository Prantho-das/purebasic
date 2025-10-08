<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function visitor(){
    	return $this->belongsTo('App\Visitor');
    }

    public function categories(){
    	return $this->belongsToMany('App\Category')->withTimestamps();
    }

    public function tags(){
    	return $this->belongsToMany('App\Tag')->withTimestamps();
    }


    public function favorite_to_visitor(){
    	return $this->belongsToMany('App\Visitor')->withTimestamps();
    }


    public function comment(){
        return $this->hasMany('App\Comment');
    }
}

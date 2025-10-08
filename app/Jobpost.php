<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobpost extends Model
{
    public function district(){
    	return $this->belongsTo('App\Distric','dist_id','id');
    }

}

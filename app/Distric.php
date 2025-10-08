<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distric extends Model
{
    public function jobs(){
    	return $this->hasMany('App\Jobpost','dist_id','id');
    }
    
}

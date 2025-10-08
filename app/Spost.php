<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spost extends Model
{
    public function categorys(){
        return $this->belongsTo('App\Seba','cat_id','id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
  public function batch(){
    return $this->belongsTo('App\Membership','batch_id','id');
  }
}

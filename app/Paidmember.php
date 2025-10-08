<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paidmember extends Model
{
    public function membership(){
      return $this->belongsTo('App\Membership','batch_id','id');
    }

    public function students(){
    return $this->belongsTo('App\Student','student_id','id');
  }

    public function batch(){
        return $this->belongsTo('App\Membership','batch_id','id');
    }

    public function BatchStudent()
    {
        return $this->belongsTo('App\Membership', 'batch_id');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded=[];
    public function membership(){
      return $this->belongsTo('App\Membership','batch_id','id');
    }

    public function course()
    {
        return $this->hasMany('App\BatchStudent','student_id');
    }

    public function batch()
    {
        return $this->hasMany('App\BatchStudent','student_id');
    }

    public function getPhotoAttribute($value)
    {

        if(!empty($value))
           return asset('uploads/user/'.$value);
        else
           return asset('uploads/user/profile.jpg');

    }
}

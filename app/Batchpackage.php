<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batchpackage extends Model
{
    //

    public function batch()
    {
        return $this->belongsTo('App\Membership');
    }

    public function getCoverImageAttribute($value)
    {

        if(!empty($value))
            return asset('uploads/user/'.$value);
        else
            return null;

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchStudent extends Model
{
    //

    public function course()
    {
        return $this->belongsTo('App\Membership','batch_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Student','student_id');
    }

    public function duration()
    {
        return $this->belongsTo('App\batch_duration', 'bd_batch_id');
    }
}

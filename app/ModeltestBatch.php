<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeltestBatch extends Model
{
    public function modeltest(){
        return $this->hasOne(Modeltest::class, 'id', 'modeltest_id', 'lecture_id');
    }
}

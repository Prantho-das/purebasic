<?php

namespace App;
use App\Question;
use Illuminate\Database\Eloquent\Model;
use App\Membership;

class Modeltest extends Model
{
	protected $table = 'modeltests';

    public function questions(){
		return $this->hasMany(Question::class);
	}

	public function batch()
    {
        return $this->belongsToMany('App\Membership', 'modeltest_batches', 'modeltest_id', 'membershipe_id');
    }
}

<?php

namespace App;
use App\Option;
use App\Modeltest;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = array('question','modeltest_id','is_multi','created_at','updated_at');

    public function options(){
		return $this->hasMany(Option::class);
	}
	public function modeltest(){
    	return $this->belongsTo(Modeltest::class,'modeltest_id');
    }

}

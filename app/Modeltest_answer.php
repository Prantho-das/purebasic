<?php

namespace App;
use App\Question;
use App\Modeltest_answer_detail;
use Illuminate\Database\Eloquent\Model;

class Modeltest_answer extends Model
{
	protected $table = 'modeltest_answers';
	public $timestamps = false;
	protected $fillable = ['student_id', 'modeltest_id', 'created_at'];

	public function answer_details(){
		return $this->hasMany(Modeltest_answer_detail::class);
	}

	public function students(){
    	return $this->belongsTo('App\Student','student_id','id');
    }

    	public function student(){
    	return $this->hasMany('App\Student','id','student_id');
    }

    public function modeltest()
    {
        return $this->belongsTo('App\Modeltest');
    }
}

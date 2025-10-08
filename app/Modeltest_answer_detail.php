<?php

namespace App;
use App\Question;
use App\Modeltest_answer;
use App\Option;
use Illuminate\Database\Eloquent\Model;

class Modeltest_answer_detail extends Model
{
	protected $table = 'modeltest_answer_details';
 //    public function questions(){
	// 	return $this->hasMany(Question::class);
	// }
	// public function options(){
	// 	return $this->hasMany(Option::class);
	// }
	public function answer(){
		return $this->belongsTo(Modeltest_answer::class,'modeltest_answer_id');
	}
	public function question(){
		return $this->belongsTo(Question::class,'question_id');
	}
	public function selected_option(){
		return $this->belongsTo(Option::class,'answered_option_id');
	}
	public function correct_option(){
		return $this->belongsTo(Option::class,'right_option_id');
	}
}

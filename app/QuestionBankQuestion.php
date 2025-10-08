<?php

namespace App;
use App\QuestionBankOption;
use App\QuestionBank;
use Illuminate\Database\Eloquent\Model;

class QuestionBankQuestion extends Model
{
    protected $fillable = array('question','question_bank_id','is_multi','created_at','updated_at');

    public function options(){
		return $this->hasMany(QuestionBankOption::class);
	}
	public function modeltest(){
    	return $this->belongsTo(QuestionBank::class,'question_bank_id');
    }

}

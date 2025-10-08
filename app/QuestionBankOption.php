<?php

namespace App;
use App\QuestionBankQuestion;
use Illuminate\Database\Eloquent\Model;

class QuestionBankOption extends Model
{
    public function question(){
    	return $this->belongsTo(QuestionBankQuestion::class,'question_id');
    }
}

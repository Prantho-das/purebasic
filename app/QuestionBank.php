<?php

namespace App;
use App\QuestionBankQuestion;
use Illuminate\Database\Eloquent\Model;
use App\Membership;

class QuestionBank extends Model
{
	protected $table = 'question_bank_groups';

    public function questions(){
		return $this->hasMany(QuestionBankQuestion::class);
	}

	public function batch()
    {
        return $this->belongsToMany('App\Membership', 'modeltest_batches', 'question_bank_id', 'membershipe_id');
    }
}

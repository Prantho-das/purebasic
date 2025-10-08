<?php

namespace App\Http\Controllers\Api;

use App\AttentModeltest;
use App\BatchStudent;
use App\Membership;
use App\Modelexam;
use App\Modeltest;
use App\Modeltest_answer;
use App\Modeltest_answer_detail;
use App\ModeltestBatch;
use App\Option;
use App\Question;
use App\Traits\ApiResponse;
use http\Env\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function Sodium\add;

class ExamController extends Controller
{
    use ApiResponse;
    public function spacialmodeltest(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'student_id' => ['required'],
            'type' => ['required']
        ]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $id = $request->input('student_id');
        $type = $request->input('type');

        if($type == 'bcs-exam'){
            $type = 'BCS';
        }else{
            $type = 'Regular Exam';
        }

        $batch_ids=BatchStudent:: where('student_id',$id)->where('enroll_status',1)->select('batch_id')->get();
        if(empty($batch_ids))
            return $this->respondWithError('You have no enroll course');


        $batch_ids_array = $batch_ids->pluck('batch_id');
        $modeltestBatch = ModeltestBatch::whereIn('membershipe_id',$batch_ids_array)->orderBy('membershipe_id','desc')->get();

        if(empty($modeltestBatch))
            return $this->respondWithError('No Model test available');


        $modelTestIds = $modeltestBatch->pluck('modeltest_id');
        $exams_raw = Modeltest::whereIn('id',$modelTestIds)->where('exam_type',$type)->orderBy('id','desc')->get();
        $attendent_exam_list = Modeltest_answer::where('student_id',$id)->where('action_status',1)->pluck('modeltest_id');

        if(!empty($attendent_exam_list))
        {
            $attendent_exam_list=$attendent_exam_list->toArray();
        }else{
            $attendent_exam_list=[];
        }

        $exams=[];
        foreach($exams_raw as $exam_raw)
        {
            $batch_name = [];
            foreach($exam_raw->batch as $exam_batch)
            {
                if(in_array($exam_batch->id, $batch_ids_array->toArray()))
                {
                    $batch_name[]=$exam_batch->plan;
                }
            }

            if(!empty($batch_name))
            {
                $exam_raw->batch_name = implode(',',$batch_name);
            }else{
                $exam_raw->batch_name ='';
            }
            //Is already taken
            if(in_array($exam_raw->id,$attendent_exam_list))
            {
                $exam_raw->already_taken = true;
            }else{
                $exam_raw->already_taken = false;
            }
            $exams[]=$exam_raw;
        }

       return $this->respondWithSuccess('Exam List',$exams);
    }

    public function examByBatch(Request $request, $batch_id)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => ['required'],
        ]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $id= $request->input('student_id');

        $batch_info = Membership::find($batch_id);
        if(empty($batch_info))
            return $this->respondWithError('Batch not found');


        $batch_ids = BatchStudent::where('student_id',$id)->where('batch_id',$batch_id)->where('enroll_status',1)->select('batch_id')->first();
        if(empty($batch_ids))
            return $this->respondWithError('No course found');


        $modeltestBatch = ModeltestBatch::where('membershipe_id',$batch_id)->orderBy('membershipe_id','desc')->get();
        if(empty($modeltestBatch))
            return $this->respondWithError('No Model test available');

        $modelTestIds = $modeltestBatch->pluck('modeltest_id');
        $exams_raw=Modeltest::whereIn('id',$modelTestIds)->orderBy('id','desc')->get();

        $attendent_exam_list = Modeltest_answer::where('student_id',$id)->where('action_status',1)->pluck('modeltest_id');

        if(!empty($attendent_exam_list))
        {
            $attendent_exam_list=$attendent_exam_list->pluck('modeltest_id')->toArray();
        }else{
            $attendent_exam_list=[];
        }

        $exams=[];
        foreach($exams_raw as $exam_raw)
        {
            //Is already taken
            if(in_array($exams_raw,$attendent_exam_list))
            {
                $exam_raw->already_taken = true;
            }else{
                $exam_raw->already_taken = false;
            }
            $exams[]=$exam_raw;
        }

        return $this->respondWithSuccess('Exam List',$exams);
    }



    public function question(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => ['required'],
        ]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $login_id=$request->input('student_id');

        $modelTest = Modeltest::find($id);
        if(empty($modelTest))
            return $this->respondWithError('Model Test Not found');

        $batch_ids = BatchStudent:: where('student_id',$login_id)->where('enroll_status',1)->select('batch_id')->get();
        if(empty($batch_ids))
            return $this->respondWithError('You have no enroll course');


        $batch_ids_array = $batch_ids->pluck('batch_id');
        $modeltestBatch = ModeltestBatch::whereIn('membershipe_id',$batch_ids_array)->where('modeltest_id',$id)->first();
        if(empty($modeltestBatch))
            return $this->respondWithError('Not a valid request');


        AttentModeltest::updateOrCreate([
            'student_id' => $login_id,
            'modeltest_id' => $id,
        ]);


        $exam = Modelexam:: where('status', 1)->where('modeltest_id', $id)->get();


        $student = $login_id;
        $modeltest_exite = Modeltest_answer::where('modeltest_id', $modelTest->id)->where('student_id', $student)->first();

        if ($modeltest_exite) {
            if($modeltest_exite && $modeltest_exite->action_status == 1){
                return $this->respondWithError('You have already taken this test. Please see the result');
            }
        }

        $answer_array = [
            'student_id' => $login_id,
            'modeltest_id' => $id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        Modeltest_answer::updateOrCreate($answer_array);

        //All Question with options
        $questions = Question::with('options')->where('modeltest_id',$id)->get();
        if(empty($questions))
            return $this->respondWithError('No questions found');

        return $data = [
            'test_info'=>$modelTest,
            'questions'=>$questions
        ];

        return $this->respondWithSuccess('All question',$data);
    }

    public function answerQuestionModeltest(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'student_id' => ['required'],
            'modeltest_exam_type' => ['required'],
            'modeltest_id' => ['required'],
            'question' => ['required'],
        ]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $student_id =$request->student_id;
        $model_test_exam_type = $request->modeltest_exam_type;
        $exam_id = $request->modeltest_id;
        $questions = $request->question;

        $questions = json_decode($questions,true);

        $totalQuestions = count($questions);

        $answer = Modeltest_answer::where('student_id', $student_id)->where('modeltest_id', $exam_id)->first()->id;

        if($model_test_exam_type == "BCS"){
            $answered = 0;
            $unanswered = 0;
            $right = 0;
            $point = 0;
            $totalPoint = 0;
            $wrong = 0;
            $totaluncheck_count = 0;

            foreach ($questions as $key => $question) {

                if (array_key_exists('option', $question)) {
                    $answered++;
                } else {
                    $unanswered++;
                }

                $question_id_check = Question::where('id', $question['questionId'])->first();
                if ($question_id_check->is_multi == 1) {
                    $uncheck = Option::where('question_id', $question['questionId'])->where('correct_or_not', 0)->get();
                    $uncheck_count = Option::where('question_id', $question['questionId'])->where('correct_or_not', 0)->count();

                    foreach ($uncheck as $key => $addPoint) {
                        if (array_key_exists('option', $question)) {
                            foreach ($question['option'] as $key => $option) {
                                if ($option == $addPoint->id) {
                                    $uncheck_count -= 1;
                                }
                            }
                        }
                    }
                    $uncheck_count *= .4;
                    $totaluncheck_count = $totaluncheck_count + $uncheck_count;
                }


                if (array_key_exists('option', $question)) {
                    foreach ($question['option'] as $key => $option) {

                        $option_id = Option::where('question_id', $question['questionId'])->where('id', $option)->first();

                        if ($option_id->correct_or_not == 1) {
                            if ($question_id_check->is_multi == 1) {
                                $point = $point + .4;
                            } else {
                                $point = $point + 1;
                            }
                            $right++;
                        } else {
                            $wrong++;
                        }


                        $answer_details_array = [
                            'modeltest_id' => $request->modeltest_id,
                            'modeltest_answer_id' => $answer,
                            'question_id' => $question['questionId'],
                            'answered_option_id' => $option,
                            'right_option_id' => 0,
                        ];
                        $answer_detail = Modeltest_answer_detail::insert($answer_details_array);
                    }
                } else {
                    $wrong++;
                }

            }
            $point = $point + $totaluncheck_count;
            $point = $point - (0.5* $wrong);

            // return $point;
            $answer_array_for_update = [
                'total_questions' => $totalQuestions,
                'answered_questions' => $answered,
                'unanswered_questions' => $unanswered,
                'right_answers' => $right,
                'point' => $point,
                'wrong_answers' => $wrong,
                'action_status' => 1
            ];
            Modeltest_answer::where('id', $answer)->update($answer_array_for_update);
        }else {
            $answered = 0;
            $unanswered = 0;
            $right = 0;
            $point = 0;
            $totalPoint = 0;
            $wrong = 0;
            $totaluncheck_count = 0;


            foreach ($questions as $key => $question) {

                if (array_key_exists('option', $question)) {
                    $answered++;
                } else {
                    $unanswered++;
                }

                $question_id_check = Question::where('id', $question['questionId'])->first();

                if ($question_id_check->is_multi == 1) {
                    $uncheck = Option::where('question_id', $question['questionId'])->where('correct_or_not', 0)->get();
                    $uncheck_count = Option::where('question_id', $question['questionId'])->where('correct_or_not', 0)->count();

                    foreach ($uncheck as $key => $addPoint) {
                        if (array_key_exists('option', $question)) {
                            foreach ($question['option'] as $key => $option) {
                                if ($option == $addPoint->id) {
                                    $uncheck_count -= 1;
                                }
                            }
                        }
                    }
                    $uncheck_count *= .4;
                    $totaluncheck_count = $totaluncheck_count + $uncheck_count;
                }

                if (array_key_exists('option', $question)) {
                    foreach ($question['option'] as $key => $option) {

                        $option_id = Option::where('question_id', $question['questionId'])->where('id', $option)->first();

                        if ($option_id->correct_or_not == 1) {
                            if ($question_id_check->is_multi == 1) {
                                $point = $point + .4;
                            } else {
                                $point = $point + 2;
                            }
                            $right++;
                        } else {
                            $wrong++;
                        }


                        $answer_details_array = [
                            'modeltest_id' => $request->modeltest_id,
                            'modeltest_answer_id' => $answer,
                            'question_id' => $question['questionId'],
                            'answered_option_id' => $option,
                            'right_option_id' => 0,
                        ];
                        $answer_detail = Modeltest_answer_detail::insert($answer_details_array);
                    }
                } else {
                    $wrong++;
                }

            }
            $point = $point + $totaluncheck_count;

            // return $point;
            $answer_array_for_update = [
                'total_questions' => $totalQuestions,
                'answered_questions' => $answered,
                'unanswered_questions' => $unanswered,
                'right_answers' => $right,
                'point' => $point,
                'wrong_answers' => $wrong,
                'action_status' => 1
            ];
            Modeltest_answer::where('id', $answer)->update($answer_array_for_update);
        }
        // return $request;
        //return redirect('seeAnswerResult/' . $answer);
        $final_answer = Modeltest_answer::find($answer);
        return $this->respondWithSuccess('seeAnswerResult', $final_answer);
    }

    public function seeAnswerResult(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => ['required'],
            'modeltest_id' => ['required']
        ]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $student_id =$request->student_id;
        $exam_id = $request->modeltest_id;

        $answer = Modeltest_answer::where('student_id', $student_id)->where('modeltest_id', $exam_id)->first();
        $answer_option_details = Modeltest_answer_detail::where('modeltest_answer_id',$answer->id)->get();


        $all_answered_option=[];
        if(!empty($answer_option_details))
        {
           foreach($answer_option_details as $value)
           {
               $all_answered_option[$value->question_id][$value->answered_option_id]=true;
           }
        }


        $exam_info = Modeltest::with(['questions','questions.options'])->find($request->modeltest_id);

        $exam_info = $exam_info->toArray();

        $questions = $exam_info['questions'];

        $processed_questions =[];

        foreach($questions as $question)
        {
            $options=$question['options'];

            $process_option=[];
            $correct_answer=[];
            foreach($options as $option)
            {
                if($option['correct_or_not']==1)
                {
                    $correct_answer[]=$option['option'];
                }

                if(isset($all_answered_option[$option['question_id']][$option['id']]))
                {
                    $option['is_answered']=1;
                }else{
                    $option['is_answered']=0;
                }
                $process_option[]=$option;
            }

            $question['options']=$process_option;
            $question['correct_answer']=empty($correct_answer)? null : $correct_answer ;
            $processed_questions[] = $question;
        }
        $exam_info['questions']=$processed_questions;
        $answer->total_mark = $exam_info['exam_in_minutes'];

//        $modelTestAnswer = Modeltest_answer::with('modeltest')->where('id', $answer_id)->get()->first();
        return $this->respondWithSuccess('All answer list', ['result'=>$answer,'exam_info'=>$exam_info]);
    }

    public function point()
    {
        $modeltest = Modeltest:: where('status',1)->paginate(10);
        return $this->respondWithSuccess('Test list with result', $modeltest);
    }

    public function point_lint($id)
    {
        $point= Modeltest_answer::with('students')->where('modeltest_id', $id)->orderBy('point', 'desc')->paginate(10)->toArray();

        $data = $point['data'];
        $process_data=[];
        foreach($data as $key=>$value)
        {
            $value['rank']=(($point['current_page']-1) * $point['per_page'])+1+$key;
            $process_data[]=$value;
        }
        $point['data']=$process_data;
        return $this->respondWithSuccess('Result Rank', $point);
    }

    public function my_exam_history(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => ['required']
        ]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $student_id =$request->student_id;

        $point=Modeltest_answer::with('modeltest')->where('student_id',$student_id)->orderBy('id','desc')->paginate(10)->toArray();
        return $this->respondWithSuccess('Result Rank', $point);

    }

    public function studentProfileResult($id)
    {
            $batchResult = DB::table('modeltest_answers as a')
                ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                ->leftJoin('memberships as m', 'b.membershipe_id', '=', 'm.id')
                ->where('a.student_id', $id)
                ->distinct()
                ->select('b.membershipe_id', 'm.plan')
                ->get();
            $batchCount = $batchResult->count();

            if ($batchCount > 0) {

                foreach ($batchResult as $batch) {
                    $quizMark = \Illuminate\Support\Facades\DB::table('modeltest_answers as a')
                        ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                        ->where('a.student_id', $id)
                        ->where('b.lecture_id', '!=', null)
                        ->where('b.membershipe_id', $batch->membershipe_id)
                        ->sum('point');

                    $quizOut = DB::table('modeltest_answers as a')
                        ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                        ->leftJoin('modeltests as m', 'b.modeltest_id', '=', 'm.id')
                        ->where('a.student_id', $id)
                        ->where('b.lecture_id', '!=', null)
                        ->where('b.membershipe_id', $batch->membershipe_id)
                        ->sum('exam_in_minutes');

                    $lectureMark = DB::table('modeltest_answers as a')
                        ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                        ->where('a.student_id', $id)
                        ->where('b.lecture_id', '=', null)
                        ->where('b.membershipe_id', $batch->membershipe_id)
                        ->sum('point');

                    $examOut = \Illuminate\Support\Facades\DB::table('modeltest_answers as a')
                        ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                        ->leftJoin('modeltests as m', 'b.modeltest_id', '=', 'm.id')
                        ->where('a.student_id', $id)
                        ->where('b.lecture_id', '=', null)
                        ->where('b.membershipe_id', $batch->membershipe_id)
                        ->sum('exam_in_minutes');

                    $videoMark = DB::table('watch_count')
                            ->where('batch_id', $batch->membershipe_id)
                            ->where('user_id', $id)
                            ->count('id') * 2;

                    $profileMarks[] = array('plan' => $batch->plan, 'quiz' => $quizMark, 'quizout' => $quizOut, 'exam' => $lectureMark, 'examout' => $examOut, 'video' => $videoMark);
                }
            }
            else
            {
                $profileMarks[] = array(['status' => 'No Result Found']);
            }

            return $this->respondWithSuccess('profile result', $profileMarks);
    }

}

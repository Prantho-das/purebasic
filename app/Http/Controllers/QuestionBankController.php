<?php

namespace App\Http\Controllers;

use App\Membership;
use App\QuestionBank;
use App\ModeltestBatch;
use App\QuestionBankOption;
use App\QuestionBankQuestion;
use App\Category;
use App\Chapter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class QuestionBankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

// all model test
    public function question_bank()
    {
        $model = QuestionBank:: where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.question_bank.all', compact('model'));
    }

    // questions
    public function all_questions($id)
    {
        $group = QuestionBank:: where('id', $id)->get();
        $question = QuestionBankQuestion::where('question_bank_id', $id)->get();
        return view('admin.question_bank_question.all', compact('question', 'id', 'group'));
    }


    public function add_questions($id)
    {
        $model = QuestionBank::where('status', 1)->where('id', $id)->first();
        return view('admin.question_bank_question.add', compact('model'));
    }

    public function add_submit_questions(Request $request, $id)
    {
        // return $request;
        $data = [];
        $data['question'] = $request->name;
        $data['detailss'] = $request->detailss;
        $data['solve_link'] = $request->solve_link;
        $data['question_bank_id'] = $id;
        $data['type'] = $request->type;
        $data['subject_id'] = $request->subject_id;
        $data['subject'] = $request->subject;
        $data['chapter_id'] = $request->chapter_id;
        $data['chapter'] = $request->chapter;

        $data['is_multi'] = (bool)$request->is_multi;
        $data['is_free'] = (bool)$request->is_free;

        $create = QuestionBankQuestion::insertGetId($data);
        foreach ($request->option as $key => $data) {
            $curre = 0;
            if (isset($data['correct'])) {
                $curre = 1;
            }
            QuestionBankOption::insert([
                'question_id' => $create,
                'question_bank_id' => $id,
                'option' => $data['option'],
                'correct_or_not' => $curre,
            ]);
        }


        if ($create) {
            session()->flash('success', 'value');
            return redirect()->back()->with('success', 'Successfully Added!!');
        } else {
            return redirect()->back()->with('error', 'Please try again!');
        }
    }


    public function edit_questions($id)
    {
        $data = QuestionBankQuestion::where('id', $id)->first();
        return view('admin.question_bank_question.edit', compact('data', 'id'));
    }


    public function edit_submit_questions(Request $request, $id)
    {
        $que = QuestionBankQuestion::where('id', $id)->first();
        $mult = $request->is_multi;
        $free = $request->is_free;

        $data = [];
        $data['question'] = $request->name;
        $data['detailss'] = $request->detailss;
        $data['solve_link'] = $request->solve_link;
        $data['question_bank_id'] = $que->question_bank_id;

        if (isset($mult)) {
            $data['is_multi'] = 1;
        } else {
            $data['is_multi'] = 0;
        }

        if (isset($free)) {
            $data['is_free'] = 1;
        } else {
            $data['is_free'] = 0;
        }

        $create = QuestionBankQuestion::where('id', $id)->update($data);

        QuestionBankOption::where('question_id', $id)->delete();

        foreach ($request->option as $key => $data) {
            $curre = 0;
            if (isset($data['correct'])) {
                $curre = 1;
            }
            QuestionBankOption::insert([
                'question_id' => $que->id,
                'question_bank_id' => $que->question_bank_id,
                'option' => $data['option'],
                'correct_or_not' => $curre,
            ]);
        }
        if ($create) {
            session()->flash('edit', 'value');
            return redirect()->back()->with('success', 'Successfully Edited!!');
        } else {
            return redirect()->back()->with('error', 'Please try again!');
        }
    }


    // option

    public function delete_questions($id)
    {
        $data = QuestionBankQuestion::where('id', $id)->delete();
        $deleteOption = QuestionBankOption::where('question_id', $id)->delete();

        if ($data && $deleteOption) {
            session()->flash('delete', 'Question Deleted');
            return back();
        } else {
            return back();
        }
    }

    public function edit_option($id)
    {
        $option = Option::where('id', $id)->first();
        return view('admin.option.edit', compact('option', 'id'));
    }


    public function update_option(Request $request, $id)
    {
        $curre = $request->is_curract;

        $data = [];
        $data['option'] = $request->name;

        if (isset($curre)) {
            $data['correct_or_not'] = 1;
        } else {
            $data['correct_or_not'] = 0;
        }

        $create = Option::where('id', $id)->update($data);
        if ($create) {
            session()->flash('edit', 'value');
            return redirect()->back()->with('success', 'Successfully Added!!');
        } else {
            return redirect()->back()->with('error', 'Please try again!');
        }

    }

    public function add_option($id)
    {
        return view('admin.option.add', compact('id'));
    }

    public function add_submit_option(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:190',
        ]);

        $question = Question::where('id', $id)->first();
        if ($question->is_multi == 0) {
            $find_correct = Option::where('question_id', $question->id)->where('correct_or_not', 1)->first();
            if ($find_correct) {
                $create = Option::insert([
                    'option' => $request->name,
                    'question_id' => $id,
                    'question_bank_id' => $question->question_bank_id,
                    'correct_or_not' => 0,
                    'created_at' => Carbon:: now()->toDateTimeString(),
                ]);

                if ($create) {
                    session()->flash('success', 'value');
                    return redirect()->back()->with('success', 'Successfully Added!!');
                } else {
                    return redirect()->back()->with('error', 'Please try again!');
                }
            } else {
                $create = Option::insert([
                    'option' => $request->name,
                    'question_id' => $id,
                    'question_bank_id' => $question->question_bank_id,
                    'correct_or_not' => (bool)$request->is_curract,
                    'created_at' => Carbon:: now()->toDateTimeString(),
                ]);

                if ($create) {
                    return redirect()->back()->with('success', 'Successfully Added!!');
                } else {
                    return redirect()->back()->with('error', 'Please try again!');
                }
            }
        } else {
            $create = Option::insert([
                'option' => $request->name,
                'question_id' => $id,
                'question_bank_id' => $question->question_bank_id,
                'correct_or_not' => (bool)$request->is_curract,
                'created_at' => Carbon:: now()->toDateTimeString(),
            ]);

            if ($create) {
                return redirect()->back()->with('success', 'Successfully Added!!');
            } else {
                return redirect()->back()->with('error', 'Please try again!');
            }
        }

    }


    public function addQuestionsToTest(Request $request)
    {
        if ($request->question && count($request->question) > 0) {
            $validate_questions_options = $this->validateQuestionsOptions();
            if ($validate_questions_options->fails()) {
                return redirect()->back()->withErrors($validate_questions_options)->withInput();
            }
            Question::where('question_bank_id', $request->question_bank_id)->delete();
            Option::where('question_bank_id', $request->question_bank_id)->delete();
            $i = 0;
            foreach ($request->question as $single_question) {
                $question_array = array(
                    'question_bank_id' => $request->question_bank_id,
                    'question' => $request->question[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $question = Question::create($question_array);
                $question_id = $question->id;
                $options = [
                    [
                        'question_id' => $question_id,
                        'question_bank_id' => $request->question_bank_id,
                        'option' => $request->option1[$i],
                        'correct_or_not' => ($request->right_option[$i] == '1') ? 1 : 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ],
                    [
                        'question_id' => $question_id,
                        'question_bank_id' => $request->question_bank_id,
                        'option' => $request->option2[$i],
                        'correct_or_not' => ($request->right_option[$i] == '2') ? 1 : 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ],
                    [
                        'question_id' => $question_id,
                        'question_bank_id' => $request->question_bank_id,
                        'option' => $request->option3[$i],
                        'correct_or_not' => ($request->right_option[$i] == '3') ? 1 : 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ],
                    [
                        'question_id' => $question_id,
                        'question_bank_id' => $request->question_bank_id,
                        'option' => $request->option4[$i],
                        'correct_or_not' => ($request->right_option[$i] == '4') ? 1 : 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                ];
                Option::insert($options);
                $i++;

            }
            return redirect()->back()->with('success', 'Successfully Added!!');
        } else {
            return redirect()->back()->with('error', 'Please Add Some Questions!!');
        }
    }

    public function getLectures(Request $request)
    {
        $lectureData = DB::table('lecture_batches as lb')
            ->leftJoin('lecture_sheets as ls', 'lb.lecture_id', '=', 'ls.id')
            ->select('ls.id', 'ls.title')
            ->where('lb.membershipe_id', '=', $request->batch_id)
            ->orderBy('ls.id', 'desc')
            ->get();

        if (count($lectureData) > 0)
        {
            return response()->json($lectureData);
        }
    }

    public function addmodel()
    {
        $subject = Category:: where('status', 1)->orderBy('id', 'asc')->get();
        $memberbatch = Membership::where('status', 1)->get();


        return view('admin.question_bank.add', compact('subject', 'memberbatch'));
    }

    public function modelUploads(Request $request)
    {
        $data = [];
        $data['type'] = $request->type;
        $data['subject_id'] = $request->subject;
        $data['subject'] = Category::where('id', $request->subject)->value('name');
        $data['chapter_id'] = $request->chapter;
        $data['chapter'] = Chapter::where('id', $request->chapter)->where('cat_id', $request->subject)->value('name');
        $data['name'] = $request->name;
        $data['serial'] = $request->serial;
        $data['created_at'] = Carbon:: now()->toDateTimeString();

        $model = QuestionBank::insertGetId($data);

        if ($model) {
            session()->flash('success', 'value');
            return redirect('/admin/question_bank');
        } else {
            return back();
        }
    }

    public function viewtest($id)
    {
        $data = QuestionBank::where('status', 1)->where('id', $id)->first();
        return view('admin.question_bank.view', compact('data'));
    }

    public function edittest($id)
    {
        $data = QuestionBank::where('status', 1)->where('id', $id)->first();
        $memberbatch = Membership::where('status', 1)->get();
        return view('admin.question_bank.edit', compact('data', 'memberbatch'));
    }

    public function testUpdate(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data['type'] = $request->type;
        $data['name'] = $request->name;
        $data['subject_id'] = $request->subject;
        $data['subject'] = Category::where('id', $request->subject)->value('name');
        $data['chapter_id'] = $request->chapter;
        $data['chapter'] = Chapter::where('id', $request->chapter)->where('cat_id', $request->subject)->value('name');
        $data['serial'] = $request->serial;

        $update = QuestionBank::where('id', $id)->update($data);

        if ($update) {
            session()->flash('update', 'value');
            return redirect('/admin/question_bank');
        } else {
            session()->flash('error', 'value');
            return back();
        }
    }

    public function deletetest($id)
    {
        $delete = QuestionBank::where('status', 1)->where('id', $id)->delete();
        if ($delete) {
            session()->flash('delete', 'value');
            return back();
        } else {
            session()->flash('error', 'value');
            return back();
        }
    }

    public function validateQuestionsOptions()
    {
        return Validator::make(request()->all(), [
            'question_bank_id' => ['required'],
            'question' => ['required'],
            'question.*' => ['required'],
            'option1' => ['required'],
            'option1.*' => ['required'],
            'option2' => ['required'],
            'option2.*' => ['required'],
            'option3' => ['required'],
            'option3.*' => ['required'],
            'option4' => ['required'],
            'option4.*' => ['required'],
            'right_option' => ['required'],
            'right_option.*' => ['required']
        ],
            [
                'question.required' => 'Question is required.',
                'option1.required' => 'Options are required.',
                'option2.required' => 'Options are required.',
                'option3.required' => 'Options are required.',
                'option4.required' => 'Options are required.',
                'right_option.required' => 'Right options are required.',

                'question.*.required' => 'Fill the questions.',
                'option1.*.required' => 'Fill the options.',
                'option2.*.required' => 'Fill the options.',
                'option3.*.required' => 'Fill the options.',
                'option4.*.required' => 'Fill the options.',
                'right_option.*.required' => 'Select Right option.',
            ]);
    }
    
    public function solve($id)
    {

        $modelTest = QuestionBank::find($id) ?? abort(404);
        
        return view('admin.question_bank.question_answer', compact('modelTest'));


    }
    
    
}

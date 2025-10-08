<?php

namespace App\Http\Controllers;

use App\Membership;
use App\Modeltest;
use App\ModeltestBatch;
use App\Option;
use App\Question;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ModeltestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

// all model test
    public function allmodel()
    {
        $model = Modeltest:: where('status', 1)->where('subject', NULL)->orderBy('id', 'desc')->get();
        return view('admin.modeltest.all', compact('model'));
    }

    // questions
    public function all_questions($id)
    {
        $question = Question::where('modeltest_id', $id)->get();
        return view('admin.question.all', compact('question', 'id'));
    }


    public function add_questions($id)
    {
        $model = Modeltest:: where('status', 1)->where('id', $id)->first();
        return view('admin.question.add', compact('model'));
    }

    public function add_submit_questions(Request $request, $id)
    {
        // return $request;
        $data = [];
        $data['question'] = $request->name;
        $data['detailss'] = $request->detailss;
        $data['solve_link'] = $request->solve_link;
        $data['modeltest_id'] = $id;
        $data['is_multi'] = (bool)$request->is_multi;

        $create = Question::insertGetId($data);
        foreach ($request->option as $key => $data) {
            $curre = 0;
            if (isset($data['correct'])) {
                $curre = 1;
            }
            Option::insert([
                'question_id' => $create,
                'modeltest_id' => $id,
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
        $data = Question::where('id', $id)->first();
        return view('admin.question.edit', compact('data', 'id'));
    }


    public function edit_submit_questions(Request $request, $id)
    {
        $que = Question::where('id', $id)->first();
        $mult = $request->is_multi;

        $data = [];
        $data['question'] = $request->name;
        $data['detailss'] = $request->detailss;
        $data['solve_link'] = $request->solve_link;
        $data['modeltest_id'] = $que->modeltest_id;

        if (isset($mult)) {
            $data['is_multi'] = 1;
        } else {
            $data['is_multi'] = 0;
        }


        $create = Question::where('id', $id)->update($data);

        Option::where('question_id', $id)->delete();

        foreach ($request->option as $key => $data) {
            $curre = 0;
            if (isset($data['correct'])) {
                $curre = 1;
            }
            Option::insert([
                'question_id' => $que->id,
                'modeltest_id' => $que->modeltest_id,
                'option' => $data['option'],
                'correct_or_not' => $curre,
            ]);
        }
        if ($create) {
            session()->flash('edit', 'value');
            return redirect()->back()->with('success', 'Successfully Eidt!!');
        } else {
            return redirect()->back()->with('error', 'Please try again!');
        }
    }


    // option

    public function delete_questions($id)
    {
        $data = Question::where('id', $id)->delete();
        if ($data) {
            session()->flash('delete', 'value');
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
                    'modeltest_id' => $question->modeltest_id,
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
                    'modeltest_id' => $question->modeltest_id,
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
                'modeltest_id' => $question->modeltest_id,
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
            Question::where('modeltest_id', $request->modeltest_id)->delete();
            Option::where('modeltest_id', $request->modeltest_id)->delete();
            $i = 0;
            foreach ($request->question as $single_question) {
                $question_array = array(
                    'modeltest_id' => $request->modeltest_id,
                    'question' => $request->question[$i],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $question = Question::create($question_array);
                $question_id = $question->id;
                $options = [
                    [
                        'question_id' => $question_id,
                        'modeltest_id' => $request->modeltest_id,
                        'option' => $request->option1[$i],
                        'correct_or_not' => ($request->right_option[$i] == '1') ? 1 : 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ],
                    [
                        'question_id' => $question_id,
                        'modeltest_id' => $request->modeltest_id,
                        'option' => $request->option2[$i],
                        'correct_or_not' => ($request->right_option[$i] == '2') ? 1 : 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ],
                    [
                        'question_id' => $question_id,
                        'modeltest_id' => $request->modeltest_id,
                        'option' => $request->option3[$i],
                        'correct_or_not' => ($request->right_option[$i] == '3') ? 1 : 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ],
                    [
                        'question_id' => $question_id,
                        'modeltest_id' => $request->modeltest_id,
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
        $subject = Subject:: where('status', 1)->orderBy('id', 'asc')->get();
        $memberbatch = Membership::where('status', 1)->get();


        return view('admin.modeltest.add', compact('subject', 'memberbatch'));
    }

    public function modelUploads(Request $request)
    {
        $data = [];
        $data['exam_pattern'] = $request->exam_pattern;
        $data['exam_type'] = $request->exam_type;
        $data['name'] = $request->name;
        $data['subject'] = $request->modeltest;
        $data['exam_in_minutes'] = $request->exam_in_minutes;
        $data['ex_time'] = $request->ex_time;
        $data['solve_shet'] = $request->solve_shet;
        $data['created_at'] = Carbon:: now()->toDateTimeString();

        $model = Modeltest:: insertGetId($data);

        foreach ($request->batch as $key => $batch) {
            ModeltestBatch::insert([
                'modeltest_id' => $model,
                'membershipe_id' => $batch,
                'lecture_id' => $request->lecture
            ]);
        }

        if ($model) {
            session()->flash('success', 'value');
            return redirect('/admin/all/model');
        } else {
            return back();
        }
    }

    public function viewtest($id)
    {
        $data = Modeltest:: where('status', 1)->where('id', $id)->first();
        return view('admin.modeltest.view', compact('data'));
    }

    public function edittest($id)
    {
        $data = Modeltest:: where('status', 1)->where('id', $id)->first();
        $memberbatch = Membership::where('status', 1)->get();
        return view('admin.modeltest.edit', compact('data', 'memberbatch'));
    }

    public function testUpdate(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data['exam_type'] = $request->exam_type;
        $data['name'] = $request->name;
        $data['subject'] = $request->modeltest;
        $data['exam_in_minutes'] = $request->exam_in_minutes;
        $data['solve_shet'] = $request->solve_shet;
        $data['serial'] = $request->serial;
        $data['ex_time'] = $request->ex_time;

        $update = Modeltest:: where('id', $id)->update($data);

        ModeltestBatch::where('modeltest_id', $id)->delete();

        foreach ($request->batch as $key => $batch) {
            ModeltestBatch::insert([
                'modeltest_id' => $id,
                'membershipe_id' => $batch,
            ]);
        }
        if ($update) {
            session()->flash('update', 'value');
            return redirect('/admin/all/model');
        } else {
            session()->flash('error', 'value');
            return back();
        }
    }

    public function deletetest($id)
    {
        $delete = Modeltest:: where('status', 1)->where('id', $id)->delete();
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
            'modeltest_id' => ['required'],
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
}

<?php

namespace App\Http\Controllers\Api;


use App\BatchStudent;
use App\Category;
use App\Chapter;
use App\LectureBatch;
use App\LectureSheet;
use App\Subject;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChapterController extends Controller
{
    use ApiResponse;

    public function chapters()
    {
        $items = Chapter::all();
        return $this->respondWithSuccess('Chapter List', $items);
    }

    public function chapterBySubject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => ['required'],
        ]);

        if ($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $items = Chapter::where('cat_id', $request->subject_id)->get();
        return $this->respondWithSuccess('Chapter List', $items);
    }

    public function chapterByBatch(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'subject_id' => ['required'],
            'batch_id' => ['required'],
        ]);

        if ($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $batch_lecture = LectureBatch::where('membershipe_id', $request->batch_id)->get();
        if (empty($batch_lecture))
            return $this->respondWithError('No subject for this Batch', 404);
        $batch_lecture_ids = $batch_lecture->pluck('lecture_id');

        $chapter_list = LectureSheet::whereIn('id', $batch_lecture_ids)->distinct('cp_id')->pluck('cp_id');

        $items = Chapter::whereIn('id', $chapter_list)->get();

        return $this->respondWithSuccess('Chapter List', $items);

    }

    public function chapterWithLectureBySubject(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'subject_id' => ['required'],
            'batch_id' => ['required'],
            'student_id' => ['required'],
        ]);

        if ($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $batch_lecture = LectureBatch::where('membershipe_id', $request->batch_id)->get();
        if (empty($batch_lecture))
            return $this->respondWithError('No subject for this Batch', 404);
        $batch_lecture_ids = $batch_lecture->pluck('lecture_id');

        $subject_name = Category::find($request->subject_id);
        if (empty($subject_name))
            return $this->respondWithError('No Subject Found', 404);

        //Student Enroll status for this batch

        $enrollInfo = BatchStudent::where('student_id', $request->student_id)->where('batch_id', $request->batch_id)->first();
        if (empty($enrollInfo))
            return $this->respondWithError('Not eligible to the lecture', 404);


//        $chapter_list = LectureSheet::whereIn('id',$batch_lecture_ids)->distinct('cp_id')->pluck('cp_id');
        $query = DB::table('lecture_sheets as ls')
            ->leftJoin('chapters as cp', 'cp.id', '=', 'ls.cp_id')
            ->select('ls.*', 'cp.name as chapter_name')
            ->whereIn('ls.id', $batch_lecture_ids)
            ->where('ls.category', $subject_name->name);

        if ($enrollInfo->enroll_status != 1) {
            $query = $query->where('ls.member_type', 'free');
        }
//            ->limit(1)
        $lecture_with_chapter = $query->get();

        //bt modification start for model test id

        foreach ($lecture_with_chapter as $lwc) {
            $modelTestId = DB::table('modeltest_batches')->where('lecture_id', $lwc->id)->select('modeltest_id')->get();
            $modelTestValue = 0;
            foreach ($modelTestId as $aModelId) {
                $modelTestValue = $aModelId->modeltest_id;
            }
            $lwc->modeltest_id = $modelTestValue;
        }
        //bt modification end

        if ($lecture_with_chapter->isEmpty())
            return $this->respondWithError('No lecture available for this subject', 404);

        if (!empty($lecture_with_chapter)) {
            $lecture_with_chapter = $lecture_with_chapter->toArray();
            foreach ($lecture_with_chapter as $key => $value) {
                $new_link = str_replace('width="560" height="315"', 'width="100%" height="100%"', $value->video);
                $lecture_with_chapter[$key]->video = $new_link;
            }
        }

        $lecture_group = collect($lecture_with_chapter)->groupBy('chapter_name');
        return $this->respondWithSuccess('Chapter List', $lecture_group);

    }
}

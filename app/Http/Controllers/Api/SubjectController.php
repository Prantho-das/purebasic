<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\LectureBatch;
use App\LectureSheet;
use App\Subject;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    use ApiResponse;

    public function subjects()
    {
        $items = Category::all();
        return $this->respondWithSuccess('Subject List',$items);
    }

    public function subjectByBatch(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'batch_id' => ['required']]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $batch_lecture = LectureBatch::where('membershipe_id',$request->batch_id)->get();
        if(empty($batch_lecture))
            return $this->respondWithError('No subject for this Batch',404);
        $batch_lecture_ids = $batch_lecture->pluck('lecture_id');

        $subject_list = LectureSheet::whereIn('id',$batch_lecture_ids)->distinct('category')->pluck('category');

        $items = Category::whereIn('name',$subject_list)->get();

        return $this->respondWithSuccess('Subject List',$items);

    }
}

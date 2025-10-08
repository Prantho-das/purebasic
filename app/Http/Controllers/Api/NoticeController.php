<?php

namespace App\Http\Controllers\Api;

use App\BatchStudent;
use App\Notice;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    use ApiResponse;

    public function getNotice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => ['required']]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $get_enroll_batch_ids=BatchStudent::where('student_id',$request->student_id)->where('enroll_status',1)->pluck('batch_id');
        $get_enroll_batch_ids[]='public';
        $items = Notice::where('status',1)->whereIn('batch_id',$get_enroll_batch_ids)->latest()->get();
        return $this->respondWithSuccess('Notice List',$items);
    }

}

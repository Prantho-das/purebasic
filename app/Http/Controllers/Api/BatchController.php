<?php

namespace App\Http\Controllers\Api;

use App\Batchpackage;
use App\BatchPromotion;
use App\BatchStudent;
use App\LectureBatch;
use App\Membership;
use App\ModeltestBatch;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BatchController extends Controller
{

    use ApiResponse;

    public function batchByStudent(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'student_id' => ['required']]);

//        $items = BatchStudent::with('course')->where('status', 1)->whereIn('enroll_status', [0, 1])->where('student_id', $request->student_id)->get();

    $items = BatchStudent::with('course')->where('status', 1)->whereIn('enroll_status', [0, 1])->where('student_id', $request->student_id)->get();

    foreach ($items as $item)
    {
        $batchDuration = DB::table('batch_duration')->where('bd_id', $item->bd_id)->get();
        $batchValue = 0;
        foreach ($batchDuration as $aDuration)
        {
            $batchValue = $aDuration->bd_duration;
        }

        $item->course->subscription_days = $batchValue;

    }

        return $this->respondWithSuccess('Course List', $items);
    }

    public function activeBatch()
    {


        $items = Batchpackage::where('showing_status', 1)->orderBy('batch_id', 'desc')->get();
        if (empty($items))
            return $this->respondWithError('No ongoing batch available');

        $items = $items->toArray();
        foreach ($items as $key => $item) {

            $items[$key]['total_video'] = LectureBatch::where('membershipe_id', $item['batch_id'])->count();
            $items[$key]['total_student'] = BatchStudent::where('batch_id', $item['batch_id'])->count();
            $items[$key]['total_exam'] = ModeltestBatch::where('membershipe_id', $item['batch_id'])->count();
            $items[$key]['total_time'] = '2500 minute';
        }

        return $this->respondWithSuccess('Active Batch List', $items);
    }

    public function batch_details($batch_id)
    {

        $batchpackage = Batchpackage::where('batch_id', $batch_id)->first();

        if (empty($batchpackage))
            return $this->respondWithError('No active batch found', 401);


        $batch_lecture = LectureBatch::where('membershipe_id', $batch_id)->get();
        if (empty($batch_lecture))
            return $this->respondWithError('No Lecture Found', 401);


        $batch_lecture_ids = $batch_lecture->pluck('lecture_id');
        $lecture_with_chapter = DB::table('lecture_sheets as ls')
            ->leftJoin('chapters as cp', 'cp.id', '=', 'ls.cp_id')
            ->select('ls.*', 'cp.name as chapter_name')
            ->whereIn('ls.id', $batch_lecture_ids)
            ->get();

        $lecture_group = [];
        foreach ($lecture_with_chapter as $value) {
            $lecture_group[$value->category][$value->chapter_name][] = $value;
        }

//        $lecture_group= $lecture_with_chapter->groupBy(['category', function ($item) {
//            return $item->chapter_name;
//        }], $preserveKeys = true)->toArray();

        $process_data = [];

        foreach ($lecture_group as $subject => $chapter_name) {

            $chapter_list = [];
            foreach ($chapter_name as $chapter => $lecture) {
                $chapter_list[] = [
                    'chapter_name' => $chapter,
                    'lecture_list' => $lecture
                ];
            }

            $process_data[] = [
                'subject_name' => $subject,
                'chapter_list' => $chapter_list
            ];
        }

        $return_data = [
            'batch_info' => $batchpackage,
            'lecture_details' => $process_data
        ];


        return $this->respondWithSuccess('Batch info data', $return_data);

//        return view('website.batch_details', compact('batchpackage','lecture_group'));

    }

    //bt modification start
    use ApiResponse;

    public function subscriptionDetails($batch_id)
    {
        //  $batch_id = $request->id;
        $subData = DB::table('batch_duration')
            ->where('bd_batch_id', $batch_id)
            ->get();

        $returnData = [];
        foreach ($subData as $data) {
            $returnData[] = [
                'id' => $data->bd_id,
                'batch_id' => $data->bd_batch_id,
                'duration' => $data->bd_duration,
                'fee' => $data->bd_fee
            ];
        }
        return $this->respondWithSuccess('Subscription Info', $returnData);
    }

    //bt modification end

    public function totalEnrolled(Request $request)
    {
        $totalEnrolled = DB::table('batch_students')
            ->where('batch_id', '=', $request->batch_id)
            ->where('enroll_status', '=', 1)
            ->count();

        return $this->respondWithSuccess('Total Enrolled', $totalEnrolled);
    }

    public function faqDetails(Request $request)
    {
        $faqData = DB::table('faq')
            ->where('batch_id', $request->batch_id)
            ->orderBy('serial', 'asc')
            ->get();
        return $this->respondWithSuccess('FAQ', $faqData);
    }

    public function lectureNumber(Request $request)
    {
        $totalLectures = DB::table('lecture_batches')
            ->where('membershipe_id', '=', $request->batch_id)
            ->count();
        return $this->respondWithSuccess('Total Lectures', $totalLectures);
    }

    public function watchCountSave(Request $request)
    {
        $id = $request->lecture_id;
        $batch_id = $request->batch_id;
        $user_id = $request->user_id;
        $has_enrolled = BatchStudent::where('batch_id', $batch_id)->where('student_id', $user_id)->where('enroll_status', 1)->first();

        //start bt modification for watch count
        if ($has_enrolled) {
            $isWatched = DB::table('watch_count')
                ->where([
                    'lecture_id' => $id,
                    'user_id' => $user_id,
                    'batch_id' => $batch_id
                ])
                ->first();

            if ($isWatched == null) {
                DB::table('watch_count')
                    ->insert([
                        'lecture_id' => $id,
                        'user_id' => $user_id,
                        'batch_id' => $batch_id,
                        'count' => 1
                    ]);
            } else {
                DB::table('watch_count')
                    ->where([
                        'lecture_id' => $id,
                        'user_id' => $user_id,
                        'batch_id' => $batch_id,
                    ])
                    ->update([
                        'count' => $isWatched->count + 1
                    ]);
            }
            return $this->respondWithSuccess('Count Saved');
        }
        //end bt modification for watch count

        return $this->respondWithSuccess('Count Not Saved');
    }


    public function enrollBatch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => ['required'],
            'batch_id' => ['required']
        ]);

        if ($validator->fails()) {
            return $this->respondWithValidationError($validator->errors()->toArray());
        } else {
            #Is batch exist
            $batch_info = Membership::where('id', $request->batch_id)->first();
            if (empty($batch_info))
                return $this->respondWithError('Batch not found', 404);


            $current_date = date('Y-m-d H:i:s');
            $has_promotions = BatchPromotion::where('batch_id', $request->batch_id)->where('status', 1)->whereRaw("'$current_date' between start_at and end_at")->first();

            if ($has_promotions) {
                $batch_info->promotion_active = True;
                $batch_info->payable_amount = $has_promotions->payable_amount;
            } else {
                $batch_info->promotion_active = False;
                $batch_info->payable_amount = $batch_info->ammount;
            }

            /**
             * enrol for batch and store payment data
             */
            $has_enrolled = BatchStudent::where('student_id', $request->student_id)->where('batch_id', $request->batch_id)->whereIn('enroll_status', [0, 1])->first();
            //$has_enrolled =  BatchStudent::where('student_id',session()->get('id'))->where('batch_id',$id)->whereIn('enroll_status',[0,1])->whereRaw("'$current_date' between subscription_start and subscription_end")->first();
            if ($has_enrolled) {
                //Payment approval pending
                if ($has_enrolled->enroll_status == 0) {
                    if (($has_enrolled->payable - $has_enrolled->paid) > 0) {
                        return $this->respondWithError('You have already enrolled for this course, Please make sure your payment', 400);
                    }
                    return $this->respondWithError('You have already enrolled for this course, Please wait for payment approval', 400);

                } elseif ($has_enrolled->subscription_start >= $current_date && $has_enrolled->subscription_end <= $current_date) {
                    return $this->respondWithError('You have already subscribed for this course', 400);

                } else {
//                #resubscribed course and update enroll table
//                $has_enrolled->fees = $batch_info->ammount;
//                $has_enrolled->payable = $batch_info->payable_amount;
//                $has_enrolled->paid = 0;
//                $has_enrolled->enroll_at = date('Y-m-d H:i:s');
//                $has_enrolled->enroll_status = 0;
//                $has_enrolled->subscription_start = null;
//                $has_enrolled->subscription_end = null;
//                $has_enrolled->updated_at = date('Y-m-d H:i:s');
//                $has_enrolled->updated_by = $request->student_id;
//                $has_enrolled->save();
                    return $this->respondWithError('You have already enrolled for this course', 400);

                }

            } else {
                #New Enrollment
                $has_enrolled = new BatchStudent();
                $has_enrolled->student_id = $request->student_id;
                $has_enrolled->batch_id = $request->batch_id;
                $has_enrolled->fees = $batch_info->ammount;
                $has_enrolled->payable = $batch_info->payable_amount;
                $has_enrolled->paid = 0;
                $has_enrolled->enroll_at = date('Y-m-d H:i:s');
                $has_enrolled->enroll_status = 0;
                $has_enrolled->created_at = date('Y-m-d H:i:s');
                $has_enrolled->created_by = $request->student_id;;
                $has_enrolled->save();

                return $this->respondWithSuccess('Successfully Enrolled, Please confirm payment', $has_enrolled);

            }


        }

    }
}

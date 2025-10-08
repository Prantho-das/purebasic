<?php

namespace App\Http\Controllers;

use App\AttentModeltest;
use App\Banner;
use App\BatchPromotion;
use App\BatchStudent;
use App\Batchpackage;
use App\Book;
use App\Chapter;
use App\Job;
use App\LectureBatch;
use App\LectureSheet;
use App\Membership;
use App\Mentor;
use App\Modelexam;
use App\Modeltest;
use App\ModeltestBatch;
use App\Modeltest_answer;
use App\Modeltest_answer_detail;
use App\Notic;
use App\Option;
use App\Otp\Otp;
use App\Paidmember;
use App\Problem;
use App\Question;
use App\Reaply;
use App\Student;
use App\Subject;
use App\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
use PHPMailer\PHPMailer\Exception;
use Session;
use App\Category;
use App\QuestionBank;


class WebsiteController extends Controller
{



    public function start()
    {
        
        $publicNotice = DB::table('notices')->where('batch_id', 'public')->value('notice');
        
        if ($publicNotice) {
            return view('website.public_notice', compact('publicNotice'));
        }
        
        return redirect('/home');

    }


    public function home()
    {
        
        $userId = Session::get('id');
        
        $profile = Student:: where('status', 1)->where('id', $userId)->first();
        
        $publicNotice = DB::table('notices')->where('batch_id', 'public')->value('notice');

        
        if(!empty($profile))
        {
            $all = DB::table('batch_students as a')
            ->join('notices as b', function ($joinOne) {
            $joinOne->on('a.batch_id', '=', 'b.batch_id');
            })->where('a.student_id', Session::get('id'))->where('a.enroll_status', 1)->where('a.subscription_end', '>=', NOW())->count();
            
            $read = DB::table('notification_history')
            ->where('user_id', Session::get('id'))->count();
            
            $new = $all - $read;
            
            if($profile->user_type = "mentor") {
                $question_count = DB::table('posts')->where('answer_count', 0)->count();
            } else {
                $question_count = DB::table('posts')->where('user_id', $userId)->where('new_count', 1)->count();

            }
            
            
            
        } else {
            
           $new = 0;
           $question_count = 0;
        }
        

        return view('website.home_english', compact('new', 'question_count', 'publicNotice'));
    }





    public function main_page()
    {


        $userId = Session::get('id');
        
        $profile = Student:: where('status', 1)->where('id', $userId)->first();
        
        $publicNotice = DB::table('notices')->where('batch_id', 'public')->value('notice');

        
        if(!empty($profile))
        {
            $all = DB::table('batch_students as a')
            ->join('notices as b', function ($joinOne) {
            $joinOne->on('a.batch_id', '=', 'b.batch_id');
            })->where('a.student_id', Session::get('id'))->where('a.enroll_status', 1)->where('a.subscription_end', '>=', NOW())->count();
            
            $read = DB::table('notification_history')
            ->where('user_id', Session::get('id'))->count();
            
            $new = $all - $read;
            
            if($profile->user_type = "mentor") {
                $question_count = DB::table('posts')->where('answer_count', 0)->count();
            } else {
                $question_count = DB::table('posts')->where('user_id', $userId)->where('new_count', 1)->count();

            }
            
            
            
        } else {
            
           $new = 0;
           $question_count = 0;
        }
        

        return view('website.main_page', compact('new', 'question_count', 'publicNotice',));

    }



    public function batch_details($batch_id)
    {

        $batchpackage = Batchpackage::where('batch_id', $batch_id)->first();
        if (empty($batchpackage))
            return redirect('/')->with('message', 'No active batch found');


        $batch_lecture = LectureBatch::where('membershipe_id', $batch_id)->get();
        if (empty($batch_lecture))
            return redirect('/')->with('message', 'No Lecture Found');

        $batch_lecture_ids = $batch_lecture->pluck('lecture_id');
        $lecture_with_chapter = DB::table('lecture_sheets as ls')
            ->leftJoin('chapters as cp', 'cp.id', '=', 'ls.cp_id')
            ->select('ls.*', 'cp.name as chapter_name')
            ->whereIn('ls.id', $batch_lecture_ids)
            ->get();


//        $lecture_group= $lecture_with_chapter->groupBy('chapter_name');
        $lecture_group = $lecture_with_chapter->groupBy(['category', function ($item) {
            return $item->chapter_name;
            return $item->member_type; //bt modification
            return $item->youtube_video_id; //bt modification
        }], $preserveKeys = true);

        $totalEnrolled = DB::table('batch_students')
            ->where('batch_id', '=', $batch_id)
            ->where('enroll_status', '=', 1)
            ->count();

        $totalLectures = DB::table('lecture_batches')
            ->where('membershipe_id', '=', $batch_id)
            ->count();

        $helpData = DB::table('help')
            ->where('batch_id', $batch_id)
            ->orderBy('serial', 'asc')
            ->get();

        $getLectureStatus = DB::table('batchpackages as bp')
            ->leftJoin('lecture_batches as lb', 'bp.batch_id', '=', 'lb.membershipe_id')
            ->leftJoin('lecture_sheets as ls', 'lb.lecture_id', '=', 'ls.id')
            ->where('bp.batch_id', '=', $batch_id)
            ->where('ls.member_type', '=', 'Free')
            ->select('ls.member_type', 'video')
            ->get();


        $enrolled = false;

        if (session::get('id')) {
            
            $enrolledBatches = DB::table('batch_students')->where('student_id', '=', session::get('id'))->where('batch_id', $batch_id)->where('enroll_status', 1)->where('subscription_end', '>=', NOW())->first();
            
            if ($enrolledBatches) {
                $enrolled = true;
            }

        }
        

        return view('website.batch_details', compact('batchpackage', 'lecture_group', 'totalEnrolled', 'totalLectures', 'helpData', 'getLectureStatus', 'enrolled',));

    }

    public function active_batches()
    {
        $batchpackages = Batchpackage::where('showing_status', 1)->latest('updated_at')->get();

        return view('website.active_batch_by_category', compact('batchpackages'));
    }
    
    
    
    public function active_batches_by_category($id)
    {

        $batchpackages = Batchpackage::where('showing_status', 1)->where('batch_category', $id)->latest('updated_at')->get();

        if(session::get('id')) {        
             $enrolledBatches = DB::table('batch_students')->where('student_id', '=', session::get('id'))->where('enroll_status', 1)->where('subscription_end', '>=', NOW())->pluck('batch_id')->toArray();
        
        } else {
           $enrolledBatches = array(); 
        }

        return view('website.active_batch_by_category', compact('batchpackages', 'enrolledBatches'));
    }


    public function free_lectures_by_category($id)
    {

        $batchpackages = Batchpackage::where('showing_status', 1)->where('batch_category', $id)->latest('updated_at')->get();

        return view('website.active_batch_by_category', compact('batchpackages'));
    }

    public function scheduleLink($batch_id)
    {

        $scheduleLink = Batchpackage::where('batch_id', $batch_id)->value("fild_5");

        return redirect($scheduleLink);
    }
    
    
    public function discussionLink($batch_id)
    {

        $discussionLink = Batchpackage::where('batch_id', $batch_id)->value("fild_6");

        return redirect($discussionLink);
    }
  
    public function liveLink($batch_id)
    {
        $hasRoot = Batchpackage::where('batch_id', $batch_id)->value("fild_7");
        
        if ($hasRoot != "null") {
            $liveLink = Batchpackage::where('batch_id', (int) $hasRoot)->value("fild_9");
        } else {

            $liveLink = Batchpackage::where('batch_id', $batch_id)->value("fild_9");

            
        }


        return redirect($liveLink);
    }  
    
    
    
    
    public function index($id)
    {

        $paidmember = Paidmember::where('student_id', Session::get('id'))->where('is_approve', 1)->first();
        if ($paidmember) {
            $notic = Notic:: where('status', 1)->orderBy('id', 'desc')->get();
            $problem = Problem:: where('status', 1)->orderBy('id', 'desc')->limit(3)->get();
            $reaply = Reaply:: where('status', 1)->orderBy('id', 'desc')->get();
            $alljob = Job:: where('status', 1)->where('manage', 1)->orderBy('id', 'desc')->get();
            $memberships = Membership:: where('status', 1)->get();

            return view('website.index', compact('notic', 'problem', 'alljob', 'reaply', 'memberships', 'paidmember'));
        } else {
            $notic = Notic:: where('status', 1)->orderBy('id', 'desc')->get();
            $problem = Problem:: where('status', 1)->orderBy('id', 'desc')->limit(3)->get();
            $reaply = Reaply:: where('status', 1)->orderBy('id', 'desc')->get();
            $alljob = Job:: where('status', 1)->where('manage', 1)->orderBy('id', 'desc')->get();
            $memberships = Membership:: where('status', 1)->get();

            return view('website.index', compact('notic', 'problem', 'alljob', 'reaply', 'memberships', 'paidmember'));
        }

    }

    public function subjects($batch_id)
    {
        $color_array = ['bg-light-white', 'bg-light-primary', 'bg-light-info', 'bg-light-success', 'bg-light-secondary', 'bg-light-o-20'];

        $hasRoot = Batchpackage::where('batch_id', $batch_id)->value("fild_7");
        
        if ($hasRoot != "null") {
            $batch_lecture = LectureBatch::where('membershipe_id', (int) $hasRoot)->get();
        } else {

            $batch_lecture = LectureBatch::where('membershipe_id', $batch_id)->get();
            
        }
        if (empty($batch_lecture)) {
            Session::flash('error', 'No subject for this Batch');
            return redirect()->back();
        }

        $batch_lecture_ids = $batch_lecture->pluck('lecture_id');

        $subject_list = LectureSheet::whereIn('id', $batch_lecture_ids)->distinct('category')->pluck('category');

        // $items = Category::whereIn('name',$subject_list)->get();

        $categories = Category::whereIn('name', $subject_list)->where('status', 1)->get()->chunk(4);
        return view('user.subject', compact('batch_id', 'categories', 'color_array'));
    }
    
    

    public function modules($batch_id)
    {

        $batch_lecture = LectureBatch::where('membershipe_id', $batch_id)->get();

        $batch_lecture_ids = $batch_lecture->pluck('lecture_id');


        $subject_list = LectureSheet::whereIn('id', $batch_lecture_ids)->distinct('category')->pluck('category');


        $categories = Category::whereIn('name', $subject_list)->where('status', 1)->get()->chunk(4);
        return view('website.module', compact('batch_id', 'categories'));
    }


    public function chapters($batch_id, $subject_id)
    {
        
        $hasRoot = Batchpackage::where('batch_id', $batch_id)->value("fild_7");
        
        if ($hasRoot != "null") {
            $batch_lecture = LectureBatch::where('membershipe_id', (int) $hasRoot)->get();
        } else {

            $batch_lecture = LectureBatch::where('membershipe_id', $batch_id)->get();
            
        }

        if (empty($batch_lecture)) {
            Session::flash('error', 'No Lecture for this Batch');
            return redirect()->back();
        }
        $batch_lecture_ids = $batch_lecture->pluck('lecture_id');

        $subject_info = Category::find($subject_id);
        
        $startsFrom = Batchpackage::where('batch_id', $batch_id)->value("fild_8");

        if (empty($subject_info)) {
            Session::flash('error', 'No subject for this Batch');
            return redirect()->back();
        }
        $chapter_list = LectureSheet::whereIn('id', $batch_lecture_ids)->where('category', $subject_info->name)->distinct('cp_id')->pluck('cp_id');

        // $items = Chapter::whereIn('id',$chapter_list)->get();

        $chapters = Chapter::whereIn('id', $chapter_list)->where('status', 1)->orderBy('serial', 'asc')->get()->chunk(100);
//        return view('website.chapter',compact('chapter','subject_id','batch_id'));
        return view('user.chapter', compact('chapters', 'subject_id', 'subject_info', 'batch_id', 'startsFrom'));
    }
    
    
    
    public function moduleSubcategories($batch_id, $module_id)
    {
        

        $batch_lecture = LectureBatch::where('membershipe_id', $batch_id)->get();



        $batch_lecture_ids = $batch_lecture->pluck('lecture_id');

        $subject_info = Category::find($module_id);
        

        if (empty($subject_info)) {
            Session::flash('error', 'No module for this Batch');
            return redirect()->back();
        }
        $chapter_list = LectureSheet::whereIn('id', $batch_lecture_ids)->where('category', $subject_info->name)->distinct('cp_id')->pluck('cp_id');


        $chapters = Chapter::whereIn('id', $chapter_list)->where('status', 1)->orderBy('serial', 'asc')->get()->chunk(100);

        return view('website.module_subcategories', compact('chapters', 'module_id', 'subject_info', 'batch_id'));
    }
    
    
    
    

    public function not_approved_or_bought()
    {
        return view('website.not_approved_or_bought');
    }

    public function classes($batch_id, $subject_id, $chapter_id)
    {

        $hasRoot = Batchpackage::where('batch_id', $batch_id)->value("fild_7");
        $isReverse = Chapter::where('id', $chapter_id)->value('is_reverse');
        
        if ($hasRoot != "null") {
            $batch_lecture_ids = LectureBatch::where('membershipe_id', (int) $hasRoot)->pluck('lecture_id');
        } else {

            $batch_lecture_ids = LectureBatch::where('membershipe_id', $batch_id)->pluck('lecture_id');
            
        }
        $startsFrom = Batchpackage::where('batch_id', $batch_id)->value("fild_8");
        #get batch Lecture ids

        if (empty($batch_lecture_ids)) {
            Session::flash('error', 'No Lecture found for selected courses');
            $info = [];
            return view('website.class_info', compact('info'));
        }

        $subject = Category::find($subject_id);
        if (empty($subject)) {
            Session::flash('error', 'Subject not found');
            return redirect()->back();
        }

        //Check user enrollment for this course

        $user_id = session()->get('id');
        $has_enrolled = BatchStudent::where('batch_id', $batch_id)->where('student_id', $user_id)->where('enroll_status', 1)->first();

        if (empty($has_enrolled)) {
            $info = LectureSheet::with('chapter')->whereIn('id', $batch_lecture_ids)->where('category', $subject->name)->where('cp_id', $chapter_id)->where('member_type', 'free')->where('status', 1)->orderBy('video_id', 'asc')->get();
        } else {
            
            if ($isReverse) {

                $info = LectureSheet::with('chapter')->whereIn('id', $batch_lecture_ids)->where('category', $subject->name)->where('cp_id', $chapter_id)->where('status', 1)->orderBy('video_id', 'desc')->get();
                
            } else {
            
                $info = LectureSheet::with('chapter')->whereIn('id', $batch_lecture_ids)->where('category', $subject->name)->where('cp_id', $chapter_id)->where('status', 1)->orderBy('video_id', 'asc')->get();
            
                }
        }

        // return view('website.class_info',compact('info','batch_id'));
        return view('user.lecture', compact('info', 'batch_id', 'subject_id', 'chapter_id', 'startsFrom'));
    }
    
    
    
    

    public function clinical_cases_list()
    {

        $info = LectureSheet::where('clinical_case', 1)->where('status', 1)->orderBy('video_id', 'desc')->get();


        return view('user.clinical_cases_list', compact('info'));
    }
    

    
    
    public function free_lecture()
    {
        /*if (!session()->has('id')) {
            return redirect('/');
        }*/
        
        $batch_1 = LectureSheet::where('levell', 'MBBS')->where('member_type', 'free')->where('status', 1)->count();
        $batch_2 = LectureSheet::where('levell', 'BDS')->where('member_type', 'free')->where('status', 1)->count();
        $batch_3 = LectureSheet::where('levell', 'BCS')->where('member_type', 'free')->where('status', 1)->count();

        return view('website.free_lecture', compact('batch_1', 'batch_2', 'batch_3'));

    }
    
    
    public function free_lectures_subjects($batch_id) {

        $color_array = ['bg-light-white', 'bg-light-primary', 'bg-light-info', 'bg-light-success', 'bg-light-secondary', 'bg-light-o-20'];

        $hasRoot = Batchpackage::where('batch_id', $batch_id)->value("fild_7");
        
        if ($hasRoot != "null") {
            $batch_lecture = LectureBatch::where('membershipe_id', (int) $hasRoot)->get();
        } else {

            $batch_lecture = LectureBatch::where('membershipe_id', $batch_id)->get();
            
        }
        if (empty($batch_lecture)) {
            Session::flash('error', 'No subject for this Batch');
            return redirect()->back();
        }

        $batch_lecture_ids = $batch_lecture->pluck('lecture_id');

        $subject_list = LectureSheet::whereIn('id', $batch_lecture_ids)->distinct('category')->pluck('category');

        // $items = Category::whereIn('name',$subject_list)->get();

        $categories = Category::whereIn('name', $subject_list)->where('status', 1)->get()->chunk(4);
        return view('user.free_lectures_subjects', compact('batch_id', 'categories', 'color_array'));
        
    }
    
    
    
    
    
    public function free_lectures_chapters($batch_id, $subject_id)
        {
            
            $hasRoot = Batchpackage::where('batch_id', $batch_id)->value("fild_7");
            
            if ($hasRoot != "null") {
                $batch_lecture = LectureBatch::where('membershipe_id', (int) $hasRoot)->get();
            } else {
    
                $batch_lecture = LectureBatch::where('membershipe_id', $batch_id)->get();
                
            }
    
            if (empty($batch_lecture)) {
                Session::flash('error', 'No Lecture for this Batch');
                return redirect()->back();
            }
            $batch_lecture_ids = $batch_lecture->pluck('lecture_id');
    
            $subject_info = Category::find($subject_id);
            
            $startsFrom = Batchpackage::where('batch_id', $batch_id)->value("fild_8");
    
            if (empty($subject_info)) {
                Session::flash('error', 'No subject for this Batch');
                return redirect()->back();
            }
            $chapter_list = LectureSheet::whereIn('id', $batch_lecture_ids)->where('category', $subject_info->name)->distinct('cp_id')->pluck('cp_id');
    
            // $items = Chapter::whereIn('id',$chapter_list)->get();
    
            $chapters = Chapter::whereIn('id', $chapter_list)->where('status', 1)->orderBy('serial', 'asc')->get()->chunk(100);
    //        return view('website.chapter',compact('chapter','subject_id','batch_id'));
            return view('user.free_lectures_chapters', compact('chapters', 'subject_id', 'subject_info', 'batch_id', 'startsFrom'));
        }
    
    
    public function free_lectures_classes($batch_id, $subject_id, $chapter_id)
    {

        $hasRoot = Batchpackage::where('batch_id', $batch_id)->value("fild_7");
        
        if ($hasRoot != "null") {
            $batch_lecture_ids = LectureBatch::where('membershipe_id', (int) $hasRoot)->pluck('lecture_id');
        } else {

            $batch_lecture_ids = LectureBatch::where('membershipe_id', $batch_id)->pluck('lecture_id');
            
        }
        $startsFrom = Batchpackage::where('batch_id', $batch_id)->value("fild_8");
        #get batch Lecture ids

        if (empty($batch_lecture_ids)) {
            Session::flash('error', 'No Lecture found for selected courses');
            $info = [];
            return view('website.class_info', compact('info'));
        }

        $subject = Category::find($subject_id);
        if (empty($subject)) {
            Session::flash('error', 'Subject not found');
            return redirect()->back();
        }

        //Check user enrollment for this course

        $user_id = session()->get('id');
        $has_enrolled = BatchStudent::where('batch_id', $batch_id)->where('student_id', $user_id)->where('enroll_status', 1)->first();

        if (empty($has_enrolled)) {
            $info = LectureSheet::with('chapter')->whereIn('id', $batch_lecture_ids)->where('category', $subject->name)->where('cp_id', $chapter_id)->where('member_type', 'free')->where('status', 1)->orderBy('video_id', 'asc')->get();
        } else {
            $info = LectureSheet::with('chapter')->whereIn('id', $batch_lecture_ids)->where('category', $subject->name)->where('cp_id', $chapter_id)->where('status', 1)->orderBy('video_id', 'asc')->get();
        }

        // return view('website.class_info',compact('info','batch_id'));
        return view('user.free_lectures_classes', compact('info', 'batch_id', 'subject_id', 'chapter_id', 'startsFrom'));
    }
    
    




    public function free_lectures_video($batch_id, $id)
    {


        $hasRoot = Batchpackage::where('batch_id', $batch_id)->value("fild_7");
        
        if ($hasRoot != "null") {
            $batch_lecture_ids = LectureBatch::where('membershipe_id', (int) $hasRoot)->where('lecture_id', $id)->first();
        } else {

            $batch_lecture_ids = LectureBatch::where('membershipe_id', $batch_id)->where('lecture_id', $id)->first();
            
        }
        #get batch Lecture ids
;
        if (empty($batch_lecture_ids)) {
//            Session::flash('error','Unauthorized access');
//            redirect()->back();
            abort(404);
        }

        $sheet = LectureSheet::where('id', $id)->where('status', 1)->first() ?? abort(404);

        $subject_id = Category::where('name', $sheet->category)->first()->id;
        return view('user.free_lectures_video', compact('sheet', 'batch_id', 'subject_id'));
    }    
    



    public function free_exam()
    {
        /*if (!session()->has('id')) {
            return redirect('/');
        }*/
        
        $modeltestBatch_1 = ModeltestBatch::where('membershipe_id', 1)->pluck('modeltest_id');
    
        $batch_1 = Modeltest::with('batch')->whereIn('id', $modeltestBatch_1)->count();
        
        $modeltestBatch_2 = ModeltestBatch::where('membershipe_id', 2)->pluck('modeltest_id');
    
        $batch_2 = Modeltest::with('batch')->whereIn('id', $modeltestBatch_2)->count();        
        
        $modeltestBatch_3 = ModeltestBatch::where('membershipe_id', 3)->pluck('modeltest_id');
    
        $batch_3 = Modeltest::with('batch')->whereIn('id', $modeltestBatch_3)->count();
        
        return view('website.free_exam', compact('batch_1', 'batch_2', 'batch_3'));

    }

    public function free_classes($batch_id)
    {

        if($batch_id == 1) {
            $level = 'MBBS';
        } elseif($batch_id == 2) {
            $level = 'BDS';
        } else {
            $level = 'BCS';
        }

        $info = LectureSheet::where('levell', $level)->where('member_type', 'free')->where('status', 1)->orderBy('video_id', 'asc')->get();
        return view('website.free_class', compact('info', 'batch_id'));

    }
    
    




    public function lecture_video($batch_id, $id)
    {


        $hasRoot = Batchpackage::where('batch_id', $batch_id)->value("fild_7");
        
        if ($hasRoot != "null") {
            $batch_lecture_ids = LectureBatch::where('membershipe_id', (int) $hasRoot)->where('lecture_id', $id)->first();
        } else {

            $batch_lecture_ids = LectureBatch::where('membershipe_id', $batch_id)->where('lecture_id', $id)->first();
            
        }
        #get batch Lecture ids
;
        if (empty($batch_lecture_ids)) {
//            Session::flash('error','Unauthorized access');
//            redirect()->back();
            abort(404);
        }

        //Check user enrollment for this course
        $user_id = session()->get('id');
        $has_enrolled = BatchStudent::where('batch_id', $batch_id)->where('student_id', $user_id)->where('enroll_status', 1)->first();
        $sheet = LectureSheet::where('id', $id)->where('status', 1)->first() ?? abort(404);
        if (empty($has_enrolled) && $sheet->member_type == 'premium')
            abort(404);

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
        }
        //end bt modification for watch count


        $subject_id = Category::where('name', $sheet->category)->first()->id;
        return view('user.lecture_video', compact('sheet', 'batch_id', 'subject_id'));
    }
    

    public function watch_clinical_case($userId, $caseId) {
        
        $has_enrolled = DB::table('videos')
            ->where('user_id', $userId)
            ->where('clinical_case_id', $caseId)
            ->first();

        $student = Student:: where('status', 1)->where('id', $userId)->first();

            
        $clinical_case = LectureSheet::where('id', $caseId)->where('status', 1)->first() ?? abort(404);
  

        if ($has_enrolled) {
            return view('user.watch_clinical_case', compact('clinical_case'));

        }
        
        return redirect('/updateInfo/' . $userId . '/case/' . $caseId);

    }    



    public function note1($batch_id, $id)
    {



        //Check user enrollment for this course
        $user_id = session()->get('id');
        $has_enrolled = BatchStudent::where('batch_id', $batch_id)->where('student_id', $user_id)->where('enroll_status', 1)->first();
        $sheet = LectureSheet::where('id', $id)->where('status', 1)->first() ?? abort(404);
        if (empty($has_enrolled) && $sheet->member_type == 'premium')
            abort(404);
            
        return redirect($sheet->links);
    }
    
    
    public function note2($batch_id, $id)
    {



        //Check user enrollment for this course
        $user_id = session()->get('id');
        $has_enrolled = BatchStudent::where('batch_id', $batch_id)->where('student_id', $user_id)->where('enroll_status', 1)->first();
        $sheet = LectureSheet::where('id', $id)->where('status', 1)->first() ?? abort(404);
        if (empty($has_enrolled) && $sheet->member_type == 'premium')
            abort(404);
            
        return redirect($sheet->pdf);
    }
  
  
    public function pdf($batch_id, $id)
    {



        //Check user enrollment for this course
        $user_id = session()->get('id');
        $has_enrolled = BatchStudent::where('batch_id', $batch_id)->where('student_id', $user_id)->where('enroll_status', 1)->first();
        $sheet = LectureSheet::where('id', $id)->where('status', 1)->first() ?? abort(404);
        if (empty($has_enrolled) && $sheet->member_type == 'premium')
            abort(404);
            
        return redirect($sheet->v_link);
    }
    
    


    public function lecture_exam(Request $request)
    {
        $lectureId = $request->id;
        $examId = ModeltestBatch::all()->where('lecture_id', $lectureId)->pluck('modeltest_id');
        $eid = null;
        foreach ($examId as $eid) {
            $eid = $eid;
        }
        $modelTest = $eid;
        return redirect()->route('question', $eid);

    }

    public function dailyExam()
    {
        $allsheet = LectureSheet:: where('status', 1)->orderBy('id', 'desc')->get();

        $beststudent = Modeltest_answer:: orderBy('id', 'DESC')->limit(5)->get()->sortByDesc('answered_questions');
        return view('website.exam', compact('allsheet', 'beststudent'));
    }

    public function application()
    {
        return view('website.application');
    }

    public function resultsheet()
    {
        $allresult = Modeltest_answer:: orderBy('id', 'desc')->get();
        $beststudent = Modeltest_answer:: orderBy('id', 'DESC')->limit(5)->get()->sortByDesc('answered_questions');
        return view('website.result', compact('allresult', 'beststudent'));
    }

    public function lecture_sheeet()
    {
        $subject = Subject:: where('status', 1)->orderBy('id', 'asc')->get();
        return view('website.lecture_sheeet', compact('subject'));
    }

    public function lecture($id)
    {
        $view = LectureSheet:: where('status', 1)->where('id', $id)->first();
        $allsheet = LectureSheet:: where('status', 1)->orderBy('id', 'desc')->get();
        return view('website.lecture', compact('view', 'allsheet'));
    }

    public function spacialmodeltest($type)
    {
        if ($type == 'bcs-exam') {
            $type = 'BCS';
        } else {
            $type = 'Regular Exam';
        }

        $id = Session:: get('id');
        $batch_ids = BatchStudent:: where('student_id', $id)->where('enroll_status', 1)->select('batch_id')->get();
        if (empty($batch_ids)) {
            Session::flash('error', 'You have no enroll course');
            return redirect('/');
        }

        $batch_ids_array = $batch_ids->pluck('batch_id');
        $modeltestBatch = ModeltestBatch::whereIn('membershipe_id', $batch_ids_array)->orderBy('membershipe_id', 'desc')->get();

        if (empty($modeltestBatch)) {
            Session::flash('error', 'No Model test available');
            return redirect('/student/profile/' . $id);
        }

        $modelTestIds = $modeltestBatch->pluck('modeltest_id');
        $exams_raw = Modeltest::with('batch')->whereIn('id', $modelTestIds)->where('exam_type', $type)->orderBy('id', 'desc')->paginate(10);
        $exams = [];
        foreach ($exams_raw as $exam_raw) {
            $batch_name = [];
            foreach ($exam_raw->batch as $exam_batch) {

                if (in_array($exam_batch->id, $batch_ids_array->toArray())) {
                    $batch_name[] = $exam_batch->plan;
                }
            }

            if (!empty($batch_name)) {
                $exam_raw->batch_name = implode(',', $batch_name);
            } else {
                $exam_raw->batch_name = '';
            }
            $exams[] = $exam_raw;
        }
        return view('user.regular_exam', compact('exams', 'exams_raw', 'type'));
    }

    public function examByBatch($batch_id)
    {
        $id = Session:: get('id');

        $batch_info = Membership::find($batch_id);
        if (empty($batch_info)) {
            Session::flash('error', 'Batch not found');
            return redirect('/student/profile/' . $id);
        }

        if ($batch_id > 3) {
            $free = false;
            $batch_ids = BatchStudent::where('student_id', $id)->where('batch_id', $batch_id)->where('enroll_status', 1)->select('batch_id')->first();
            if (empty($batch_ids)) {
                Session::flash('error', 'You have no enroll course');
                return redirect('/student/profile/' . $id);
            }
            
        }

        $modeltestBatch = ModeltestBatch::where('membershipe_id', $batch_id)->where('lecture_id', null)->orderBy('membershipe_id', 'desc')->get();
        if (empty($modeltestBatch)) {
            Session::flash('error', 'No Model test available');
            return redirect('/student/profile/' . $id);
        }

        $modelTestIds = $modeltestBatch->pluck('modeltest_id');
        $modelTest =  Modeltest::with('batch')->whereIn('id', $modelTestIds);
        $exams_raw = $modelTest->orderBy('serial', 'asc')->paginate(300);
        //$count = $modelTest->count();

        return view('user.exam_by_batch', compact('exams_raw', 'batch_info', 'free',));
    }


    public function free_exams($batch_id)
    {


        $batch_info = Membership::find($batch_id);
        if (empty($batch_info)) {
            Session::flash('error', 'Batch not found');
        }

        if ($batch_id <= 3) {
            $free = true;
            $modeltestBatch = ModeltestBatch::where('membershipe_id', $batch_id)->where('lecture_id', null)->orderBy('membershipe_id', 'desc')->get();
            
            if (empty($modeltestBatch)) {
                Session::flash('error', 'No Model test available');
            }
    
            $modelTestIds = $modeltestBatch->pluck('modeltest_id');
            $exams_raw = Modeltest::with('batch')->whereIn('id', $modelTestIds)->where('exam_pattern', '!=', 'Clinical Case')->latest('updated_at')->paginate(10);
   
            return view('user.exam_by_batch', compact('exams_raw', 'batch_info', 'free'));
         
        }

    }


    public function clinical_cases($batch_id)
    {


        $batch_info = Membership::find($batch_id);
        if (empty($batch_info)) {
            Session::flash('error', 'Batch not found');
        }

        if ($batch_id <= 3) {
            $free = true;
            $modeltestBatch = ModeltestBatch::where('membershipe_id', $batch_id)->where('lecture_id', null)->orderBy('membershipe_id', 'desc')->get();
            
            if (empty($modeltestBatch)) {
                Session::flash('error', 'No Model test available');
            }
    
            $modelTestIds = $modeltestBatch->pluck('modeltest_id');
            $exams_raw = Modeltest::with('batch')->whereIn('id', $modelTestIds)->where('exam_pattern', '=', 'Clinical Case')->latest('updated_at')->paginate(100);
   
            return view('user.clinical_case_by_batch', compact('exams_raw', 'batch_info', 'free'));
         
        }

    }



    public function question($id)
    {
        $student_id = Session:: get('id');
        
        $modelTest = Modeltest::find($id) ?? abort(404);
        
        if ($modelTest->exam_type != "Free") {
        
            $batch_ids = BatchStudent:: where('student_id', $student_id)->where('enroll_status', 1)->select('batch_id')->get();
            if (empty($batch_ids)) {
                Session::flash('error', 'You have no enroll course');
                return redirect('/');
            }
    
            $batch_ids_array = $batch_ids->pluck('batch_id');
            $modeltestBatch = ModeltestBatch::whereIn('membershipe_id', $batch_ids_array)->where('modeltest_id', $id)->first();
            if (empty($modeltestBatch)) {
                Session::flash('error', 'Not a valid request');
                return redirect('/student/profile/'.$student_id);
            }

        }

        AttentModeltest::updateOrCreate([
            'student_id' => session()->get('id'),
            'modeltest_id' => $id,
        ]);


        $exam = Modelexam:: where('status', 1)->where('modeltest_id', $id)->get();



        $modeltest_exite = Modeltest_answer::where('modeltest_id', $modelTest->id)->where('student_id', $student_id)->first();

        if ($modeltest_exite) {
            if ($modeltest_exite && $modeltest_exite->action_status == 1) {
                return redirect('seeAnswerResult/' . $modeltest_exite->id);
            } else {
//                    return view('website.question', compact('modelTest'));
                return view('user.question', compact('modelTest'));
            }
        } else {
            $answer_array = [
                'student_id' => Session::get('id'),
                'modeltest_id' => $id,
                'created_at' => date('Y-m-d H:i:s')
            ];
            Modeltest_answer::updateOrCreate($answer_array);
//                return view('website.question', compact('modelTest'));
            return view('user.question', compact('modelTest'));
        }


    }
    
    
    
    public function clinical_case_question($id)
    {
        $student_id = Session:: get('id');
        
        $modelTest = Modeltest::find($id) ?? abort(404);
        
        if ($modelTest->exam_pattern == "Clinical Case") {
        
            return view('user.clinical_case_question', compact('modelTest'));
        } else {
            return back();
        }


    }
    

    
    
    public function quiz($batch_id, $class_id, $quiz_id)
    {
        $student_id = Session:: get('id');
        
        $modelTest = Modeltest::find($quiz_id) ?? abort(404);
        
        if ($modelTest->exam_type != "Free") {
        
            $batch_ids = BatchStudent:: where('student_id', $student_id)->where('enroll_status', 1)->where('batch_id', $batch_id)->get();
            if (empty($batch_ids)) {
                Session::flash('error', 'You have no enroll course');
                return redirect('/');
            }
    
            $lectureSheet = LectureSheet::where('id', $class_id)->where('isExam', $quiz_id)->get();
            if (empty($lectureSheet)) {
                Session::flash('error', 'Not a valid request');
                return redirect('/student/profile/'.$student_id);
            }

        }

        AttentModeltest::updateOrCreate([
            'student_id' => session()->get('id'),
            'modeltest_id' => $quiz_id,
        ]);


        $exam = Modelexam:: where('status', 1)->where('modeltest_id', $quiz_id)->get();



        $modeltest_exite = Modeltest_answer::where('modeltest_id', $modelTest->id)->where('student_id', $student_id)->first();

        if ($modeltest_exite) {
            if ($modeltest_exite && $modeltest_exite->action_status == 1) {
                return redirect('seeAnswerResult/' . $modeltest_exite->id);
            } else {
//                    return view('website.question', compact('modelTest'));
                return view('user.quiz', compact('modelTest'));
            }
        } else {
            
            $answer_array = [
                'student_id' => Session::get('id'),
                'modeltest_id' => $quiz_id,
                'created_at' => date('Y-m-d H:i:s')
            ];
            Modeltest_answer::updateOrCreate($answer_array);
//                return view('website.question', compact('modelTest'));            
            return view('user.quiz', compact('modelTest'));
        }


    }
    
    
    
    
    
    public function solve_class($id)
    {
        $student_id = Session:: get('id');
        
        $modelTest = Modeltest::find($id) ?? abort(404);
        
        if ($modelTest->exam_type != "Free") {
        
            $batch_ids = BatchStudent:: where('student_id', $student_id)->where('enroll_status', 1)->select('batch_id')->get();
            if (empty($batch_ids)) {
                Session::flash('error', 'You have no enroll course');
                return redirect('/');
            }
    
            $batch_ids_array = $batch_ids->pluck('batch_id');
            $modeltestBatch = ModeltestBatch::whereIn('membershipe_id', $batch_ids_array)->where('modeltest_id', $id)->first();
            if (empty($modeltestBatch)) {
                Session::flash('error', 'Not a valid request');
                return redirect('/student/profile/'.$student_id);
            }

        }

        AttentModeltest::updateOrCreate([
            'student_id' => session()->get('id'),
            'modeltest_id' => $id,
        ]);


        $exam = Modelexam:: where('status', 1)->where('modeltest_id', $id)->get();



        $modeltest_exite = Modeltest_answer::where('modeltest_id', $modelTest->id)->where('student_id', $student_id)->first();

        if ($modeltest_exite) {
            if ($modeltest_exite && $modeltest_exite->action_status == 1) {
                $solveClass = $modelTest->solve_shet;
                return view('user.solve_class', compact('solveClass'));
                
            } else {
//                    return view('website.question', compact('modelTest'));
                return view('user.question', compact('modelTest'));
            }
        } else {
            $answer_array = [
                'student_id' => Session::get('id'),
                'modeltest_id' => $id,
                'created_at' => date('Y-m-d H:i:s')
            ];
            Modeltest_answer::updateOrCreate($answer_array);
//                return view('website.question', compact('modelTest'));
            return view('user.question', compact('modelTest'));
        }


    }
    
    

    
    public function solve_video($modelTestId, $questionId)
    {
        $student_id = Session:: get('id');

        
        $modeltest_exite = Modeltest_answer::where('modeltest_id', $modelTestId)->where('student_id', $student_id)->first();

        if ($modeltest_exite && $modeltest_exite->action_status == 1) {
            
            $solveClass = Question::where('id', $questionId)->value('solve_link');
            return view('user.solve_class', compact('solveClass'));
            
        } else {
            
            return back();
        }
                
        
    }


    

    public function answerQuestionModeltest(Request $request)
    {

        $totalQuestions = count($request->questions);

        $answer = Modeltest_answer::where('student_id', session::get('id'))->where('modeltest_id', $request->modeltest_id)->first()->id;

        if ($request->modeltest_exam_pattern == "BCS") {
            $answered = 0;
            $unanswered = 0;
            $right = 0;
            $point = 0;
            $totalPoint = 0;
            $wrong = 0;
            $totaluncheck_count = 0;
            $totalSba = 0;
            $rightSba = 0;
        
            foreach ($request->questions as $key => $question) {

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
                } else {
                    $totalSba++;
                }


                if (array_key_exists('option', $question)) {
                    foreach ($question['option'] as $key => $option) {

                        $option_id = Option::where('question_id', $question['questionId'])->where('id', $option)->first();

                        if ($option_id->correct_or_not == 1) {
                            if ($question_id_check->is_multi == 1) {
                                $point = $point + .4;
                            } else {
                                $point = $point + 1;
                                $rightSba++;
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
            $wrong = $wrong - $unanswered;
            $point = $point - (0.50 * $wrong);

            // return $point;
            $answer_array_for_update = [
                'exam_pattern' => $request->modeltest_exam_pattern,
                'total_questions' => $totalQuestions,
                'answered_questions' => $answered,
                'unanswered_questions' => $unanswered,
                'right_answers' => $right,
                'point' => $point,
                'wrong_answers' => $wrong,
                'total_sba' => $totalSba,
                'right_sba' => $rightSba,
                'action_status' => 1
            ];
            Modeltest_answer::where('id', $answer)->update($answer_array_for_update);
        } else {
            $totalMcq = 0;
            $totalSba = 0;
            $rightMcq = 0;
            $rightSba = 0;
            $wrongMcq = 0;
            $wrongSba = 0;
            $answered = 0;
            $unanswered = 0;
            $right = 0;
            $point = 0;
            $point_1 = 0;
            $totalPoint = 0;
            $wrong = 0;
            $totaluncheck_count = 0;
            $percentage = null;
            $pass_status = null;
            $candidate_type = null;
            $discipline = null;
            //dd(json_encode($request->modeltest_exam_pattern));
            
            if ($request->modeltest_exam_pattern == "Regular exam") {

                $candidate_type = $request->candidate;
                $discipline = $request->discipline;

            }

            foreach ($request->questions as $key => $question) {

                if (array_key_exists('option', $question)) {
                    $answered++;
                } else {
                    $unanswered++;
                }

                $question_id_check = Question::where('id', $question['questionId'])->first();
                if ($question_id_check->is_multi == 1) {
                    $totalMcq++;
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
                    $rightMcq = $rightMcq + $uncheck_count;
                    $uncheck_count *= .4;
                    $totaluncheck_count = $totaluncheck_count + $uncheck_count;
                } else {
                   $totalSba++; 
                }


                if (array_key_exists('option', $question)) {
                    foreach ($question['option'] as $key => $option) {

                        $option_id = Option::where('question_id', $question['questionId'])->where('id', $option)->first();

                        if ($option_id->correct_or_not == 1) {
                            if ($question_id_check->is_multi == 1) {
                                $rightMcq++;
                                $point = $point + .4;
                            } else {
                                $point = $point + 2;
                                $rightSba++;
                            }
                            $right++;
                        } else {
                            
                            if ($question_id_check->is_multi != 1) {
                                $wrongSba++;
                            }
                            
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
            
            if ($request->modeltest_exam_pattern == "Regular exam") {
            
                $percentage = round(100 * $point / $request->modeltest_total_mark, 1);
                
                if ($percentage >= 70) {
                    
                    $pass_status = "Passed";
                } else {
                    $pass_status = "Failed";
                }
            
            }
            
            // for residency, non residency
            $point_1 = ($rightMcq * 0.2) + ($rightSba * 1) - (5 * $totalMcq - $rightMcq) * 0.05 - ($wrongSba * 0.25);

            // return $point;
            $answer_array_for_update = [
                'exam_pattern' => $request->modeltest_exam_pattern,
                'total_questions' => $totalQuestions,
                'total_mcq' => $totalMcq,
                'total_sba' => $totalSba,
                'answered_questions' => $answered,
                'unanswered_questions' => $unanswered,
                'right_answers' => $right,
                'right_mcq' => $rightMcq,
                'right_sba' => $rightSba,
                'point' => $point,
                'percentage' => $percentage,
                'pass_status' => $pass_status,
                'point_1' => $point_1,
                'wrong_answers' => $wrong,
                'action_status' => 1,
                'candidate_type' => $candidate_type,
                'discipline' => $discipline,
            ];
            Modeltest_answer::where('id', $answer)->update($answer_array_for_update);
        }
        // return $request;
        return redirect('seeAnswerResult/' . $answer);
    }

    public function seeAnswerResult($answer_id)
    {
        $modelTestAnswer = Modeltest_answer::where('id', $answer_id)->get()->first();
        $modelTest = Modeltest::find($modelTestAnswer->modeltest_id) ?? abort(404);
        $answeredOptions =  Modeltest_answer_detail::where('modeltest_answer_id',$answer_id)->pluck('answered_option_id')->toArray();

//        return view('website.question_answer_result', compact('modelTestAnswer', 'modelTest'));
        return view('user.question_answer', compact('modelTestAnswer', 'modelTest', 'answeredOptions'));
    }
    
    
    

    public function clinical_case_answer
(Request $request)
    {
        
        $modelTest = Modeltest::find($request->modeltest_id) ?? abort(404);
        
        $studentInfo = Student:: where('mobile', $request->mobile)->first();

        
        if ($request->mobile && empty($studentInfo)) {
            
        
            $data = $request->only(['mobile']);
            $student = Student:: insertGetId($data);
            

        }

        
        return view('user.clinical_case_answer', compact('modelTest'));

    }

    public function seeQuizResult($quiz_id)
    {
        
        $quizAnswer = Modeltest_answer::where('modeltest_id', $quiz_id)->where('student_id', Session:: get('id'))->first();
        return redirect('seeAnswerResult/' . $quizAnswer->id);

    }
    

    public function paidmember(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'batch_id' => 'required',
            'mar' => 'required',
            'taka' => 'required',
            'transaction' => 'required',

        ], [
            'transaction.required' => 'plase enter your transaction',

        ]);

        if (session()->get('id') != $request->id) {
            session()->flash('error', 'Unauthorized access');
            return redirect('/');
        }

        /**
         * Check Batch Info
         */

        $batch = Membership::find($request->batch_id);
        if (empty($batch)) {
            session()->flash('error', 'Batch not found');
            return redirect('/');
        }


        /**
         * Check transactions validation
         */
//        $is_already_exist = Paidmember::where('student_id',$request->id)->where('mar',$request->mar)->where('transaction',$request->transaction)->first();
//        if($is_already_exist)
//        {
//            session()->flash('error','This payment already exist');
//            return redirect('/payment/'.$request->batch_id);
//        }

        /**
         * Check transactions validation
         */
//        $has_pending_member = Paidmember::where('student_id',$request->id)->where('batch_id',$request->batch_id)->where('is_approve',0)->first();
//        if($has_pending_member)
//        {
//            session()->flash('error','You have pending payment request for this course');
//            return redirect('/payment/'.$request->batch_id);
//        }

        /**
         * enrol for batch and store payment data
         */

        $has_enrolled = BatchStudent::where('student_id', $request->id)->where('batch_id', $request->batch_id)->first();
        if (empty($has_enrolled)) {
            session()->flash('error', 'You have not enrolled for this course');
            return redirect('/batches');
        }


//       if(($has_enrolled->paid + $request->taka)>$has_enrolled->payable)
//       {
//           session()->flash('error','Amount exceed than payable amount');
//           return redirect('/payment/'.$request->batch_id);
//       }
        $data['student_id'] = $request->id;
        $data['batch_id'] = $request->batch_id;
        $data['module_id'] = $request->module_id;
        $data['module_subcategory_id'] = $request->module_subcategory_id;
        $data['sub_id'] = $request->batch_duration_id;
        $data['transaction'] = $request->transaction;
        $data['mar'] = $request->mar;
        $data['amount'] = $request->taka;
        $data['reference_id'] = $has_enrolled->id;
        $data['created_at'] = Carbon::now()->toDateTimeString();

        //bt modification for addmission information
        session()->put('studentId', $request->id);
        session()->put('batchId', $request->batch_id);
        session()->put('subId', $request->batch_duration_id);
        session()->put('transactionId', $request->transaction);
        session()->put('mar', $request->mar);


        if ($request->batch_id == 6) {
            $data['is_approve'] = 1;
        }


        $Paidmember = Paidmember:: updateOrInsert([
                    'student_id' => $request->id,
                    'batch_id' => $request->batch_id,
                ],$data);

        $payableAmount = DB::table('batch_duration')
            ->select('bd_fee')
            ->where('bd_id', $request->batch_duration_id)
            ->first();

        $subEndDate = DB::table('batch_duration')
            ->select('bd_duration')
            ->where('bd_id', $request->batch_duration_id)
            ->first();

        $batchUpdate = DB::table('batch_students')
            ->where('student_id', '=', $request->id)
            ->where('batch_id', '=', $request->batch_id)
            ->update([
                'payable' => $payableAmount->bd_fee,
                'subscription_start' => Carbon::now()->toDateTimeString(),
                'subscription_end' => Carbon::now()->addDays($subEndDate->bd_duration),
                'bd_id' => $request->batch_duration_id,
            ]);

        if ($Paidmember or $batchUpdate) {
            #Send Message to the user
            $student_info = Student::find($request->id);
            //$msg = 'Welcome to Pure Basic family. Your payment BDT' . $request->taka . '   is successfully submitted.  Please wait for a while for approval.  Now  you can enjoy our Free Courses via Log in into your Account.';
            //SMS OTP only for BD User
            /*if ($student_info->country == 'Bangladesh') {
                $otp = new Otp;
                $otp->sendMessage($student_info->mobile, $msg);
                // return $otp;
            } else {
                $data = ['msg' => $msg, 'name' => $student_info->name];
                //       return view('website.mail.message',['message' => $message, 'name'=>$student_info->name]);
                Mail::send('website.mail.message', $data, function ($mail) use ($student_info) {
                    $mail->from('contact@purebasic.com.bd');
                    $mail->to($student_info->email)->subject('Purebasic Payment Confirmation!');
                });
            }*/

            //session()->flash('success', 'Payment successfully done, Please wait for approval');
            //session()->flash('approve', 'value');
            //   return redirect('/student/profile/' . session()->get('id'));

            $checkAdmission = DB::table('admission')
                ->where('pb_id', $request->id)
                ->where('batch_id', $request->batch_id)
                ->where('sub_id', $request->batch_duration_id)
                ->count('id');

            if ($checkAdmission >= 1)
            {
                return redirect('/payment_history/' . session()->get('id'));
            }
            else
            {
                return view('user.admissionform', compact('student_info'));
            }


        } else {
            session()->flash('error', 'Payment not done, Please try again');

            return redirect('/home');
        }
    }

    public function admissionFormShow()
    {
        return view('user.admissionform');
    }

    public function admissionFormSave(Request $request)
    {

        $admissionData = $request->only(['pb_id','address','enrolled_batch','payment_method','transaction_id','batch_id','sub_id']);
        

        if(!is_null($request->name)){
            $admissionData['name'] = $request->name;
            DB::table('students')->where('id', $request->pb_id)->update([
                'name' => $request->name]);

        }        
        if(!is_null($request->phone_number)){
            $admissionData['phone_number'] = $request->phone_number;
            DB::table('students')->where('id', $request->pb_id)->update([
                'mobile' => $request->phone_number]);

        }
        
        if(!is_null($request->email)){
            $admissionData['email'] = $request->email;
            DB::table('students')->where('id', $request->pb_id)->update([
                'email' => $request->email]);
        }
        
        if(!is_null($request->password)){
            DB::table('students')->where('id', $request->pb_id)->update([
                'password' => md5($request->password)]);
        }

        $admission = DB::table('admission')->insert($admissionData);
        
        
        /*$admissionData = DB::table('admission')
            ->insert([
                'pb_id' => $request->pb_id,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'bmdc' => $request->bmdc,
                'session' => $request->pb_session,
                'college' => $request->college,
                'address' => $request->address,
                'enrolled_batch' => $request->enrolled_batch,
                'payment_method' => $request->payment_method,
                'transaction_id' => $request->transaction_id,
                'batch_id' => $request->batch_id,
                'sub_id' => $request->sub_id
            ]);*/

        if ($admissionData) {
            return redirect('/student/profile/' . session()->get('id'));
        }

    }

    public function checkMailView($id)
    {
        $student_info = Student::find($id);
        $taka = 10000;
        $message = 'Welcome to Pure Basic family. Your payment BDT' . $taka . '   is successfully submitted.  Please wait for a while for approval.  Now  you can enjoy our Free Courses via Log in into your Account.';
        $data = ['msg' => $message, 'name' => $student_info->name];
        //       return view('website.mail.message',['message' => $message, 'name'=>$student_info->name]);
        Mail::send('website.mail.message', $data, function ($mail) use ($student_info) {
            $mail->from('contact@purebasic.com.bd');
            $mail->to($student_info->email)->subject('Purebasic Payment Confirmation!');
        });
    }

    public function duePay(Request $request)
    {
        $id = Session:: get('id');
        $student = Student:: where('id', $id)->first();
        $due = $student->membership->ammount - $student->taka;


        $this->validate($request, [
            'transaction' => 'required',

        ], [
            'transaction.required' => 'plase enter your transaction',

        ]);
        if ($due == $request->taka) {

            $data = [];
            $data['student_id'] = $request->id;
            $data['batch_id'] = $request->batch_id;
            $data['taka'] = $request->taka;
            $data['mar'] = $request->mar;
            $data['transaction'] = $request->transaction;
            $data['created_at'] = Carbon::now()->toDateTimeString();

            $Paidmember = Job:: insertGetId($data);

            if ($Paidmember) {
                session()->flash('success', 'value');
                session()->flash('approve', 'value');
                return redirect('/');
            } else {
                return back();
            }
        } else {
            session()->flash('error');
            return back();
        }
    }


    public function problem(Request $request)
    {

        $data = [];
        $data['student_id'] = Session:: get('id');
        $data['problem'] = $request->problem;
        $data['created_at'] = Carbon:: now()->toDateTimeString();

        $problem = Problem:: insert($data);
        if ($problem) {
            session()->flash('success', 'value');
            return redirect('/');
        } else {
            session()->flash('error', 'value');
            return back();
        }
    }


    public function reaply(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data['student_id'] = Session:: get('id');
        $data['problem_id'] = $id;
        $data['reaply'] = $request->reply;
        $reply = Reaply:: insert($data);
        if ($reply) {
            return redirect('/');
        } else {
            return back();
        }
    }

    public function view_video($id)
    {

        $userid = Session:: get('id');
        $user = Student:: where('id', $userid)->first();
        $sheet = LectureSheet:: where('id', $id)->where('status', 1)->first();
        $batchsheet = LectureBatch:: where('lecture_id', $sheet->id)->where('membershipe_id', $user->batch_id)->first() ?? abort(404);
        $allsheet = LectureSheet:: where('id', $batchsheet->lecture_id)->where('status', 1)->first();
        return view('website.view_video', compact('allsheet'));
    }

    //bt modification
    public function resultProfile($id)
    {
        if (session()->get('id') != $id) {
            Session::flash('error', 'Unauthorized access');
            return redirect('/');
        }


        $profile = Student:: where('status', 1)->where('id', $id)->first();
        if (empty($profile)) {
            Session:: flush('error', 'No user found');
            return redirect('/');
        }

        $batchResult = DB::table('modeltest_answers as a')
            ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
            ->leftJoin('memberships as m', 'b.membershipe_id', '=', 'm.id')
            ->where('a.student_id', $id)
            ->distinct()
            ->select('b.membershipe_id', 'm.plan')
            ->get();

//        $quizResult = DB::table('modeltest_answers as a')
//            ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
//            ->where('a.student_id', $id)
//            ->where('b.lecture_id', '!=', null)
//            ->sum('point');

        return view('user.result_profile', compact('batchResult'));
    }




    //bt modification
    public function studentProfile($id)
    {
        if (session()->get('id') != $id) {
            Session::flash('error', 'Unauthorized access');
            return redirect('/');
        }


        $profile = Student:: where('status', 1)->where('id', $id)->first();
        if (empty($profile)) {
            Session:: flush('error', 'No user found');
            return redirect('/');
        }

        return view('user.student_profile', compact('profile'));
    }



    public function result()
    {
        return view('website.result');
    }

    public function point()
    {
        $modeltest = Modeltest:: where('status', 1)->paginate(10);
        return view('user.exam_point', compact('modeltest'));
    }

    public function point_list($id)
    {
        $modelTestName =  Modeltest:: where('id', $id)->value("name");
        $modelTestMarks =  Modeltest:: where('id', $id)->value("exam_in_minutes");
        $modeltest = Modeltest_answer::with('students')->where('modeltest_id', $id)->orderBy('point', 'desc')->paginate(1000);
        
        $userPoint = Modeltest_answer::where('modeltest_id', $id)->where('student_id', Session::get('id'))->value('point');
        
        $userRank = Modeltest_answer::where('modeltest_id', $id)->where('point', '>', $userPoint)->count();
        
        
        return view('user.exam_point_list', compact('modeltest', 'modelTestName', 'modelTestMarks', 'userRank'));
    }


    public function admin_point_list($id)
    {
        $modelTestName =  Modeltest:: where('id', $id)->value("name");
        $modelTestMarks =  Modeltest:: where('id', $id)->value("exam_in_minutes");
        $modeltest = Modeltest_answer::with('students')->where('modeltest_id', $id)->orderBy('point', 'desc')->paginate(1000);
        
        $userPoint = 0;
        
        $userRank = -1;
        
        
        return view('user.exam_point_list', compact('modeltest', 'modelTestName', 'modelTestMarks', 'userRank'));
    }


    public function point_list_fcps($id)
    {
        $modelTestName =  Modeltest:: where('id', $id)->value("name");
        $modelTestMarks =  Modeltest:: where('id', $id)->value("exam_in_minutes");
        $modeltest = Modeltest_answer::with('students')->where('modeltest_id', $id)->orderBy('point', 'desc')->paginate(1000);
        
        $userPoint = Modeltest_answer::where('modeltest_id', $id)->where('student_id', Session::get('id'))->value('point');
        
        $userRank = Modeltest_answer::where('modeltest_id', $id)->where('point', '>', $userPoint)->count();
        
        return view('user.exam_point_list_fcps', compact('modeltest', 'modelTestName', 'modelTestMarks', 'userRank'));
    }
    
    
    public function point_list_ms_md_dds($id)
    {
        $modelTestName =  Modeltest:: where('id', $id)->value("name");
        $modelTestMarks =  Modeltest:: where('id', $id)->value("exam_in_minutes");
        $modeltest = Modeltest_answer::with('students')->where('modeltest_id', $id)->orderBy('point_1', 'desc')->paginate(1000);

        $userPoint = Modeltest_answer::where('modeltest_id', $id)->where('student_id', Session::get('id'))->value('point_1');
        
        $userRank = Modeltest_answer::where('modeltest_id', $id)->where('point_1', '>', $userPoint)->count();
        
        
        return view('user.exam_point_list_ms_md_dds', compact('modeltest', 'modelTestName', 'modelTestMarks', 'userRank'));
    }


    public function point_list_discipline($id)
    {
        $modelTestName =  Modeltest:: where('id', $id)->value("name");
        $modelTestMarks =  Modeltest:: where('id', $id)->value("exam_in_minutes");
        
        
        return view('user.exam_point_list_discipline', compact('id', 'modelTestName', 'modelTestMarks'));
    }
    
    
    
    public function point_list_by_discipline($id, $discipline)
    {
        
        
        $modelTestName =  Modeltest:: where('id', $id)->value("name");
        $modelTestMarks =  Modeltest:: where('id', $id)->value("exam_in_minutes");
        
        $discipline_modified = str_replace("_", " ", $discipline);
        
        $privateCandidate = Modeltest_answer::with('students')->where('modeltest_id', $id)->where('discipline', $discipline_modified)->where('candidate_type', "Private")->orderBy('point_1', 'desc')->paginate(1000);
        
        
        $governmentCandidate = Modeltest_answer::with('students')->where('modeltest_id', $id)->where('discipline', $discipline_modified)->where('candidate_type', "Government")->orderBy('point_1', 'desc')->paginate(1000);
        
        
        $userPoint = Modeltest_answer::where('modeltest_id', $id)->where('student_id', Session::get('id'))->value('point_1');
        
        $userDiscipline = Modeltest_answer::where('modeltest_id', $id)->where('student_id', Session::get('id'))->value('discipline');
        
        $candidate = Modeltest_answer::where('modeltest_id', $id)->where('student_id', Session::get('id'))->value('candidate_type');
        
        if ($userDiscipline == $discipline_modified) {
        
            if ($candidate == "Private") {
            
                $userRank = Modeltest_answer::where('modeltest_id', $id)->where('candidate_type', 'Private')->where('discipline', $discipline_modified)->where('point_1', '>', $userPoint)->count();
                
            } else {
                $userRank = Modeltest_answer::where('modeltest_id', $id)->where('candidate_type', 'Government')->where('discipline', $discipline_modified)->where('point_1', '>', $userPoint)->count();
                
            }
        
        } else {
            
           $userRank = null; 
        }
        
        return view('user.exam_point_list_by_discipline', compact('privateCandidate', 'governmentCandidate', 'modelTestName', 'modelTestMarks', 'discipline_modified', 'candidate', 'userDiscipline', 'userRank'));
    }
    
    
    

    public function my_exam_history()
    {

        $point = Modeltest_answer:: where('student_id', Session::get('id'))->orderBy('created_at', 'desc')->paginate(100);
        return view('user.my_exam_history', compact('point'));

    }
    
    public function my_quiz_history()
    {

        $point = Modeltest_answer:: where('student_id', Session::get('id'))->where('exam_pattern', '=', 'lecture')->orderBy('created_at', 'desc')->paginate(100);
        
        
        return view('user.my_quiz_history', compact('point'));

    }


    public function bookmarks()
    {

        return view('user.bookmarks');

    }


    public function watch_history()
    {

        return view('user.watch_history');

    }
    

    public function books()
    {
        $books = Visitor::where('status', 1)->orderBy('id', 'desc')->get()->chunk(3);
        //return view('user.books', 'books'));
    }

    public function notices()
    {

        $all = DB::table('batch_students as a')
        ->join('notices as b', function ($joinOne) {
        $joinOne->on('a.batch_id', '=', 'b.batch_id');
        })->where('a.student_id', Session::get('id'))->where('a.enroll_status', 1)->where('a.subscription_end', '>=', NOW())->select('b.id', 'b.batch_name','b.notice', 'b.link', 'b.updated_at')->latest('b.updated_at')
        ->get();
        
        $read = DB::table('notification_history')
        ->where('user_id', Session::get('id'))->pluck('notice_id')->toArray();
        

        return view('user.notice_by_user', compact('all', 'read'));
        
        

    }



    public function help()
    {
        $tutorials = DB::table('help')->where('is_tutorial', 1)->orderBy('serial', 'asc')->get();
        return view('website.help', compact('tutorials'));
    }



    public function class_info($idd)
    {
        $info = LectureSheet::where('cp_id', $idd)->where('status', 1)->orderBy('id', 'desc')->get();
        return view('website.class_info', compact('info', 'idd'));
    }

    public function chapter($id)
    {
        $chapter = Chapter::where('cat_id', $id)->where('status', 1)->orderBy('id', 'desc')->get();
        return view('website.chapter', compact('chapter'));
    }
    
    public function adminOtp() {

        $adminOtp = Student::where('id', 3074)->value('otp');

        return view('admin.admin_otp', compact('adminOtp'));        
        
    }
    

    
    public function contact() {

        return view('website.contact');
        
    }
    
    public function aboutUs() {

        $review = Problem:: where('status', 1)->orderBy('id', 'desc')->get();
        $mentors = Mentor::all();

        return view('website.about_us', compact('review', 'mentors'));
        
    }
    
    public function news() {

        return view('website.news');
        
    }    
    
    public function mentors() {

        $mentors = Mentor::orderBy('updated_at', 'desc')->get();

        return view('website.mentors', compact('mentors'));
        
    } 


    public function question_bank() {

        $modelTest = QuestionBank::first();
        
        return redirect('/question_bank_topic/' . $modelTest->id);

        //return view('website.question_bank.question_answer', compact('modelTest'));        
    }

    public function question_bank_topic($id)
    {

        
        $userId = Session::get('id');

        $has_enrolled =  BatchStudent::where('student_id',Session::get('id'))->where('batch_id', 87)->where('enroll_status', 1)->where('subscription_end', '>=', NOW())->first();


        
        $modelTest = QuestionBank::find($id) ?? abort(404);
        
        if ($has_enrolled) {
            
        
            return view('website.question_bank.question_answer', compact('modelTest',));
           
        }


        return view('website.question_bank.free_question_answer', compact('modelTest')); 



    }
    
}

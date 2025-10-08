<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modeltest_answer;
use App\ModeltestBatch;
use App\Modeltest;
use App\Student;
use App\Paidmember;
use App\Membership;
use App\Batchpackage;
use App\BatchStudent;
use Carbon\Carbon;
use Session;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $batchIds = Batchpackage::orderBy('updated_at', 'desc')->get(['batch_id', 'title']);
        
        $batchArray = [];
        
        
        foreach ($batchIds as $batchId) {
            $count = BatchStudent::where('batch_id', $batchId['batch_id'])->where('enroll_status', 1)->count();
            $batchArray[] = [$batchId['batch_id'], $batchId['title'], $count];

        }
        
        $otp = Student::where('id', 3074)->value('otp');

        return view('admin.index', compact('batchIds','batchArray', 'otp'));
    }


    public function search(Request $request)
    {

        $search = $request->search;
        $paidmember = Paidmember::with('students')
            ->orWhereHas('students' , function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orwhere('email', 'LIKE', "%$search%");
            })->where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.search.all', compact('paidmember'));
    }

    public function student_delete($id)
    {
        $student = Student:: where('status', 1)->where('id', $id)->first();
        $delete = Student:: where('status', 1)->where('id', $id)->delete();
        $delete = Paidmember:: where('status', 1)->where('student_id', $student->id)->delete();
        if ($delete) {
            return back();
        } else {
            return back();
        }
    }


    public function student_result()
    {
        $result = Modeltest_answer::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.result.all', compact('result'));
    }

    public function student_ex_result()
    {
        $result = Modeltest::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.result.exam', compact('result'));
    }

    public function m_view($id)
    {
        $batch = ModeltestBatch::where('modeltest_id', $id)->get();
        $request = Null;
        return view('admin.result.m_view', compact('batch', 'id', 'request'));
    }

    public function res_view(Request $request)
    {
        $batch = ModeltestBatch::where('modeltest_id', $request->modeltest_id)->get();
        $id = $request->modeltest_id;
        return view('admin.result.m_view', compact('batch', 'id', 'request'));
    }

    public function point()
    {
        return view('admin.result.point');
    }

    public function point_lint($id)
    {
        $modeltest = Modeltest_answer:: where('modeltest_id', $id)->orderBy('point', 'desc')->get();
        return view('admin.result.point_list', compact('modeltest'));
    }


    public function view($id)
    {

        $modelTest = Modeltest::find($id) ?? abort(404);
        
        return view('admin.question', compact('modelTest'));


    }


    public function solve($id)
    {

        $modelTest = Modeltest::find($id) ?? abort(404);
        
        return view('admin.question_answer', compact('modelTest'));


    }


    function studentsList() {
        $items = Student::orderBy('updated_at', 'desc')->paginate(100);
        return view('admin.student_info.all', compact('items'));
    }

    function mobileList() {
        $items = Student::orderBy('id', 'asc')->pluck('mobile');
        return view('admin.student_info.mobile', compact('items'));
    }
    
    function whatsappList() {
        $items = Student::where('whatsapp_number', '!=', 'null')->orderBy('id', 'asc')->pluck('whatsapp_number');
        return view('admin.student_info.whatsapp', compact('items'));
    }
    
    
    function details($studentId)
    {

        $otpRequired = Student::where('id', $studentId)->value('otp_required');
        return view('admin.student_info.student_details', compact('studentId', 'otpRequired'));
        
    }


    function viewInformation($studentId, $batchId, $enrollId)
    {

        $profile = Student::where('id', $studentId)->first();
        $enrollInfo = BatchStudent::where('id', $enrollId)->value('information');
        $batchInfo = Batchpackage::where('batch_id', $batchId)->value('title');
        
        return view('admin.updateBatchStudentInfo', compact('studentId','batchId', 'enrollId', 'profile', 'enrollInfo', 'batchInfo'));
        
    }



    function updateInformation($studentId, $batchId, $enrollId, Request $request)
    {

        $informationUpdate = DB::table('batch_students')->where('id', $enrollId)->where('student_id', $studentId)->where('batch_id', $batchId)->update(['information' => $request->information]);
 
        
        return redirect('/admin/updateInformation/user/' . $studentId . '/batch/' . $batchId . '/batchSubscription/' . $enrollId);
        
    }



    function profile_admin($id)
    {

        $profile = Student:: where('status', 1)->where('id', $id)->first();
        if (empty($profile)) {
            Session:: flush('error', 'No user found');
            return redirect('/');
        }

        return view('user.student_profile', compact('profile'));
    }    


    function view_profile_admin($id)
    {

        $profile = Student:: where('status', 1)->where('id', $id)->first();
        if (empty($profile)) {
            Session:: flush('error', 'No user found');
            return redirect('/');
        }

        return view('admin.student_profile', compact('profile'));
    }  



    function update_user_profile($id, Request $request)
    {


        $profileUpdate = DB::table('students')->where('id', $id)->update(['name' => $request->name, 'email' => $request->email, 'mobile' => $request->mobile, 'address' => $request->address]);
        
        if ($request->password) {
            DB::table('students')->where('id', $id)->update(['password' => md5($request->password)]);
            
        }
        

        if (empty($profileUpdate)) {
            Session:: flush('error', 'No user found');
            return redirect('/');
        }

        return redirect('/admin/updateProfile/user/' . $id);
    }  


    function payment_admin($id) {
        

        $profile = Student:: where('status', 1)->where('id', $id)->first();
        if(empty($profile))
        {
            Session:: flush('error','No user found');
            return redirect('/');
        }

        $enrolledBatches = BatchStudent::where('student_id',$id)->with('course')->latest('updated_at')->get()->chunk(3);

        return view('admin.payment_history', compact('profile', 'enrolledBatches'));      
        
    }    




    function update_subscription($userId, $batchId, Request $request)
    {

        $now = Carbon::now();

        
        if(!is_null($request->paid)){
            
                
                $batchDurationId = DB::table('batch_duration')->where('bd_batch_id', $batchId)->where('bd_duration', $request->addition)->where('bd_fee', $request->fees)->value('bd_id');
                
                $batchStudentsUpdate = DB::table('batch_students')->updateOrInsert(['student_id' => $userId, 'batch_id' => $batchId], ['student_id' => $userId, 'batch_id' => $batchId, 
                'fees' => $request->fees, 'payable' => $request->fees, 'paid' => $request->paid, 'enroll_at' => $now->toDateTimeString(), 
                'subscription_start' => $now->toDateTimeString(), 'subscription_end' => Carbon::now()->addDays($request->addition), 'enroll_status' => 1,
                'status' => 1, 'bd_id' => $batchDurationId, 'created_at' => $now->toDateTimeString(), 'updated_at' => $now->toDateTimeString(), 'created_by' => $userId,
                'updated_by' => $userId]);
                
                
                $batchSubscriptionHistoryUpdate = DB::table('batch_subscription_history')->insert(['student_id' => $userId, 'batch_id' => $batchId,'paid' => $request->paid, 
                'created_at' => $now->toDateTimeString(), 'updated_at' => $now->toDateTimeString()]);


        }
        
        
        if(!is_null($request->addition)){
            DB::table('batch_students')->where('student_id', $userId)->where('batch_id', $batchId)->update(['subscription_end' => Carbon::now()->addDays($request->addition), 'enroll_status' => 1, 'status' => 1, 'updated_at' => $now->toDateTimeString()]);

        }

        if(!is_null($request->reference)){
            DB::table('batch_students')->where('student_id', $userId)->where('batch_id', $batchId)->update(['reference' => $request->reference]);
            DB::table('batch_subscription_history')->where('student_id', $userId)->where('batch_id', $batchId)->update(['reference_id' => $request->reference]);

        }
        

        return redirect('/admin/payment/user/' . $userId);
    }

 
 
    function live_class_admin($id) {


        $profile = Student:: where('status', 1)->where('id', $id)->first();
        if(empty($profile))
        {
            Session:: flush('error','No user found');
            return redirect('/');
        }

         $enrolledBatches = DB::table('batch_students as a')
        ->join('batchpackages as b', function ($joinOne) {
            $joinOne->on('a.batch_id', '=', 'b.batch_id');
        })
        ->where('a.student_id', '=', $id)->where('a.enroll_status', 1)->where('a.subscription_end', '>=', NOW())->select('a.batch_id','a.subscription_end', 'b.title', 'b.fild_9')->latest('a.enroll_at')
        ->get();

        return view('user.live_class_by_user', compact('profile', 'enrolledBatches'));      
        
    }
    

    function lecture_admin($id) {


        $profile = Student:: where('status', 1)->where('id', $id)->first();
        
        if(empty($profile))
        {
            Session:: flush('error','No user found');
            return redirect('/');
        }
        
     
         $enrolledBatches = DB::table('batch_students as a')
        ->join('batchpackages as b', function ($joinOne) {
            $joinOne->on('a.batch_id', '=', 'b.batch_id');
        })
        ->where('a.student_id', '=', $id)->where('a.enroll_status', 1)->where('a.subscription_end', '>=', NOW())->select('a.batch_id','a.subscription_end', 'b.title', 'b.fild_5')->latest('a.enroll_at')
        ->get();   



        return view('user.lecture_by_user', compact('profile', 'enrolledBatches'));      
        
    }
    
    

    function discussion_admin($id) {


        $profile = Student:: where('status', 1)->where('id', $id)->first();
        if(empty($profile))
        {
            Session:: flush('error','No user found');
            return redirect('/');
        }

         $enrolledBatches = DB::table('batch_students as a')
        ->join('batchpackages as b', function ($joinOne) {
            $joinOne->on('a.batch_id', '=', 'b.batch_id');
        })
        ->where('a.student_id', '=', $id)->where('a.enroll_status', 1)->where('a.subscription_end', '>=', NOW())->select('a.batch_id','a.subscription_end', 'b.title', 'b.fild_6')->latest('a.enroll_at')
        ->get();

        return view('user.discussion_by_user', compact('profile', 'enrolledBatches'));      
        
    }


    function exam_admin($id) {

        $profile = Student:: where('status', 1)->where('id', $id)->first();
        if(empty($profile))
        {
            Session:: flush('error','No user found');
            return redirect('/');
        }

         $enrolledBatches = DB::table('batch_students as a')
        ->join('batchpackages as b', function ($joinOne) {
            $joinOne->on('a.batch_id', '=', 'b.batch_id');
        })
        ->where('a.student_id', '=', $id)->where('a.enroll_status', 1)->where('a.subscription_end', '>=', NOW())->select('a.batch_id','a.subscription_end', 'b.title')->latest('a.enroll_at')
        ->get();

        return view('user.exam_by_user', compact('profile', 'enrolledBatches'));      
        
    }
    
    
    function modeltest_history_admin($id)
    {

        $point = Modeltest_answer:: where('student_id', $id)->where('exam_pattern', '=', 'Regular exam')->orderBy('created_at', 'desc')->paginate(100);
        return view('user.my_exam_history', compact('point'));

    }


    public function enableOtp($id)
    {


        $otpStatusr = DB::table('students')->where('id', $id)->update([
                    'otp_required' => 1,
                    ]);
                    
            return redirect('/admin/student_info/' . $id);

    }
    
    
    public function disableOtp($id)
    {


        $otpStatusr = DB::table('students')->where('id', $id)->update([
                    'otp_required' => 0,
                    ]);
                    
            return redirect('/admin/student_info/' . $id);

    }
    
    
    public function studentById()
    
    {
        
        return view ('admin.student_by_id');
        
    }
    
    public function studentByMobile()
    
    {
        
        return view ('admin.student_by_mobile');
        
    }


    public function studentByName()
    
    {
        
        return view ('admin.student_by_name');
        
    }



    public function findUserById(Request $request)
    
    {
        $profile = Student:: where('id', $request->id)->first();

        if(empty($profile))
        {
            Session:: flush('error','No user found');
            return redirect('/admin');
        }
        
        return redirect('/admin/student_info/' . $request->id);

        
    }
    
    
    public function findUserByMobile(Request $request)
    
    {
        $items = Student:: where('mobile', 'regexp', $request->mobile)->paginate(100);
        if(empty($items))
        {
            Session:: flush('error','No user found');
            return redirect('/admin');
        }
        
        return view('admin.student_info.all', compact('items'));

        
    }


    public function findUserByName(Request $request)
    
    {
        $items = Student:: where('name', 'regexp', $request->name)->paginate(100);
        
        if(empty($items))
        {
            Session:: flush('error','No user found');
            return redirect('/admin');
        }
        
        return view('admin.student_info.all', compact('items'));

        
    }


}

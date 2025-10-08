<?php

namespace App\Http\Controllers\Admin;

use App\BatchStudent;
use App\BatchSubscriptionHistory;
use App\Membership;
use App\Otp\Otp;
use App\Paidmember;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        //       $paidmember = Paidmember:: where('status', 1)->orderByRaw('FIELD(is_approve,0) desc')->orderBy('batch_id','desc')->get();

        // $paidmember = Paidmember:: where('status', 1)->orderBy('batch_id','desc')->get();

        //bt modification
        $showReport = 0;
        $batchData = DB::table('memberships')
            ->select('id', 'plan')
            ->orderBy('plan', 'asc')
            ->get();

        return view('admin.payment.all', compact('batchData', 'showReport'));
    }

    public function PaymentDataLoad(Request $request)
    {

        $batchData = DB::table('memberships')
            ->select('id', 'plan')
            ->orderBy('plan', 'asc')
            ->get();

        $batchId = $request->batch_id;
        $appStatus = $request->app_status;
        $showReport = 1;

        if ($batchId != null)
        {
            $paidmember = DB::table('batch_students as s')
                ->leftJoin('paidmembers as p', 's.id', '=', 'p.reference_id')
                ->leftJoin('memberships as m', 's.batch_id', '=', 'm.id')
                ->leftJoin('batch_duration as bd', 'p.sub_id', '=', 'bd.bd_id')
                ->leftJoin('students as st', 's.student_id', '=', 'st.id')
                ->where('p.status', 1)
                ->where('s.batch_id', $batchId)
                ->select('p.created_at', 'p.id', 'st.name', 'p.student_id', 'st.mobile', 'm.plan', 'bd.bd_duration', 'p.mar', 'p.amount', 'p.transaction', 'p.is_approve', 's.payable', 's.paid', 'st.address')
                ->get();
        }

        if ($appStatus != null)
        {
            $paidmember = DB::table('batch_students as s')
                ->leftJoin('paidmembers as p', 's.id', '=', 'p.reference_id')
                ->leftJoin('memberships as m', 's.batch_id', '=', 'm.id')
                ->leftJoin('batch_duration as bd', 'p.sub_id', '=', 'bd.bd_id')
                ->leftJoin('students as st', 's.student_id', '=', 'st.id')
                ->where('p.status', 1)
                ->where('p.is_approve', $appStatus)
                ->select('p.created_at', 'p.id', 'st.name', 'p.student_id', 'st.mobile', 'm.plan', 'bd.bd_duration', 'p.mar', 'p.amount', 'p.transaction', 'p.is_approve', 's.payable', 's.paid', 'st.address')
                ->get();
        }

        if ($appStatus != null && $batchId != null)
        {
            $paidmember = DB::table('batch_students as s')
                ->leftJoin('paidmembers as p', 's.id', '=', 'p.reference_id')
                ->leftJoin('memberships as m', 's.batch_id', '=', 'm.id')
                ->leftJoin('batch_duration as bd', 'p.sub_id', '=', 'bd.bd_id')
                ->leftJoin('students as st', 's.student_id', '=', 'st.id')
                ->where('p.status', 1)
                ->where('s.batch_id', $batchId)
                ->where('p.is_approve', $appStatus)
                ->select('p.created_at', 'p.id', 'st.name', 'p.student_id', 'st.mobile', 'm.plan', 'bd.bd_duration', 'p.mar', 'p.amount', 'p.transaction', 'p.is_approve', 's.payable', 's.paid', 'st.address')
                ->get();
        }

        if ($appStatus == null && $batchId == null)
        {
            $showReport = 0;
        }

        return view('admin.payment.all', compact('batchData', 'showReport', 'paidmember'));

    }

    public function approval($id)
    {


        ## Updated payment info table
        $payment_info = Paidmember::find($id);
        if (empty($payment_info)) {
            session()->flash('error', 'Payment info not exist');
            return redirect('admin/payment');
        }

        if ($payment_info->is_approve == 1) {
            session()->flash('error', 'Already approved');
            return redirect('admin/payment');
        }

        #Update batch student table
        $enroll_info = BatchStudent::where('student_id', $payment_info->student_id)->where('batch_id', $payment_info->batch_id)->first();
        if (empty($enroll_info)) {
            session()->flash('error', 'Enrollment not found');
            return redirect('admin/payment');
        }


        #Batch info checking
        $batch_info = Membership::where('id', $payment_info->batch_id)->first();
        if (empty($batch_info)) {
            session()->flash('error', 'Course info not found');
            return redirect('admin/payment');
        }

        #Calculating paid amount
        $total_paid = $enroll_info->paid + $payment_info->amount;
        #if There is no subscription, update subscription table
        if (!$this->hasActiveSubscription($enroll_info)) {
            $subscription_start = date('Y-m-d H:i:s');
            if (!empty($batch_info->subscription_days)) {
                $subscription_end = date('Y-m-d H:i:s', strtotime('+' . $batch_info->subscription_days . ' day', strtotime($subscription_start)));
            } else {
                #default 365 days
                $subscription_end = date('Y-m-d H:i:s', strtotime('+365 day', strtotime($subscription_start)));
            }

            #Subscription table updating
            $batch_subscription_info = new BatchSubscriptionHistory();
            $batch_subscription_info->reference_id = $enroll_info->id;
            $batch_subscription_info->batch_id = $payment_info->batch_id;
            $batch_subscription_info->student_id = $payment_info->student_id;
            $batch_subscription_info->fees = $enroll_info->fees;
            $batch_subscription_info->payable = $enroll_info->payable;
            $batch_subscription_info->enroll_at = $enroll_info->enroll_at;
            $batch_subscription_info->subscription_start = $subscription_start;
            $batch_subscription_info->subscription_end = $subscription_end;
            $batch_subscription_info->enroll_status = 1;
            $batch_subscription_info->status = 1;
            $batch_subscription_info->created_at = date('Y-m-d H:i:s');
            $batch_subscription_info->created_by = Auth::id();
            $batch_subscription_info->save();

            #Subscritions data updating
            $enroll_info->subscription_start = $subscription_start;
            $enroll_info->subscription_end = $subscription_end;

        }

        ##Batch info updating
        $enroll_info->enroll_status = 1;
        $enroll_info->paid = $total_paid;
        $enroll_info->updated_at = date('Y-m-d H:i:s');
        $enroll_info->updated_by = Auth::id();
        $enroll_info->save();

        #Updated payment Table
        $payment_info->is_approve = 1;
        $payment_info->approved_at = date('Y-m-d H:i:s');
        $payment_info->save();

        $student_info = Student::find($payment_info->student_id);
        $msg = 'Welcome to Pure Basic family. Your payment ' . $payment_info->amount . ' is Approved. Now you can enjoy your course via Log in into your Account.';
        //SMS OTP only for BD User
        if ($student_info->country == 'Bangladesh') {
            $otp = new Otp;
            $otp->sendMessage($student_info->mobile, $msg);
            // // return $otp;
        } else {
            $data = ['msg' => $msg, 'name' => $student_info->name];
            //       return view('website.mail.message',['message' => $message, 'name'=>$student_info->name]);
            Mail::send('website.mail.message', $data, function ($mail) use ($student_info) {
                $mail->from('contact@purebasic.com.bd');
                $mail->to($student_info->email)->subject('Purebasic Payment Confirmation!');
            });
        }


        session()->flash('success', 'Payment Approved successfully done');
        return redirect('admin/payment');

    }

    private function hasActiveSubscription($batch_student_info)
    {
        if ($batch_student_info->subscription_start = null && $batch_student_info->subscription_end = null) {
            return false;
        } elseif ($batch_student_info->subscription_end < date('Y-m-d H:i:s')) {
            return false;
        } else {
            return true;
        }
    }

    public function reject($id)
    {

        ## Updated payment info table
        $payment_info = Paidmember::find($id);
        if (empty($payment_info)) {
            session()->flash('error', 'Payment info not exist');
            return redirect('admin/payment');
        }

        #Updated payment Table
        $payment_info->is_approve = 2;
        $payment_info->save();

        session()->flash('success', 'Payment rejected successfully');
        return redirect('admin/payment');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Paidmember::find($id);
        if (empty($item)) {
            session()->flash('error', 'Payment info not exist');
            return redirect('admin/payment');
        }
        $item->status = 2;
        $item->save();

        session()->flash('success', 'Payment deleted successfully');
        return redirect('admin/payment');
    }
}

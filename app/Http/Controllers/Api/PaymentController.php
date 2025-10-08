<?php

namespace App\Http\Controllers\Api;

use App\BatchStudent;
use App\Membership;
use App\Otp\Otp;
use App\Paidmember;
use App\Student;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    use ApiResponse;


    public function makePayment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'student_id' => ['required'],
            'batch_id' => ['required'],
            'sub_id' => ['required'],
            'amount' => ['required'],
            'mar' => ['required'],
            'transaction' => ['required'],
        ]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $student_id = $request->student_id;
        $batch_id = $request->batch_id;
        $subs_id = $request->sub_id;
        $amount = $request->amount;
        $mar = $request->mar;
        $transaction = $request->transaction;

        /**
         * enrol for batch and store payment data
         */
        $has_enrolled =  BatchStudent::where('student_id',$student_id)->where('batch_id',$batch_id)->where('status',1)->first();
        if(empty($has_enrolled))
            return $this->respondWithError('You have not enroll this batch, Please enroll',404);

        /**
         * Check transactions validation
         */
        $is_already_exist = Paidmember::where('student_id',$student_id)->where('mar',$request->payment_type)->where('transaction',$request->transaction)->first();
        if($is_already_exist)
            return $this->respondWithError('This payment already exist',404);

        /**
         * Check transactions validation
         */
        $has_pending_member = Paidmember::where('student_id',$student_id)->where('batch_id',$batch_id)->where('is_approve',0)->first();
        if($has_pending_member)
            return $this->respondWithError('You have pending payment request for this course',404);

        #Request amount greater than dua amount
        # if(($has_enrolled->paid + $amount)>$has_enrolled->payable)
        #   return $this->respondWithError('Amount exceed than payable amount',404);
        if($amount <= 0 )
            return $this->respondWithError('Amount can not 0 or Negative',404);

        $Paidmember = new Paidmember();
        $Paidmember->student_id = $student_id;
        $Paidmember->batch_id = $batch_id;
        $Paidmember->sub_id = $subs_id; //bt modification
        $Paidmember->transaction = $transaction;
        $Paidmember->mar = $mar;
        $Paidmember->amount = $amount;
        $Paidmember->reference_id = $has_enrolled->id;
        $Paidmember->created_at = Carbon::now()->toDateTimeString();
        if ($request->batch_id == 6) {
            $Paidmember->is_approve = 1;
        }

        #update other tables
        $payableAmount = DB::table('batch_duration')
            ->select('bd_fee')
            ->where('bd_id', $request->sub_id)
            ->first();

        $subEndDate = DB::table('batch_duration')
            ->select('bd_duration')
            ->where('bd_id', $request->sub_id)
            ->first();

        if ( $Paidmember->save())
        {
            DB::table('batch_students')
            ->where('student_id', '=', $request->student_id)
            ->where('batch_id', '=', $request->batch_id)
            ->update([
                'payable' => $payableAmount->bd_fee,
                'subscription_start' => Carbon::now()->toDateTimeString(),
                'subscription_end' => Carbon::now()->addDays($subEndDate->bd_duration),
                'bd_id' => $request->sub_id,
            ]);
        }

        #Send Message to the user
        $student_info = Student::find($student_id);

        if(empty($student_info))
            return $this->respondWithError('No student found',404);

        $msg ='Welcome to Pure Basic family. Your payment BDT'.$amount.'   is successfully submitted.  Please wait for a while for approval.  Now  you can enjoy our Free Courses via Log in into your Account.';
        //SMS OTP only for BD User
        if($student_info->country == 'Bangladesh'){
            $otp = new Otp;
            $otp->sendMessage($student_info->mobile,$msg);
            // // return $otp;
        }else{
            $data =['msg' => $msg, 'name'=>$student_info->name];
            //       return view('website.mail.message',['message' => $message, 'name'=>$student_info->name]);
            Mail::send('website.mail.message',$data, function ($mail) use ($student_info) {
                $mail->from('contact@purebasic.com.bd');
                $mail->to($student_info->email)->subject('Purebasic Payment Confirmation!');
            });
        }

        return $this->respondWithSuccess('Payment successfully done, Please wait for approval');

    }

    public function paymentHistory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => ['required'],
        ]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $student_id = $request->student_id;

        $paymentHistory = Paidmember::with('batch')->where('student_id',$student_id)->orderBy('created_at','desc')->get();
        return $this->respondWithSuccess('Payment History',$paymentHistory);

    }
}

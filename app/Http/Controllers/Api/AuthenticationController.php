<?php

namespace App\Http\Controllers\Api;

use App\Otp\Otp;
use App\Student;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    use ApiResponse;


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator= Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'mobile' => 'required|unique:students,mobile',
            'password' => 'required|min:6',
            'country' => 'required'
        ], [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'email.unique' => 'This email already exist',
            'mobile.required' => 'Please enter your mobile',
            'mobile.unique' => 'This mobile already exist',
            'password.required' => 'Please enter password',
        ]);

      if($validator->fails())
          return $this->respondWithValidationError($validator->errors()->toArray());

        $data = $request->only(['name','email','mobile','country']);

        $data['otp'] = rand(1000, 9999);
        $data['password'] = md5($request->password);

        $student = Student:: insertGetId($data);

        //SMS OTP only for BD User
        if($request->country == 'Bangladesh'){
            $otp = new Otp;
            $otp->otp($student);
            // // return $otp;
        }else{
            Mail::send('website.mail.otp', ['otp' => $data['otp']], function ($mail) use ($request) {
                $mail->from('contact@purebasic.com.bd');
                $mail->to($request->email)->subject('Purebasic Registration OTP!');
            });
        }


        if ($student) {
            $return_data=[
                'user_id'=>$student,
                'opt'=>$data['otp']
            ];

            //generate Student ID
            $student_info = Student::find($student);
            $student_info->student_id=sprintf("%06d", $student_info->id);
            $student_info->save();
            return $this->respondWithSuccessNext('Registration request successful, Please verify your account','opt_verification',$return_data);

        } else {
            return $this->respondWithError('Not done, Try again',404);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @param $is_login
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */

    public function otp_verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'user_id' => 'required',
            'from_page' => 'required',
        ]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());


        $id = $request->input('user_id');
        $is_login = $request->input('from_page');
        $student = Student::where('id', $id)->first();
        #student check
        if(empty($student))
            return $this->respondWithError('User not found',404);

        #Otp not Match
        if ($student->otp != $request->otp)
            return $this->respondWithError('Invalid OTP',401);

        //Create api_token and return with login information
        $token = Str::random(60);
        $student->api_token = $token;
        $student->otp=NULL;
        $student->save();

        $returnData = [
            'api_token'=>Crypt::encryptString($token),
            'student_info'=>$this->getStudentLoginInfo($student->id),
            'play_store_key'=>config('sys.google_play_store_key')
        ];
        return $this->respondWithSuccess('OTP verified',$returnData);
    }

    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required']]);


        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $user_id = $request->user_id;
        $student = Student::find($user_id);

        if(empty($student))
            return $this->respondWithError('Student not found',404);

        $studentOPT =rand(1000, 9999);
        $student->otp = $studentOPT;
        $student->save();

        //OTP send to mobile
        if(!empty($student->mobile)){
            $otp = new Otp;
            $otp->otp($student->id);
        }

        //OTP send to email
        if(!empty($student->email)){
            Mail::send('website.mail.otp', ['otp' => $studentOPT], function ($mail) use ($student) {
                $mail->from('contact@purebasic.com.bd');
                $mail->to($student->email)->subject('Purebasic Reset Password OTP!');
            });
        }

        $return_data=[
            'user_id'=>$student->id,
            'opt'=>$studentOPT
        ];
        return $this->respondWithSuccessNext('OTP request successful, Please verify','opt_verification',$return_data);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required','min:6']]);


        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $email = $request->email;
        $password = md5($request->password);

        $is_email=False;
        #Check email or mobile number
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $is_email=True;
        }
        if ($is_email) {
            $student = Student:: where('email', $email)->where('password', $password)->first();
        } else {
            $student = Student:: where('mobile', $email)->where('password', $password)->first();
        }

        #Not exist
        if(empty($student))
            return $this->respondWithError('No user found',404);

        $studentOPT =rand(1000, 9999);
        $update = Student:: where('id', $student->id)->update([
            'otp' => $studentOPT,
        ]);

        if(!$is_email){
            $otp = new Otp;
            $otp->otp($student->id);
        }else{
            Mail::send('website.mail.otp', ['otp' => $studentOPT], function ($mail) use ($student) {
                $mail->from('contact@purebasic.com.bd');
                $mail->to($student->email)->subject('Purebasic Login OTP!');
            });
        }

        $return_data=[
            'user_id'=>$student->id,
            'opt'=>$studentOPT
        ];
        return $this->respondWithSuccessNext('Login request successful, Please verify','opt_verification',$return_data);

    }



    private function getStudentLoginInfo($student_id)
    {
        $studentInfo = Student::withCount('batch')->with('batch')->find($student_id);
        return $studentInfo;
    }


    public function apiTokenTest()
    {
        return $this->respondWithSuccess('request passed');
    }



    public function updateStudentInfo($request,$id)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required','min:6']]);


        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $student = Student::find($id);
        if(empty($student))
            return $this->respondWithError('Student Not found',404);


        return $student;
    }


    public function forgotUserVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_mobile' => ['required']]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());

        $email = $request->email_or_mobile;

        $is_email=False;
        #Check email or mobile number
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $is_email=True;
        }
        if ($is_email) {
            $student = Student:: where('email', $email)->first();
        } else {
            $student = Student:: where('mobile', $email)->first();
        }

        #Not exist
        if(empty($student))
            return $this->respondWithError('No user found',404);

        $studentOPT =rand(1000, 9999);
        $update = Student:: where('id', $student->id)->update([
            'otp' => $studentOPT,
        ]);

        if(!$is_email){
            $otp = new Otp;
            $otp->otp($student->id);
        }else{
            Mail::send('website.mail.otp', ['otp' => $studentOPT], function ($mail) use ($student) {
                $mail->from('contact@purebasic.com.bd');
                $mail->to($student->email)->subject('Purebasic Login OTP!');
            });
        }

        $return_data=[
            'user_id'=>$student->id,
            'opt'=>$studentOPT
        ];
        return $this->respondWithSuccessNext('Forgot password request successful, Please verify your reset OTP','opt_verification',$return_data);

    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'user_id' => 'required',
            'new_password' => 'required',
        ]);

        if($validator->fails())
            return $this->respondWithValidationError($validator->errors()->toArray());


        $id = $request->input('user_id');
        $student = Student::find($id);
        #student check
        if(empty($student))
            return $this->respondWithError('User not found',400);

        #Otp not Match
        if ($student->otp != $request->otp)
            return $this->respondWithError('Invalid OTP',400);

        $student->otp=NULL;
        $student->password=md5($request->new_password);
        $student->save();

        return $this->respondWithSuccess('Password Reset Successfully done');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

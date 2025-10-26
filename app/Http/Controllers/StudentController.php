<?php

namespace App\Http\Controllers;

use App\Otp\Otp;
use App\BatchPromotion;
use App\BatchStudent;
use App\Chapter;
use App\LectureSheet;
use App\Membership;
use App\Paidmember;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;
use Mail;
use Session;

class StudentController extends Controller
{
    public function register()
    {
        $data = Membership::where('status', 1)->get();
        return view('website.register', compact('data'));
    }

    public function register_form(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'mobile' => 'required|unique:students,mobile',
            'password' => 'required|min:6|confirmed',
            'country' => 'required'
        ], [
            'name.required' => 'plase enter your name',
            'email.required' => 'plase enter your email',
            'email.unique' => 'This email already exist',
            'mobile.required' => 'plase enter your mobile',
            'mobile.unique' => 'This mobile already exist',
            'password.required' => 'plase enter password',
            'password.confirmed' => 'password did not match',
        ]);

        $data = $request->only(['name', 'email', 'mobile', 'country']);

        $data['otp'] = rand(1000, 9999);
        $data['password'] = md5($request->password);

        $student = Student::insertGetId($data);

        // SMS OTP only for BD User
        if ($request->country == 'Bangladesh') {
            $otp = new Otp;
            $otp->otp($student);
            // // return $otp;
        } else {
            Mail::send('website.mail.otp', ['otp' => $data['otp']], function ($mail) use ($request) {
                $mail->from('mail.purebasic.com.bd');
                $mail->to($request->email)->subject('Purebasic Registration OTP!');
            });
        }

        if ($student) {
            session()->flash('success', 'Registration request successful, Please verify your account');
            return redirect('/student/otp/' . $student . '/reg');
        } else {
            return back();
        }
    }

    public function password($id, $method)
    {
        $student = Student::where('id', $id)->first();
        return view('website.password', compact('student', 'method'));
    }

    public function password_verify(Request $request, $id, $method)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);

        $student = Student::where('id', $id)->first() ?? abort(404);

        if ($student->password == md5($request->password)) {
            $loginOTP = rand(1000, 9999);

            $update = Student::where('id', $student->id)->update([
                'otp' => $loginOTP,
            ]);

            if ($method == 'phone') {
                $otp = new Otp;
                $otp->otp($id);
            }  /* else{
                  Mail::send('website.mail.otp', ['otp' => $loginOTP], function ($mail) use ($student) {
                      $mail->from('contact@purebasic.com.bd');
                      $mail->to($student->email)->subject('Purebasic Login OTP!');
                  });
              }*/

            return redirect('/student/otp/' . $id . '/login');
        } else {
            session()->flash('error', 'Password not matched !');
            return redirect()->back();
        }
    }

    public function otp($id, $is_login)
    {
        $student = Student::where('id', $id)->first();
        $number = $student->mobile;
        $otp = $student->otp;
        $otpRequired = $student->otp_required;
        return view('website.otp', compact('student', 'is_login', 'number', 'otp', 'otpRequired', 'id'));
    }

    public function otp_verify(Request $request, $id, $is_login)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);

        $student = Student::where('id', $id)->first() ?? abort(404);

        if ($student->otp == $request->otp) {
            // Create api_token and return with login information
            $token = Str::random(60);
            $student->api_token = $token;
            $student->otp = NULL;
            $student->save();
            //            $student_verify = Student::where('id', $id)->where('otp', $request->otp)->update([
            //                'otp' => NULL,
            //            ]);

            $this->make_student_login($student);
            if ($is_login == 'reg') {
                // Generate Student ID
                $student->student_id = $this->generateStudentID($student->id);
                $student->save();
                // session()->flash('success', 'Successfully registered please enroll your desired course');
                return redirect('/home');
            } else {
                // session()->flash('success', 'Successfully login, You can enroll your desired course');

                return redirect('/home');

                // return redirect('/student/profile/'.session()->get('id'));
            }
        } else {
            session()->flash('error', 'Your Otp Invalid !');
            return redirect()->back();
        }
    }

    private function make_student_login($student)
    {
        Session::put('id', $student->id);
        Session::put('login_type', 'student');
        Session::put('is_student_login', true);
        Session::put('name', $student->name);
        Session::put('api_token', $student->api_token);
        Session::put('student_info', $student->toArray());
    }

    public function login()
    {
        return view('website.login');
    }

    /**
     * Forgot password
     */
    public function resetPassword()
    {
        return view('website.reset_password');
    }

    public function resetOtp(Request $request)
    {
        $this->validate($request, [
            'email' => ['required']
        ]);

        $email = $request->email;

        $is_email = False;
        // Check email or mobile number
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $is_email = True;
        }

        if ($is_email) {
            $login = Student::where('email', $email)->where('status', 1)->first();
        } else {
            $login = Student::where('mobile', $email)->where('status', 1)->first();
        }

        if ($login) {
            $loginOPT = rand(1000, 9999);
            $update = Student::where('id', $login->id)->update([
                'otp' => $loginOPT,
            ]);

            if (!$is_email) {
                $otp = new Otp;
                $otp->otp($login->id);
            } else {
                Mail::send('website.mail.otp', ['otp' => $loginOPT], function ($mail) use ($login) {
                    $mail->from('contact@purebasic.com.bd');
                    $mail->to($login->email)->subject('Purebasic Password Reset OTP!');
                });
            }

            return redirect('/student/reset_otp/' . $login->id . '/reset_password');
        } else {
            Session::flash('error', 'OTP is not valid');
            return back();
        }
    }

    public function showResetPassword($id)
    {
        $student = Student::where('id', $id)->first();
        $otp = new Otp;
        $otp->otp($id);
        $otp = $student->otp;
        $number = $student->mobile;
        return view('website.reset_otp', compact('student', 'otp', 'number'));
    }

    public function submitResetPass(Request $request, $id)
    {
        $this->validate($request, [
            'otp' => 'required',
            'password' => 'required|confirmed'
        ], [
            'otp.required' => 'plase enter OTP',
            'password.required' => 'plase enter password',
            'password.confirmed' => 'password did not match',
        ]);

        $student = Student::where('id', $id)->first() ?? abort(404);
        if ($student->otp == $request->otp) {
            $student_verify = Student::where('id', $id)->where('otp', $request->otp)->update([
                'otp' => NULL, 'password' => md5($request->password)
            ]);

            session()->flash('success', 'Password reset successfully please login');
            return redirect('/student/login');
        } else {
            session()->flash('error', 'Your Otp Invalid !');
            return redirect()->back();
        }
    }

    public function loginSubmit(Request $request)
    {
        /*$this->validate($request, [
            'email' => ['required'],
            'password' => ['required','min:6'],
        ]);*/
        $this->validate($request, [
            'email' => ['required'],
        ]);
        $email = $request->email;
        // $password = md5($request->password);

        $is_email = False;
        // Check email or mobile number
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $is_email = True;
        }

        if ($is_email) {
            $login = Student::where('email', $email)->first();
            $method = 'email';
        } else {
            $login = Student::where('mobile', $email)->first();
            $method = 'phone';
        }

        $loginOTP = rand(1000, 9999);

        if ($login) {
            $isPassword = Student::where('id', $login->id)->value('password');

            if (!is_null($isPassword)) {
                return redirect('/student/password/' . $login->id . '/login/' . $method);
            }

            $update = Student::where('id', $login->id)->update([
                'otp' => $loginOTP,
            ]);

            if (!$is_email) {
                $otp = new Otp;
                $otp->otp($login->id);
            } else {
                Mail::send('website.mail.otp', ['otp' => $loginOTP], function ($mail) use ($login) {
                    $mail->from('contact@purebasic.com.bd');
                    $mail->to($login->email)->subject('Purebasic Login OTP!');
                });
            }

            return redirect('/student/otp/' . $login->id . '/login');
        } else {
            $registrationData = [];

            if ($is_email) {
                $registrationData['email'] = $request->email;
            } else {
                $registrationData['mobile'] = $request->email;
            }

            $registrationData['otp'] = $loginOTP;
            $student = Student::insertGetId($registrationData);

            // SMS OTP only for BD User
            if (!$is_email) {
                $otp = new Otp;
                $otp->otp($student);
            } else {
                Mail::send('website.mail.otp', ['otp' => $registrationData['otp']], function ($mail) use ($request) {
                    $mail->from('mail.purebasic.com.bd');
                    $mail->to($request->email)->subject('Purebasic Registration OTP!');
                });
            }

            return redirect('/student/otp/' . $student . '/reg');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/home');
    }

    public function profile($id)
    {
        if (session()->get('id') != $id) {
            Session::flash('error', 'Unauthorized access');
            return redirect('/home');
        }

        $profile = Student::where('status', 1)->where('id', $id)->first();
        if (empty($profile)) {
            Session::flush('error', 'No user found');
            return redirect('/home');
        }

        $courses = BatchStudent::where('student_id', $id)->with('course')->latest('updated_at')->get()->chunk(3);

        //        return view('website.profile', compact('profile', 'courses'));
        return view('user.dashboard', compact('profile', 'courses'));
    }

    public function profileUp(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['gender'] = $request->gender;
        $data['birth'] = $request->birth;
        $data['position'] = $request->position;
        $data['BMDC'] = $request->BMDC;
        $data['batch_id'] = $request->group;
        $data['medical'] = $request->medical;
        $data['batch'] = $request->batch;
        $data['sessionn'] = $request->sessionn;
        $data['levell'] = $request->levell;
        $data['fb'] = $request->fb;
        $data['address'] = $request->address;

        if ($request->has('photo')) {
            $image = $request->file('photo');

            $imageName = 'lc_image' . str_random() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user/'), $imageName);

            $data['photo'] = $imageName;
        }

        $profile = Student::where('id', $id)->update($data);
        if ($profile) {
            session()->flash('profile', 'value');
            return redirect('/student/profile/' . $id);
        } else {
            return back();
        }
    }

    public function batchEnroll($id)
    {
        /** Check is user loign or not, if not login redirect to registration */
        if (!session::has('id')) {
            $url = "/student/batch/{{$id}}/enroll";
            session::put('url.intended', $url);
            return redirect('student/login');
        }

        $batch_info = Membership::where('id', $id)->first();

        if (empty($batch_info)) {
            session()->flash('error', 'Batch not found');
            return redirect('/home');
        }

        $current_date = date('Y-m-d H:i:s');
        $has_promotions = BatchPromotion::where('batch_id', $id)->where('status', 1)->whereRaw("'$current_date' between start_at and end_at")->first();

        if ($has_promotions) {
            $batch_info->promotion_active = True;
            $batch_info->payable_amount = $has_promotions->payable_amount;
        } else {
            $batch_info->promotion_active = False;
            $batch_info->payable_amount = $batch_info->ammount;
        }

        /** enrol for batch and store payment data */
        $has_enrolled = BatchStudent::where('student_id', session()->get('id'))->where('batch_id', $id)->whereIn('enroll_status', [0, 1])->first();
        // $has_enrolled =  BatchStudent::where('student_id',session()->get('id'))->where('batch_id',$id)->whereIn('enroll_status',[0,1])->whereRaw("'$current_date' between subscription_start and subndscription_end")->first();
        if ($has_enrolled) {
            // Payment approval pending
            if ($has_enrolled->enroll_status == 0) {
                if (($has_enrolled->payable - $has_enrolled->paid) > 0) {
                    session()->flash('error', 'You have already enrolled for this course, Please make sure your payment');
                    return redirect('/updateInfo/' . session()->get('id') . '/batch/' . $id);
                }

                session()->flash('error', 'You have already enrolled for this course, Please wait for payment approval');
                return redirect('/student/profile/' . session()->get('id'));
            } elseif ($has_enrolled->subscription_start <= $current_date && $has_enrolled->subscription_end >= $current_date && $has_enrolled->enroll_status == 1) {
                $has_enrolled->enroll_status = 0;
                $has_enrolled->save();

                session()->flash('error', 'You have already subscribed for this course');
                return redirect('/student/profile/' . session()->get('id'));
            } elseif ($has_enrolled->enroll_status == 2) {
                $has_enrolled->enroll_status = 0;
                $has_enrolled->save();

                session()->flash('error', 'Your enrolment have been blocked for this course, Please contact with Purebasic admin');
                return redirect('/student/profile/' . session()->get('id'));
            } else {
                // resubscribed course and update enroll table

                $has_enrolled->enroll_status = 0;

                $has_enrolled->updated_at = date('Y-m-d H:i:s');
                $has_enrolled->updated_by = session()->get('id');
                $has_enrolled->save();
            }
        } else {
            // New Enrollment
            $has_enrolled = new BatchStudent();
            $has_enrolled->student_id = session()->get('id');
            $has_enrolled->batch_id = $id;
            $has_enrolled->fees = $batch_info->ammount;
            $has_enrolled->payable = $batch_info->payable_amount;
            $has_enrolled->paid = 0;
            $has_enrolled->enroll_at = date('Y-m-d H:i:s');
            $has_enrolled->enroll_status = 0;
            $has_enrolled->created_at = date('Y-m-d H:i:s');
            $has_enrolled->created_by = session()->get('id');
            $has_enrolled->save();
            session()->flash('success', 'You have successfully enrolled, choose & pay for your subscription');
        }

        return redirect('/updateInfo/' . session()->get('id') . '/batch/' . $id);
    }

    public function updateInfo($userId, $type, $id)
    {
        $student = Student::where('status', 1)->where('id', $userId)->first();

        if (!empty($student->password) && $type == 'case') {
            $clinical_case = LectureSheet::where('id', $id)->where('status', 1)->first() ?? abort(404);

            return view('website.case_subscription', compact('clinical_case', 'userId'));
        }

        $courier = Membership::where('id', $id)->value('courier');

        return view('website.updateInfo', compact('student', 'userId', 'type', 'id', 'courier'));
    }

    public function postUpdateInfo($userId, $type, $id, Request $request)
    {
        if (!is_null($request->name)) {
            DB::table('students')->where('id', $userId)->update([
                'name' => $request->name
            ]);
        }
        if (!is_null($request->phone_number)) {
            DB::table('students')->where('id', $userId)->update([
                'mobile' => $request->phone_number
            ]);
        }

        if (!is_null($request->email)) {
            DB::table('students')->where('id', $userId)->update([
                'email' => $request->email
            ]);
        }

        if (!is_null($request->password)) {
            DB::table('students')->where('id', $userId)->update([
                'password' => md5($request->password)
            ]);
        }

        if (!is_null($request->address)) {
            DB::table('students')->where('id', $userId)->update([
                'address' => $request->address
            ]);
        }

        if (!is_null($request->whatsapp_number)) {
            DB::table('students')->where('id', $userId)->update([
                'whatsapp_number' => $request->whatsapp_number
            ]);
        }

        if ($type == 'batch') {
            return redirect('/payment/' . $id);
        }
        if ($type == 'case') {
            $clinical_case = LectureSheet::where('id', $id)->where('status', 1)->first() ?? abort(404);

            return view('website.case_subscription', compact('clinical_case', 'userId'));
        }
    }

    public function old_batchEnroll($id)
    {
        /** Check is user loign or not, if not login redirect to registration */
        if (!session::has('id')) {
            $url = "/student/batch/{{$id}}/enroll";
            session::put('url.intended', $url);
            return redirect('student/login');
        }

        $batch_info = Membership::where('id', $id)->first();

        if (empty($batch_info)) {
            session()->flash('error', 'Batch not found');
            return redirect('/home');
        }

        $current_date = date('Y-m-d H:i:s');
        $has_promotions = BatchPromotion::where('batch_id', $id)->where('status', 1)->whereRaw("'$current_date' between start_at and end_at")->first();

        if ($has_promotions) {
            $batch_info->promotion_active = True;
            $batch_info->payable_amount = $has_promotions->payable_amount;
        } else {
            $batch_info->promotion_active = False;
            $batch_info->payable_amount = $batch_info->ammount;
        }

        /** enrol for batch and store payment data */
        $has_enrolled = BatchStudent::where('student_id', session()->get('id'))->where('batch_id', $id)->whereIn('enroll_status', [0, 1])->first();
        // $has_enrolled =  BatchStudent::where('student_id',session()->get('id'))->where('batch_id',$id)->whereIn('enroll_status',[0,1])->whereRaw("'$current_date' between subscription_start and subscription_end")->first();
        if ($has_enrolled) {
            // Payment approval pending
            if ($has_enrolled->enroll_status == 0) {
                if (($has_enrolled->payable - $has_enrolled->paid) > 0) {
                    session()->flash('error', 'You have already enrolled for this course, Please make sure your payment');
                    return redirect('/payment/' . $id);
                }

                session()->flash('error', 'You have already enrolled for this course, Please wait for payment approval');
                return redirect('/student/profile/' . session()->get('id'));
            } elseif ($has_enrolled->subscription_start <= $current_date && $has_enrolled->subscription_end >= $current_date && $has_enrolled->enroll_status == 1) {
                $has_enrolled->enroll_status = 0;
                $has_enrolled->save();

                session()->flash('error', 'You have already subscribed for this course');
                return redirect('/student/profile/' . session()->get('id'));
            } elseif ($has_enrolled->enroll_status == 2) {
                $has_enrolled->enroll_status = 0;
                $has_enrolled->save();

                session()->flash('error', 'Your enrolment have been blocked for this course, Please contact with Purebasic admin');
                return redirect('/student/profile/' . session()->get('id'));
            } else {
                // resubscribed course and update enroll table

                $has_enrolled->enroll_status = 0;

                $has_enrolled->updated_at = date('Y-m-d H:i:s');
                $has_enrolled->updated_by = session()->get('id');
                $has_enrolled->save();
            }
        } else {
            // New Enrollment
            $has_enrolled = new BatchStudent();
            $has_enrolled->student_id = session()->get('id');
            $has_enrolled->batch_id = $id;
            $has_enrolled->fees = $batch_info->ammount;
            $has_enrolled->payable = $batch_info->payable_amount;
            $has_enrolled->paid = 0;
            $has_enrolled->enroll_at = date('Y-m-d H:i:s');
            $has_enrolled->enroll_status = 0;
            $has_enrolled->created_at = date('Y-m-d H:i:s');
            $has_enrolled->created_by = session()->get('id');
            $has_enrolled->save();
            session()->flash('success', 'You have successfully enrolled, choose & pay for your subscription');
        }
        return redirect('/old_payment/' . $id);
    }

    public function moduleSubcategoryEnroll($id, $module_id, $subcategory_id)
    {
        /** Check is user loign or not, if not login redirect to registration */
        if (!session::has('id')) {
            $url = "/student/batch/{{$id}}/enroll";
            session::put('url.intended', $url);
            return redirect('student/login');
        }

        $batch_info = Membership::where('id', $id)->first();
        $fee = Chapter::where('id', $subcategory_id)->where('cat_id', $module_id)->where('status', 1)->value('fee');

        if (empty($batch_info)) {
            session()->flash('error', 'Batch not found');
            return redirect('/home');
        }

        $current_date = date('Y-m-d H:i:s');

        /** enrol for batch and store payment data */
        $has_enrolled = BatchStudent::where('student_id', session()->get('id'))->where('batch_id', $id)->where('module_id', $module_id)->where('module_subcategory_id', $subcategory_id)->whereIn('enroll_status', [0, 1])->first();

        if (!$has_enrolled) {
            // New Enrollment
            $has_enrolled = new BatchStudent();
            $has_enrolled->student_id = session()->get('id');
            $has_enrolled->batch_id = $id;
            $has_enrolled->module_id = $module_id;
            $has_enrolled->module_subcategory_id = $subcategory_id;
            $has_enrolled->fees = $fee;
            $has_enrolled->payable = $fee;
            $has_enrolled->paid = 0;
            $has_enrolled->enroll_at = date('Y-m-d H:i:s');
            $has_enrolled->enroll_status = 0;
            $has_enrolled->created_at = date('Y-m-d H:i:s');
            $has_enrolled->created_by = session()->get('id');
            $has_enrolled->save();
            session()->flash('success', 'You have successfully enrolled, choose & pay for your subscription');
        }
        return redirect('/payment/batch/' . $id . '/module/' . $module_id . '/subcategory/' . $subcategory_id);
    }

    function liveClass($id)
    {
        if (session()->get('id') != $id) {
            Session::flash('error', 'Unauthorized access');
            return redirect('/home');
        }

        $profile = Student::where('status', 1)->where('id', $id)->first();
        if (empty($profile)) {
            Session::flush('error', 'No user found');
            return redirect('/home');
        }

        $enrolledBatches = DB::table('batch_students as a')
            ->join('batchpackages as b', function ($joinOne) {
                $joinOne->on('a.batch_id', '=', 'b.batch_id');
            })
            ->where('a.student_id', '=', $id)
            ->where('a.enroll_status', 1)
            ->where('a.subscription_end', '>=', NOW())
            ->select('a.batch_id', 'a.subscription_end', 'b.title', 'b.fild_9')
            ->latest('a.enroll_at')
            ->get();

        return view('user.live_class_by_user', compact('profile', 'enrolledBatches'));
    }

    function lecture($id)
    {
        if (session()->get('id') != $id) {
            Session::flash('error', 'Unauthorized access');
            return redirect('/home');
        }

        $profile = Student::where('status', 1)->where('id', $id)->first();

        if (empty($profile)) {
            Session::flush('error', 'No user found');
            return redirect('/home');
        }

        $enrolledBatches = DB::table('batch_students as a')
            ->join('batchpackages as b', function ($joinOne) {
                $joinOne->on('a.batch_id', '=', 'b.batch_id');
            })
            ->where('a.student_id', '=', $id)
            ->where('a.enroll_status', 1)
            ->where('a.subscription_end', '>=', NOW())
            ->select('a.batch_id', 'a.subscription_end', 'b.title', 'b.fild_5')
            ->latest('a.enroll_at')
            ->get();

        return view('user.lecture_by_user', compact('profile', 'enrolledBatches'));
    }

    function discussion($id)
    {
        if (session()->get('id') != $id) {
            Session::flash('error', 'Unauthorized access');
            return redirect('/home');
        }

        $profile = Student::where('status', 1)->where('id', $id)->first();
        if (empty($profile)) {
            Session::flush('error', 'No user found');
            return redirect('/home');
        }

        $enrolledBatches = DB::table('batch_students as a')
            ->join('batchpackages as b', function ($joinOne) {
                $joinOne->on('a.batch_id', '=', 'b.batch_id');
            })
            ->where('a.student_id', '=', $id)
            ->where('a.enroll_status', 1)
            ->where('a.subscription_end', '>=', NOW())
            ->select('a.batch_id', 'a.subscription_end', 'b.title', 'b.fild_6')
            ->latest('a.enroll_at')
            ->get();

        return view('user.discussion_by_user', compact('profile', 'enrolledBatches'));
    }

    function exam($id)
    {
        if (session()->get('id') != $id) {
            Session::flash('error', 'Unauthorized access');
            return redirect('/home');
        }

        $profile = Student::where('status', 1)->where('id', $id)->first();
        if (empty($profile)) {
            Session::flush('error', 'No user found');
            return redirect('/home');
        }

        $enrolledBatches = DB::table('batch_students as a')
            ->join('batchpackages as b', function ($joinOne) {
                $joinOne->on('a.batch_id', '=', 'b.batch_id');
            })
            ->where('a.student_id', '=', $id)
            ->where('a.enroll_status', 1)
            ->where('a.subscription_end', '>=', NOW())
            ->select('a.batch_id', 'a.subscription_end', 'b.title')
            ->latest('a.enroll_at')
            ->get();

        return view('user.exam_by_user', compact('profile', 'enrolledBatches'));
    }

    function paymentHistory($id)
    {
        if (session()->get('id') != $id) {
            Session::flash('error', 'Unauthorized access');
            return redirect('/home');
        }

        $profile = Student::where('status', 1)->where('id', $id)->first();
        if (empty($profile)) {
            Session::flush('error', 'No user found');
            return redirect('/home');
        }

        $enrolledBatches = BatchStudent::where('student_id', $id)->with('course')->latest('updated_at')->get()->chunk(3);

        return view('user.payment_history', compact('profile', 'enrolledBatches', 'id'));
    }

    function paymentCompleted()
    {
        return view('user.payment_completed');
    }

    function payment($id)
    {
        /** Check is user loign or not, if not login redirect to registration */
        if (!session::has('id'))
            return redirect('student/login');

        $batch_info = Membership::where('id', $id)->first();

        if (empty($batch_info)) {
            session()->flash('error', 'Batch not found');
            return redirect('/home');
        }

        $current_date = date('Y-m-d H:i:s');

        /** enrol for batch and store payment data */
        $has_enrolled = BatchStudent::where('student_id', session()->get('id'))->where('batch_id', $id)->first();
        // $has_enrolled =  BatchStudent::where('student_id',session()->get('id'))->where('batch_id',$id)->whereIn('enroll_status',[0,1])->whereRaw("'$current_date' between subscription_start and subscription_end")->first();
        // Not enrolled
        if (empty($has_enrolled)) {
            session()->flash('error', 'You have not enroll this batch, Please enroll');
            return redirect('/batches');
        }

        $batch_info->payable_amount = $has_enrolled->payable - $has_enrolled->paid;
        $student = Student::where('status', 1)->where('id', session::get('id'))->first();

        // BT Modification for selecting batch duration start

        $selectBatchDuration = DB::table('batch_duration as d')
            ->leftJoin('memberships as m', function ($joinOne) {
                $joinOne->on('d.bd_batch_id', '=', 'm.id');
            })
            ->where('d.bd_batch_id', '=', $id)
            ->select('d.bd_id', 'd.bd_batch_id', 'm.plan', 'd.bd_duration', 'd.bd_fee', 'd.information')
            ->get();

        // BT Modification for selecting batch duration end

        /** Check transactions validation */
        //        $has_pending_member = Paidmember::where('student_id',session()->get('id'))->where('batch_id',$id)->where('is_approve',0)->first();
        //        if($has_pending_member)
        //        {
        //            session()->flash('error','You have pending payment request for this course');
        //            return redirect('/student/profile/'.session()->get('id'));
        //        }

        $userId = session::get('id');
        $batchId = $id;

        session::put('batchId', $batchId);

        return view('website.membership', compact('batch_info', 'student', 'selectBatchDuration', 'userId', 'batchId'));

        // return view('website.membership_old', compact('batch_info', 'student', 'selectBatchDuration', 'userId', 'batchId'));
    }

    function old_payment($id)
    {
        /** Check is user loign or not, if not login redirect to registration */
        if (!session::has('id'))
            return redirect('student/login');

        $batch_info = Membership::where('id', $id)->first();

        if (empty($batch_info)) {
            session()->flash('error', 'Batch not found');
            return redirect('/home');
        }

        $current_date = date('Y-m-d H:i:s');

        /** enrol for batch and store payment data */
        $has_enrolled = BatchStudent::where('student_id', session()->get('id'))->where('batch_id', $id)->first();
        // $has_enrolled =  BatchStudent::where('student_id',session()->get('id'))->where('batch_id',$id)->whereIn('enroll_status',[0,1])->whereRaw("'$current_date' between subscription_start and subscription_end")->first();
        // Not enrolled
        if (empty($has_enrolled)) {
            session()->flash('error', 'You have not enroll this batch, Please enroll');
            return redirect('/batches');
        }

        $batch_info->payable_amount = $has_enrolled->payable - $has_enrolled->paid;
        $student = Student::where('status', 1)->where('id', session::get('id'))->first();

        // BT Modification for selecting batch duration start

        $selectBatchDuration = DB::table('batch_duration as d')
            ->leftJoin('memberships as m', function ($joinOne) {
                $joinOne->on('d.bd_batch_id', '=', 'm.id');
            })
            ->where('d.bd_batch_id', '=', $id)
            ->select('d.bd_id', 'd.bd_batch_id', 'm.plan', 'd.bd_duration', 'd.bd_fee')
            ->get();

        // BT Modification for selecting batch duration end

        /** Check transactions validation */
        //        $has_pending_member = Paidmember::where('student_id',session()->get('id'))->where('batch_id',$id)->where('is_approve',0)->first();
        //        if($has_pending_member)
        //        {
        //            session()->flash('error','You have pending payment request for this course');
        //            return redirect('/student/profile/'.session()->get('id'));
        //        }

        return view('website.membership_old', compact('batch_info', 'student', 'selectBatchDuration', 'userId', 'batchId'));
    }

    function module_subcategory_payment($id, $module_id, $subcategory_id)
    {
        /** Check is user loign or not, if not login redirect to registration */
        if (!session::has('id'))
            return redirect('student/login');

        $batch_info = Membership::where('id', $id)->first();

        if (empty($batch_info)) {
            session()->flash('error', 'Batch not found');
            return redirect('/home');
        }

        $current_date = date('Y-m-d H:i:s');

        /** enrol for batch and store payment data */
        $has_enrolled = BatchStudent::where('student_id', session()->get('id'))->where('batch_id', $id)->where('module_id', $module_id)->where('module_subcategory_id', $subcategory_id)->first();

        // Not enrolled
        if (empty($has_enrolled)) {
            session()->flash('error', 'You have not enrolled, Please enroll');
            return redirect('/batches');
        }

        $batch_info->payable_amount = $has_enrolled->payable - $has_enrolled->paid;
        $student = Student::where('status', 1)->where('id', session::get('id'))->first();

        // BT Modification for selecting batch duration start

        $selectBatchDuration = DB::table('batch_duration as d')
            ->leftJoin('memberships as m', function ($joinOne) {
                $joinOne->on('d.bd_batch_id', '=', 'm.id');
            })
            ->where('d.bd_batch_id', '=', $id)
            ->select('d.bd_id', 'd.bd_batch_id', 'm.plan', 'd.bd_duration', 'd.bd_fee')
            ->get();

        // BT Modification for selecting batch duration end

        /** Check transactions validation */
        //        $has_pending_member = Paidmember::where('student_id',session()->get('id'))->where('batch_id',$id)->where('is_approve',0)->first();
        //        if($has_pending_member)
        //        {
        //            session()->flash('error','You have pending payment request for this course');
        //            return redirect('/student/profile/'.session()->get('id'));
        //        }

        return view('website.module_subcategory_membership', compact('batch_info', 'module_id', 'subcategory_id', 'student', 'selectBatchDuration'));
    }

    function due($id)
    {
        $data = Membership::where('status', 1)->get();
        $student = Student::where('status', 1)->where('id', $id)->first();
        return view('website.due', compact('data', 'student'));
    }

    public function demo_register()
    {
        $data = Membership::where('status', 1)->where('id', 6)->get();
        return view('website.demo', compact('data'));
    }

    public function demo_insert(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:students,email',
            'mobile' => 'required',
            'medical' => 'required',
            'password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'plase enter your name',
            'email.required' => 'plase enter your email',
            'email.unique' => 'This email already exist',
            'mobile.required' => 'plase enter your mobile',
            'medical.required' => 'plase enter your medical',
            'password.required' => 'plase enter password',
            'password.confirmed' => 'password did not match',
        ]);

        $data = [];
        $data['student_id'] = '';
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['gender'] = '';
        $data['birth'] = '';
        $data['position'] = '';
        $data['BMDC'] = '';
        $data['batch_id'] = 6;
        $data['medical'] = '';
        $data['batch'] = '';
        $data['sessionn'] = '';
        $data['levell'] = '';
        $data['fb'] = '';
        $data['address'] = '';
        $data['password'] = md5($request->password);

        $student = Student::insertGetId($data);

        Paidmember::insert([
            'student_id' => $student,
            'batch_id' => 6,
            'transaction' => 'demo',
            'mar' => 'bkash',
            'created_at' => Carbon::now()->toDateTimeString(),
            'is_approve' => 1,
        ]);

        if ($student) {
            Session::put('id', $student);
            session()->flash('success', 'value');
            return redirect('/home');
        } else {
            return back();
        }
    }

    public function updateBulkStudentID()
    {
        $students = Student::whereNotNull('updated_at')->get();
        foreach ($students as $student) {
            $student->student_id = $this->generateStudentID($student->id);
            $student->save();
        }

        echo 'Update Successfully';
    }

    private function generateStudentID($id)
    {
        return sprintf('%06d', $id);
    }

    public function notice($id)
    {
        if (Session::get('id')) {
            $history = DB::table('notification_history')->updateOrInsert([
                'user_id' => Session::get('id'),
                'notice_id' => $id,
            ], [
                'user_id' => Session::get('id'),
                'notice_id' => $id,
            ]);

            $notice = DB::table('notices')->where('id', $id);
            $batch_id = $notice->value('batch_id');
            $link = $notice->value('link');

            $modified_link = str_replace('batch_id', $batch_id, $link);

            return redirect($modified_link);
        }
    }

    public function ask($user_id)
    {
        if (Session::get('id') == $user_id) {
            return view('user.ask_by_user');
        }

        return redirect('/home');
    }

    public function edit_ask($user_id, $question_id)
    {
        if (Session::get('id') == $user_id) {
            $question = DB::table('posts')->where('user_id', $user_id)->where('id', $question_id)->value('question');

            return view('user.edit_ask_by_user', compact('question', 'question_id'));
        }

        return redirect('/home');
    }

    public function asked($user_id)
    {
        $profile = Student::where('status', 1)->where('id', $user_id)->first();
        $profile_type = $profile->user_type;

        if (Session::get('id') == $user_id) {
            $user_asked = DB::table('posts')->where('user_id', $user_id)->select('id', 'user_id', 'question', 'answer', 'updated_at')->latest('updated_at')->get();
            $other_asked = DB::table('posts')->where('user_id', '!=', $user_id)->select('id', 'user_id', 'question', 'answer', 'updated_at')->latest('updated_at')->get();

            return view('user.asked_by_user', compact('user_asked', 'other_asked', 'profile_type'));
        }

        return redirect('/home');
    }

    public function post_ask(Request $request, $user_id)
    {
        if (Session::get('id') == $user_id) {
            $this->validate($request, [
                'question' => 'required',
            ], [
                'question.required' => 'plase write your question',
            ]);

            $data = $request->only(['question']);
            $data['user_id'] = $user_id;
            $data['created_at'] = Carbon::now()->toDateTimeString();
            $data['updated_at'] = Carbon::now()->toDateTimeString();

            $post_ask = DB::table('posts')->insert($data);

            if ($post_ask) {
                return redirect('/asked/user/' . $user_id);
            }
        }

        return redirect('/home');
    }

    public function post_edit_ask(Request $request, $user_id, $question_id)
    {
        if (Session::get('id') == $user_id) {
            $this->validate($request, [
                'question' => 'required',
            ], [
                'question.required' => 'plase write your question',
            ]);

            $data = $request->only(['question']);
            $data['updated_at'] = Carbon::now()->toDateTimeString();

            $post_edit_ask = DB::table('posts')->where('id', $question_id)->where('user_id', $user_id)->update($data);

            if ($post_edit_ask) {
                return redirect('/asked/user/' . $user_id);
            }
        }

        return redirect('/home');
    }

    public function delete_ask($user_id, $question_id)
    {
        if (Session::get('id') == $user_id) {
            $delete_ask = DB::table('posts')->where('id', $question_id)->where('user_id', $user_id)->delete();

            if ($delete_ask) {
                return redirect('/asked/user/' . $user_id);
            }
        }

        return redirect('/home');
    }

    public function answer_ask($user_id, $question_id)
    {
        $profile = Student::where('status', 1)->where('id', $user_id)->first();
        $profile_type = $profile->user_type;

        if (Session::get('id') == $user_id) {
            $answer = DB::table('posts')->where('id', $question_id)->first();
            $all = DB::table('posts')->where('id', $question_id)->select('id', 'user_id', 'question', 'answer')->get();

            if ($answer->user_id == $user_id) {
                $data['new_count'] = 0;
                DB::table('posts')->where('id', $question_id)->update($data);
            }

            return view('user.answer_by_user', compact('all', 'profile_type'));
        }

        return redirect('/home');
    }

    public function answer_question($user_id, $question_id)
    {
        $profile = Student::where('status', 1)->where('id', $user_id)->first();

        if (Session::get('id') == $user_id && $profile->user_type == 'mentor') {
            $questionDetails = DB::table('posts')->where('id', $question_id)->select('user_id', 'question', 'answer')->get();

            return view('user.answer_question_by_user', compact('questionDetails', 'question_id'));
        }

        return redirect('/home');
    }

    public function post_answer_question(Request $request, $user_id, $question_id)
    {
        $profile = Student::where('status', 1)->where('id', $user_id)->first();

        if (Session::get('id') == $user_id && $profile->user_type == 'mentor') {
            $this->validate($request, [
                'answer' => 'required',
            ], [
                'answer.required' => 'plase write your question',
            ]);

            $data = $request->only(['answer']);
            $data['mentor_id'] = $user_id;
            $data['answer_count'] = 1;
            $data['new_count'] = 1;
            $data['updated_at'] = Carbon::now()->toDateTimeString();

            $post_answer_question = DB::table('posts')->where('id', $question_id)->update($data);

            if ($post_answer_question) {
                return redirect('/user/' . $user_id . '/question/' . $question_id . '/answer');
            }
        }

        return redirect('/home');
    }

    public function studentLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->email;
        $is_email = false;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $is_email = True;
        }

        if ($is_email) {
            $login = Student::where('email', $email)->first();
        } else {
            $login = Student::where('mobile', $email)->first();
        }
        if ($login) {
            if ($login->password == md5($request->password)) {
                $loginOTP = rand(1000, 9999);
                $id = $login->id;
                $update = Student::where('id', $login->id)->update([
                    'otp' => $loginOTP,
                ]);
                if(!$is_email){
                    $otp = new Otp;
                    $otp->otp($login->id);
                }else{
                    Mail::send('website.mail.otp', ['otp' => $loginOTP], function ($mail) use ($login) {
                        $mail->from('contact@purebasic.com.bd');
                        $mail->to($login->email)->subject('Purebasic Login OTP!');
                    });
                }
                Session::put('id', $id);
                return redirect('/student/otp/' . $id . '/login');
            } else {
                session()->flash('error', 'Invalid password, please try again');
                return redirect('/student/login');
            }
        }
    }
}
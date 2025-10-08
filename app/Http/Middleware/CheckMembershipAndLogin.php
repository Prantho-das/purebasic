<?php

namespace App\Http\Middleware;
use App\Paidmember;
use App\Student;
use Closure;
use Session;
// use Illuminate\Foundation\Http\Middleware\CheckMembershipAndLogin as Middleware;

class CheckMembershipAndLogin
{
    public function handle($request, Closure $next)
    {
    	// dump(!$request->session()->exists('id'));
    	// dump(!Paidmember::where('student_id',Session::get('id'))->where('is_approve',1)->first());
    	// dd(Paidmember::where('student_id',Session::get('id'))->where('is_approve',1)->first());

       // if (!$request->session()->exists('id') || !Paidmember::where('student_id',Session::get('id'))->where('is_approve',1)->first()) {
        if (!$request->session()->exists('id')) {
            // user value cannot be found in session
            return redirect('/student/login');
        }

        $student = Student::find($request->session()->get('id'));

        if($student->api_token != $request->session()->get('api_token'))
        {
//            dd($student->api_token,$request->session()->get('api_token'));
            $request->session()->flush();
            return redirect('/student/login');
        }

        return $next($request);
    }
}

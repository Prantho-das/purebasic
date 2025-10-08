<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Student;
use Carbon\Carbon;
use Image;

class UserController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function alluser(){
    	$alluser=User:: all();
    	return view('admin.user.all',compact('alluser'));
    }

    public function view($id){
    	$data=User:: where('id',$id)->first();
    	return view('admin.user.view',compact('data'));
    }

    public function delete($id){
    	$delete=User:: where('id',$id)->delete();
    	if ($delete) {
    		session()->flash('delete','value');
    		return back();
    	}else{
    		session()->flash('error','value');
    		return back();
    	}
    }
    public function add_user(){
    	return view('admin.user.add');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
          'name'=>'required',
          'email'=>'required',
          'password'=>'required|min:6|confirmed',
        ],[
          'name.required'=> 'Please enter your name',
          'email.required'=> 'Please enter your email',
          'password.required'=>'Plase enter your password at 6 lanth',
          'password.confirmed'=> 'password did not match',
        ]);

        $data=[];
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']= Hash::make($request['password']);
        $data['created_at']=Carbon:: now()->toDateTimeString();
         if ($request->has('pic')) {
           $image = $request->file('pic');


           $imageName = 'lc_image'.str_random().'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/user/'),$imageName);

           $data['photo']=$imageName;

        }

        $register=User:: insertGetId($data);




        if ($register) {
          session()->flash('success','value');
          return redirect('admin/all/user');
        }else {
          session()->flash('error','value');
          return back();
        }
    }


    public function allstudent(){
      $alluser=Student:: where('status',1)->orderBy('id','desc')->get();
      return view('admin.student.all',compact('alluser'));
    }


    public function student_approve($id){
      $approve=Student:: where('status',1)->where('id',$id)->where('is_approve',0)->update([
        'is_approve'=>1,
      ]);
      if ($approve) {
        session()->flash('approve');
        return back();
      }else{
        return back();
      }
    }

    public function student_pending($id){
      $approve=Student:: where('status',1)->where('is_approve',1)->where('id',$id)->update([
        'is_approve'=>0,
      ]);
      if ($approve) {
        session()->flash('pending');
        return back();
      }else{
        return back();
      }
    }
}

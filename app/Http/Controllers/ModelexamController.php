<?php

namespace App\Http\Controllers;

use App\Membership;
use App\Modelexam;
use App\Modeltest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ModelexamController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function allexam(){
    $exam=Modelexam:: where('status',1)->orderBy('id','desc')->get();
    return view('admin.modelexam.all',compact('exam'));
  }


  public function addexam(){
    $model=Modeltest:: where('status',1)->where('subject',NULL)->orderBy('id','asc')->get();
    return view('admin.modelexam.add',compact('model'));
  }

  public function examUploads(Request $request){
    $data=[];
    $data['modeltest_id']=$request->modeltest;
    $data['question']=$request->question;
    $data['a']=$request->a;
    $data['b']=$request->b;
    $data['c']=$request->c;
    $data['d']=$request->d;
    $data['created_at']=Carbon:: now()->toDateTimeString();

    $modelexam=Modelexam:: insert($data);
    if ($modelexam) {
      session()->flash('success','value');
      return redirect('/admin/all/exam');
    }else{
      return back();
    }
  }


  public function createdq($id){
    $model=Modeltest:: where('status',1)->where('subject',$id)->orderBy('id','asc')->get();
    return view('admin.modelexam.question',compact('model'));
  }
}

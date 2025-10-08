<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use Carbon\Carbon;

class JobController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function alljob(){
    	$alljob=Job:: where('status',1)->where('manage',1)->orderBy('id','desc')->get();
    	$allcircular=Job:: where('status',1)->where('manage',2)->orderBy('id','desc')->get();
    	return view('admin.job.all',compact('alljob','allcircular'));
    }


    public function addjob(){
    	return view('admin.job.add');
    }

    public function jobUploads(Request $request){

      $data=[];
      $data['jobTitle']=$request->title;
      $data['manage']=$request->manage;
      $data['details']=$request->details;
      $data['created_at']=Carbon:: now()->toDateTimeString();


      $job=Job:: insert($data);
      if ($job) {
      	session()->flash('success','value');
        return redirect('/admin/all/job');
      }else{
        return back();
      }
    }
}

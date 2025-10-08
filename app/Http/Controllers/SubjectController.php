<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Modeltest;
use Carbon\Carbon;

class SubjectController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function allsubject(){
    $subject=Category:: where('status',1)->orderBy('id','desc')->get();
    return view('admin.subject.all',compact('subject'));
  }
  public function showModelTests($id)
  {
    $model = Modeltest::where('subject',$id)->orderBy('id','asc')->get();
    return view('admin.subject.allmodeltests',compact('model'));
  }
  public function addsubject(){
    return view('admin.subject.add');
  }

  public function subjectUploads(Request $request){
    $data=[];
    $data['name']=$request->name;
    $data['serial']=$request->serial;
    $data['qb_serial']=$request->qb_serial;
    $data['price']=$request->price;

    $data['created_at']=Carbon:: now()->toDateTimeString();

    $subject=Category:: insert($data);
    if ($subject) {
      session()->flash('success','value');
      return redirect('/admin/all/subject');
    }else{
      return back();
    }
  }

  public function viewsubject($id){
      $data=Category:: where('status',1)->where('id',$id)->first();
      return view('admin.subject.view',compact('data'));
    }

    public function editsubject($id){
      $data=Category:: where('status',1)->where('id',$id)->first();
      return view('admin.subject.edit',compact('data'));
    }
    public function subjectUpdate(Request $request){
        $id=$request->id;
        $data=[];
        $data['name']=$request->name;
        $data['serial']=$request->serial;
        $data['qb_serial']=$request->qb_serial;
        $data['price']=$request->price;
        $update=Category:: where('id',$id)->update($data);
        if ($update) {
            session()->flash('update','value');
            return redirect('/admin/all/subject');
        }else{
            session()->flash('error','value');
            return back();
        } 
    }

    public function deletesubject($id){
      $delete=Category:: where('status',1)->where('id',$id)->delete();
      if ($delete) {
        session()->flash('delete','value');
            return back();
        }else{
            session()->flash('error','value');
            return back();
        }
    }
}

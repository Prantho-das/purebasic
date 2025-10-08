<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Video;
use App\Visitor;
use App\Gallery;
use App\Spost;
use App\Jobpost;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
      $Post=Post:: where('status',1)->count();
      $Video=Video:: where('status',1)->count();
      $gellary=Gallery:: where('status',1)->count();
      $Spost=Spost:: where('status',1)->count();
      $activeUser=Visitor:: where('status',1)->where('is_approve',1)->count();
      $pandingUser=Visitor:: where('status',1)->where('is_approve',0)->count();
      $totaluser=Visitor:: where('status',1)->count();
      $jobpost=Jobpost:: where('status',1)->count();
    	return view('admin.home',compact('Post','Video','Spost','gellary','activeUser','pandingUser','totaluser','jobpost'));
    }
    
    

    public function approve($id){
      $approve=Post:: where('status',1)->where('is_apporve',2)->where('id',$id)->update([
        'is_apporve'=> 1,
      ]);
      if ($approve) {
        return back();
      }else {
        return back();
      }
    }
    public function panding($id){
      $panding=Post:: where('status',1)->where('is_apporve',1)->where('id',$id)->update([
        'is_apporve'=> 2,
      ]);
      if ($panding) {
        return back();
      }else {
        return back();
      }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ads;
use Image;

class AdsController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }
  public function all_ads(){
    $ads=Ads:: where('status',1)->get();
    return view('admin.ads.all',compact('ads'));
  }

   public function ads_edit($id){
    $data=Ads:: where('status',1)->where('id',$id)->first();
    return view('admin.ads.edit',compact('data'));
  }

  public function update_ads($id){
    $data=Ads:: where('status',1)->where('id',$id)->first();
    return view('admin.ads.edit',compact('data'));
  }

  public function ads_submit(Request $request){
    $id=$request->id;
    $data=[];
    $data['manage']= $request->manage;
    $data['is_approve']= 1;
    

    $update=Ads:: where('id',$id)->update($data);
    if ($update) {
      session()->flash('success','value');
      return redirect('admin/all-ads');
    }else {
      return back();
    }
  }

  public function ads_off($id){
    $ads_off=Ads:: where('status',1)->where('is_approve',1)->where('id',$id)->update([
      'is_approve'=> 0,
      'manage'=> NULL,
    ]);
    if ($ads_off) {
      session()->flash('off');
      return redirect()->back();
    }else{
     return redirect()->back(); 
    }

  }
}

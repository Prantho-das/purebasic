<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Social;

class SocialController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function all(){
    	$data=Social:: where('status',1)->get();
    	return view('admin.Social.all',compact('data'));
    }

    public function edit($id){
    	$data=Social:: where('status',1)->where('id',$id)->first();
    	return view('admin.Social.edit',compact('data'));
    }

    public function edit_submit(Request $request){
    	$id=$request->id;
     	$data=[];
     	$data['facebook']=$request->facebook;
     	$data['twitter']=$request->twitter;
     	$data['google']=$request->google;
     	$data['youtube']=$request->youtube;

	    $link=Social:: where('id',$id)->update($data);
	    if ($link) {
	    	session()->flash('success','value');
	    	return redirect('admin/all/social/link');
	    }else{
	    	return back(); 
	    }
    }
}

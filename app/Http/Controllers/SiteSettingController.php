<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteSetting;
use Image;

class SiteSettingController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function all(){
    	$data=SiteSetting:: where('status',1)->get();
    	return view('admin.setting.all',compact('data'));
    }

    public function edit($id){
    	$data=SiteSetting:: where('status',1)->where('id',$id)->first();
    	return view('admin.setting.edit',compact('data'));
    }

     public function edit_submit(Request $request){
     	$id=$request->id;
     	$data=[];
     	$data['site_title']=$request->site_title;
     	$data['keyword']=$request->keyword;
     	$data['description']=$request->description;
     	if ($request->hasFile('fav_icon')) {
	      $image=$request->file('fav_icon');
	      $imageName='fav_icon'.$id.time().'.'.$image->getclientoriginalextension();
	      Image::make($image)->save('uploads/setting/'.$imageName);
	      SiteSetting:: where('id',$id)->update([
	        'fav_icon'=> $imageName,
	      ]);
	    }

	    if ($request->hasFile('site_logo')) {
	      $image=$request->file('site_logo');
	      $imageName='site_logo'.$id.time().'.'.$image->getclientoriginalextension();
	      Image::make($image)->save('uploads/setting/'.$imageName);
	      SiteSetting:: where('id',$id)->update([
	        'site_logo'=> $imageName,
	      ]);
	    }

	    if ($request->hasFile('og_image')) {
	      $image=$request->file('og_image');
	      $imageName='og_image'.$id.time().'.'.$image->getclientoriginalextension();
	      Image::make($image)->save('uploads/setting/'.$imageName);
	      SiteSetting:: where('id',$id)->update([
	        'og_image'=> $imageName,
	      ]);
	    }

	    $SiteSetting=SiteSetting:: where('id',$id)->update($data);
	    if ($SiteSetting) {
	    	session()->flash('success','value');
	    	return redirect('admin/site-setting');
	    }else{
	    	return back(); 
	    }

     }
}

<?php

namespace App\Http\Controllers;

use App\MainCategory;
use App\Tag;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

class VideoController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function all_video(){
    $allvideo= Video:: where('status',1)->orderBy('id','desc')->get();
    return view('admin.video.all',compact('allvideo'));
  }
  public function add_video(){
    $allMainCat=MainCategory::all();
    $alltag=Tag:: where('status',1)->get();
    return view('admin.video.add',compact('allMainCat','alltag'));
  }

  public function uploads_photo(Request $request){

    $link=$request->link;
    $duration=$request->duration;
    $title=$request->title;
    $subtitle=$request->subtitle;
    $description=$request->description;
    $manage=$request->manage;

    if($request->hasFile('photo')){
      $image=$request->file('photo');
      $imageName='video'.time().'.'.$image->getClientOriginalExtension();
      Image::make($image)->save('uploads/video/'.$imageName);

      $video=Video::insertGetId([
        'user_id'=> Auth::id(),
        'image'=> $imageName,
        'video'=> $link,
        'duration'=> $duration,
        'title'=> $title,
        'subtitle'=> $subtitle,
        'details'=> $description,
        'manage'=> $manage,
        'created_at'=> Carbon:: now()->toDateTimeString(),
      ]);

      foreach ($request->categorys as $category) {
        DB::table('category_video')->insert([
          'video_id' => $video,
          'category_id' => $category,
        ]);
      }

      if ($video) {
        session()->flash('success');
        return redirect('admin/all-video');
      }else {
        session()->flash('error');
        return redirect('admin/add-video');
      }
    }
    // return $request->categorys;
  }

  public function view($id){
    $data=Video:: where('status',1)->where('id',$id)->first();
    return view('admin.video.view',compact('data'));
  }


  public function delete($id){
    $videodelete=Video:: where('status',1)->where('id',$id)->delete();
    if ($videodelete) {
      session()->flash('delete','value');
      return back();
    }else{
      session()->flash('delete_error','value');
      return back();
    }
  }

}

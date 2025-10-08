<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Carbon\Carbon;
use Image;

class TagController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function all_tag(){
    $alltag=Tag:: where('status',1)->orderBy('id','desc')->get();
    return view('admin.tag.all',compact('alltag'));
  }
  public function add_tag(){
    return view('admin.tag.add');
  }
  public function tag_submit(Request $request){
    $data=[];
    $data['name'] = $request->name;
    $data['slug'] = str_slug($request->name);
    $data['image']='';
    $data['created_at'] = Carbon::now()->toDateTimeString();
 

    $tag=Tag:: insertGetId($data);

    if($request->hasFile('image')){
        $image=$request->file('image');
        $imageName='tag'.time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('uploads/tag/'.$imageName);
        Tag:: where('id',$tag)->update([
          'image'=> $imageName,
        ]);
      } 

    if ($tag) {
        session()->flash('success','value');
        return redirect('admin/all/tag');
    }else{
        session()->flash('error','value');
        return back();
    }
  }

  public function delete($id){
    $delete=Tag:: where('status',1)->where('id',$id)->delete();
    if ($delete) {
      session()->flash('delete','value');
      return back();
    }else {
      session()->flash('d_error','value');
      return back();
    }
  }
  public function view_tag($id){
    $data=Tag:: where('status',1)->where('id',$id)->first();
    return view('admin.tag.edit',compact('data'));
  }

  public function tag_update(Request $request){
    $id=$request->id;
    

    $data=[];
    $data['name'] = $request->name;
    $data['slug'] = str_slug($request->name);
    if($request->hasFile('image')){
        $image=$request->file('image');
        $imageName='tag'.time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->save('uploads/tag/'.$imageName);
         $tag=Tag:: where('id',$id)->update([
          'image'=> $imageName,
        ]);
      }

    $tag=Tag:: where('id',$id)->update($data);
    if ($tag) {
        session()->flash('update','value');
        return redirect('admin/all/tag');
    }else{
        session()->flash('error','value');
        return back();
    }
  }
}

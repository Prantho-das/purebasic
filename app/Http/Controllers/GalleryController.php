<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use Image;
use Carbon\Carbon;

class GalleryController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function all_gallery(){
      $allphotos= Gallery:: where('status',1)->orderBy('id','desc')->get();
      return view('admin.gallery.all',compact('allphotos'));
    }
    public function add_gallery(){
      return view('admin.gallery.add');
    }

    public function uploads_photo(Request $request){
      $data=[];
      $data['caption']=$request->caption;
      $data['created_at']= Carbon:: now()->toDateTimeString();

      $gallery=Gallery:: insertGetId($data);

      if($request->hasFile('photo')){
        $image=$request->file('photo');
        $imageName='photo-story'.time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(290,218)->save('uploads/gallery/'.$imageName);
        Gallery:: where('id',$gallery)->update([
          'photo'=> $imageName,
        ]);
      }

        if ($gallery) {
          session()->flash('success');
          return redirect('admin/all-photos');
        }else {
          session()->flash('error');
          return redirect('admin/add-photos');
        }
    }

    public function delete_photo($id){
      $delete=Gallery:: where('status',1)->where('id',$id)->delete();
      if ($delete) {
        session()->flash('delete','value');
        return redirect('admin/all-photos');
      }else {
        return back();
      }
    }

    public function view_photo($id){
      $data=Gallery:: where('id',$id)->first();
      return view('admin.gallery.view',compact('data'));
    }
}

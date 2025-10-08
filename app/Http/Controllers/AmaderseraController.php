<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use App\Spost;
use App\Seba;

class AmaderseraController extends Controller
{
   public function change($id){
   	 $change=Spost:: where('id',$id)->where('is_approve',0)->update([
   	 	'is_approve'=>1,
   	 ]);
   	 if ($change) {
   	 	session()->flash('change');
   	 	return redirect()->back();
   	 }else{
   	 	return redirect()->back();
   	 }
   }


    public function panding($id){
   	 $change=Spost:: where('id',$id)->where('is_approve',1)->update([
   	 	'is_approve'=>0,
   	 ]);
   	 if ($change) {
   	 	session()->flash('change');
   	 	return redirect()->back();
   	 }else{
   	 	return redirect()->back();
   	 }
   }


    public function sera_post_view($id){
        $data=Spost:: where('status',1)->where('id',$id)->first();
        return view('admin.sera.view',compact('data'));
    }


       public function edit_visitor_post($id){
      $sera_cat=Seba:: where('status',1)->get();
      $data=Spost:: where('status',1)->where('id',$id)->first();
      return view('admin.sera.edit',compact('data','sera_cat'));
    }

    public function update_visitor_post(Request $request){
      
        $image = $request->file('image');
         $slug = str_slug($request->title).time();
         $imageName = '';
        if(isset($image))
        {
            $imageName  = 'post_'.time().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
            $postImage = Image::make($image)->resize(1600,1066)->save('post/'.$imageName);
        }

   
        $id= $request->id;

        $data=[];
        $data['title']=$request->title;
        $data['cat_id']=$request->category;
        $data['description']=$request->description;
        $data['image']=$imageName;
       

       $post=Spost:: where('id',$id)->update($data);

        if ($post) {
            session()->flash('update','value');
            return redirect('/admin/sera/post');
        }else{
           session()->flash('error','value');
            return redirect()->back();
        }
    }

    public function delete_visitor_post($id)
    {
        $postdelete=Spost:: where('status',1)->where('id',$id)->delete();
        if ($postdelete) {
          session()->flash('delete','value');
          return back();
        }else {
          session()->flash('error','value');
          return back();
        }
    }


}

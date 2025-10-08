<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Seba;
use App\Spost;

class NewController extends Controller
{


	public function index(){
		$sera=Spost:: where('status',1)->orderBy('id','desc')->get();
		return view('admin.sera.all',compact('sera'));
	}
   public function create(){
   	$sera_cat=Seba:: where('status',1)->get();
   	return view('admin.sera.add',compact('sera_cat'));
   }




   public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
        ],[
            'title.required'=>'Please enter your post title',
            'description.required'=>'Please enter your post description',
        ]);

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

        $post = new Spost();
        $post->title = $request->title;
        $post->cat_id = $request->category;
        $post->description = $request->description;

        $post->image = $imageName;
        $post->save();

        if ($post) {
            session()->flash('success','value');
            return redirect('admin/sera/post');
        }else{
           session()->flash('success','value');
            return redirect('admin/sera/post');
        }

    }
}

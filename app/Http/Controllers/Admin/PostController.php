<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\MainCategory;
use App\Post;
use App\Tag;
use App\Subcategory;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allpost=Post:: where('status',1)->orderBy('id','desc')->get();
        return view('admin.post.all',compact('allpost'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allMainCat=MainCategory::all();
        $alltag=Tag:: where('status',1)->get();
        $sub_cat=SubCategory:: where('status',1)->orderBy('id','DESC')->get();
        return view('admin.post.add',compact('allMainCat','alltag','sub_cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = str_slug('title');
        $post->sc_id = $request->sc_id;
        $post->sub_title = $request->sub_title;
        $post->meta = $request->meta;
        $post->keyword = $request->keyword;
        $post->tag = $request->tag;
        $post->description = $request->description;
        $post->source = $request->source;
        $post->caption = $request->caption;
        $post->manage = $request->manage;
        $post->image = $imageName;
        if (isset($request->publich)) {
            $post->is_apporve= 1;
        }else{
          $post->is_apporve= 0;  
        }

        $post->save();
        $post->categories()->attach($request->categorys);
        if ($post) {
            session()->flash('success','value');
            return redirect('admin/post');
        }else{
           session()->flash('success','value');
            return redirect('admin/post');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data=Post:: where('status',1)->where('id',$id)->first();
        return view('admin.post.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $allcat=Category:: where('status',1)->get();
      $alltag=Tag:: where('status',1)->get();
      $data=Post:: where('status',1)->where('id',$id)->first();
      $allMainCat=MainCategory::all();
      return view('admin.post.edit',compact('data','allcat','alltag','allMainCat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $id=$request->id;
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

        $image1 = $request->file('ogimage');
         $slug = str_slug($request->title).time();
         $imageName1 = '';
        if(isset($image1))
        {
            $imageName1  = 'fbog_'.time().'.'.$image1->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
            $postImage = Image::make($image1)->resize(1600,1066)->save('post/'.$imageName1);
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->sub_title = $request->sub_title;
        $post->ogtitle = $request->ogtitle;
        $post->description = $request->description;
        $post->source = $request->source;
        $post->caption = $request->caption;
        $post->manage = $request->manage;
        $post->image = $imageName;
        $post->ogimage = $imageName1;


        // return $request;
        $post->save();
        
        $post->categories()->attach($request->categorys);
        $post->tags()->attach($request->tags);
        if ($post) {
            session()->flash('success','value');
            return redirect('admin/post');
        }else{
           session()->flash('success','value');
            return redirect('admin/post');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postdelete=Post:: where('status',1)->where('id',$id)->delete();
        if ($postdelete) {
          session()->flash('delete','value');
          return back();
        }else {
          session()->flash('error','value');
          return back();
        }
    }

    public function deletePost($id)
    {
        $postdelete=Post:: where('status',1)->where('id',$id)->delete();
        if ($postdelete) {
          session()->flash('delete','value');
          return back();
        }else {
          session()->flash('error','value');
          return back();
        }
    }


    public function approvePost(){
        $allpost=Post:: where('status',1)->where('is_apporve',1)->orderBy('id','desc')->get();
        return view('admin.post.approve',compact('allpost'));
    }
}

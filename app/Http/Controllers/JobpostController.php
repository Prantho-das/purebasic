<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Jobpost;
use Carbon\Carbon;

class JobpostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alljob=Jobpost:: where('status',1)->orderBy('id','desc')->get();
        return view('admin.job.all',compact('alljob'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.job.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


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
        $post = new Jobpost();
        
        $post->title = $request->title;
        $post->company = $request->company;
        $post->vacancy = $request->vacancy;
        $post->e_status = $request->e_status;
        $post->experience = $request->experience;
        $post->gender = $request->gender;
        $post->age = $request->age;
        $post->location = $request->location;
        $post->salary = $request->salary;
        $post->a_deadline = $request->a_deadline;
        $post->description = $request->description;
        $post->manage = $request->manage;
        $post->dist_id = $request->distric;
        $post->image = $imageName;
        $post->created_at= Carbon:: now()->toDateTImeString();

        $post->save();
        if ($post) {
            session()->flash('success','value');
            return redirect('admin/job');
        }else{
           session()->flash('success','value');
            return redirect('admin/job');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

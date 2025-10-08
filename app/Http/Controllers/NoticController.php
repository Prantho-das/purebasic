<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notic;
use App\Reaply;
use App\Problem;
use App\Membership;
use App\Notice;
use Carbon\Carbon;
use Image;

class NoticController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function allNotic(){
    	$notic=Notic:: where('status',1)->orderBy('id','desc')->get();
    	return view('admin.notic.all',compact('notic'));
    }
    public function addNotic(){
    	return view('admin.notic.add');
    }

    public function noticUploads(Request $request){
    	$this->validate($request,[
    		'photo'=>'required',
    	],[
    		'photo.required'=>'Please enter photo',
    	]);

    	$data=[];
    	$data['notic']='';
    	$data['created_at']=Carbon:: now()->toDateTime();
    	      if ($request->has('photo')) {
           $image = $request->file('photo');


           $imageName = 'lc_image'.str_random().'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/user/'),$imageName);

           $data['notic']=$imageName;

        }

    	$notic=Notic:: insertGetId($data);


    	if ($notic) {
    		session()->flash('success','value');
    		return redirect('/admin/all/photos');
    	}else{
    		session()->flash('error','value');
    		return back();
    	}
    }

    public function viewnotic($id){
      $data=Notic:: where('status',1)->where('id',$id)->first();
      return view('admin.notic.view',compact('data'));
    }

    public function editnotic($id){
      $data=Notic:: where('status',1)->where('id',$id)->first();
      return view('admin.notic.edit',compact('data'));
    }
    public function noticUpdate(Request $request){
        $id=$request->id;




        if ($request->hasFile('photo')) {
        $image=$request->file('photo');
        $imageName='photos-'.$id.time().'.'.$image->getClientOriginalExtension();
        Image:: make($image)->save('uploads/user/'.$imageName);
        $update= Notic:: where('id',$id)->update([
          'notic'=>$imageName,
        ]);


      }


        if ($update) {
            session()->flash('update','value');
            return redirect('/admin/all/photos');
        }else{
            session()->flash('error','value');
            return back();
        }
    }

    public function deletenotic($id){
      $notic=Notic:: where('status',1)->where('id',$id)->delete();
      if ($notic) {
        session()->flash('delete','value');
            return back();
        }else{
            session()->flash('error','value');
            return back();
        }
    }


    public function allreview(){
        $notic=Problem:: where('status',1)->orderBy('id','desc')->get();
        return view('admin.review.all',compact('notic'));
    }
    public function addreview(){
        return view('admin.review.add');
    }

     public function reviewUploads(Request $request){
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'Please enter name',
        ]);

        $data=[];
        $data['name']=$request->name;
        $data['review']=$request->review;
        $data['photo']='';
        $data['created_at']=Carbon:: now()->toDateTime();

              if ($request->has('photo')) {
           $image = $request->file('photo');


           $imageName = 'lc_image'.str_random().'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/review/'),$imageName);

           $data['photo']=$imageName;

        }

        $review=Problem:: insertGetId($data);



        if ($review) {
            session()->flash('success','value');
            return redirect('/admin/all/review');
        }else{
            session()->flash('error','value');
            return back();
        }
    }

     public function viewreview($id){
      $data=Problem:: where('status',1)->where('id',$id)->first();
      return view('admin.review.view',compact('data'));
    }

    public function deletereview($id){
      $notic=Problem:: where('status',1)->where('id',$id)->delete();
      if ($notic) {
        session()->flash('delete','value');
            return back();
        }else{
            session()->flash('error','value');
            return back();
        }
    }



    public function allNews(){
        $news=Reaply:: where('status',1)->orderBy('id','desc')->get();
        return view('admin.news.all',compact('news'));
    }
    public function addNews(){
        return view('admin.news.add');
    }

     public function NewsUploads(Request $request){


        $data=[];
        $data['title']=$request->title;
        $data['link']=$request->links;
        $data['details']=$request->details;
        $data['photo']='';
        $data['created_at']=Carbon:: now()->toDateTime();

              if ($request->has('photo')) {
           $image = $request->file('photo');


           $imageName = 'lc_image'.str_random().'.'.$image->getClientOriginalExtension();
           $image->move(public_path('uploads/review/'),$imageName);

           $data['photo']=$imageName;

        }

        $review=Reaply:: insertGetId($data);



        if ($review) {
            session()->flash('success','value');
            return redirect('/admin/all/news');
        }else{
            session()->flash('error','value');
            return back();
        }
    }

     public function viewNews($id){
      $data=Reaply:: where('status',1)->where('id',$id)->first();
      return view('admin.news.view',compact('data'));
    }

    public function deleteNews($id){
      $notic=Reaply:: where('status',1)->where('id',$id)->delete();
      if ($notic) {
        session()->flash('delete','value');
            return back();
        }else{
            session()->flash('error','value');
            return back();
        }
    }




    public function all_Notic(){
    	$notic=Notice:: where('status',1)->orderBy('id','desc')->get();
    	return view('admin.notice.all',compact('notic'));
    }
    public function add_Notic(){
      $data = Membership::where('status', 1)->where('show', 1)->get();
    	return view('admin.notice.add',compact('data'));
    }

    public function notic_Uploads(Request $request){
    	$this->validate($request,[
    		'title'=>'required',
    	],[
    		'title.required'=>'Please enter title',
    	]);

	if($request->batch){
      foreach ($request->batch as $key => $batch) {
        $notic=  Notice::insert([
              'name' => $request->title,
              'notice' => $request->notic,
              'link' =>$request->link,
              'created_at' => Carbon:: now()->toDateTime(),
              'updated_at' => Carbon:: now()->toDateTime(),
              'batch_id' => $batch,
              'batch_name' => DB::table('batchpackages')->where('batch_id', $batch)->value('title'),
          ]);
      }}else{
		$notic=  Notice::insert([
              'name' => $request->title,
              'notice' => $request->notic,
              'link' =>$request->link,
              'created_at' => Carbon:: now()->toDateTime(),
              'batch_id' => 'public',
          ]);
	}


    	if ($notic) {
    		session()->flash('success','value');
    		return redirect('/admin/all/notice');
    	}else{
    		session()->flash('error','value');
    		return back();
    	}
    }

    public function view_notic($id){
      $data=Notice:: where('status',1)->where('id',$id)->first();
      return view('admin.notice.view',compact('data'));
    }

    public function edit_notic($id){
      $data=Notice:: where('status',1)->where('id',$id)->first();
      return view('admin.notice.edit',compact('data'));
    }
    public function notic_Update(Request $request){
        $id=$request->id;

        $data=[];
        $data['name']=$request->title;
        $data['notice']=$request->notic;
        $data['link']=$request->link;
        $data['updated_at'] = Carbon:: now()->toDateTime();
        
        $batch_id =Notice::where('id',$id)->value('batch_id');
        $data['batch_name'] = DB::table('batchpackages')->where('batch_id', $batch_id)->value('title');



        
        $update =  Notice::where('id',$id)->update($data);
        $notification_history = DB::table('notification_history')->where('notice_id', $id)->delete();
    	   

        if ($update) {
            session()->flash('update','value');
            return redirect('/admin/all/notice');
        }else{
            session()->flash('error','value');
            return back();
        }
    }

    public function delete_notic($id){
      $notic=Notice:: where('status',1)->where('id',$id)->delete();
      $notification_history = DB::table('notification_history')->where('notice_id', $id)->delete();
      if ($notic) {
        session()->flash('delete','value');
            return back();
        }else{
            session()->flash('error','value');
            return back();
        }
    }
}

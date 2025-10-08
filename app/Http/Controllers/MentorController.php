<?php

namespace App\Http\Controllers;

use App\Mentor;
use Carbon\Carbon;
use Image;
use Illuminate\Http\Request;

class MentorController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$mentors=Mentor::orderBy('id','desc')->get();
		return view('admin.mentor.all',compact('mentors'));
	}
	public function create(){
		return view('admin.mentor.add');
	}

	public function store(Request $request){
		$this->validate($request,[
			'name'=>'required',
			'designation'=>'required',
			'image'=>'required',
		],[]);

		$data=[];
		$data['name']=$request->name;
		$data['designation']=$request->designation;
		$data['created_at']=Carbon:: now()->toDateTime();

		if ($request->has('image')) {
			$image = $request->file('image');
			$imageName = 'lc_image'.str_random().'.'.$image->getClientOriginalExtension();
			$image->move(public_path('uploads/mentor/'),$imageName);
			$data['image']=$imageName;
		}

		$mentor=Mentor:: insertGetId($data);
		if ($mentor) {
			session()->flash('success','value');
			return back();
		}else{
			session()->flash('error','value');
			return back();
		}
	}

	public function view($id){
		$data=Mentor::where('id',$id)->first();
		return view('admin.mentor.view',compact('data'));
	}

	public function edit($id){
		$data=Mentor::where('id',$id)->first();
		return view('admin.mentor.edit',compact('data'));
	}
	public function update($id, Request $request){
		$this->validate($request,[
			'name'=>'required',
			'designation'=>'required',
		],[]);

		$update = Mentor::where('id',$id)->update([
			'name' => $request->name,
			'designation' => $request->designation,
		]);

		if ($request->hasFile('image')) {
			$image=$request->file('image');
			$imageName='photos-'.$id.time().'.'.$image->getClientOriginalExtension();
			$image->move(public_path('uploads/mentor/'),$imageName);
			$data['image']=$imageName;

			Mentor:: where('id',$id)->update([
				'image'=>$imageName,
			]);
		}
		if ($update) {
			session()->flash('update','value');
			return back();
		}else{
			session()->flash('error','value');
			return back();
		}
	}

	public function delete($id){
		$delete=Mentor::where('id',$id)->delete();
		if ($delete) {
			session()->flash('delete','value');
			return back();
		}else{
			session()->flash('error','value');
			return back();
		}
	}
}

<?php

namespace App\Http\Controllers;

use App\Book;
use App\Notic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
    	$book=Book::orderBy('id','desc')->get();
    	return view('admin.book.all',compact('book'));
    }

    public function create(){
    	return view('admin.book.add');
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'photo'=>'required',
    	],[
    		'photo.required'=>'Please enter photo',
    	]);

    	$data=[];
    	$data['created_at']=Carbon:: now()->toDateTime();
    	if ($request->has('photo')) {
    		$image = $request->file('photo');
    		$imageName = 'lc_image'.str_random().'.'.$image->getClientOriginalExtension();
    		$image->move(public_path('uploads/book/'),$imageName);
    		$data['name']=$imageName;
    	}
    	$book=Book::insertGetId($data);
    	if ($book) {
    		session()->flash('success','value');
    		return back();
    	}else{
    		session()->flash('error','value');
    		return back();
    	}
    }

    public function view($id){
      $data=Book::where('id',$id)->first();
      return view('admin.book.view',compact('data'));
    }


    public function delete($id){
      $book=Book::where('id',$id)->delete();
      if ($book) {
        session()->flash('delete','value');
            return back();
        }else{
            session()->flash('error','value');
            return back();
        }
    }

}

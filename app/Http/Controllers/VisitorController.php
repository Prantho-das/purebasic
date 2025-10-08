<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use App\Visitor;
use Carbon\Carbon;
use Session;


class VisitorController extends Controller
{
    public function all_books()
    {
		$books=Visitor::where('status',1)->orderBy('id','desc')->get();
        return view('admin.visitor.all',compact('books'));
    }


      public function add_books()
    {
        return view('admin.visitor.add');

    }

    public function store(Request $request)
    {

        $data=[];
        $data['sl'] = $request->sl;
        $data['name'] = $request->name;
        $data['url'] = $request->url;
        $data['created_at'] = Carbon:: now()->toDateTimeString();
		
		 if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = 'boooks' . str_random() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user/'), $imageName);
            $data['image'] = $imageName;
        }

        $visitor=Visitor:: insert($data);
        if ($visitor) {
            return redirect('admin/books');
        }else{
             return redirect()->back();
        }
    }

}

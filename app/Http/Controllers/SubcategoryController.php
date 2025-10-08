<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\Category;
use Carbon\Carbon;

class SubcategoryController extends Controller
{
     public function index()
    {
        $allcat=SubCategory:: where('status',1)->orderBy('id','DESC')->get();
        return view('admin.sub.all',compact('allcat'));
    }

    public function create()
    {
        $allcat=Category:: where('status',1)->get();
        return view('admin.sub.add',compact('allcat'));
    }

     public function store(Request $request)
    {
        $data=[];
        $data['name'] = $request->name;
        $data['cat_id'] = $request->mainCategory;
        $data['created_at'] = Carbon::now()->toDateTimeString();

        $category=SubCategory:: insert($data);

        if ($category) {
            session()->flash('success','value');
            return redirect('admin/all/subcategory');
        }else{
            session()->flash('error','value');
            return back();
        }
    }
    public function delete($id)
    {
       $delete=SubCategory:: where('id',$id)->delete();
       if ($delete) {
       	session()->flash('delete');
       	return back();
       }
    }

}

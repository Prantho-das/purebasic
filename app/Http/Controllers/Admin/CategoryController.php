<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\MainCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allcat=Category:: where('status',1)->orderBy('id','DESC')->get();
        return view('admin.category.all',compact('allcat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainCategory = MainCategory::all();
        return view('admin.category.add',compact('mainCategory'));
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[];
        $data['name'] = $request->name;
        $data['maincategory_id'] = $request->mainCategory;
        $data['slug'] = str_slug($request->name);
        $data['created_at'] = Carbon::now()->toDateTimeString();

        $category=Category:: insert($data);

        if ($category) {
            session()->flash('success','value');
            return redirect('/admin/category/create');
        }else{
            session()->flash('error','value');
            return redirect('/admin/category/create');
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
        $data=Category:: where('id',$id)->first();
        $mainCategory = MainCategory::all();
        return view('admin.category.edit',compact('data','mainCategory'));
    }

    public function cat_update(Request $request){
        $id=$request->id;
        $data=[];
        $data['name'] = $request->name;
        $data['maincategory_id'] = $request->mainCategory;
        $data['slug'] = str_slug($request->name);


        $categoryU=Category:: where('id',$id)->update($data);

        if ($categoryU) {
            session()->flash('update','value');
            return redirect('/admin/category');
        }else{
            session()->flash('error','value');
            return rback();
        }
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

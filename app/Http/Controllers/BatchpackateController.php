<?php

namespace App\Http\Controllers;

use App\Batchpackage;
use App\Membership;
use Illuminate\Http\Request;

class BatchpackateController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$datas = Batchpackage::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.batchpackage.all',compact('datas'));
    }

	public function batch_delete($id)
    {
    	Batchpackage::where('id',$id)->delete();
    	return redirect()->back();
    }

    public function create()
    {
        $batch_list = Membership::latest()->get();
        return view('admin.batchpackage.add',compact('batch_list'));
    }

    public function store(Request $request)
    {
    	/*$this->validate($request,[
    		'batch_id' => 'required',
    		'title' => 'required',
    		'fild1' => 'required',
    		'fild2' => 'required',
    		'fild3' => 'required',
    		'fild4' => 'required',
    		'fild5' => 'required',
    		'fild6' => 'required',
    		'fild7' => 'required',
    		'fild8' => 'required',
    		'fild9' => 'required',
    		'fild10' => 'required',
            'link' => 'required|url',
            'showing_status' => 'required',
            'batch_category' => 'required',
    	]);*/

    	if($request->has('cover_image'))
        {
            $image = $request->file('cover_image');


            $imageName = 'batch_image' . str_random() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user/'), $imageName);

            $cover_image = $imageName;
        }else{
    	    $cover_image = NULL;
        }

    	$create = Batchpackage::insert([
    		'batch_id' => $request->batch_id,
    		'title' => $request->title,
    		'fild_1' => $request->fild1,
    		'fild_2' => $request->fild2,
    		'fild_3' => $request->fild3,
    		'fild_4' => $request->fild4,
    		'fild_5' => $request->fild5,
    		'fild_6' => $request->fild6,
    		'fild_7' => $request->fild7,
    		'fild_8' => $request->fild8,
    		'fild_9' => $request->fild9,
    		'fild_10' => $request->fild10,
            'link' => $request->link,
            'promotion_video' => $request->promotion_video,
            'cover_image' => $cover_image,
			 'showing_status' => $request->showing_status,
			 'batch_category' => $request->batch_category,
    	]);
    	if ($create) {
    		return redirect('admin/batchPackage');
    	}
    }


    public function edit($id)
    {
        $batch_list = Membership::latest()->get();
    	$data = Batchpackage::with('batch')->where('id',$id)->first();
        return view('admin.batchpackage.edit',compact('data','batch_list'));
    }

    public function update(Request $request,$id)
    {
    	/*$this->validate($request,[
    		'batch_id' => 'required',
    		'title' => 'required',
    		'fild1' => 'required',
    		'fild2' => 'required',
    		'fild3' => 'required',
    		'fild4' => 'required',
    		'fild5' => 'required',
    		'fild6' => 'required',
    		'fild7' => 'required',
    		'fild8' => 'required',
    		'fild9' => 'required',
    		'fild10' => 'required',
            'link' => 'required|url',
			 'showing_status' => 'required',
			 'batch_category' => 'required',
    	]);*/

        if($request->has('cover_image'))
        {
            $image = $request->file('cover_image');


            $imageName = 'batch_image' . str_random() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user/'), $imageName);

            $cover_image = $imageName;
        }else{
            $cover_image = NULL;
        }

    	$update = Batchpackage::where('id',$id)->update([
            'batch_id' => $request->batch_id,
    		'title' => $request->title,
    		'fild_1' => $request->fild1,
    		'fild_2' => $request->fild2,
    		'fild_3' => $request->fild3,
    		'fild_4' => $request->fild4,
    		'fild_5' => $request->fild5,
    		'fild_6' => $request->fild6,
    		'fild_7' => $request->fild7,
    		'fild_8' => $request->fild8,
    		'fild_9' => $request->fild9,
    		'fild_10' => $request->fild10,
            'link' => $request->link,
            'promotion_video' => $request->promotion_video,
            'cover_image' => $cover_image,
			   'showing_status' => $request->showing_status,
			   'batch_category' => $request->batch_category,
    	]);
    	if ($update) {
            return redirect('admin/batchPackage');
    	}
    }
}

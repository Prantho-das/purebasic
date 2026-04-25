<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use Illuminate\Http\Request;
use App\Chapter;
use Image;
class BannerController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$datas = Banner::all();
        return view('admin.banner.all',compact('datas'));
    }

    public function create()
    {
    	return view('admin.banner.add');
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'image' => 'required|image',
    	]);

    	if($request->hasFile('image')){
    		$image=$request->file('image');
    		$imageName='banner-image'.time().'.'.$image->getClientOriginalExtension();
    		Image::make($image)->save('/home/purebasic/public_html/uploads/banner/'.$imageName);
    		$create =  Banner::insert([
    			'image'=> $imageName,
    			'batch_id' => $request->batch_id,
    		]);
    		return redirect()->back();
    	}
    }
    
    
    public function edit($id)
    {
        $data = Banner::where('id',$id)->first();
        return view('admin.banner.edit',compact('data'));
    }
    
    
    public function update(Request $request,$id)
    {
        
        
        $update = Banner::where('id',$id)->update([
            'batch_id' => $request->batch_id,
    	]);
    	
    	if ($update) {
            return redirect('admin/banner');
    	}

    }
    
    

    public function delete($id)
    {
    	Banner::where('id',$id)->delete();
    	return redirect()->back();
    }



    public function cp_create(Request $request)
    {
        $categories = Category::where('status', 1)->orderBy('name')->get(['id', 'name']);
        $chapters = Chapter::where('status', 1)
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            })
            ->orderBy('serial')
            ->paginate(20)
            ->appends(request()->query());
        return view('admin.chapter.add', compact('categories', 'chapters'));
    }


    public function cp_edit($id)
    {
        $data = Chapter::where('id',$id)->first();
        return view('admin.chapter.edit',compact('data'));
    }
    
    


    public function cp_store(Request $request)
    {
        $data=[];
        $data['cat_id']=$request->cat_id;
        $data['subject']=Category::where('id',$request->cat_id)->value('name');
        $data['name']=$request->name;
        $data['literature']=$request->literature;
        $data['serial']=$request->serial;
        $data['qb_serial']=$request->qb_serial;
        $data['price']=$request->price;


        $store=Chapter:: insert($data);

        if ($store) {
            return redirect()->back();
        }else{
           return redirect()->back();  
        }
    }
    

    public function cp_update(Request $request, $id)
    {
        $update = Chapter::where('id',$id)->update([
            'name' => $request->name,
            'literature' => $request->literature,
            'serial' => $request->serial,
            'qb_serial' => $request->qb_serial,
            'price' => $request->price,


    	]);
    	
    	if ($update) {
            return redirect('/admin/chapter/create');
    	}
    }
    
    
	
	public function cp_delete($id){
		$delete=Chapter::where('id',$id)->delete();
		if($delete){
			return back();
		}
	}





}

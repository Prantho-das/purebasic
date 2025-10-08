<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
use Session;

class CommentController extends Controller
{
    public function comment(Request $request,$post){
    	
    	$data=[];
    	$data['visitor_id']= Session::get('id');
    	$data['post_id']= $post;
    	$data['comments']=$request->comment;


    	$comment=Comment:: insert($data);

    	if ($comment) {
    		return back();
    	}else{
    		return back();
    	}
    }
}

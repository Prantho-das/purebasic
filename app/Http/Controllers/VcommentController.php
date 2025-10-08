<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vcomment;
use Session;

class VcommentController extends Controller
{
  public function comment(Request $request,$post){

    $data=[];
    $data['visitor_id']= Session::get('id');
    $data['video_id']= $post;
    $data['comments']=$request->comment;


    $comment=Vcomment:: insert($data);

    if ($comment) {
      return back();
    }else{
      return back();
    }
  }
}

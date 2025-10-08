<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;

class SearchController extends Controller
{
    public function search(Request $request){
      $mostView=Post:: where('status',1)->limit(9)->orderBy('id','desc')->get()->sortByDesc('view_count');
      $most=Post:: where('status',1)->limit(3)->orderBy('id','desc')->get()->sortByDesc('view_count');
    	$allcat=Category:: where('status',1)->orderBy('id','DESC')->get();
      $fivecategorys = Category:: where('status',1)->where('id',5)->first();
      $sixcategorys = Category:: where('status',1)->where('id',6)->first();
      $taending=Tag:: where('status',1)->orderBy('id','desc')->get();

    	$search=$request->search;
    	$allpost=Post:: where('title','LIKE',"%$search%")->orwhere('sub_title','LIKE',"%$search%")->orwhere('caption','LIKE',"%$search%")->orwhere('description','LIKE',"%$search%")->get();
    	return view('website.search',compact('search','allcat','allpost','mostView','most','sixcategorys','fivecategorys','taending'));

    }
}

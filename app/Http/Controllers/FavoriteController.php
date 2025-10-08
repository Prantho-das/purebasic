<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitor;
use Session;

class FavoriteController extends Controller
{
    public function create($id){
    	 $visitor = Session::get('id');
    	 $visitorDetails = Visitor:: where('id',$visitor)->first();
    	  $isFavorite = $visitorDetails->favorite_posts()->where('post_id',$id)->count();
    	if ($isFavorite == 0) {
    		$visitorDetails->favorite_posts()->attach($id);
    		return back();
    	}else{
    		$visitorDetails->favorite_posts()->detach($id);
    		return back();
    	}
    }

    public function video_like($id){
    	 $visitor = Session::get('id');
    	 $visitorDetails = Visitor:: where('id',$visitor)->first();
    	  $isFavorite = $visitorDetails->favorite_posts()->where('id',$id)->count();
    	if ($isFavorite == 0) {
    		$visitorDetails->favorite_posts()->attach($id);
    		return back();
    	}else{
    		$visitorDetails->favorite_posts()->detach($id);
    		return back();
    	}
    }


}

<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use App\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{

    use ApiResponse;
    public function books()
    {
        $books=Visitor::where('status',1)->orderBy('id','desc')->get();

        $books = $books->each(function ($value){
           return $value->image=asset('uploads/user/'.$value->image);
        });

        return $this->respondWithSuccess('Book list',$books);
   }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


class CmsController extends Controller
{

    public function index(){
        if(request()->type=='review'){
            
        }
        return view('admin.cms.index');
    }

}
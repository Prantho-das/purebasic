<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contactus;

class ContactusController extends Controller
{
    public function all(){
    	$allcontact=Contactus:: where('status',1)->orderBy('id','desc')->get();
    	return view('admin.contact.all',compact('allcontact'));
    }
    public function view($id){
    	$data=Contactus:: where('status',1)->where('id',$id)->first();
    	return view('admin.contact.view',compact('data'));
    }

    public function delete($id){
    	$delete=Contactus:: where('status',1)->where('id',$id)->delete();
    	if ($delete) {
    		session()->flash('success','value');
    		return back();
    	}else{
    		return back();
    	}
    }
}

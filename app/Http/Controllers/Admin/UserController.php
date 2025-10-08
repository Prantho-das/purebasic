<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Image;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alluser=User:: where('status',1)->orderBy('id','desc')->get();
        return view('admin.user.all',compact('alluser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Role=Role:: where('status',1)->get();
        return view('admin.user.add',compact('Role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'name'=>'required',
          'username'=>'required',
          'email'=>'required',
          'password'=>'required|min:6|confirmed',
        ],[
          'name.required'=> 'Please enter your name',
          'user_name.required'=> 'Please enter your username',
          'email.required'=> 'Please enter your email',
          'password.required'=>'Plase enter your password at 6 lanth',
          'password.confirmed'=> 'password did not match',
        ]);

        $data=[];
        $data['role_id']=$request->role;
        $data['name']=$request->name;
        $data['user_name']=$request->username;
        $data['email']=$request->email;
        $data['password']= Hash::make($request['password']);
        $data['created_at']=Carbon:: now()->toDateTimeString();

        $register=User:: insertGetId($data);

        if ($request->hasFile('pic')){
        $image=$request->file('pic');
        $imagename='user'.$register.time().'.'.$image->getclientoriginalextension();
         Image::make($image)->save('uploads/user/'.$imagename);
         User::where('id',$register)->update([
           'photo'=>$imagename,
         ]);
      }


        if ($register) {
          session()->flash('success','value');
          return redirect('admin/user');
        }else {
          session()->flash('error','value');
          return back();
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
      $view=User:: where('status',1)->where('id',$id)->first();
      return view('admin.user.view',compact('view'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $destroy=User:: where('status',1)->where('id',$id)->delete();
        if ($destroy) {
            session()->flash('delete','value');
            return back();
        }else{
            return back();
        }
    }
}

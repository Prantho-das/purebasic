<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paidmember;
use App\Student;
use App\Membership;
use App\Job;
use Carbon\Carbon;

class PaidmemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function paidmember()
    {
        $paidmember = Paidmember:: where('status', 1)->orderBy('id', 'desc')->paginate(15);
        return view('admin.paidmember.all', compact('paidmember'));
    }

    public function approveMember($id)
    {
        $approve = Paidmember:: where('status', 1)->where('is_approve', 0)->where('id', $id)->update([
            'is_approve' => 1,
            'approved_at' => date('Y-m-d H:i:s'),
        ]);
        $paid_member = Paidmember::where('id', $id)->where('status', 1)->where('is_approve', 1)->first();
        $batch_info = Membership::where('id', $paid_member->batch_id)->first();


        $sudent_update = Student::where('id', $paid_member->student_id)->update([
            'student_id' => $batch_info->yr . $batch_info->batch_id . $paid_member->student_id,
            'is_approve' => 1,
        ]);
        if ($approve) {
            session()->flash('approve', 'value');
            return back();
        } else {
            return back();
        }
    }


    public function memberdelete($id)
    {
        $delete_id = Paidmember:: where('status', 1)->where('id', $id)->first();
        $delete = Paidmember:: where('status', 1)->where('id', $id)->delete();
        $delete = Student:: where('id', $delete_id->student_id)->delete();

        if ($delete) {
            session()->flash('delete', 'value');
            return back();
        } else {
            return back();
        }


    }

    public function memberview($id)
    {
        $data = Paidmember:: where('status', 1)->where('id', $id)->first();
        return view('admin.paidmember.view', compact('data'));
    }

    public function all_due()
    {
        $paidmember = Job:: where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.due.all', compact('paidmember'));
    }


    public function dueMember($id)
    {
        $approve = Job:: where('status', 1)->where('is_approve', 0)->where('id', $id)->update([
            'is_approve' => 1,
        ]);
        if ($approve) {
            session()->flash('approve', 'value');
            return back();
        } else {
            return back();
        }
    }


    public function duedelete($id)
    {
        $delete = Job:: where('status', 1)->where('id', $id)->delete();
        if ($delete) {
            session()->flash('delete', 'value');
            return back();
        } else {
            return back();
        }


    }

    public function dueview($id)
    {
        $data = Job:: where('status', 1)->where('id', $id)->first();
        return view('admin.due.view', compact('data'));
    }


    public function student_update(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['gender'] = $request->gender;
        $data['birth'] = $request->birth;
        $data['position'] = $request->position;
        $data['BMDC'] = $request->BMDC;
        $data['batch_id'] = $request->group;
        $data['medical'] = $request->medical;
        $data['batch'] = $request->batch;
        $data['sessionn'] = $request->sessionn;
        $data['levell'] = $request->levell;
        $data['fb'] = $request->fb;
        $data['address'] = $request->address;

        if ($request->has('photo')) {
            $image = $request->file('photo');


            $imageName = 'lc_image' . str_random() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user/'), $imageName);

            $data['photo'] = $imageName;

        }

        if ($request->password != null) {

            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed',
            ], [
                'password.confirmed' => 'Password did not match',
            ]);
        }
        $check = Student::where('id', $id)->first();

        if ($request->password != null) {
            $data['password'] = md5($request->password);
        }


        $profile = Student:: where('id', $id)->update($data);
        if ($profile) {
            session()->flash('success', 'value');
            return back();
        } else {
            return back();
        }
    }


}

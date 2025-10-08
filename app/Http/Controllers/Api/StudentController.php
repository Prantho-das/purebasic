<?php

namespace App\Http\Controllers\Api;

use App\Student;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $student = Student::find($id);
        if(empty($student))
            return $this->respondWithError('Student Not found',404);

//        $student->photo=asset('/uploads/user/').$student->photo;
        return $this->respondWithSuccess('Student_info',$student);
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


    public function updateData(Request $request)
    {
        echo 'Testing post update';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeProfile(Request $request, $id)
    {


        $student = Student::find($id);

        if(empty($student))
        {
            return $this->respondWithError('Not found',404);
        }

        $data=$request->post();
        if($request->hasFile('photo'))
        {
            $image = $request->file('photo');
            $imageName = 'lc_image' . str_random() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/user/'), $imageName);
            $data['photo'] = $imageName;
        }

        if($request->has('password'))
        {
            unset($data['password']);
        }

        if($request->has('otp'))
        {
            unset($data['otp']);
        }

        if($request->has('api_token'))
        {
            unset($data['api_token']);
        }

        Student::where('id',$id)->update($data);
        $student_up = Student::find($id);
        return $this->respondWithSuccess('Successfully Updated',$student_up);

    }


public function admissionFormSave(Request $request)
{
    $admissionData = DB::table('admission')
        ->insert([
            'pb_id' => $request->pb_id,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'bmdc' => $request->bmdc,
            'session' => $request->pb_session,
            'college' => $request->college,
            'address' => $request->address,
            'enrolled_batch' => $request->enrolled_batch,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id
        ]);

    if ($admissionData)
    {
        return $this->respondWithSuccess('Admission Form Saved!');
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

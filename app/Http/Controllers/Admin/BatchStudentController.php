<?php

namespace App\Http\Controllers\Admin;

use App\BatchStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BatchStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showReport = 0;

        $batchData = DB::table('memberships')
            ->select('id', 'plan')
            ->orderBy('id', 'desc')
            ->get();

       // $items  = BatchStudent::where('status',1)->orderByRaw('FIELD(enroll_status,0) desc')->orderBy('id', 'desc')->get();
        return view('admin.batch_student.all_ajax', compact('batchData', 'showReport'));
    }

    public function loadData (Request $request)
    {
        $batchId = $request->batch_id;
        $enrollStatus = $request->enroll_id;
        $showReport = 1;

        $batchData = DB::table('memberships')
            ->select('id', 'plan')
            ->orderBy('id', 'desc')
            ->get();

        if ($enrollStatus != null)
        {
            $items  = BatchStudent::where('enroll_status',$enrollStatus)->orderBy('id', 'desc')->get();
        }

        if ($batchId != null)
        {
            $items  = BatchStudent::where('batch_id',$batchId)->orderBy('id', 'desc')->get();
        }

        if ($batchId != null and $enrollStatus != null)
        {
            $items  = BatchStudent::where('batch_id',$batchId)->where('enroll_status', $enrollStatus)->orderBy('id', 'desc')->get();
        }

        if ($batchId == null and $enrollStatus == null)
        {
            $showReport = 0;
        }

        return view('admin.batch_student.all_ajax', compact('items', 'batchData', 'showReport'));

    }
    
    
    
    
    public function enrolledData ($batchId)
    {


        $batchName = DB::table('batchpackages')->where('batch_id',$batchId)->value('title');


            

        $items  = BatchStudent::where('batch_id',$batchId)->where('enroll_status', 1)->orderBy('id', 'desc')->get();



        return view('admin.batch_student.enrolled', compact('items', 'batchId', 'batchName'));

    }

    public function enrolledMobile ($batchId)
    {


        $batchName = DB::table('batchpackages')->where('batch_id',$batchId)->value('title');


            

        $items  = BatchStudent::where('batch_id',$batchId)->where('enroll_status', 1)->orderBy('id', 'desc')->get();



        return view('admin.batch_student.mobile', compact('items', 'batchId', 'batchName'));

    }    
    


    public function enrolledWhatsapp ($batchId)
    {


        $batchName = DB::table('batchpackages')->where('batch_id',$batchId)->value('title');


            

        $items  = BatchStudent::where('batch_id',$batchId)->where('enroll_status', 1)->orderBy('id', 'desc')->get();



        return view('admin.batch_student.whatsapp', compact('items', 'batchId', 'batchName'));

    }
    

    public function approve($id)
    {
        $item = BatchStudent::find($id);
        if(empty($item))
        {
            session()->flash('error', 'Enrollment information not exist');
            return redirect('admin/batch_student');
        }

        $item->enroll_status=1;
        $item->save();

        session()->flash('error', 'Successfully approved');
        return redirect('admin/batch_student');
    }

    public function reject($id)
    {
        $item = BatchStudent::find($id);
        if(empty($item))
        {
            session()->flash('error', 'Enrollment information not exist');
            return redirect('admin/batch_student');
        }

        $item->enroll_status=2;
        $item->save();

        session()->flash('error', 'Successfully Rejected');
        return redirect('admin/batch_student');
    }


    public function activate($id)
    {
        $item = BatchStudent::find($id);
        if(empty($item))
        {
            session()->flash('error', 'Enrollment information not exist');
            return redirect('admin/batch_student');
        }

        $item->enroll_status=1;
        $item->save();

        session()->flash('error', 'Successfully Activated');
        return redirect('admin/batch_student');
    }

    public function deactivate($id)
    {
        $item = BatchStudent::find($id);
        if(empty($item))
        {
            session()->flash('error', 'Enrollment information not exist');
            return redirect('admin/batch_student');
        }

        $item->enroll_status=2;
        $item->save();

        session()->flash('error', 'Successfully deactivated');
        return redirect('admin/batch_student');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BatchStudent::find($id);
        dd($item);
        return view('admin.batch_student.edit',compact('item'));
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
        //
    }
}

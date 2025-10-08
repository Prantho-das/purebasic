<?php

namespace App\Http\Controllers\Admin;

use App\BatchStudent;
use App\BatchSubscriptionHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BatchSubscriptionHistoryController extends Controller
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
        return view('admin.batch_subscription.all_ajax', compact('batchData', 'showReport'));
    }


    public function loadData (Request $request)
    {
        $batchId = $request->batch_id;
        $day = $request->day;
        $month = $request->month;
        $year = $request->year;
        

        $batchData = DB::table('memberships')
            ->select('id', 'plan')
            ->orderBy('id', 'desc')
            ->get();




        if ($year != null)
        {
            $items  = BatchSubscriptionHistory::whereYear('created_at',$year)->orderBy('id', 'desc')->get();
            
            if ($batchId != null) {
                $items  = BatchSubscriptionHistory::where('batch_id', $batchId)->whereYear('created_at',$year)->orderBy('id', 'desc')->get();
                
                
            }
            
            $dateInfo = $year;
            $totalEnrolled = $items->count();
            $totalPayment = $items->sum('paid');
        }

        if ($year != null and $month != null)
        {
            $items  = BatchSubscriptionHistory::whereYear('created_at',$year)->whereMonth('created_at',$month)->orderBy('id', 'desc')->get();
            
            if ($batchId != null) {
                $items  = BatchSubscriptionHistory::where('batch_id', $batchId)->whereYear('created_at',$year)->whereMonth('created_at',$month)->orderBy('id', 'desc')->get();
                
                
            }
            
            $monthName = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            $dateInfo = $monthName[$month - 1] . ', ' . $dateInfo;
            $totalEnrolled = $items->count();
            $totalPayment = $items->sum('paid');


        }

        if ($day != null)
        {
            $items  = BatchSubscriptionHistory::whereDay('created_at',$day)->whereMonth('created_at',$month)->whereYear('created_at',$year)->orderBy('id', 'desc')->get();
            
            if ($batchId != null) {
                $items  = BatchSubscriptionHistory::where('batch_id', $batchId)->whereDay('created_at',$day)->whereMonth('created_at',$month)->whereYear('created_at',$year)->orderBy('id', 'desc')->get();
                
                
            }
            
            $dateInfo = $day . ' ' . $dateInfo; 
            $totalEnrolled = $items->count();
            $totalPayment = $items->sum('paid');

            

            
        }        
        




        return view('admin.batch_subscription.all_ajax', compact('items', 'batchData', 'dateInfo', 'totalEnrolled', 'totalPayment'));

    }
    
    
    
    
    public function enrolledData ($batchId)
    {


        $batchName = DB::table('batchpackages')->where('batch_id',$batchId)->value('title');


            

        $items  = BatchStudent::where('batch_id',$batchId)->where('enroll_status', 1)->orderBy('id', 'desc')->get();



        return view('admin.batch_subscription.enrolled', compact('items', 'batchId', 'batchName'));

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
        return view('admin.batch_subscription.edit',compact('item'));
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

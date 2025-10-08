<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Membership;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    public function all()
    {
        $allbatch = Membership:: where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.batch.all', compact('allbatch'));
    }

    public function add()
    {
        $lastId = Membership:: where('status', 1)->latest('id')->get()[0];
        return view('admin.batch.add', compact('lastId'));
    }

    public function submit(Request $request)
    {
        $data = [];
        $data['plan'] = $request->plan;
        $data['type'] = $request->type;
        $data['graduation'] = $request->graduation;
        $data['duration'] = $request->duration;
        $data['ammount'] = $request->ammount;
        $data['batch_id'] = $request->batch_id;
        $data['created_at'] = Carbon:: now()->toDateTimeString();

        if (isset($request->show)) {
            $data['show'] = 1;
        } else {
            $data['show'] = 0;
        }

        if (isset($request->courier)) {
            $data['courier'] = 1;
        } else {
            $data['courier'] = 0;
        }

        $batch = Membership:: insert($data);
        if ($batch) {
            session()->flash('success');
            return redirect('admin/addmition/batch');
        } else {
            return back();
        }
    }

    public function edit($id)
    {
        $data = Membership:: where('status', 1)->where('id', $id)->first();
        return view('admin.batch.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $data = [];
        $data['plan'] = $request->plan;
        $data['type'] = $request->type;
        $data['duration'] = $request->duration;
        $data['graduation'] = $request->graduation;
        $data['ammount'] = $request->ammount;
        $data['batch_id'] = $request->batch_id;

        if (isset($request->show)) {
            $data['show'] = 1;
        } else {
            $data['show'] = 0;
        }
        
        if (isset($request->courier)) {
            $data['courier'] = 1;
        } else {
            $data['courier'] = 0;
        }

        $batch = Membership:: where('id', $id)->update($data);
        if ($batch) {
            session()->flash('update');
            return redirect('admin/addmition/batch');
        } else {
            return back();
        }
    }

    public function delete($id)
    {
        $delete = Membership:: where('id', $id)->delete();
        if ($delete) {
            session()->flash('delete');
            return redirect('admin/addmition/batch');
        } else {
            return back();
        }
    }

    //bt modification add batch duration
    public function showDuration()
    {
        $allBatchDuration = DB::table('batch_duration as d')
            ->leftJoin('memberships as m', function ($joinOne) {
                $joinOne->on('d.bd_batch_id', '=', 'm.id');
            })
            ->select('bd_id', 'd.bd_batch_id', 'm.plan', 'm.id', 'd.bd_duration', 'd.bd_fee', 'd.information')
            ->orderBy('bd_id', 'desc')->get();
        return view('admin.batch.showbatchduration', compact('allBatchDuration'));
    }

    public function addBatchDuration()
    {
        $batch_list = DB::table('memberships')
            ->select('id', 'plan')->orderBy('id', 'desc')
            ->get();
        return view('admin.batch.addduration', compact('batch_list'));
    }

    public function storeBatchDuration(Request $request)
    {
        $data = [];
        $data['bd_batch_id'] = $request->batch_id;
        $data['bd_duration'] = $request->batch_duration;
        $data['bd_fee'] = $request->batch_fee;
        $data['information'] = $request->information;
        $data['subscription_end'] = $request->subscription_end;


        $store = DB::table('batch_duration')
            ->insert($data);

        if ($store) {
            session()->flash('success');
            return redirect(route('show.duration'));
        } else {
            return back();
        }
    }

    public function editBatchDuration($id)
    {
        $editdata = DB::table('batch_duration as d')
            ->leftJoin('memberships as m', function ($joinOne) {
                $joinOne->on('d.bd_batch_id', '=', 'm.id');
            })
            ->where('d.bd_id', '=', $id)
            ->select('d.bd_id', 'd.bd_batch_id', 'm.plan', 'd.bd_duration', 'd.bd_fee', 'd.information', 'd.subscription_end')
            ->get();
        return view('admin.batch.editbatchduration', compact('editdata'));
    }

    public function updateBatchDuration(Request $request)
    {
        $id = $request->bd_id;
        $data = [];
     //   $data['bd_batch_id'] = $request->batch_id;
        $data['bd_duration'] = $request->batch_duration;
        $data['bd_fee'] = $request->batch_fee;
        $data['information'] = $request->information;
        $data['subscription_end'] = $request->subscription_end;

        $store = DB::table('batch_duration')
            ->Where('bd_id', '=', $id)
            ->update($data);

        if ($store) {
            session()->flash('update');
            return redirect(route('show.duration'));
        } else {
            return back();
        }
    }

    public function summaryReport()
    {
        $showReport = 0;
        $batchData = DB::table('memberships')
            ->select('id', 'plan')
            ->orderBy('plan', 'asc')
            ->get();

        return view('admin.report.student_summary', compact('showReport', 'batchData'));
    }

    public function summaryReportDataload(Request $request)
    {
        $showReport = 1;

        $batchData = DB::table('memberships')
            ->select('id', 'plan')
            ->orderBy('plan', 'asc')
            ->get();

//        $reportDataCount = DB::table('sub_summary_info')
//            ->where('membershipe_id', $request->batch_id)
//           ->select('student_id', 'name', 'mobile', 'plan', 'exam_type', 'membershipe_id', DB::raw('SUM(point) as point'))
//            ->groupBy('student_id', 'name', 'mobile', 'plan', 'exam_type', 'membershipe_id')
//            ->get();

        $batchResult = DB::table('modeltest_answers as a')
            ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
            ->leftJoin('memberships as m', 'b.membershipe_id', '=', 'm.id')
            ->leftJoin('students as s', 'a.student_id', '=', 's.id')
            ->where('b.membershipe_id', $request->batch_id)
            ->distinct()
            ->select('b.membershipe_id', 'm.plan', 'a.student_id', 's.name', 's.mobile', 'm.plan')
            ->get();

        return view('admin.report.student_summary', compact('showReport', 'batchData', 'batchResult'));
    }




}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allHelp = DB::table('help')
            ->leftJoin('memberships as m', function ($joinOne) {
                $joinOne->on('help.batch_id', '=', 'm.id');
            })
            ->select('m.plan', 'help.serial', 'help.title', 'help.details', 'help.id', 'help.is_tutorial')
            ->get();
        return view('admin.batch.helpshow', compact('allHelp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$batch_list = DB::table('memberships')->select('id', 'plan')->get();
        //return view('admin.batch.helpadd', compact('batch_list'));
        return view('admin.batch.helpadd');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inserHelp = DB::table('help')
            ->insert([
                'serial' => $request->serial,
                'title' => $request->title,
                'details' => $request->details,
                'is_tutorial' => $request->is_tutorial,
            ]);

        if ($inserHelp) {
            session()->flash('success');
            return redirect(url('/admin/help'));
        } else {
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
        $editData = DB::table('help')
            ->leftJoin('memberships as m',function ($joinOne){
                $joinOne->on('help.batch_id', '=', 'm.id');
            })
            ->select('help.id', 'm.plan', 'help.serial', 'help.title', 'help.details', 'help.is_tutorial')
            ->where('help.id', '=', $id)
            ->get();
        return view('admin.batch.helpedit', compact('editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    public function updateHelp(Request $request)
    {
        $id = $request['helpid'];
        $data = [];
        $data['serial'] = $request['serial'];
        $data['title'] = $request['title'];
        $data['details'] = $request['details'];
        $data['is_tutorial'] = $request['is_tutorial'];


        $store = DB::table('help')
            ->where('id', $id)
            ->update($data);

        if ($store) {
            session()->flash('update');
            return redirect(url('/admin/help'));
        } else {
            return back();
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

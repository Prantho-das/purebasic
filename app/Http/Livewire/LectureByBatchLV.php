<?php

namespace App\Http\Livewire;

use App\Batchpackage;
use App\Membership;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LectureByBatchLV extends Component
{
    public $batch;
    private $lecture;

    public $selectBatch = null;
    public $selectLecture = null;

    public function mount()
    {
       // $this->batch = Membership::where('status', 1)->get();
        $this->batch = DB::table('memberships')->where('status', '=', 1)->get();
    //    $this->lecture = collect();
    }

    public function updatedSelectedBatch($batch)
    {
        $lectureData = DB::table('modeltest_batches as mb')
            ->leftJoin('modeltests as mt', 'mb.modeltest_id', '=', 'mt.id')
            ->select('mt.id', 'mt.name')
            ->where('mb.membershipe_id', '=', $batch)
            ->get();
    }

    public function render()
    {
        return view('livewire.lecture-by-batch-l-v');
    }
}

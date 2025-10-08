@extends('layouts.admin')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <i class="fas fa-users"></i>
                            Student Summary Report
                        </div>

                        <form action="{{route('report.summary.dataload')}}" method="post" enctype="multipart/form-data"
                              class="col-md-12">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="batch_id">Filter by Batch:</label>
                                    <select name="batch_id" class="col-md-3 form-control-sm">
                                        <option value="">{{ 'Select' }}</option>
                                        @foreach($batchData as $aBatchData)
                                            <option value="{{$aBatchData->id}}">{{$aBatchData->plan}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm form-control col-md-2">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>

                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered yajra-datatable"
                                           style="text-transform: capitalize;"
                                           width="100%">
                                        <thead>
                                        <tr role="row">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Batch</th>
                                            <th>Quiz Marks</th>
                                            <th>Exam Marks</th>
                                            <th>Video Watch Marks</th>
                                            <th>Result</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($showReport != 0)
                                            @foreach($batchResult as $batch)
                                            <tr>
                                                <th>{{$batch->student_id}}</th>
                                                <th>{{$batch->name}}</th>
                                                <th>{{$batch->mobile}}</th>
                                                <th>{{$batch->plan}}</th>


                                                @php $quizMark = \Illuminate\Support\Facades\DB::table('modeltest_answers as a')
                                ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                                ->where('a.student_id', $batch->student_id)
                                ->where('b.lecture_id', '!=', null)
                                ->where('b.membershipe_id', $batch->membershipe_id)
                                ->sum('point');

                                                @endphp
                                                <th>{{number_format($quizMark, 2)}}</th>

                                                @php $lectureMark = \Illuminate\Support\Facades\DB::table('modeltest_answers as a')
                                ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                                ->where('a.student_id', $batch->student_id)
                                ->where('b.lecture_id', '=', null)
                                ->where('b.membershipe_id', $batch->membershipe_id)
                                ->sum('point');

                                                @endphp
                                                <th>{{number_format($lectureMark, 2)}}</th>

                                                @php
                                                    $videoMark = \Illuminate\Support\Facades\DB::table('watch_count')
                                                    ->where('batch_id', $batch->membershipe_id)
                                                    ->where('user_id', $batch->student_id)
                                                    ->where('count', '>=', 2)
                                                    ->count('id')*2;

                                                $totalMark = $videoMark + $lectureMark + $quizMark;

                                                @endphp
                                                <th>{{number_format($videoMark, 2)}}</th>

                                                <th>{{number_format($totalMark, 2)}}</th>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                                        <div class="card-footer small text-muted">

                                        </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
@endsection
@section('admin_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.yajra-datatable').dataTable(
                {
                    ordering: false,
                }
            );
        });
    </script>

@endsection

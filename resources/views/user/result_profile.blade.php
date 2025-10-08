@extends('layouts.register')
@section('content')


    <!--begin::Entry-->
    <div class="row container">
        <!--begin::Container-->
        <div class="col-3">&nbsp;</div>
        <div class="col-6">

            @foreach($batchResult as $batch)
            <div class="card card-custom overflow-hidden medicineFree">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                            <b>{{$batch->plan}}</b>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                            @php $quizMark = \Illuminate\Support\Facades\DB::table('modeltest_answers as a')
                                ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                                ->where('a.student_id', session()->get('id'))
                                ->where('b.lecture_id', '!=', null)
                                ->where('b.membershipe_id', $batch->membershipe_id)
                                ->sum('point');

                            $quizOut = \Illuminate\Support\Facades\DB::table('modeltest_answers as a')
                                ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                                ->leftJoin('modeltests as m', 'b.modeltest_id', '=', 'm.id')
                                ->where('a.student_id', session()->get('id'))
                                ->where('b.lecture_id', '!=', null)
                                ->where('b.membershipe_id', $batch->membershipe_id)
                                ->sum('exam_in_minutes');

                            @endphp
                            Quiz Mark: {{number_format($quizMark,2)}}<i style="font-size: 10px"><span class="text-danger">(out of {{$quizOut}})</span></i>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                            @php $lectureMark = \Illuminate\Support\Facades\DB::table('modeltest_answers as a')
                                ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                                ->where('a.student_id', session()->get('id'))
                                ->where('b.lecture_id', '=', null)
                                ->where('b.membershipe_id', $batch->membershipe_id)
                                ->sum('point');

                            $examOut = \Illuminate\Support\Facades\DB::table('modeltest_answers as a')
                                ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                                ->leftJoin('modeltests as m', 'b.modeltest_id', '=', 'm.id')
                                ->where('a.student_id', session()->get('id'))
                                ->where('b.lecture_id', '=', null)
                                ->where('b.membershipe_id', $batch->membershipe_id)
                                ->sum('exam_in_minutes');

                                @endphp
                                Exam Mark: {{number_format($lectureMark, 2)}}<i style="font-size: 10px"><span class="text-danger">(out of {{$examOut}})</span></i>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                            @php
                                $videoMark = \Illuminate\Support\Facades\DB::table('watch_count')
                                ->where('batch_id', $batch->membershipe_id)
                                ->where('user_id', session()->get('id'))
                                ->count('id')*2;
                                @endphp
                            Video Study Mark: {{number_format($videoMark, 2)}}<i style="font-size: 10px"><span class="text-danger">(out of {{$videoMark}})</span></i>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                            @php
                            $totalMark = $quizMark + $lectureMark + $videoMark;
                            $totalOut = $quizOut + $examOut + $videoMark;
                            @endphp
                            <b>Total Mark: {{number_format($totalMark, 2)}}<i style="font-size: 10px"><span class="text-danger">(out of {{$totalOut}})</span></i></b>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                            @php
                                $inPercent = ($totalMark * 100)/$totalOut;
                            @endphp
                            <b> {{number_format($inPercent, 2)}} %</b>
                        </div>
                    </div>
                </div>
            </div>
                <br>
            @endforeach
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection
@push('script')
    <script>
        $(document).ready(function(){
            $('#dashboard_tab').removeClass('active');
            $('#kt_header_tab_1').addClass('show active');
            $('#exam_tab').addClass('active');

            $('#mb_dashboard_tab').removeClass('active');
            $('#mb_remove_tab').attr("aria-selected","true");
        });
    </script>
@endpush

@extends('layouts.register')
@section('content')

    <div class="container">
        @if($free)
            <div class="centerText">
            <h3>Please read the instructions before appearng in free exams</h3>
            <a href="/help" class="instructionButton">Instructions</a>
            </div>
        @endif
        <div>
            <h3 class="centerText"> {{$batch_info->plan}} </h3>
            <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">Exam Name</th>
                    <th title="Field #2">Total Mark</th>
                    <th title="Field #3">Total Time</th>
                    <th title="Field #4">Action</th>
                    <th style="display: none"></th>
    
                </tr>
                </thead>
                <tbody>
                @php $key=($exams_raw->perPage() * ($exams_raw->currentPage()-1))+1; @endphp
                @foreach($exams_raw as $exam)
                    <tr>
                        <td>{{$key++ . '. ' .  $exam->name}}</td>
                        <td>{{$exam->exam_in_minutes}}</td>
                        <td>{{$exam->ex_time.' minutes'}}</td>
                        <td><a href="{{url('/spacialmodeltest-examm/'.$exam->id)}}">Start Exam</a></td>
                    </tr>
                @endforeach
                </tbody>
    
            </table>
            <div class="row">
                <div class="col-3">&nbsp</div>
                <div class="col-6">{{$exams_raw->links()}}</div>
                <div class="col-3">&nbsp</div>

            </div>
        </div>
                    
    </div>

@endsection

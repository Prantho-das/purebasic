@extends('layouts.website')
@section('content')
    <section style="background: #F9F9F9;margin-bottom: -15px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="specialExam">
                        <h1 class="mb-5">Live Examination</h1>
                        <table class="table table-striped" style="background: #fff;border: 1px solid #ccc;">
                            <tr>
                                <th>SL</th>
                                <th>Exam name</th>
                                <th>Batch</th>
                                <th>Total marks</th>
                                <th>Total Time</th>
                                <th>Action</th>
                            </tr>
                            @php $key=($exams_raw->perPage() * ($exams_raw->currentPage()-1))+1; @endphp
                            @foreach($exams as $exam)
                                    <tr>
                                        <td>{{$key++}}</td>
                                        <td>{{$exam->name}}</td>
                                        <td style="width: 25%">{{$exam->batch_name}}</td>
                                        <td>{{$exam->exam_in_minutes}}</td>
                                        <td>{{$exam->ex_time.' minutes'}}</td>
                                        <td><a href="{{url('/spacialmodeltest-examm/'.$exam->id)}}">Start Exam</a></td>
                                    </tr>
                            @endforeach
                        </table>
                        <div>{{ $exams_raw->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

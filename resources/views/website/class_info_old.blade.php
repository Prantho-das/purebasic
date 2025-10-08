@extends('layouts.website')
@section('content')

        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:80px">
                <div class="my_cl">
                    <table class="table table-striped" style="background: #fff;border: 1px solid #ccc;">
                        <tr class="text-center">
                            <th>Sl</th>
                            <th>Category</th>
                            <th>Topic</th>
                            <th>Lecture Pdf</th>
                            <th>Lecture Note</th>
                            <th>Necessary Extra Pdf</th>
                            <th>Lecture Video</th>
                        </tr>
						
                        @php
                            $id=Session:: get('id');
                            $user=App\Student:: where('id',$id)->first();
						
                            if($user->position == 'Doctor'){
                                $lectureBatch = App\LectureBatch::where('membershipe_id',$user->batch_id)->orderBy('id','desc')->get();
                            }else{
                                $lectureBatch = App\LectureBatch::where('membershipe_id',$user->batch_id)->orderBy('id','desc')->get();
                            }
						
                        @endphp
						
                        @foreach($lectureBatch as $key=>$batch)
                            @php
                                if($user->position == 'Doctor'){
                                    $data=App\LectureSheet::where('id',$batch->lecture_id)->where('levell', $user->qualification)->where('cp_id',$idd)->orderBy('id','desc')->first();
                                }else{
                                    $data=App\LectureSheet::where('id',$batch->lecture_id)->where('levell', $user->qualification)->where('cp_id',$idd)->orderBy('id','desc')->first();
                                }
                            @endphp
                            @if($data)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">{{$data->category}}</td>
                                    <td class="text-center">{{str_limit($data->title,20)}}</td>
                                    <td class="text-center"><a href="{{$data->v_link}}" class="btn btn-primary">Lecture Pdf</a></td>
                                    <td class="text-center"><a href="{{$data->links}}" class="btn btn-primary">Lecture Note</a></td>
                                    <td class="text-center"><a href="{{$data->pdf}}" class="btn btn-primary">Necessare Extra Pdf</a></td>
                                    <td class="text-center">
                                        <a href="{{url('view-videos/'.$data->id)}}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.website')
@section('content')

        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="margin-top:80px">
                <div class="my_cl">
                    <table class="table table-striped" style="background: #fff;border: 1px solid #ccc;">
                        <tr class="text-center">
                            <th>Sl</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Topic</th>
                            <th>Lecture Pdf</th>
                            <th>Lecture Note</th>
                            <th>Necessary Extra Pdf</th>
                            <th>Lecture Video</th>
                        </tr>

                        @foreach($info as $key=>$data)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">{{$data->member_type}}</td>
                                    <td class="text-center">{{$data->category}}</td>
                                    <td class="text-center">{{str_limit($data->title,20)}}</td>
                                    <td class="text-center">@if(!empty($data->v_link))<a href="{{$data->v_link}}" class="btn btn-primary">Lecture Pdf</a>@else{{'-'}}@endif</td>
                                    <td class="text-center">@if(!empty($data->links))<a href="{{$data->links}}" class="btn btn-primary">Lecture Note</a>@else{{'-'}}@endif</td>
                                    <td class="text-center">@if(!empty($data->pdf))<a href="{{$data->pdf}}" class="btn btn-primary">Necessare Extra Pdf</a>@else{{'-'}}@endif</td>
                                    <td class="text-center">
                                        @if(!empty($data->video)) <a href="{{route('lecture_video',['batch_id'=>$batch_id,'id'=>$data->id])}}" class="btn btn-primary">View</a>@else{{'-'}}@endif
                                    </td>
                                </tr>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

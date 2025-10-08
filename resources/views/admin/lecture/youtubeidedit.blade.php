@extends('layouts.admin')
@section('content')
    <div id="content-wrapper">

        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <a href="{{url('/admin/lecture-sheet')}}"></a><i class="fas fa-users"></i>
                            Lecture-Sheet</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/update/youtubevideoid')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <h3>Total Left: {{$total_left}}</h3>
                        </div>
                        @foreach($taks as $tak)
                        <div class="row">
                            <input type="hidden" name="id[{{$tak->id}}]" class="form-control" value="{{$tak->id}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Lecture Video</label>
                                    <input type="text" name="video[{{$tak->id}}]" class="form-control" value="{{$tak->video}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Youtube video ID for app lecture</label>
                                    @php
                                    $after_first = str_replace('<iframe width="560" height="315" src="https://www.youtube.com/embed/','',$tak->video);

                                     if(strpos($after_first,'title="YouTube video player"'))
                                         {
                                          $final_string = str_replace('" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>','',$after_first);
                                         }else{
                                          $final_string = str_replace('" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>','',$after_first);
                                         }
                                     @endphp
                                    <input type="text" name="youtube_video_id[{{$tak->id}}]" class="form-control" value="{{$final_string}}">
                                </div>
                            </div>
                        </div>

                        @endforeach

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer small text-muted">www.purebasic.com.bd</div>
            </div>

        </div>

    </div>

    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
@endsection


@section('admin_js')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        $('#doctor_radio_btn').on('click', function () {
            $('#student').hide();
            $('#doctor').show();
        })

        $('#student_radio_btn').on('click', function () {
            $('#doctor').hide();
            $('#student').show();
        })

    </script>
@endsection



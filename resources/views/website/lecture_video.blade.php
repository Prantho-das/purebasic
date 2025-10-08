@extends('layouts.website')
@push('css')
	<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
@endpush
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
        <div class="plyr__video-embed" id="player">
          {!! $sheet->video !!}
      </div>
    </div>
  </div>
{{--@php
  $id=Session:: get('id');
  $user=App\Student:: where('id',$id)->first();
  $lectureBatch = App\LectureBatch::where('membershipe_id',$user->batch_id)->orderBy('id','desc')->first();
  $data=App\LectureSheet::where('id',$lectureBatch->lecture_id)->where('status',1)->orderBy('id','desc')->first();
@endphp

<div class="row mt-3">
  <div class="col-md-2">
    <a href="{{$data->v_link}}" class="btn btn-primary"> Lecture Pdf</a>
  </div>
  <div class="col-md-2">
    <a href="{{$data->links}}" class="btn btn-primary"> Lecture Note</a>
  </div>
  <div class="col-md-2">
    <a href="{{$data->pdf}}" class="btn btn-primary"> Necessary Extra Pdf</a>
  </div>
</div>--}}

</div>
@endsection
@push('js')
<script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
<script>
	const player = new Plyr('#player');
</script>
@endpush

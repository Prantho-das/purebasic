@extends('layouts.website')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="cat_info">
                <ul>
                    @foreach($chapter as $cat)
                    <li><a href="{{route('chapter_classes',['batch_id'=>$batch_id,'subject_id'=>$subject_id,'chapter_id'=>$cat->id])}}">{{$cat->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

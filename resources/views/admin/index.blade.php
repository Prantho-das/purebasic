@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{url('admin/')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">Overview</li>
        </ol>
      </div>
<div>
    
@foreach($batchArray as $batch)
    <p style="margin-left:2rem;"><span><b>{{$batch[1]}}</b> - enrolled : <b>{{$batch[2]}}</b></span> <a class="btn btn-primary" style="color: white; margin-left: 1rem;" href="{{'/admin/batch_student/' . $batch[0] . '/enrolled'}}">Show List</a><a class="btn btn-primary" style="color: white; margin-left: 1rem;" href="{{'/admin/batch_student/' . $batch[0] . '/mobile'}}">Phone List</a><a class="btn btn-primary" style="color: white; margin-left: 1rem;" href="{{'/admin/batch_student/' . $batch[0] . '/whatsapp'}}">WhatsApp List</a></p>
    


@endforeach

<div style="margin-left:2rem;"><b>Admin : {{$otp}}</b></div>
@endsection
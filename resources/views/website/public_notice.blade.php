@extends('layouts.public_notice')
@section('content')
    
    <div class="row" style="margin:5rem 2rem; text-align: center;
">
        <a href="/home" class="loginButton">Skip Notice</a>
        <div>
            {!! $publicNotice !!}
        </div>
    </div>
        
        
@endsection
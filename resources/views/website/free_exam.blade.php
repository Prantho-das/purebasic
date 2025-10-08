@extends('layouts.register')
@section('content')

<div class="container">
    <div class="row">
        
        <div class="col-4">&nbsp</div>
        
        <div class="col-4 marginAbove paddingBelow round centerText medicineFree">
    
            <a href="/batch/1/free_exam">
                <h2>Medicine</h2>
                <h5>{{$batch_1 > 0 ? $batch_1 . " " : ""}}Free Exams</h5>
            </a>
            
        </div>
        
        <div class="col-4">&nbsp</div>
    
    </div>
    

    <div class="row">
        
        <div class="col-4">&nbsp</div>
        
        <div class="col-4 marginAbove paddingBelow round centerText dentistryFree">
    
            <a href="/batch/2/free_exam">
                <h2>Dentistry</h2>
                <h5>{{$batch_2 > 0 ? $batch_2 . " " : ""}}Free Exams</h5>
            </a>
            
        </div>
        
        <div class="col-4">&nbsp</div>
    
    </div>
    
    <div class="row">
        
        <div class="col-4">&nbsp</div>
        
        <div class="col-4 marginAbove paddingBelow round centerText bcsFree">
    
            <a href="/batch/3/free_exam">
                <h2>Bcs</h2>
                <h5>{{$batch_3 > 0 ? $batch_3 . " " : ""}}Free Exams</h5>
            </a>
            
        </div>
        
        <div class="col-4">&nbsp</div>
    
    </div>
    
<div>


@endsection

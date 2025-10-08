@extends('layouts.register')
@section('content')

<div class="row container">

    <div class="centerText"><h3>{{$modelTestName}}</h3></div>
    <div class="centerText"><h3>Total marks {{$modelTestMarks}}</h3></div>
    <div class="centerText"><h3>Your Rank : {{$userRank + 1}}</h3></div>   


    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Marks</th>
            <th>Percentage</th>
            <th>Rank</th>
        </tr>
        </thead>
        <tbody>
        @php 
        
            $key=($modeltest->perPage() * ($modeltest->currentPage()-1))+1;
            $ranking = "123";
        
        @endphp
        @foreach($modeltest as $data)

        
            @if(!empty($data->students))
            
                <tr>
                        <td>{{$data->students->id??'-'}}</td>
                
                        <td>{{$data->students->name??'-'}}</td>
                        <td>{{$data->point}}</td>
                        <td>{{round(100 * $data->point / $modelTestMarks,1)}}%</td>
                        <td>{{$key++}}</td>
                </tr>
            @endif
    
        @endforeach
        </tbody>
    </table>

</div>


@extends('layouts.register')
@section('content')

<div class="row container">

    <div class="centerText"><h3>{{$modelTestName}}</h3></div>
    <div class="centerText"><h3>Total marks {{$modelTestMarks}}</h3></div>
    <div class="centerText"><h3>This merit list follows FCPS standard</h3></div>
    <div class="centerText"><h3>Your Rank : {{$userRank + 1}}</h3></div>   
    

    <table class="table">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Name</th>
            <th>Marks</th>
            <th>Percentage</th>
            <th>Remark</th>
        </tr>
        </thead>
        <tbody>
        @php 
        
            $key=($modeltest->perPage() * ($modeltest->currentPage()-1))+1;

        @endphp
        @foreach($modeltest as $data)

                
            <tr>
                <td>{{$key++}}</td>
        
                <td>{{$data->students->name??'-'}}</td>
                <td>{{$data->point}}</td>
                <td>{{$data->percentage ? $data->percentage . "%" : ""}}</td>
                <td><span style="color:{{$data->percentage < 70 ? 'red' : 'green'}}">{{$data->pass_status}}</span></td>
            </tr>

        @endforeach
        </tbody>
    </table>

</div>


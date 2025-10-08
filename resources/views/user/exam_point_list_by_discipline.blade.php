@extends('layouts.register')
@section('content')


<div class="row container">

    <div class="centerText"><h3>{{$modelTestName}}</h3></div>
    <div class="centerText"><h3>Total marks {{$modelTestMarks / 2}}</h3></div>
    <div class="centerText"><h3>This merit list follows MS/MD/DDS standard</h3></div>

    <div class="centerText"><h3>Discipline : {{$discipline_modified}}</h3></div>
    <div class="centerText"><h3>Candidate Type : </h3></div>
   
    
    <div class="centerText">
        <label><input type="radio" name="candidate" value="Private" onclick='return onRadioSelect(this);' checked><b>Private</b></label>
        <label><input type="radio" name="candidate" value="Government" onclick='return onRadioSelect(this);'><b>Government</b></label>   
    </div>
    
    
    <div id="Private">
        
        @if($userRank != null && $candidate == "Private")
            <div class="centerText"><h3>Your Rank : {{$userRank + 1}}</h3></div>   
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Marks</th>
                <th>Candidate Type</th>
                <th>Discipline</th>
            </tr>
            </thead>
            <tbody>
            @php 
            
                $key=($privateCandidate->perPage() * ($privateCandidate->currentPage()-1))+1;
    
            @endphp
            @foreach($privateCandidate as $data)
    
            
                @if(!empty($data->students))
                
                    <tr>
                            <td>{{$key++}}</td>
                    
                            <td>{{$data->students->name??'-'}}</td>
                            <td>{{$data->point_1}}</td>
                            <td>{{$data->candidate_type}}</td>
                            <td>{{$data->discipline}}</td>
                    </tr>
                @endif
        
            @endforeach
            </tbody>
        </table>
    </div>
    
    
    <div id="Government" style="display:none;"> 
        @if($userRank != null && $candidate == "Government")
            <div class="centerText"><h3>Your Rank : {{$userRank + 1}}</h3></div>   
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Marks</th>
                <th>Candidate Type</th>
                <th>Discipline</th>
            </tr>
            </thead>
            <tbody>
            @php 
            
                $key=($governmentCandidate->perPage() * ($governmentCandidate->currentPage()-1))+1;
    
            @endphp
            @foreach($governmentCandidate as $data)
    
            
                @if(!empty($data->students))
                
                    <tr>
                            <td>{{$key++}}</td>
                    
                            <td>{{$data->students->name??'-'}}</td>
                            <td>{{$data->point_1}}</td>
                            <td>{{$data->candidate_type}}</td>
                            <td>{{$data->discipline}}</td>
                    </tr>
                @endif
        
            @endforeach
            </tbody>
        </table>
    </div>

</div>

<script>
    function onRadioSelect(obj) {
        var selectedValue = obj.value;
        if (selectedValue == "Private") {
            document.getElementById("Private").style.display = 'block';
            document.getElementById("Government").style.display = 'none';
        }
        else if (selectedValue == "Government") {
            document.getElementById("Private").style.display = 'none';
            document.getElementById("Government").style.display = 'block';
        }        
    }
</script>

@endsection


@extends('layouts.register')
@section('content')
 

<div class="container">
    
    @php $key=($point->perPage() * ($point->currentPage()-1))+1; @endphp
    @foreach($point as $data) @php $modeltest = App\Modeltest:: where('id',$data->modeltest_id)->first(); @endphp @if($modeltest)
    
        <div class="row resultContainer">
            <div class="col-4">&nbsp</div>
            
            <div class="col-4 round result">
                <h3>{{$modeltest->name}}</h3>
                @if ($modeltest->exam_pattern == "Regular exam")
                    <div>
                        <p>Obtained Marks</p>
                        <p>FCPS Standard :  <b>{{$data->point . " out of " . $modeltest->exam_in_minutes . " (" . $data->percentage . "%)"}}</b>
                        </p>
                        <p>MS/MD/DDS Standard : <b>{{$data->point_1 . " out of " . $modeltest->exam_in_minutes / 2 }}</b>
                        </p>
                    </div>
                @else
                     <span>
                        Total Marks <b>{{$modeltest->exam_in_minutes}}</b> <br>
                        Obtained Marks <b>{{$data->point . " out of " . $modeltest->exam_in_minutes . "(" . $data->percentage . "%)"}}</b>
                    </span>               
                @endif
                
                <div style="margin-top: 1rem;">
                    @if ($modeltest->exam_pattern == "Regular exam")
                        <div style="margin-bottom: 1rem;">
                            <a href="/exam/point/list/fcps/{{$data->modeltest_id}}" class="resultButton">FCPS merit list</a>
                            <a href="/exam/point/list/ms_md_dds/{{$data->modeltest_id}}" class="resultButton" >MS/MD/DDS merit list</a>
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <a href="/exam/point/list/discipline/{{$data->modeltest_id}}" class="resultButton">Discipline wise merit list</a>
                        </div>

                    @else
                    
                        <a href="/exam/point/list/{{$data->modeltest_id}}" class="resultButton">Merit List</a>                   
                    @endif

                    <a href="/spacialmodeltest-examm/{{$data->modeltest_id}}" class="resultButton">Solve
                            Sheet</a>
                    @if ($modeltest->solve_shet != "null")
                        <a href="/solve_class/{{$data->modeltest_id}}" class="resultButton">Solve
                            class</a>
                    @endif
                </div>
            </div>      
        </div>
    @endif @endforeach
        
    {{ $point->links() }}
</div>
                        

@endsection


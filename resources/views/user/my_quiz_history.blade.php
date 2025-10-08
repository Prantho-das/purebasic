@extends('layouts.register')
@section('content')
 

<div class="container">
    
    @php $key=($point->perPage() * ($point->currentPage()-1))+1; @endphp
    @foreach($point as $data) @php $modeltest = App\Modeltest:: where('id',$data->modeltest_id)->first(); @endphp @if($modeltest)
    
        <div class="row resultContainer">
            <div class="col-4">&nbsp</div>
            
            <div class="col-4 round result">
                <h3>{{$modeltest->name}}</h3>

                <div style="margin-top: 1rem;">

                    <a href="/seeQuizResult/{{$data->modeltest_id}}" class="resultButton">Solve
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


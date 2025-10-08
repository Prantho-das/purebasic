@extends('layouts.sera')
@section('content')

<section style="margin-bottom: 30px;">
    <div class="container">
       <div class="row">
       		@foreach($sera as $data)
            <div class="col-md-3">
             <div class="k_main">
              <a href="{{url('/amader/sera/category-post/'.$data->id)}}"> 
                 <div class="k_header">
                     <h3>{{$data->title}}</h3>
                 </div>
                 <div class="k_body">
                     <img src="{{asset('post/'.$data->image)}}">

                     <h6><a href="{{url('/amader/sera/category-post/'.$data->id)}}"> আরও</a></h6>
                 </div>
               </a>
             </div>
           </div>
            @endforeach
       </div>
    </div>
</section>

@endsection

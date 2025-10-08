@extends('layouts.website')
@section('content')
 @php
    $id=Session:: get('id');
@endphp
    @if(session()->has('approve'))
    <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your information submited',
        showConfirmButton: false,
        timer: 1500
          })
    </script>
    @endif
  <div class="container">
      <div class="row">
          <div class="col-md-12" style="margin-top:80px">
              <div class="my_cl">
                   <table class="table table-striped" style="background: #fff;border: 1px solid #ccc;">
                        <tr>
                            <th style="width: 1px;">SL</th>
                            <th>Name</th>
                        </tr>
                        @php 
                            $modeltest = App\Modeltest:: where('status',1)->get(); 
                        @endphp 
                        @foreach($modeltest as $key=>$dataa)
                            <tr>
                                <th>{{$key+1}}</th>
                                <th><a href="{{url('exam/point/list/'.$dataa->id)}}" style="color:#000">{{$dataa->name}}</a></th>
                               
                            </tr>
                        @endforeach
                    </table>
                    <div></div>
              </div>
          </div>
      </div>
  </div>
@endsection

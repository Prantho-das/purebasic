@extends('layouts.admin')
@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                          <div class="col-md-10">
                            <strong class="card-title">All Photos</strong>
                          </div>
                          <div class="col-md-2">
                                <a href="{{url('admin/add-photos')}}" class="btn btn-primary"><i class="fa fa-plus"></i>  Add Photo</a>
                          </div>
                        </div>
                    </div>
                    @if(session()->has('success'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "New Photos uploads success....",
                      icon: "success",
                      });
                    </script>
                    @endif

                    @if(session()->has('delete'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "Photo permanent delete....",
                      icon: "success",
                      });
                    </script>
                    @endif
                    <div class="card-body">
                      <div class="row">
                          @foreach($allphotos as $data)

                        <div class="col-md-3">
                           <img src="{{asset('uploads/gallery/'.$data->photo)}}" style="width:100%;height:240px"><br>
                           <a href="">{{$data->caption}}</a>
                        </div>
                          @endforeach
                      </div>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->
 <!-- <a href="{{url('/admin/view-photos/'.$data->id)}}" title="Edit"><i class="fa fa-plus btn btn-primary"></i></a> -->
                                            <!-- <a href="{{url('/admin/delete-photos/'.$data->id)}}" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a> -->
    @endsection

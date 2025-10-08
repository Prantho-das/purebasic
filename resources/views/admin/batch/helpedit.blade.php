@extends('layouts.admin')
@section('content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Edit Help
                        </div>
                    </div>
                </div>
                <!-- Body start -->
                <div class="card-body">

                    <form action="{{url('/admin/help/update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @foreach($editData as $item)
                        

                            <div class="form-group" hidden>
                                <input type="number" name="helpid"
                                       class="form-control" value="{{$item->id}}" required>
                            </div>

                        <div class="form-group">
                            <label for="serial" class=" form-control-label">Serial</label>
                            <input type="number" name="serial"
                                   class="form-control" value="{{$item->serial}}" required>
                        </div>

                        <div class="form-group">
                            <label for="text" class=" form-control-label">Title</label>
                            <input type="text" name="title" value="{{$item->title}}"
                                   class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="details" class=" form-control-label">Details</label>
                            <textarea type="text" name="details"
                                      class="form-control" required>{{$item->details}}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="is_tutorial" class=" form-control-label">Is it a tutorial ? If yes, enter 1, otherwise enter 0</label>
                            <input type="number" name="is_tutorial"
                                   class="form-control" value="{{$item->is_tutorial}}">
                        </div>

                        @endforeach

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>

                    </form>


                </div>
                <!-- Body end -->

            </div>
        </div>
    </div>
    </div>



@endsection

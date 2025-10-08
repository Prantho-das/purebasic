@extends('layouts.admin')
@section('content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Add Help
                        </div>
                    </div>
                </div>
                <!-- Body start -->
                <div class="card-body">

                    <form action="{{url('/admin/help/add')}}" method="post" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group">
                            <label for="serial" class=" form-control-label">Serial</label>
                            <input type="number" name="serial"
                                   class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="text" class=" form-control-label">Title</label>
                            <input type="text" name="title"
                                   class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="answer" class=" form-control-label">Details</label>
                            <textarea type="text" name="details"
                                      class="form-control" required> </textarea>
                        </div>

                        <div class="form-group">
                            <label for="answer" class=" form-control-label">Is it a tutorial ? If yes, enter 1, otherwise enter 0</label>
                            <input type="number" name="is_tutorial"
                                      class="form-control"> </textarea>
                        </div>

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

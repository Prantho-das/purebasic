@extends('layouts.admin')
@section('content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Add Batch Duration & Fees
                        </div>
                    </div>
                </div>

                <!-- Body start -->
                <div class="card-body">

                    @foreach($editdata as $item)

                    @endforeach

                    <form action="{{route('update.duration')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nf-batch_id" class=" form-control-label">Batch Name</label>
                            <select name="batch_id" class="form-control" disabled>
                                <option value="{{$item->bd_id}}">{{$item->plan}}</option>
                            </select>
                            @if ($errors->has('batch_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('batch_id') }}</strong>
                                  </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="text" name="bd_id"
                                   class="form-control" value="{{$item->bd_id}}" hidden>
                        </div>

                        <div class="form-group">
                            <label for="batch_duration" class=" form-control-label">Batch Duration (in days)</label>
                            <input type="number" name="batch_duration"
                                   class="form-control" value="{{$item->bd_duration}}" required>
                        </div>

                        <div class="form-group">
                            <label for="fee" class=" form-control-label">Batch Fees</label>
                            <input type="number" name="batch_fee"
                                   class="form-control" value="{{$item->bd_fee}}" required>
                        </div>


                        <div class="form-group">
                            <label for="information" class=" form-control-label">Information</label>
                            <input type="text" name="information"
                                   class="form-control" value="{{$item->information}}">
                        </div>

                        <div class="form-group">
                            <label for="subscription_end" class=" form-control-label">Subscription End</label>
                            <input type="date" name="subscription_end"
                                   class="form-control" value="{{ $item->subscription_end ? date('Y-m-d', strtotime($item->subscription_end)) : ''}}">
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

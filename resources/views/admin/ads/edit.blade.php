@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="card">
          <div class="card-body card-block">
            <div class="row">
              <div class="col-md-8">
                <form action="{{url('/admin/ads/update/submit')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group"><label for="nf-email" class=" form-control-label">Select Ads Position</label>
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <select class="form-control" name="manage">
                            <option value="1">Home 1</option>
                            <option value="2">Home 2</option>
                            <option value="3">Job 2</option>
                            <option value="4">Sera 1</option>
                            <option value="5">Sera 2</option>
                            <option value="6">Job 1</option>
                            <option value="7">Job 2</option>
                        </select>
                      </div>

                      <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Submit
                      </button>
                  </form>
              </div>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>
    </div><!-- .animated -->
</div><!-- .content -->
</div>

@endsection

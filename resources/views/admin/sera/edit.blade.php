@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="card">
            <div class="card-header">
                <strong>Normal</strong> Form
            </div>
            <div class="card-body card-block">
              <form action="{{url('admin/sera/post/update')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
                             <label for="nf-email" class=" form-control-label">Post titile</label>
                            <input type="hidden" id="nf-email" name="id" value="{{$data->id}}" class="form-control">
                            <input type="taxt" id="nf-email" name="title" value="{{$data->title}}" class="form-control">
                            @if ($errors->has('title'))
                                  <span class="invalid-feedback" role="alert" style="display: inline;">
                                      <strong>{{ $errors->first('title') }}</strong>
                                  </span>
                              @endif
                        </div>
                      </div>

                    </div>

                    <div class="row">
                          <div class="col-md-8">
                           <div class="form-group">
                              <label for="nf-password" class=" form-control-label">Category</label>
                                <select  name="category" class="form-control" required="">
                                  <!-- <option value="{{$data->cat_id}}">Select Category</option> -->
                                  @foreach ($sera_cat as $data)
                                   <option value="{{$data->id}}" {{ $data->id == $data->id ? 'selected="selected"' : '' }}>{{$data->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                          <label for="nf-password" class=" form-control-label">Featured image</label>
                          <input type="file" id="file-input" name="image" value="{{$data->image}}" class="form-control">
                        </div>
                      </div>
                      </div>


                    <div class="form-group{{ $errors->has('description') ? ' is-invalid' : '' }}">
                        <label for="nf-email" class=" form-control-label">Post Description</label>
                        <textarea type="taxt" class="summernote form-control"   name="description" required="">
                          {!! $data->description !!}
                        </textarea>
                    </div>


                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                </form>
            </div>
          </div>
    </div><!-- .animated -->
</div><!-- .content -->

 @endsection

@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="card">
            <div class="card-header">
                <strong>Normal</strong> Form
            </div>
            <div class="card-body card-block">
              <form action="{{url('admin/post/update')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                            <input type="hidden" name="id" value="{{$data->id}}">
                             <label for="nf-email" class=" form-control-label">Blog post titile</label>
                            <input type="taxt" id="nf-email" name="title" value="{{$data->title}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
  
                            <div class="form-group">
                              <label for="nf-password" class=" form-control-label">Featured image</label>
                              <input type="file" id="file-input" name="image" class="form-control">
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                             <label for="nf-email" class=" form-control-label">Image Source</label>
                            <input type="taxt" id="nf-email" name="source" value="{{$data->source}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="nf-email" class=" form-control-label">Image Caption</label>
                            <input type="taxt" id="nf-email" name="caption" value="{{$data->caption}}" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-8">
                          <div class="form-group">
                             <label for="nf-email" class=" form-control-label">Blog post sub titile</label>
                            <input type="taxt" id="nf-email" name="sub_title" value="{{$data->sub_title}}" class="form-control">
                          </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="nf-password" class=" form-control-label">Fb og image</label>
                            <input type="file" id="file-input" name="ogimage" class="form-control">
                         </div>
                    </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                             <label for="nf-email" class=" form-control-label">Facebook og titile</label>
                            <input type="taxt" id="nf-email" name="ogtitle" value="{{$data->ogtitle}}" class="form-control">
                          </div> 
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                           <label for="nf-email" class=" form-control-label">Manage</label>
                           <select id="maxOption2" name="manage" class="form-control">
                             <option value="0">Select Option</option>
                             <option value="1">Left</option>
                             <option value="2">Center</option>
                             <option value="3">Down</option>
                             <option value="4">Leadnews</option>
                           </select>
                      </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-8">
                         <div class="form-group">
                            <label for="nf-password" class=" form-control-label">Category</label>
                              <select id="maxOption2" name="categorys[]" class="{{-- selectpicker --}} show-menu-arrow form-control" multiple data-max-options="50">
                                <option value="">Select Category</option>
                                @foreach($allMainCat as $cat)
                                  @php
                                    $allcat=App\Category::where('status',1)->where('maincategory_id',$cat->id)->get();
                                  @endphp
                                @foreach ($allcat as $data)
                                 <option value="{{$data->id}}">{{$cat->name}} > {{$data->name}}</option>
                                @endforeach
                                @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="nf-password" class=" form-control-label">Tags</label>
                            <select id="maxOption2" name="tags[]" class="selectpicker show-menu-arrow form-control" multiple data-max-options="50">
                              <option>Select Tag</option>
                              @foreach($alltag as $data)
                              <option value="{{$data->id}}">{{$data->name}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                    </div>

                    <div class="form-group">
                        <label for="nf-email" class=" form-control-label">Post Description</label>
                        <textarea type="taxt" class="summernote form-control"   name="description">{{$data->description}}</textarea>
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

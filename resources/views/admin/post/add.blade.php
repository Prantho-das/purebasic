@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="row">
              <div class="col-md-8">
                  <div class="card">
            <div class="card-header">
                <strong>Post</strong> Details
            </div>
            <div class="card-body card-block">
              <form action="{{url('admin/post')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
                             <label for="nf-email" class=" form-control-label">Title</label>
                            <input type="taxt" id="nf-email" name="title" placeholder="Enter post titile.." class="form-control">
                            @if ($errors->has('title'))
                                  <span class="invalid-feedback" role="alert" style="display: inline;">
                                      <strong>{{ $errors->first('title') }}</strong>
                                  </span>
                              @endif
                        </div>
                      </div>
                      
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group{{ $errors->has('sub_title') ? ' is-invalid' : '' }}">
                             <label for="nf-email" class=" form-control-label">Sub Tiitile</label>
                            <input type="taxt" id="nf-email" name="sub_title" placeholder="Enter post titile.." class="form-control" required="">
                            @if ($errors->has('sub_title'))
                                  <span class="invalid-feedback" role="alert" style="display: inline;">
                                      <strong>{{ $errors->first('sub_title') }}</strong>
                                  </span>
                              @endif
                          </div>
                         </div>
                         
                      </div>

                    <div class="row">
                        
                       <div class="col-md-6">
                           <div class="form-group">
                              <label for="nf-password" class=" form-control-label">Category</label>
                                <select id="maxOption2" name="categorys[]" class="{-- selectpicker --}} show-menu-arrow form-control" multiple data-max-options="50" required="">
                                  <option value="">Select Category</option>
                                    @php
                                      $allcat=App\Category::where('status',1)->get();
                                    @endphp
                                  @foreach ($allcat as $data)
                                   <option value="{{$data->id}}">{{$data->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label for="nf-password" class=" form-control-label">Sub-Category</label>
                            <select name="sc_id" class="form-control">
                              <option value="0">Select Sub Category</option>
                              @foreach($sub_cat as $data)
                              <option value="{{$data->id}}">{{$data->name}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="nf-email" class=" form-control-label">Summary & Description (Meta Tag)</label>
                        <textarea type="taxt" class="form-control"   name="meta" required="" placeholder="Summary & Description (Meta Tag)"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="nf-email" class=" form-control-label">Keywords (Meta Tag)</label>
                        <input type="taxt" class="form-control"   name="keyword" required="" placeholder="Keywords (Meta Tag)">
                    </div>

                    <div class="form-group">
                        <label for="nf-email" class=" form-control-label">Tags</label>
                        <textarea type="taxt" class="form-control"   name="tag" required="" placeholder="Ads tags"></textarea>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' is-invalid' : '' }}">
                        <label for="nf-email" class=" form-control-label">Description</label>
                        <textarea type="taxt" class="summernote form-control"   name="description" placeholder="Course description here" required=""></textarea>
                        @if ($errors->has('description'))
                              <span class="invalid-feedback" role="alert" style="display: inline;">
                                  <strong>{{ $errors->first('description') }}</strong>
                              </span>
                          @endif
                    </div>


                   
                
            </div>
          </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                  <strong>Image</strong>
               </div>
                <div class="card-body card-block">

                        <div class="form-group">
                          <label for="nf-password" class=" form-control-label">Featured image</label>
                          <input type="file" id="file-input" name="image" class="form-control">
                        </div>



                          <div class="form-group">
                             <label for="nf-email" class=" form-control-label">Image Source</label>
                            <input type="taxt" id="nf-email" name="source" placeholder="Image Source.." class="form-control" required="">
                        </div>


                        <div class="form-group">
                          <label for="nf-email" class=" form-control-label">Image Caption</label>
                            <input type="taxt" id="nf-email" name="caption" placeholder="Image Caption.." class="form-control" required="">
                        </div>



                        <div class="form-group">
                           <label for="nf-email" class=" form-control-label">Manage</label>
                           <select id="maxOption2" name="manage" class="form-control" required="">
                             <option value="0">Select Option</option>
                             <option value="1">Leadnews</option>
                             <option value="2">Down</option>
                             <option value="3">Right</option>
                             <option value="4">2nd Leadnews</option>
                             <option value="5">2nd Right</option>
                           </select>
                          </div>

                  </div>

                  
                  </div> 
                  <div class="puv">
                    <div class="form-check">
                      <input type="checkbox" name="publich" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Publish on website</label>
                    </div>

                     <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                  </div>
                  
                  </form>   
              </div>
          </div>
    </div><!-- .animated -->
</div><!-- .content -->

 @endsection

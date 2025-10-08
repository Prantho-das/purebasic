@extends('layouts.admin') @section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="">
            <div class="row">
                <div class="col-md-8">
                   <div class="card">
                        <div class="card-header">
                        <strong> Video Uploads</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{url('/admin/uploads-video')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nf-email" class="form-control-label">Video link</label>
                                <input type="text" name="link" class="form-control" placeholder="Please enter video link" />
                            </div>
                            <div class="form-group">
                                <label for="nf-email" class="form-control-label">Video duration</label>
                                <input type="text" name="duration" class="form-control" placeholder="Please enter video duration" />
                            </div>

                            <div class="form-group">
                                <label for="nf-email" class="form-control-label">Video title</label>
                                <input type="text" name="title" class="form-control" placeholder="Please enter video title" />
                            </div>
                            <div class="form-group">
                                <label for="nf-email" class="form-control-label">Video sub-title</label>
                                <input type="text" name="subtitle" class="form-control" placeholder="Please enter sub-title" />
                            </div>

                            <div class="form-group">
                                <label for="nf-password" class="form-control-label">Category</label>
                                <select id="maxOption2" name="categorys[]" class="{{-- selectpicker --}} show-menu-arrow form-control" multiple data-max-options="50">
                                    @foreach($allMainCat as $cat) @php $allcat=App\Category::where('status',1)->where('maincategory_id',$cat->id)->get(); @endphp @foreach ($allcat as $data)
                                    <option value="{{$data->id}}">{{$cat->name}} > {{$data->name}}</option>
                                    @endforeach @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nf-password" class="form-control-label">Tags</label>
                                <select id="maxOption2" name="tags[]" class="selectpicker show-menu-arrow form-control" multiple data-max-options="50">
                                    <option>Select Tag</option>
                                    @foreach($alltag as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nf-email" class="form-control-label">Video description</label>
                                <textarea type="taxt" class="summernote form-control" name="description" placeholder="Course description here"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> Submit</button>
                    </div>
                   </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                        <strong> Image</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label for="nf-email" class="form-control-label">Video Tremble Image</label>
                            <input type="file" name="photo" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class="form-control-label">Manage</label>
                            <select id="maxOption2" name="manage" class="form-control">
                                <option value="0">Select Option</option>
                                <option value="1">Leadnews</option>
                                <option value="2">Down</option>
                                <option value="3">Right</option>
                            </select>
                        </div>
                    </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .animated -->
</div>
<!-- .content -->

@endsection

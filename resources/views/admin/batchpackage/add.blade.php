@extends('layouts.admin')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/batchPackage/create')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nf-batch_id" class=" form-control-label">Batch</label>
                            <select name="batch_id" class="form-control" id="batch_id">
                                <option value="">{{ 'Select Batch' }}</option>
                                @foreach($batch_list as $item)
                                    <option value="{{$item->id}}">{{$item->plan}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('batch_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('batch_id') }}</strong>
                                  </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Title</label>
                            <input type="text" name="title" id="title" value="{{old('title')}}"
                                   class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
          </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Batch Coverage</label>
                            <input type="text" name="fild1" value="FCPS Part 1, MS, MD, DDS"
                                   class="form-control{{ $errors->has('fild1') ? ' is-invalid' : '' }}">
                            @if ($errors->has('fild1'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fild1') }}</strong>
          </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Fees</label>
                            <input type="text" name="fild2" value="6500 Taka ( Without Lecture Notes ); 9500 Taka ( With Lecture Notes )"
                                   class="form-control{{ $errors->has('fild2') ? ' is-invalid' : '' }}">
                            @if ($errors->has('fild2'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fild2') }}</strong>
          </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Duration</label>
                            <input type="text" name="fild3" value="7 months"
                                   class="form-control{{ $errors->has('fild3') ? ' is-invalid' : '' }}">
                            @if ($errors->has('fild3'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fild3') }}</strong>
          </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Content Link</label>
                            <input type="text" name="fild4" value="null"
                                   class="form-control{{ $errors->has('fild4') ? ' is-invalid' : '' }}">
                            @if ($errors->has('fild4'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fild4') }}</strong>
          </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Schedule Link</label>
                            <input type="text" name="fild5" value="null"
                                   class="form-control{{ $errors->has('fild5') ? ' is-invalid' : '' }}">
                            @if ($errors->has('fild5'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fild5') }}</strong>
          </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Discussion Link</label>
                            <input type="text" name="fild6" value="null"
                                   class="form-control{{ $errors->has('fild6') ? ' is-invalid' : '' }}">
                            @if ($errors->has('fild6'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fild6') }}</strong>
          </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Root Batch Id</label>
                            <input type="text" name="fild7" value="49"
                                   class="form-control{{ $errors->has('fild7') ? ' is-invalid' : '' }}">
                            @if ($errors->has('fild7'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fild7') }}</strong>
          </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Week Starts From</label>
                            <input type="text" name="fild8" value="11"
                                   class="form-control{{ $errors->has('fild8') ? ' is-invalid' : '' }}">
                            @if ($errors->has('fild8'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fild8') }}</strong>
          </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Live Link</label>
                            <input type="text" name="fild9" value="null"
                                   class="form-control{{ $errors->has('fild9') ? ' is-invalid' : '' }}">
                            @if ($errors->has('fild9'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fild9') }}</strong>
          </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Field 10</label>
                            <input type="text" name="fild10" value="null"
                                   class="form-control{{ $errors->has('fild10') ? ' is-invalid' : '' }}">
                            @if ($errors->has('fild10'))
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fild10') }}</strong>
          </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Link</label>
                            <input type="text" name="link" value="null"
                                   class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}">
                            @if ($errors->has('link'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('link') }}</strong>
                          </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="promotion_video" class=" form-control-label">Promotion Video</label>
                            <input type="text" name="promotion_video" value="null"
                                   class="form-control{{ $errors->has('promotion_video') ? ' is-invalid' : '' }}">
                            @if ($errors->has('promotion_video'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('promotion_video') }}</strong>
                          </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="cover_image" class=" form-control-label">Cover Photo</label>
                            <input type="file" name="cover_image" value="{{old('cover_image')}}"
                                   class="form-control{{ $errors->has('cover_image') ? ' is-invalid' : '' }}">
                            @if ($errors->has('cover_image'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cover_image') }}</strong>
                          </span>
                            @endif
                        </div>

						<div class="form-group">
                            <label for="showing_status" class=" form-control-label">Showing Status</label>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="showing_status" value="1" checked>Active
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="showing_status" value="0">Inactive
                                </label>
                            </div>
                            @if ($errors->has('showing_status'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('showing_status') }}</strong>
                          </span>
                            @endif
                        </div>
                        @php
                        $batchCategory=App\BatchCategory::all();
                        @endphp
                        <div class="form-group">
                            <label for="batch_category" class=" form-control-label">Batch Category</label>

                            @foreach($batchCategory as $bcategory)
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="batch_category" value="{{ $bcategory->id }}">{{ $bcategory->name }}
                                </label>
                            </div>
                            @endforeach
                            
                            @if ($errors->has('batch_category'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('batch_category') }}</strong>
                          </span>
                            @endif
                        </div>


                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                    </form>
                </div>
                <div class="card-footer small text-muted"></div>
            </div>

        </div>

    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script>

        let dropdown = document.querySelector('select');
        if (dropdown) dropdown.addEventListener('change', function(event) {

            document.getElementById("title").value = dropdown.options[dropdown.selectedIndex].text;
        });

    </script>
@endsection





@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
  <div class="row justify-content-center">
    <div class="col-12">
      <h1 class="h2 mb-4 text-center text-dark">Site Settings</h1>
    </div>
  </div>

  @if (session('success'))
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
  @endif

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Edit Site Information</h5>
        </div>
        <form method="POST" action="{{ route('admin.site-settings.update') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="card-body">
            <div class="row">
              {{-- Logo Upload --}}
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="form-label font-weight-bold">Site Logo</label>
                  @if(isset($settings['site_logo']) && !empty($settings['site_logo']))
                  <div class="mb-2">
                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Current Logo" class="img-thumbnail"
                      style="max-width: 100px; max-height: 100px;">
                  </div>
                  @endif
                  <input type="file" name="site_logo"
                    class="form-control-file @if ($errors->has('site_logo')) is-invalid @endif" accept="image/*">
                  @if ($errors->has('site_logo'))
                  <div class="invalid-feedback">
                    {{ $errors->first('site_logo') }}
                  </div>
                  @endif
                  <small class="form-text text-muted">Upload a new logo (JPG, PNG, max 2MB)</small>
                </div>
              </div>

              {{-- Site Description --}}
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="form-label font-weight-bold">Site Description</label>
                  <textarea name="site_description" rows="4"
                    class="form-control @if ($errors->has('site_description')) is-invalid @endif">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                  @if ($errors->has('site_description'))
                  <div class="invalid-feedback">
                    {{ $errors->first('site_description') }}
                  </div>
                  @endif
                  <small class="form-text text-muted">Brief description of your site</small>
                </div>
              </div>

              {{-- Site Phone --}}
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="form-label font-weight-bold">Site Phone Number</label>
                  <input type="tel" name="site_phone" value="{{ old('site_phone', $settings['site_phone'] ?? '') }}"
                    class="form-control @if ($errors->has('site_phone')) is-invalid @endif"
                    placeholder="+1-234-567-8900">
                  @if ($errors->has('site_phone'))
                  <div class="invalid-feedback">
                    {{ $errors->first('site_phone') }}
                  </div>
                  @endif
                </div>
              </div>

              {{-- Site Email --}}
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="form-label font-weight-bold">Site Email</label>
                  <input type="email" name="site_email" value="{{ old('site_email', $settings['site_email'] ?? '') }}"
                    class="form-control @if ($errors->has('site_email')) is-invalid @endif"
                    placeholder="info@yoursite.com">
                  @if ($errors->has('site_email'))
                  <div class="invalid-feedback">
                    {{ $errors->first('site_email') }}
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary btn-lg">
              <i class="fas fa-save mr-2"></i>Update Settings
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Preview Section --}}
  <div class="row justify-content-center mt-4">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-info text-white">
          <h5 class="mb-0">Current Site Info Preview</h5>
        </div>
        <div class="card-body text-center">
          @if(isset($settings['site_logo']) && !empty($settings['site_logo']))
          <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Site Logo" class="img-fluid mb-3"
            style="max-width: 150px; max-height: 150px;">
          @else
          <div class="alert alert-warning">No logo uploaded yet.</div>
          @endif

          @if(!empty($settings['site_description'] ?? ''))
          <p class="lead mb-3">{{ $settings['site_description'] }}</p>
          @else
          <p class="text-muted mb-3">No description set.</p>
          @endif

          @if(!empty($settings['site_phone'] ?? ''))
          <p class="mb-2"><i class="fas fa-phone mr-2 text-primary"></i>{{ $settings['site_phone'] }}</p>
          @else
          <p class="text-muted mb-2"><i class="fas fa-phone mr-2"></i>No phone set.</p>
          @endif

          @if(!empty($settings['site_email'] ?? ''))
          <p class="mb-0"><i class="fas fa-envelope mr-2 text-primary"></i>{{ $settings['site_email'] }}</p>
          @else
          <p class="text-muted mb-0"><i class="fas fa-envelope mr-2"></i>No email set.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
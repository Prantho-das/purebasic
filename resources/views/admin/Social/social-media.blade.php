@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1 class="h2 mb-4 text-center text-dark">Social Media Links</h1>
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
                    <h5 class="mb-0">Edit Social Media Links</h5>
                </div>
                <form method="POST" action="{{ route('admin.social-media.update') }}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            @foreach($socialTypes as $type)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label font-weight-bold text-capitalize">{{ $type }}</label>
                                    <input type="url" name="links[{{ $type }}]" value="{{ old(" links.$type",
                                        $settings[$type] ?? '' ) }}" class="form-control @if ($errors->has("
                                        links.$type")) is-invalid @endif" placeholder="https://facebook.com/yourpage">
                                    @if ($errors->has("links.$type"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("links.$type") }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save mr-2"></i>Update Links
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
                    <h5 class="mb-0">Links Preview</h5>
                </div>
                <div class="card-body">
                    @if(count(array_filter($settings)) > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($socialTypes as $type)
                        @if(!empty($settings[$type] ?? ''))
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="text-capitalize font-weight-bold">{{ $type }}:</span>
                            <a href="{{ $settings[$type] }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fab fa-external-link-alt mr-1"></i>View
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    @else
                    <p class="text-muted text-center">No active links to preview. Add some above!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="content mt-3">
    @include('admin.inc.cms-tab')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Manage Locations Section</span>
            <a href="" class="btn btn-sm btn-primary">Add New Location</a>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Section Title Edit Form -->
            <div class="mb-4 p-3 border rounded">
                <h5>Section Title</h5>
                <form method="POST" action="" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-md-8">
                        <input type="text" class="form-control @error('section_title') is-invalid @enderror"
                            name="section_title"
                            value="{{ old('section_title', $sectionTitle ?? 'Our Comprehensive Courses - Available In Your Locations') }}"
                            placeholder="Enter the section title" required>
                        
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">Update Title</button>
                    </div>
                </form>
            </div>

            <!-- Locations Table with Inline Edit -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Map Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $location)
                        <tr>
                            <td>
                                <form method="POST" action=""
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" class="form-control form-control-sm d-inline-block w-auto"
                                        name="name" value="{{ old('name', $location->name) }}" style="width: 150px;"
                                        required>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.locations.update', $location->id) }}"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="url" class="form-control form-control-sm d-inline-block w-auto"
                                        name="map_link" value="{{ old('map_link', $location->map_link) }}"
                                        placeholder="https://maps.google.com/..." style="width: 300px;" required>
                                    <button type="submit" class="btn btn-sm btn-success ms-1">Save</button>
                                </form>
                                
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.locations.destroy', $location->id) }}"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No locations found. <a
                                    href="">Add one</a>.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
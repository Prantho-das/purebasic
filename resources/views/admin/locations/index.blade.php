@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Manage Locations Section</h4>
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

            {{-- Section Title Update Form --}}
            <div class="mb-4 p-3 border rounded bg-light">
                <h5>Section Title</h5>
                <form method="POST" action="{{ route('admin.locations.section-title-update') }}" class="row g-3">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="col-md-10">
                        <input type="text" class="form-control @if($errors->has('section_title')) is-invalid @endif"
                            name="section_title" value="{{ old('section_title', $sectionTitle) }}"
                            placeholder="Enter the section title" required>
                        @if($errors->has('section_title'))
                        <div class="invalid-feedback">{{ $errors->first('section_title') }}</div>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Update Title</button>
                    </div>
                </form>
            </div>

            {{-- Create New Location Form --}}
            <div class="mb-4 p-3 border rounded bg-light">
                <h5>Add New Location</h5>
                <form method="POST" action="{{ route('admin.locations.store') }}" class="row g-3">
                    {{ csrf_field() }}
                    <div class="col-md-3">
                        <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name"
                            value="{{ old('name') }}" placeholder="Location Name (e.g., Utara)" required>
                        @if($errors->has('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <input type="url" class="form-control @if($errors->has('map_link')) is-invalid @endif"
                            name="map_link" value="{{ old('map_link') }}" placeholder="https://www.google.com/maps/..."
                            required>
                        @if($errors->has('map_link'))
                        <div class="invalid-feedback">{{ $errors->first('map_link') }}</div>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <select class="form-control @if($errors->has('status')) is-invalid @endif" name="status"
                            required>
                            <option value="active" {{ old('status')=='active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status')=='inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                        @if($errors->has('status'))
                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input @if($errors->has('is_homepage')) is-invalid @endif"
                                type="checkbox" name="is_homepage" id="is_homepage_create" value="1" {{
                                old('is_homepage') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_homepage_create">
                                Show on Homepage
                            </label>
                        </div>
                        @if($errors->has('is_homepage'))
                        <div class="invalid-feedback">{{ $errors->first('is_homepage') }}</div>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">Add Location</button>
                    </div>
                </form>
            </div>

            {{-- Locations Table with Inline Update and Delete --}}
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Map Link</th>
                            <th>Status</th>
                            <th>Show on Homepage</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $location)
                        <tr>
                            <form method="POST" action="{{ route('admin.locations.update', $location->id) }}"
                                class="d-inline" style="display: contents;">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <td>
                                    <input type="text" class="form-control form-control-sm d-inline-block" name="name"
                                        value="{{ old('name', $location->name) }}"
                                        style="width: 150px; display: inline;" required>
                                </td>
                                <td>
                                    <input type="url" class="form-control form-control-sm d-inline-block"
                                        name="map_link" value="{{ old('map_link', $location->map_link) }}"
                                        placeholder="https://maps.google.com/..." style="width: 300px; display: inline;"
                                        required>
                                </td>
                                <td>
                                    <select class="form-control form-control-sm" name="status"
                                        style="width: auto; display: inline;" required>
                                        <option value="active" {{ old('status', $location->status) == 'active' ?
                                            'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $location->status) == 'inactive' ?
                                            'selected' : '' }}>Inactive</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="form-check form-switch form-switch-sm">
                                        <input class="form-check-input" type="checkbox" name="is_homepage"
                                            id="is_homepage_{{ $location->id }}" value="1" {{ old('is_homepage',
                                            $location->is_homepage) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_homepage_{{ $location->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                                </form>
                                    <form method="POST" action="{{ route('admin.locations.destroy', $location->id) }}"
                                        class="d-inline ms-1" style="display: inline;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this location?')">Delete</button>
                                    </form>
                                </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No locations found. Add one above.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
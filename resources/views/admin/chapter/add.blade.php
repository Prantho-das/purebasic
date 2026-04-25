@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid py-4">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 font-weight-bold text-gray-800">Chapter Management</h4>
        </div>

        <div class="row">

            {{-- CREATE FORM --}}
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h6 class="mb-0 font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>Create New Chapter</h6>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Chapter created successfully.
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        @endif

                        <form action="{{ url('admin/chapter/create') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Subject</label>
                                <select name="cat_id" class="form-control" required>
                                    <option value="">-- Select Subject --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Chapter Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter chapter name" required />
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Literature</label>
                                <input type="text" name="literature" class="form-control" value="{{ old('literature') }}" placeholder="Enter literature" />
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Chapter Serial</label>
                                    <input type="number" name="serial" class="form-control" value="{{ old('serial') }}" placeholder="Serial" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">QB Serial</label>
                                    <input type="number" name="qb_serial" class="form-control" value="{{ old('qb_serial') }}" placeholder="QB Serial" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Price</label>
                                <input type="number" name="price" class="form-control" value="{{ old('price') }}" placeholder="0" />
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save mr-1"></i> Create Chapter
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- CHAPTERS TABLE --}}
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold text-gray-800"><i class="fas fa-list mr-2"></i>All Chapters</h6>
                        <span class="badge badge-primary">{{ $chapters->total() }} total</span>
                    </div>
                    <div class="card-body">

                        {{-- Search --}}
                        <form method="GET" action="{{ url('admin/chapter/create') }}" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search by chapter name or subject..." value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                                    @if(request('search'))
                                        <a href="{{ url('admin/chapter/create') }}" class="btn btn-secondary">Clear</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Chapter Name</th>
                                        <th>Subject</th>
                                        <th>Serial</th>
                                        <th>QB Serial</th>
                                        <th>Price</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($chapters as $chapter)
                                    <tr>
                                        <td>{{ $chapter->id }}</td>
                                        <td>{{ $chapter->name }}</td>
                                        <td>{{ $chapter->subject }}</td>
                                        <td>{{ $chapter->serial }}</td>
                                        <td>{{ $chapter->qb_serial }}</td>
                                        <td>{{ $chapter->price }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/chapter/edit/' . $chapter->id) }}" class="btn btn-info btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ url('admin/chapter/delete/' . $chapter->id) }}" class="btn btn-danger btn-sm" title="Delete"
                                               onclick="return confirm('Delete this chapter?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-3">No chapters found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                Showing {{ $chapters->firstItem() }}–{{ $chapters->lastItem() }} of {{ $chapters->total() }} chapters
                            </small>
                            {{ $chapters->links() }}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

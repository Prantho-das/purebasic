@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
    <div class="container-fluid py-4">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 font-weight-bold text-gray-800">
                <i class="fas fa-file-alt mr-2"></i>All Exams
            </h4>
            <a href="{{ url('/admin/add/model') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus mr-1"></i> Add Exam
            </a>
        </div>

        @if(session()->has('update'))
        <script>
            Swal.fire({ position: 'top-end', icon: 'success', title: 'Exam Updated', showConfirmButton: false, timer: 1500 });
        </script>
        @endif
        @if(session()->has('delete'))
        <script>
            Swal.fire({ position: 'top-end', icon: 'success', title: 'Exam Deleted', showConfirmButton: false, timer: 1500 });
        </script>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 font-weight-bold text-gray-800">Exam List</h6>
                <span class="badge badge-primary">{{ $model->total() }} total</span>
            </div>
            <div class="card-body">

                {{-- Search --}}
                <form method="GET" action="{{ url('/admin/all/model') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by exam name..." value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ url('/admin/all/model') }}" class="btn btn-secondary">Clear</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Exam Name</th>
                                <th>Total Marks</th>
                                <th>Exam Time</th>
                                <th>Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($model as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ str_limit($data->name, 40) }}</td>
                                <td>{{ $data->exam_in_minutes }}</td>
                                <td>{{ $data->ex_time }}</td>
                                <td>{{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->format('d M Y') : '—' }}</td>
                                <td class="text-center" style="white-space:nowrap;">
                                    <a href="{{ url('/admin/questions/' . $data->id) }}" class="btn btn-secondary btn-sm" title="Questions">
                                        <i class="fas fa-clipboard-list"></i>
                                    </a>
                                    <a href="{{ url('/admin/edit/modeltest/' . $data->id) }}" class="btn btn-info btn-sm" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{ url('/admin/view/' . $data->id) }}" class="btn btn-primary btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('/admin/solve/' . $data->id) }}" class="btn btn-warning btn-sm" title="Solve">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
                                    <a href="{{ url('/admin/result/' . $data->id) }}" class="btn btn-success btn-sm" title="Result">
                                        <i class="fas fa-chart-bar"></i>
                                    </a>
                                    <a href="{{ url('/admin/delete/modeltest/' . $data->id) }}" class="btn btn-danger btn-sm" title="Delete"
                                       onclick="return confirm('Delete this exam?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">No exams found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <small class="text-muted">
                        Showing {{ $model->firstItem() }}–{{ $model->lastItem() }} of {{ $model->total() }} exams
                    </small>
                    {{ $model->links() }}
                </div>

            </div>
        </div>

    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container-fluid">


    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>ব্যাচ ক্যাটাগরি লিস্ট</h4>
                <a href="{{ route('admin.batch-categories.create') }}" class="btn btn-success">নতুন ক্যাটাগরি যোগ
                    করুন</a>
            </div>
            <div class="card-body">
                <!-- সার্চ ফর্ম -->
                <form method="GET" action="{{ route('admin.batch-categories.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="ক্যাটাগরি নাম সার্চ করুন..."
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">সার্চ</button>
                        </div>
                    </div>
                </form>

                <!-- টেবিল -->
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>নাম</th>
                            <th>টাইপ</th>
                            <th>ফি রেঞ্জ</th>
                            <th>অ্যাডমিশন সংখ্যা</th>
                            <th>স্ট্যাটাস</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }} @if($category->parent) <small>(সাব: {{ $category->parent->name
                                    }})</small> @endif</td>
                            <td><span
                                    class="badge badge-{{ $category->type == 'online' ? 'success' : ($category->type == 'offline' ? 'danger' : 'warning') }}">{{
                                    ucfirst($category->type) }}</span></td>
                            <td>{{ $category->fee_range ?? 'N/A' }}</td>
                            <td>{{ $category->admissions_count ?? 0 }}</td>
                            <td>{{ $category->status ? 'অ্যাকটিভ' : 'ইনঅ্যাকটিভ' }}</td>
                            <td>
                                <a href="{{ route('admin.batch-categories.edit', $category) }}"
                                    class="btn btn-warning btn-sm">এডিট</a>
                                <form action="{{ route('admin.batch-categories.destroy', $category) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('নিশ্চিত?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">ডিলিট</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">কোনো ক্যাটাগরি পাওয়া যায়নি!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- পেজিনেশন -->
                <div class="d-flex justify-content-center">
                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
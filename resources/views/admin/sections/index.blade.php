@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h1>হোম সেকশন লিস্ট</h1>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.sections.create') }}" class="btn btn-primary mb-3">নতুন অ্যাড</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>টাইটেল</th>
                <th>টাইপ</th>
                <th>অর্ডার</th>
                <th>অ্যাকটিভ</th>
                <th>অ্যাকশন</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sections as $section)
            <tr>
                <td>{{ $section->id }}</td>
                <td>{{ $section->title }}</td>
                <td>{{ $section->section_type }}</td>
                <td>{{ $section->order_num }}</td>
                <td>{{ $section->is_active ? 'হ্যাঁ' : 'না' }}</td>
                <td>
                    <a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-sm btn-warning">এডিট</a>
                    @if(in_array($section->section_type,['mentor','home_slider','batch','batch_category','books','hero_slider','locations','testimonial','notice','static_design']))
                    <a href="{{ route('admin.sections.data-input', $section->id) }}" class="btn btn-sm btn-info">ডেটা
                        ইনপুট</a>
                    @endif
                    <form method="POST" action="{{ route('admin.sections.destroy', $section->id) }}" style="display:inline;"
                        onsubmit="return confirm('নিশ্চিত?')">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger">ডিলিট</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

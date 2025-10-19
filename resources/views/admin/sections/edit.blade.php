@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h1>সেকশন এডিট</h1>
    <form action="{{ route('admin.sections.update', $section) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group mb-3">
            <label>টাইটেল</label>
            <input type="text" name="title" value="{{ old('title', $section->title) }}" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>সাবটাইটেল</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label>সেকশন টাইপ</label>
            <select name="section_type" class="form-control" required>
                <option value="mentor" {{ $section->section_type == 'mentor' ? 'selected' : '' }}>মেন্টর</option>
                {{-- অন্য অপশন যোগ --}}
            </select>
        </div>
        <div class="form-group mb-3">
            <label>মেইন ইমেজ</label>
            <input type="file" name="main_image" class="form-control">
            @if($section->main_image)
            <img src="{{ asset('storage/' . $section->main_image) }}" width="100" class="mt-2">
            @endif
        </div>
        <div class="form-group mb-3">
            <label>অর্ডার নম্বর</label>
            <input type="number" name="order_num" value="{{ old('order_num', $section->order_num) }}"
                class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>অ্যাকটিভ?</label>
            <input type="checkbox" name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }}>
        </div>
        <button type="submit" class="btn btn-success">আপডেট</button>
    </form>
</div>
@endsection
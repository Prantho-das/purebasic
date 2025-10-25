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

                <option value="testimonial" {{ $section->section_type == 'testimonial' ? 'selected' : '' }}>টেস্টিমোনিয়াল</option>
                <option value="batch_category" {{ $section->section_type == 'batch_category' ? 'selected' : '' }}>Batch Category</option>
                <option value="batch" {{ $section->section_type == 'batch' ? 'selected' : '' }}>ব্যাচ</option>
                <option value="home_slider" {{ $section->section_type == 'home_slider' ? 'selected' : '' }}>Home Slider</option>
                <option value="hero_slider" {{ $section->section_type == 'hero_slider' ? 'selected' : '' }}>Hero Slider</option>
                <option value="mentor" {{ $section->section_type == 'mentor' ? 'selected' : '' }}>মেন্টর</option>
                <option value="books" {{ $section->section_type == 'books' ? 'selected' : '' }}>Books</option>
                <option value="locations" {{ $section->section_type == 'locations' ? 'selected' : '' }}>locations</option>
                <option value="notice" {{ $section->section_type == 'notice' ? 'selected' : '' }}>locations</option>
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
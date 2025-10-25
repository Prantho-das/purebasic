@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h1>নতুন সেকশন তৈরি</h1>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.sections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label>টাইটেল</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>সাবটাইটেল</label>
            <input type="text" name="subtitle" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label>সেকশন টাইপ</label>
            <select name="section_type" class="form-control" required>
                <option value="testimonial">টেস্টিমোনিয়াল</option>
                <option value="batch_category">Batch Category</option>
                <option value="batch">অনলাইন ব্যাচ</option>
                <option value="home_slider">Home Slider</option>
                <option value="hero_slider">Hero Slider</option>
                <option value="books">Books</option>
                <option value="mentor">মেন্টর</option>
                <option value="locations">লোকেশনস</option>
                <option value="notice">Notice</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label>মেইন ইমেজ</label>
            <input type="file" name="main_image" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label>অর্ডার নম্বর</label>
            <input type="number" name="order_num" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>অ্যাকটিভ?</label>
            <input type="checkbox" name="is_active" value="1" checked>
        </div>
        <button type="submit" class="btn btn-success">তৈরি করো (পরে ডেটা অ্যাড করো)</button>
    </form>
</div>
@endsection

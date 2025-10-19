@extends('layouts.admin')

@section('content')
@php
    $message="";
@endphp
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>ব্যাচ ক্যাটাগরি এডিট করুন</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.batch-categories.update', $batchCategory) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">নাম <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $batchCategory->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- অন্যান্য ফিল্ড একই, কিন্তু value="{{ old('field', $batchCategory->field) }}" -->
                    <div class="form-group">
                        <label for="slug">স্লাগ <span class="text-danger">*</span></label>
                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $batchCategory->slug) }}" required>
                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">বিবরণ</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $batchCategory->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">টাইপ <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="">সিলেক্ট করুন</option>
                            <option value="online" {{ old('type', $batchCategory->type) == 'online' ? 'selected' : '' }}>অনলাইন</option>
                            <option value="offline" {{ old('type', $batchCategory->type) == 'offline' ? 'selected' : '' }}>অফলাইন</option>
                            <option value="hybrid" {{ old('type', $batchCategory->type) == 'hybrid' ? 'selected' : '' }}>হাইব্রিড</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="parent_id">প্যারেন্ট ক্যাটাগরি</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">কোনোটাই না</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id', $batchCategory->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fee_range">ফি রেঞ্জ</label>
                        <input type="text" name="fee_range" id="fee_range" class="form-control @error('fee_range') is-invalid @enderror" value="{{ old('fee_range', $batchCategory->fee_range) }}">
                        @error('fee_range') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">ইমেজ আপলোড (পুরানো: {{ $batchCategory->image ?? 'নেই' }})</label>
                        @if($batchCategory->image)
                            <img src="{{ asset('storage/' . $batchCategory->image) }}" alt="Current Image" style="max-width: 100px;">
                        @endif
                        <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">প্রিভিউ: <img id="image-preview" src="" alt="Preview" style="max-width: 100px; display: none;"></small>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" name="status" id="status" class="form-check-input" value="1" {{ old('status', $batchCategory->status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">অ্যাকটিভ</label>
                    </div>

                    <button type="submit" class="btn btn-warning btn-block">আপডেট করুন</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ইমেজ প্রিভিউ (একই JS)
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
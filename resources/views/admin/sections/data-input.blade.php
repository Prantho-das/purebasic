@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h1>ডেটা ইনপুট: {{ $section->title }} ({{ $section->section_type }})</h1>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
@php
    use Illuminate\Support\Str;
    @endphp
    @if($section->section_type === 'mentor')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>মেন্টর লিস্ট (নাম, বায়ো, ইমেজ, YouTube ভিডিও)</h4>
        <div id="mentors-container">
            @if(empty($section->dynamic_data))
            <div class="mentor-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="row">
                    <div class="col-md-2">
                        <select name="mentor_name[]" class="form-control">
                            @foreach ($mentors as $mentor)
                            <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="file" name="mentor_image[]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="url" name="mentor_youtube_url[]"
                            placeholder="YouTube URL (e.g., https://youtube.com/watch?v=abc)" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <textarea name="mentor_bio[]" placeholder="বায়ো/ইনফো" class="form-control"></textarea>
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="this.closest('.mentor-item').remove()"
                            class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @else
            @foreach($section->dynamic_data as $key => $mentor)
            <div class="mentor-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="row">
                    <div class="col-md-2">
                        <select name="mentor_name[]" class="form-control">
                            @foreach ($mentors as $ment)
                            <option {{ (isset($mentor['mentor_id']) ? ($mentor['mentor_id']==$ment->id ? 'selected' :
                                '') : '') }} value="{{ $ment->id }}">{{ $ment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="file" name="mentor_image[]" class="form-control">
                        @if(isset($mentor['image']))
                        <img src="{{ asset('storage/' . $mentor['image']) }}" width="50" class="mt-1">
                        @endif
                    </div>
                    <div class="col-md-3">
                        <input type="url" name="mentor_youtube_url[]" value="{{ $mentor['youtube_url'] ?? '' }}"
                            placeholder="YouTube URL" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <textarea name="mentor_bio[]" class="form-control">{{ $mentor['bio'] ?? '' }}</textarea>
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="this.closest('.mentor-item').remove()"
                            class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <button type="button" onclick="addMentor()" class="btn btn-secondary mb-3">নতুন মেন্টর অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ</button>
    </form>

    @elseif($section->section_type === 'home_slider')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>হোম স্লাইডার (টাইটেল, সাবটাইটেল, এনরোল টেক্সট/লিঙ্ক, ইমেজ অ্যাড করো)</h4>
        <div id="slides-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $slideIndex => $slide)
            <div class="slide-item mb-3" style="border:2px solid #ccc; padding:15px;">
                <h5>স্লাইড {{ $slideIndex + 1 }}</h5>
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="slide_title[]" value="{{ $slide['title'] ?? '' }}" placeholder="টাইটেল"
                            class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="slide_subtitle[]" value="{{ $slide['subtitle'] ?? '' }}"
                            placeholder="সাবটাইটেল" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="slide_enroll_text[]" value="{{ $slide['enroll_text'] ?? '' }}"
                            placeholder="এনরোল টেক্সট" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="url" name="slide_enroll_link[]" value="{{ $slide['enroll_link'] ?? '' }}"
                            placeholder="এনরোল লিঙ্ক" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label>মেইন ইমেজ (স্লাইডের ব্যাকগ্রাউন্ড)</label>
                        <input type="file" name="slide_main_image[{{ $slideIndex }}]" class="form-control">
                        @if(isset($slide['main_image']))
                        <img src="{{ asset('storage/' . $slide['main_image']) }}" width="100" class="mt-1">
                        @endif
                    </div>
                </div>
                <button type="button" onclick="this.closest('.slide-item').remove()"
                    class="btn btn-sm btn-danger">স্লাইড রিমুভ</button>
            </div>
            @endforeach
            @else
            <div class="slide-item mb-3" style="border:2px solid #ccc; padding:15px;">
                <h5>স্লাইড 1</h5>
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="slide_title[]" placeholder="টাইটেল" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="slide_subtitle[]" placeholder="সাবটাইটেল" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="slide_enroll_text[]" placeholder="এনরোল টেক্সট" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="url" name="slide_enroll_link[]" placeholder="এনরোল লিঙ্ক" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label>মেইন ইমেজ</label>
                        <input type="file" name="slide_main_image[0]" class="form-control">
                    </div>
                </div>
            </div>
            @endif
        </div>
        <button type="button" onclick="addSlide()" class="btn btn-secondary mb-3">নতুন স্লাইড অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ</button>
    </form>

    @elseif($section->section_type === 'batch')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>ব্যাচ সেকশন (ব্যাচ সিলেক্ট + ইমেজ)</h4>
        <div id="batch-images-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $key => $batchItem)
            <div class="batch-image-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="row batch-item">
                    <div class="col-md-6">
                        <select name="batch_id[]" class="form-control">
                            @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}" {{ (isset($batchItem['batch_id']) &&
                                $batchItem['batch_id']==$batch->id) ? 'selected' : '' }}>{{ $batch->plan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="batch_image[]" class="form-control">
                        @if(isset($batchItem['image']))
                        <img src="{{ asset('storage/' . $batchItem['image']) }}" width="50" class="mt-1">
                        @endif
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="this.closest('.batch-item').remove()"
                            class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="batch-image-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="row batch-item">
                    <div class="col-md-6">
                        <select name="batch_id[]" class="form-control">
                            @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->plan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="batch_image[]" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="this.closest('.batch-item').remove()"
                            class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <button type="button" onclick="addBatchImageField()" class="btn btn-secondary mb-3">নতুন ব্যাচ ইমেজ ফিল্ড
            অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ</button>
    </form>

    @elseif($section->section_type === 'batch_category')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>ব্যাচ ক্যাটাগরি সেকশন (মাল্টিপল ব্যাচ সিলেক্ট + ক্যাটাগরি + ইমেজ অ্যাড করো)</h4>
        <div id="batch-items-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $key => $batchItem)
            <div class="batch-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="row">
                    <div class="col-md-4">
                        <select name="batch_category_id[]" class="form-control">
                            @foreach ($batch_categories as $batch)
                            <option value="{{ $batch->id }}" {{ (isset($batchItem['batch_category_id']) &&
                                $batchItem['batch_category_id']==$batch->id) ? 'selected' : '' }}>{{ $batch->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="batch_image[]" class="form-control" accept="image/*">
                        @if(isset($batchItem['image']))
                        <img src="{{ asset('storage/' . $batchItem['image']) }}" width="50" class="mt-1">
                        @endif
                    </div>
                    <div class="col-md-4">
                        <button type="button" onclick="this.closest('.batch-item').remove()"
                            class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="batch-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="row">
                    <div class="col-md-4">
                        <select name="batch_category_id[]" class="form-control">
                            @foreach ($batch_categories as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="batch_image[]" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-4">
                        <button type="button" onclick="this.closest('.batch-item').remove()"
                            class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <button type="button" onclick="addBatchItem()" class="btn btn-secondary mb-3">নতুন ব্যাচ + ক্যাটাগরি + ইমেজ
            অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ</button>
    </form>

    @elseif($section->section_type === 'books')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>বুক সিলেকশন সেকশন (মাল্টিপল বুক সিলেক্ট + প্রত্যেকের ইমেজ অ্যাড করো)</h4>
        <div id="book-items-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $key => $bookItem)
            <div class="book-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="row">
                    <div class="col-md-3">
                        <select name="book_id[]" class="form-control">
                            @foreach ($books as $book)
                            <option value="{{ $book->id }}" {{ (isset($bookItem['book_id']) &&
                                $bookItem['book_id']==$book->id) ? 'selected' : '' }}>{{ $book->name }} - {{
                                $book->author }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="file" name="book_image[]" class="form-control" accept="image/*">
                        @if(isset($bookItem['image']))
                        <img src="{{ asset('storage/' . $bookItem['image']) }}" width="50" class="mt-1">
                        @endif
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="book_name[]" value="{{ $bookItem['book_name'] ?? '' }}"
                            class="form-control" placeholder="কাস্টম বুক নাম (ঐচ্ছিক)">
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="this.closest('.book-item').remove()"
                            class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="book-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="row">
                    <div class="col-md-3">
                        <select name="book_id[]" class="form-control">
                            @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->name }} - {{ $book->author }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="file" name="book_image[]" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="book_name[]" class="form-control"
                            placeholder="কাস্টম বুক নাম (ঐচ্ছিক)">
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="this.closest('.book-item').remove()"
                            class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <button type="button" onclick="addBookItem()" class="btn btn-secondary mb-3">নতুন বুক + ইমেজ অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ</button>
    </form>

    @elseif($section->section_type === 'hero_slider')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>হিরো স্লাইডার (মাল্টিপল স্লাইড: টাইটেল, প্রমোশন, অপশন + ইমেজ)</h4>
        <div id="hero-slides-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $slideIndex => $slide)
            <div class="hero-slide-item mb-4" style="border:2px solid #ddd; padding:20px; margin-bottom:20px;">
                <h5>স্লাইড {{ $slideIndex + 1 }}</h5>

                <!-- Title & Promotion -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>মেইন টাইটেল</label>
                        <input type="text" name="hero_title[]" value="{{ $slide['title'] ?? '' }}" class="form-control"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label>প্রমোশন টাইটেল</label>
                        <input type="text" name="hero_promotion_title[]" value="{{ $slide['promotion_title'] ?? '' }}"
                            class="form-control">
                    </div>
                </div>

                <!-- Type Selection -->
                <div class="mb-3">
                    <label>লিঙ্ক টাইপ (একটি মাত্র)</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="hero_type[]" value="batch" id="type-batch-{{ $slideIndex }}"
                            class="form-check-input" {{ ($slide['type'] ?? 'batch' )==='batch' ? 'checked' : '' }}
                            onchange="toggleHeroFields({{ $slideIndex }})">
                        <label for="type-batch-{{ $slideIndex }}" class="form-check-label">ব্যাচ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="hero_type[]" value="class" id="type-class-{{ $slideIndex }}"
                            class="form-check-input" {{ ($slide['type'] ?? 'batch' )==='class' ? 'checked' : '' }}
                            onchange="toggleHeroFields({{ $slideIndex }})">
                        <label for="type-class-{{ $slideIndex }}" class="form-check-label">ক্লাস</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="hero_type[]" value="book" id="type-book-{{ $slideIndex }}"
                            class="form-check-input" {{ ($slide['type'] ?? 'batch' )==='book' ? 'checked' : '' }}
                            onchange="toggleHeroFields({{ $slideIndex }})">
                        <label for="type-book-{{ $slideIndex }}" class="form-check-label">বুক</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="hero_type[]" value="custom" id="type-custom-{{ $slideIndex }}"
                            class="form-check-input" {{ ($slide['type'] ?? 'batch' )==='custom' ? 'checked' : '' }}
                            onchange="toggleHeroFields({{ $slideIndex }})">
                        <label for="type-custom-{{ $slideIndex }}" class="form-check-label">কাস্টম লিঙ্ক</label>
                    </div>
                </div>

                <!-- Conditional Fields -->
                @php $type = $slide['type'] ?? 'batch'; @endphp
                <div id="hero-fields-{{ $slideIndex }}">
                    <div id="batch-field-{{ $slideIndex }}" style="display: {{ $type === 'batch' ? 'block' : 'none' }};"
                        class="mb-3">
                        <label>ব্যাচ সিলেক্ট</label>
                        <select name="hero_batch_id[]" class="form-control">
                            <option value="">সিলেক্ট করো</option>
                            @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}" {{ ($slide['batch_id'] ?? '' )==$batch->id ? 'selected' :
                                '' }}>{{ $batch->plan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="class-field-{{ $slideIndex }}" style="display: {{ $type === 'class' ? 'block' : 'none' }};"
                        class="mb-3">
                        <label>ক্লাস সিলেক্ট</label>
                        <select name="hero_class_id[]" class="form-control">
                            <option value="">সিলেক্ট করো</option>
                            @foreach ($batch_categories as $cat)
                            <option value="{{ $cat->id }}" {{ ($slide['class_id'] ?? '' )==$cat->id ? 'selected' : ''
                                }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="book-field-{{ $slideIndex }}" style="display: {{ $type === 'book' ? 'block' : 'none' }};"
                        class="mb-3">
                        <label>বুক সিলেক্ট</label>
                        <select name="hero_book_id[]" class="form-control">
                            <option value="">সিলেক্ট করো</option>
                            @foreach ($books as $book)
                            <option value="{{ $book->id }}" {{ ($slide['book_id'] ?? '' )==$book->id ? 'selected' : ''
                                }}>{{ $book->name }} - {{ $book->author }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="custom-field-{{ $slideIndex }}"
                        style="display: {{ $type === 'custom' ? 'block' : 'none' }};" class="mb-3">
                        <label>কাস্টম লিঙ্ক</label>
                        <input type="url" name="hero_custom_link[]" value="{{ $slide['custom_link'] ?? '' }}"
                            class="form-control" placeholder="https://example.com">
                    </div>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label>হিরো ইমেজ (স্লাইড {{ $slideIndex + 1 }})</label>
                    <input type="file" name="hero_image[{{ $slideIndex }}]" class="form-control">
                    @if(isset($slide['image']))
                    <img src="{{ asset('storage/' . $slide['image']) }}" width="150" class="mt-1">
                    @endif
                </div>

                <button type="button" onclick="this.closest('.hero-slide-item').remove()"
                    class="btn btn-sm btn-danger">স্লাইড রিমুভ</button>
            </div>
            @endforeach
            @else
            <!-- Default empty slide -->
            <div class="hero-slide-item mb-4" style="border:2px solid #ddd; padding:20px; margin-bottom:20px;">
                <h5>স্লাইড 1</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>মেইন টাইটেল</label>
                        <input type="text" name="hero_title[]" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>প্রমোশন টাইটেল</label>
                        <input type="text" name="hero_promotion_title[]" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label>লিঙ্ক টাইপ</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="hero_type[]" value="batch" id="type-batch-0" class="form-check-input"
                            checked onchange="toggleHeroFields(0)">
                        <label for="type-batch-0" class="form-check-label">ব্যাচ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="hero_type[]" value="class" id="type-class-0" class="form-check-input"
                            onchange="toggleHeroFields(0)">
                        <label for="type-class-0" class="form-check-label">ক্লাস</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="hero_type[]" value="book" id="type-book-0" class="form-check-input"
                            onchange="toggleHeroFields(0)">
                        <label for="type-book-0" class="form-check-label">বুক</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="hero_type[]" value="custom" id="type-custom-0"
                            class="form-check-input" onchange="toggleHeroFields(0)">
                        <label for="type-custom-0" class="form-check-label">কাস্টম লিঙ্ক</label>
                    </div>
                </div>
                <div id="hero-fields-0">
                    <div id="batch-field-0" style="display: block;" class="mb-3">
                        <label>ব্যাচ সিলেক্ট</label>
                        <select name="hero_batch_id[]" class="form-control">
                            <option value="">সিলেক্ট করো</option>
                            @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->plan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="class-field-0" style="display: none;" class="mb-3">
                        <label>ক্লাস সিলেক্ট</label>
                        <select name="hero_class_id[]" class="form-control">
                            <option value="">সিলেক্ট করো</option>
                            @foreach ($batch_categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="book-field-0" style="display: none;" class="mb-3">
                        <label>বুক সিলেক্ট</label>
                        <select name="hero_book_id[]" class="form-control">
                            <option value="">সিলেক্ট করো</option>
                            @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->name }} - {{ $book->author }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="custom-field-0" style="display: none;" class="mb-3">
                        <label>কাস্টম লিঙ্ক</label>
                        <input type="url" name="hero_custom_link[]" class="form-control"
                            placeholder="https://example.com">
                    </div>
                </div>
                <div class="mb-3">
                    <label>হিরো ইমেজ</label>
                    <input type="file" name="hero_image[0]" class="form-control">
                </div>
                <button type="button" onclick="this.closest('.hero-slide-item').remove()"
                    class="btn btn-sm btn-danger">স্লাইড রিমুভ</button>
            </div>
            @endif
        </div>
        <button type="button" onclick="addHeroSlide()" class="btn btn-secondary mb-3">নতুন হিরো স্লাইড অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ হিরো স্লাইডার</button>
    </form>
    @elseif($section->section_type === 'locations')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>লোকেশন সেকশন (মাল্টিপল লোকেশন: নাম + ম্যাপ এমবেড)</h4>
        <div id="locations-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $key => $location)
            <div class="location-item mb-3" style="border:1px solid #ccc; padding:10px;" data-index="{{ $key }}">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="location_name[]" value="{{ $location['name'] ?? '' }}"
                            placeholder="লোকেশন নাম (যেমন: ঢাকা ব্রাঞ্চ)" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <textarea name="location_map[]" placeholder="ম্যাপ লোকেশন (Google Maps iframe কোড বা URL)"
                            class="form-control" rows="3" required>{{ $location['map_location'] ?? '' }}</textarea>
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="location-item mb-3" style="border:1px solid #ccc; padding:10px;" data-index="0">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="location_name[]" placeholder="লোকেশন নাম" class="form-control"
                            required>
                    </div>
                    <div class="col-md-6">
                        <textarea name="location_map[]"
                            placeholder="ম্যাপ লোকেশন (যেমন: &lt;iframe src=&quot;https://maps.google.com/...&quot;&gt;&lt;/iframe&gt;)"
                            class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <button type="button" onclick="addLocation()" class="btn btn-secondary mb-3">নতুন লোকেশন অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ লোকেশন</button>
    </form>
   
    @elseif($section->section_type === 'testimonial')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>টেস্টিমোনিয়াল সেকশন (মাল্টিপল: রিভিউ সিলেক্ট + ইমেজ)</h4>
        <div id="testimonials-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $key => $testimonial)
            <div class="testimonial-item mb-3" style="border:1px solid #ccc; padding:10px;" data-index="{{ $key }}">
                <div class="row">
                    <div class="col-md-6">
                        <select name="problem_id[]" class="form-control" required>
                            <option value="">রিভিউ সিলেক্ট করো</option>
                            @foreach ($problems as $problem)
                            <option value="{{ $problem->id }}" {{ (isset($testimonial['problem_id']) &&
                                $testimonial['problem_id']==$problem->id ? 'selected' : '') }}>
                                {{ $problem->user_name ?? 'User' }}: {{ Str::limit($problem->review_text ?? $problem->review
                                ?? '', 50) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="testimonial_image[]" class="form-control" accept="image/*">
                        @if(isset($testimonial['image']))
                        <img src="{{ asset('storage/' . $testimonial['image']) }}" width="50" class="mt-1">
                        @endif
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="testimonial-item mb-3" style="border:1px solid #ccc; padding:10px;" data-index="0">
                <div class="row">
                    <div class="col-md-6">
                        <select name="problem_id[]" class="form-control" required>
                            <option value="">রিভিউ সিলেক্ট করো</option>
                            @foreach ($problems as $problem)
                            <option value="{{ $problem->id }}">
                                {{ $problem->user_name ?? 'User' }}: {{ Str::limit($problem->review_text ?? $problem->review
                                ?? '', 50) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="testimonial_image[]" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <button type="button" onclick="addTestimonial()" class="btn btn-secondary mb-3">নতুন টেস্টিমোনিয়াল অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ টেস্টিমোনিয়াল</button>
    </form>
    @elseif($section->section_type === 'notice')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>নোটিশ সেকশন (মাল্টিপল: নোটিশ সিলেক্ট + ইমেজ)</h4>
        <div id="notices-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $key => $noticeItem)
            <div class="notice-item mb-3" style="border:1px solid #ccc; padding:10px;" data-index="{{ $key }}">
                <div class="row">
                    <div class="col-md-6">
                        <select name="notice_id[]" class="form-control" required>
                            <option value="">নোটিশ সিলেক্ট করো</option>
                            @foreach ($notices as $notice)
                            <option value="{{ $notice->id }}" {{ (isset($noticeItem['notice_id']) &&
                                $noticeItem['notice_id']==$notice->id ? 'selected' : '') }}>
                                {{ $notice->name ?? 'Untitled' }}: {{ \Illuminate\Support\Str::limit($notice->notice ??
                                '', 50) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="notice_image[]" class="form-control" accept="image/*">
                        @if(isset($noticeItem['image']))
                        <img src="{{ asset('storage/' . $noticeItem['image']) }}" width="50" class="mt-1">
                        @endif
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="notice-item mb-3" style="border:1px solid #ccc; padding:10px;" data-index="0">
                <div class="row">
                    <div class="col-md-6">
                        <select name="notice_id[]" class="form-control" required>
                            <option value="">নোটিশ সিলেক্ট করো</option>
                            @foreach ($notices as $notice)
                            <option value="{{ $notice->id }}">
                                {{ $notice->notice ?? 'Untitled' }}: {{ \Illuminate\Support\Str::limit($notice->notice ??
                                '', 50) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="file" name="notice_image[]" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <button type="button" onclick="addNotice()" class="btn btn-secondary mb-3">নতুন নোটিশ অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ নোটিশ</button>
    </form>
    @else
    <p>ডেটা রেডি নয়।</p>
    @endif
</div>

@php
    $noticesJson = $notices->map(function ($n) {
        return [
            'id' => $n->id,
            'label' => ($n->name ?? 'Untitled') . ': ' . \Illuminate\Support\Str::limit($n->notice ?? '', 50)
        ];
    })->toArray();
@endphp
<script>
    const noticesJson = @json($noticesJson);
</script>


<script>
    // Mentor Add Function
    function addMentor() {
        const container = document.getElementById('mentors-container');
        const newItem = document.createElement('div');
        newItem.className = 'mentor-item mb-3';
        newItem.style = 'border:1px solid #ccc; padding:10px;';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-2">
                    <select name="mentor_name[]" class="form-control">
                        @foreach ($mentors as $mentor)
                            <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2"><input type="file" name="mentor_image[]" class="form-control"></div>
                <div class="col-md-3"><input type="url" name="mentor_youtube_url[]" placeholder="YouTube URL" class="form-control"></div>
                <div class="col-md-4"><textarea name="mentor_bio[]" placeholder="বায়ো" class="form-control"></textarea></div>
                <div class="col-md-1"><button type="button" onclick="this.closest('.mentor-item').remove()" class="btn btn-danger btn-sm">রিমুভ</button></div>
            </div>
        `;
        container.appendChild(newItem);
    }

    // Home Slider Add Function
    function addSlide() {
        const container = document.getElementById('slides-container');
        const newSlide = document.createElement('div');
        newSlide.className = 'slide-item mb-3';
        newSlide.style = 'border:2px solid #ccc; padding:15px;';
        newSlide.innerHTML = `
            <h5>নতুন স্লাইড</h5>
            <div class="row">
                <div class="col-md-3"><input type="text" name="slide_title[]" placeholder="টাইটেল" class="form-control"></div>
                <div class="col-md-3"><input type="text" name="slide_subtitle[]" placeholder="সাবটাইটেল" class="form-control"></div>
                <div class="col-md-3"><input type="text" name="slide_enroll_text[]" placeholder="এনরোল টেক্সট" class="form-control"></div>
                <div class="col-md-3"><input type="url" name="slide_enroll_link[]" placeholder="এনরোল লিঙ্ক" class="form-control"></div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label>মেইন ইমেজ</label>
                    <input type="file" name="slide_main_image[]" class="form-control">
                </div>
            </div>
            <button type="button" onclick="this.closest('.slide-item').remove()" class="btn btn-sm btn-danger">রিমুভ</button>
        `;
        container.appendChild(newSlide);
    }

    // Batch Add Function
    function addBatchImageField() {
        const container = document.getElementById('batch-images-container');
        const newItem = document.createElement('div');
        newItem.className = 'batch-image-item mb-3';
        newItem.style = 'border:1px solid #ccc; padding:10px;';
        newItem.innerHTML = `
            <div class="row batch-item">
                <div class="col-md-6">
                    <select name="batch_id[]" class="form-control">
                        @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->plan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5"><input type="file" name="batch_image[]" class="form-control"></div>
                <div class="col-md-1"><button type="button" onclick="this.closest('.batch-item').remove()" class="btn btn-danger btn-sm">রিমুভ</button></div>
            </div>
        `;
        container.appendChild(newItem);
    }

    // Batch Category Add Function
    function addBatchItem() {
        const container = document.getElementById('batch-items-container');
        const newItem = document.createElement('div');
        newItem.className = 'batch-item mb-3';
        newItem.style = 'border:1px solid #ccc; padding:10px;';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-4">
                    <select name="batch_category_id[]" class="form-control">
                        @foreach ($batch_categories as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4"><input type="file" name="batch_image[]" class="form-control" accept="image/*"></div>
                <div class="col-md-4"><button type="button" onclick="this.closest('.batch-item').remove()" class="btn btn-danger btn-sm">রিমুভ</button></div>
            </div>
        `;
        container.appendChild(newItem);
    }

    // Books Add Function
    function addBookItem() {
        const container = document.getElementById('book-items-container');
        const newItem = document.createElement('div');
        newItem.className = 'book-item mb-3';
        newItem.style = 'border:1px solid #ccc; padding:10px;';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-3">
                    <select name="book_id[]" class="form-control">
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->name }} - {{ $book->author }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3"><input type="file" name="book_image[]" class="form-control" accept="image/*"></div>
                <div class="col-md-4"><input type="text" name="book_name[]" class="form-control" placeholder="কাস্টম বুক নাম (ঐচ্ছিক)"></div>
                <div class="col-md-2"><button type="button" onclick="this.closest('.book-item').remove()" class="btn btn-danger btn-sm">রিমুভ</button></div>
            </div>
        `;
        container.appendChild(newItem);
    }

    // Hero Slider Toggle Function
    function toggleHeroFields(index) {
        const slideItem = document.querySelector(`.hero-slide-item:nth-child(${index + 1})`);
        if (!slideItem) return;

        const checkedRadio = slideItem.querySelector('input[name="hero_type[]"]:checked');
        const slideType = checkedRadio ? checkedRadio.value : 'batch';

        document.getElementById(`batch-field-${index}`).style.display = slideType === 'batch' ? 'block' : 'none';
        document.getElementById(`class-field-${index}`).style.display = slideType === 'class' ? 'block' : 'none';
        document.getElementById(`book-field-${index}`).style.display = slideType === 'book' ? 'block' : 'none';
        document.getElementById(`custom-field-${index}`).style.display = slideType === 'custom' ? 'block' : 'none';
    }

    // Hero Slider Add Function
    function addHeroSlide() {
        const container = document.getElementById('hero-slides-container');
        const slideCount = container.children.length;
        const newSlide = document.createElement('div');
        newSlide.className = 'hero-slide-item mb-4';
        newSlide.style = 'border:2px solid #ddd; padding:20px; margin-bottom:20px;';
        newSlide.innerHTML = `
            <h5>স্লাইড ${slideCount + 1}</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>মেইন টাইটেল</label>
                    <input type="text" name="hero_title[]" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>প্রমোশন টাইটেল</label>
                    <input type="text" name="hero_promotion_title[]" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label>লিঙ্ক টাইপ</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hero_type[]" value="batch" id="type-batch-${slideCount}" class="form-check-input" checked onchange="toggleHeroFields(${slideCount})">
                    <label for="type-batch-${slideCount}" class="form-check-label">ব্যাচ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hero_type[]" value="class" id="type-class-${slideCount}" class="form-check-input" onchange="toggleHeroFields(${slideCount})">
                    <label for="type-class-${slideCount}" class="form-check-label">ক্লাস</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hero_type[]" value="book" id="type-book-${slideCount}" class="form-check-input" onchange="toggleHeroFields(${slideCount})">
                    <label for="type-book-${slideCount}" class="form-check-label">বুক</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="hero_type[]" value="custom" id="type-custom-${slideCount}" class="form-check-input" onchange="toggleHeroFields(${slideCount})">
                    <label for="type-custom-${slideCount}" class="form-check-label">কাস্টম লিঙ্ক</label>
                </div>
            </div>
            <div id="hero-fields-${slideCount}">
                <div id="batch-field-${slideCount}" style="display: block;" class="mb-3">
                    <label>ব্যাচ সিলেক্ট</label>
                    <select name="hero_batch_id[]" class="form-control">
                        <option value="">সিলেক্ট করো</option>
                        @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->plan }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="class-field-${slideCount}" style="display: none;" class="mb-3">
                    <label>ক্লাস সিলেক্ট</label>
                    <select name="hero_class_id[]" class="form-control">
                        <option value="">সিলেক্ট করো</option>
                        @foreach ($batch_categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="book-field-${slideCount}" style="display: none;" class="mb-3">
                    <label>বুক সিলেক্ট</label>
                    <select name="hero_book_id[]" class="form-control">
                        <option value="">সিলেক্ট করো</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->name }} - {{ $book->author }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="custom-field-${slideCount}" style="display: none;" class="mb-3">
                    <label>কাস্টম লিঙ্ক</label>
                    <input type="url" name="hero_custom_link[]" class="form-control" placeholder="https://example.com">
                </div>
            </div>
            <div class="mb-3">
                <label>হিরো ইমেজ</label>
                <input type="file" name="hero_image[${slideCount}]" class="form-control">
            </div>
            <button type="button" onclick="this.closest('.hero-slide-item').remove()" class="btn btn-sm btn-danger">স্লাইড রিমুভ</button>
        `;
        container.appendChild(newSlide);
        toggleHeroFields(slideCount);
    }

    // Initialize toggles for existing hero slides
    document.addEventListener('DOMContentLoaded', function() {
        @if(isset($section->dynamic_data) && $section->section_type === 'hero_slider')
            @foreach($section->dynamic_data as $slideIndex => $slide)
                toggleHeroFields({{ $slideIndex }});
            @endforeach
        @endif
    });
    // Locations Add Function
    function addLocation() {
    const container = document.getElementById('locations-container');
    const index = container.children.length;
    const newItem = document.createElement('div');
    newItem.className = 'location-item mb-3';
    newItem.style = 'border:1px solid #ccc; padding:10px;';
    newItem.setAttribute('data-index', index);
    newItem.innerHTML = `
    <div class="row">
        <div class="col-md-5">
            <input type="text" name="location_name[]" placeholder="লোকেশন নাম" class="form-control" required>
        </div>
        <div class="col-md-6">
            <textarea name="location_map[]" placeholder="ম্যাপ লোকেশন (Google Maps iframe কোড বা URL)" class="form-control"
                rows="3" required></textarea>
        </div>
        <div class="col-md-1">
            <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
        </div>
    </div>
    `;
    container.appendChild(newItem);
    }
    // Testimonials Add Function
    function addTestimonial() {
    const container = document.getElementById('testimonials-container');
    const index = container.children.length;
    const newItem = document.createElement('div');
    newItem.className = 'testimonial-item mb-3';
    newItem.style = 'border:1px solid #ccc; padding:10px;';
    newItem.setAttribute('data-index', index);
    newItem.innerHTML = `
    <div class="row">
        <div class="col-md-6">
            <select name="problem_id[]" class="form-control" required>
                <option value="">রিভিউ সিলেক্ট করো</option>
                @foreach ($problems as $problem)
                <option value="{{ $problem->id }}">
                    {{ $problem->user_name ?? 'User' }}: {{ Str::limit($problem->review_text ?? $problem->review ?? '', 50)
                    }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-5">
            <input type="file" name="testimonial_image[]" class="form-control" accept="image/*">
        </div>
        <div class="col-md-1">
            <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
        </div>
    </div>
    `;
    container.appendChild(newItem);
    }



    // Notices Add Function
function addNotice() {
    const container = document.getElementById('notices-container');
    const index = container.children.length;
    const newItem = document.createElement('div');
    newItem.className = 'notice-item mb-3';
    newItem.style = 'border:1px solid #ccc; padding:10px;';
    newItem.setAttribute('data-index', index);
    
    const optionsHtml = noticesJson.map(n => `<option value="${n.id}">${n.label}</option>`).join('');
    console.log(optionsHtml)
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <select name="notice_id[]" class="form-control" required>
                    <option value="">নোটিশ সিলেক্ট করো</option>
                    ${optionsHtml}
                </select>
            </div>
            <div class="col-md-5">
                <input type="file" name="notice_image[]" class="form-control" accept="image/*">
            </div>
            <div class="col-md-1">
                <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
            </div>
        </div>
    `;
    container.appendChild(newItem);
}
    // Generic Remove Function (add if missing)
    function removeItem(button) {
       button.closest('.location-item, .mentor-item, .slide-item, .batch-image-item, .batch-item, .book-item,.hero-slide-item').remove();
    }
</script>
@endsection

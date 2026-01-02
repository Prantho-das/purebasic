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
        <h4>হিরো স্লাইডার - কোর্স কার্ড সহ (প্রতি স্লাইডে ৪টা কার্ড)</h4>
    
        <div id="hero-slides-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $slideIndex => $slide)
            <div class="hero-slide-item mb-5 p-4 border rounded">
                <h5 class="mb-3">স্লাইড {{ $slideIndex + 1 }}</h5>
    
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>মেইন টাইটেল</label>
                        <input type="text" name="slide_title[]" value="{{ $slide['title'] ?? '' }}" class="form-control"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label>প্রমোশন টাইটেল (উপরে লাল ব্যাজ)</label>
                        <input type="text" name="slide_promotion_title[]" value="{{ $slide['promotion_title'] ?? '' }}"
                            class="form-control">
                    </div>
                </div>
    
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label>এনরোল বাটন টেক্সট</label>
                        <input type="text" name="enroll_text[]" value="{{ $slide['enroll_text'] ?? '' }}"
                            class="form-control" placeholder="Click To Enroll In 30+ Free Courses">
                    </div>
                    <div class="col-md-6">
                        <label>এনরোল লিঙ্ক</label>
                        <input type="url" name="enroll_link[]" value="{{ $slide['enroll_link'] ?? '' }}"
                            class="form-control">
                    </div>
                </div>
    
                <h6>কোর্স কার্ডস (৪টা)</h6>
                <div class="items-container mb-3">
                    @foreach($slide['items'] ?? [] as $itemIndex => $item)
                    <div class="row mb-3 item-row p-3 border">
                        <div class="col-md-3">
                            <label>টাইপ</label><br>
                            <div class="btn-group" role="group">
                                <input type="radio" name="items[{{ $slideIndex }}][{{ $itemIndex }}][type]" value="course"
                                    class="btn-check" id="course-{{ $slideIndex }}-{{ $itemIndex }}" {{ ($item['type'] ?? ''
                                    )==='course' ? 'checked' : '' }}
                                    onchange="toggleItemType({{ $slideIndex }}, {{ $itemIndex }})">
                                <label class="btn btn-outline-primary"
                                    for="course-{{ $slideIndex }}-{{ $itemIndex }}">কোর্স</label>
    
                                <input type="radio" name="items[{{ $slideIndex }}][{{ $itemIndex }}][type]" value="custom"
                                    class="btn-check" id="custom-{{ $slideIndex }}-{{ $itemIndex }}" {{ ($item['type'] ?? ''
                                    )==='custom' ? 'checked' : '' }}
                                    onchange="toggleItemType({{ $slideIndex }}, {{ $itemIndex }})">
                                <label class="btn btn-outline-secondary"
                                    for="custom-{{ $slideIndex }}-{{ $itemIndex }}">কাস্টম</label>
                            </div>
                        </div>
    
                        <div class="col-md-4 course-field"
                            style="display: {{ ($item['type'] ?? '') === 'course' ? 'block' : 'none' }};">
                            <label>কোর্স সিলেক্ট করুন</label>
                            <select name="items[{{ $slideIndex }}][{{ $itemIndex }}][course_id]" class="form-control">
                                <option value="">-- সিলেক্ট করুন --</option>
                                @foreach($batches as $batch)
                                <option value="{{ $batch->id }}" {{ isset($item['course_id']) &&
                                    $item['course_id']==$batch->id ? 'selected' : '' }}>
                                    {{ $batch->plan ?? $batch->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="col-md-4 custom-fields"
                            style="display: {{ ($item['type'] ?? '') === 'custom' ? 'block' : 'none' }};">
                            <label>কাস্টম নাম</label>
                            <input type="text" name="items[{{ $slideIndex }}][{{ $itemIndex }}][custom_name]"
                                value="{{ $item['custom_name'] ?? '' }}" class="form-control mb-2"
                                placeholder="যেমন: Complete Grammar">
    
                            <label>কাস্টম লিঙ্ক</label>
                            <input type="url" name="items[{{ $slideIndex }}][{{ $itemIndex }}][custom_link]"
                                value="{{ $item['custom_link'] ?? '' }}" class="form-control" placeholder="https://...">
                        </div>
    
                        <div class="col-md-4">
                            <label>ইমেজ</label>
                            <input type="file" name="item_image[{{ $slideIndex }}][{{ $itemIndex }}]" class="form-control">
                            @if(isset($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}" width="100" class="mt-2 rounded">
                            @endif
                        </div>
    
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" onclick="this.closest('.item-row').remove()"
                                class="btn btn-danger btn-sm">X</button>
                        </div>
                    </div>
                    @endforeach
                </div>
    
                <button type="button" onclick="addItem({{ $slideIndex }})" class="btn btn-sm btn-secondary mb-3">+ নতুন
                    কার্ড অ্যাড করুন</button>
                    <button type="button" onclick="addSlide()" class="btn btn-secondary mb-3">+ নতুন স্লাইড অ্যাড করুন</button>

                <button type="button" onclick="this.closest('.hero-slide-item').remove()"
                    class="btn btn-danger float-end">স্লাইড ডিলিট</button>
            </div>
            @endforeach
            @else
            <!-- Default empty slide -->
            <div class="hero-slide-item mb-5 p-4 border rounded">
                <h5>স্লাইড 1</h5>
                <!-- same structure as above but empty -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" name="slide_title[]" placeholder="মেইন টাইটেল" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="slide_promotion_title[]" placeholder="প্রমোশন টাইটেল" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <input type="text" name="enroll_text[]" placeholder="Click To Enroll In 30+ Free Courses"
                            class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input type="url" name="enroll_link[]" class="form-control">
                    </div>
                </div>
    
                <h6>কোর্স কার্ডস</h6>
                <div class="items-container mb-3">
                    <!-- 4 empty items by default -->
                    @for($i = 0; $i < 4; $i++) <div class="row mb-3 item-row p-3 border">
                        <!-- same fields as above, empty -->
                        <div class="col-md-3">
                            <div class="btn-group" role="group">
                                <input type="radio" name="items[0][{{ $i }}][type]" value="course" class="btn-check"
                                    id="course-0-{{ $i }}" checked onchange="toggleItemType(0, {{ $i }})">
                                <label class="btn btn-outline-primary" for="course-0-{{ $i }}">কোর্স</label>
    
                                <input type="radio" name="items[0][{{ $i }}][type]" value="custom" class="btn-check"
                                    id="custom-0-{{ $i }}" onchange="toggleItemType(0, {{ $i }})">
                                <label class="btn btn-outline-secondary" for="custom-0-{{ $i }}">কাস্টম</label>
                            </div>
                        </div>
                        <div class="col-md-4 course-field">
                            <select name="items[0][{{ $i }}][course_id]" class="form-control">
                                <option value="">-- সিলেক্ট করুন --</option>
                                @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->plan ?? $batch->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 custom-fields" style="display:none;">
                            <input type="text" name="items[0][{{ $i }}][custom_name]" class="form-control mb-2"
                                placeholder="কাস্টম নাম">
                            <input type="url" name="items[0][{{ $i }}][custom_link]" class="form-control"
                                placeholder="https://">
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="item_image[0][{{ $i }}]" class="form-control">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" onclick="this.closest('.item-row').remove()"
                                class="btn btn-danger btn-sm">X</button>
                        </div>
                </div>
                @endfor
            </div>
            <button type="button" onclick="addItem(0)" class="btn btn-sm btn-secondary">+ নতুন কার্ড</button>
        </div>
        @endif
        </div>
    
        <button type="button" onclick="addSlide()" class="btn btn-secondary mb-3">+ নতুন স্লাইড অ্যাড করুন</button>
        <button type="submit" class="btn btn-success">সেভ করুন</button>
        </form>







@elseif($section->section_type === 'static_design')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>স্ট্যাটিক ডিজাইন সেকশন (মাল্টিপল: টাইপ + লেবেল)</h4>
        <div id="static-items-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $key => $item)
            <div class="static-item mb-3" style="border:1px solid #ccc; padding:10px;" data-index="{{ $key }}">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="item_type[]" value="{{ $item['type'] ?? '' }}"
                            placeholder="টাইপ (যেমন: feature)" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="item_label[]" value="{{ $item['label'] ?? '' }}"
                            placeholder="লেবেল (যেমন: Free Access)" class="form-control" required>
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="static-item mb-3" style="border:1px solid #ccc; padding:10px;" data-index="0">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="item_type[]" placeholder="টাইপ" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="item_label[]" placeholder="লেবেল" class="form-control" required>
                    </div>
                    <div class="col-md-1">
                        <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <button type="button" onclick="addStaticItem()" class="btn btn-secondary mb-3">নতুন আইটেম অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ</button>
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
    // function addSlide() {
    //     const container = document.getElementById('slides-container');
    //     const newSlide = document.createElement('div');
    //     newSlide.className = 'slide-item mb-3';
    //     newSlide.style = 'border:2px solid #ccc; padding:15px;';
    //     newSlide.innerHTML = `
    //         <h5>নতুন স্লাইড</h5>
    //         <div class="row">
    //             <div class="col-md-3"><input type="text" name="slide_title[]" placeholder="টাইটেল" class="form-control"></div>
    //             <div class="col-md-3"><input type="text" name="slide_subtitle[]" placeholder="সাবটাইটেল" class="form-control"></div>
    //             <div class="col-md-3"><input type="text" name="slide_enroll_text[]" placeholder="এনরোল টেক্সট" class="form-control"></div>
    //             <div class="col-md-3"><input type="url" name="slide_enroll_link[]" placeholder="এনরোল লিঙ্ক" class="form-control"></div>
    //         </div>
    //         <div class="row mt-2">
    //             <div class="col-md-6">
    //                 <label>মেইন ইমেজ</label>
    //                 <input type="file" name="slide_main_image[]" class="form-control">
    //             </div>
    //         </div>
    //         <button type="button" onclick="this.closest('.slide-item').remove()" class="btn btn-sm btn-danger">রিমুভ</button>
    //     `;
    //     container.appendChild(newSlide);
    // }

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
        <label>ব্যাচ সিলেক্ট (মাল্টিপল)</label>
        <select name="hero_batch_ids[${slideCount}][]" multiple class="form-control">
            @foreach ($batches as $batch)
            <option value="{{ $batch->id }}">{{ $batch->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>বুক সিলেক্ট (মাল্টিপল)</label>
        <select name="hero_book_ids[${slideCount}][]" multiple class="form-control">
            @foreach ($books as $book)
            <option value="{{ $book->id }}">{{ $book->name }} - {{ $book->author }}</option>
            @endforeach
        </select>
    </div>
    <div id="custom-links-${slideCount}" class="mb-3">
        <label>কাস্টম লিঙ্কস (মাল্টিপল)</label>
        <button type="button" onclick="addCustomLink(${slideCount})" class="btn btn-secondary btn-sm">নতুন লিঙ্ক
            অ্যাড</button>
    </div>
    <div id="images-${slideCount}" class="mb-3">
        <label>হিরো ইমেজস (মাল্টিপল)</label>
        <button type="button" onclick="addImageField(${slideCount})" class="btn btn-secondary btn-sm">নতুন ইমেজ
            অ্যাড</button>
    </div>
    <button type="button" onclick="this.closest('.hero-slide-item').remove()" class="btn btn-sm btn-danger">স্লাইড
        রিমুভ</button>
    `;
    container.appendChild(newSlide);
    }

    // Initialize toggles for existing hero slides
    document.addEventListener('DOMContentLoaded', function() {
        @if(isset($section->dynamic_data) && $section->section_type === 'hero_slider')
            @foreach($section->dynamic_data as $slideIndex => $slide)
                toggleHeroFields({{ $slideIndex }});
            @endforeach
        @endif
    });
    // Static Design Add Function
    function addStaticItem() {
    const container = document.getElementById('static-items-container');
    const index = container.children.length;
    const newItem = document.createElement('div');
    newItem.className = 'static-item mb-3';
    newItem.style = 'border:1px solid #ccc; padding:10px;';
    newItem.setAttribute('data-index', index);
    newItem.innerHTML = `
    <div class="row">
        <div class="col-md-5">
            <input type="text" name="item_type[]" placeholder="টাইপ" class="form-control" required>
        </div>
        <div class="col-md-6">
            <input type="text" name="item_label[]" placeholder="লেবেল" class="form-control" required>
        </div>
        <div class="col-md-1">
            <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">রিমুভ</button>
        </div>
    </div>
    `;
    container.appendChild(newItem);
    }

    function addImageField(index) {
    const container = document.getElementById(`images-${index}`);
    const newImage = document.createElement('div');
    newImage.className = 'row mb-2 image-item';
    newImage.innerHTML = `
    <div class="col-md-8">
        <input type="file" name="hero_images[${index}][]" class="form-control">
    </div>
    <div class="col-md-4">
        <button type="button" onclick="this.closest('.image-item').remove()" class="btn btn-danger btn-sm">রিমুভ</button>
    </div>
    `;
    container.appendChild(newImage);
    }
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

function addCustomLink(index) {
    const container = document.getElementById(`custom-links-${index}`);
    const newLink = document.createElement('div');
    newLink.className = 'row mb-2 custom-link-item';
    newLink.innerHTML = `
    <div class="col-md-10">
        <input type="url" name="hero_custom_links[${index}][]" class="form-control" placeholder="https://example.com">
    </div>
    <div class="col-md-2">
        <button type="button" onclick="this.closest('.custom-link-item').remove()"
            class="btn btn-danger btn-sm">রিমুভ</button>
    </div>
    `;
    container.appendChild(newLink);
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



    let slideCounter = {{ count($section->dynamic_data ?? []) ?: 1 }};

function addSlide() {
    const container = document.getElementById('hero-slides-container');
    const newSlide = document.createElement('div');
    newSlide.className = 'hero-slide-item mb-5 p-4 border rounded';
    newSlide.innerHTML = `
        <h5 class="mb-3">স্লাইড ${slideCounter + 1}</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label>মেইন টাইটেল</label>
                <input type="text" name="slide_title[]" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>প্রমোশন টাইটেল</label>
                <input type="text" name="slide_promotion_title[]" class="form-control">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label>এনরোল বাটন টেক্সট</label>
                <input type="text" name="enroll_text[]" placeholder="Click To Enroll In 30+ Free Courses" class="form-control">
            </div>
            <div class="col-md-6">
                <label>এনরোল লিঙ্ক</label>
                <input type="url" name="enroll_link[]" class="form-control">
            </div>
        </div>
        <h6>কোর্স কার্ডস</h6>
        <div class="items-container mb-3">
            <!-- ৪টা ডিফল্ট কার্ড -->
            ${[0,1,2,3].map(i => getItemHTML(slideCounter, i)).join('')}
        </div>
        <button type="button" onclick="addItem(${slideCounter})" class="btn btn-sm btn-secondary mb-3">+ নতুন কার্ড অ্যাড করুন</button>
        <button type="button" onclick="this.closest('.hero-slide-item').remove()" class="btn btn-danger float-end">স্লাইড ডিলিট</button>
    `;
    container.appendChild(newSlide);
    slideCounter++;
}

function getItemHTML(slideIndex, itemIndex) {
    return `
        <div class="row mb-3 item-row p-3 border">
            <div class="col-md-3">
                <label>টাইপ</label><br>
                <div class="btn-group" role="group">
                    <input type="radio" name="items[${slideIndex}][${itemIndex}][type]" value="course" class="btn-check" id="course-${slideIndex}-${itemIndex}" checked onchange="toggleItemType(${slideIndex}, ${itemIndex})">
                    <label class="btn btn-outline-primary" for="course-${slideIndex}-${itemIndex}">কোর্স</label>

                    <input type="radio" name="items[${slideIndex}][${itemIndex}][type]" value="custom" class="btn-check" id="custom-${slideIndex}-${itemIndex}" onchange="toggleItemType(${slideIndex}, ${itemIndex})">
                    <label class="btn btn-outline-secondary" for="custom-${slideIndex}-${itemIndex}">কাস্টম</label>
                </div>
            </div>

            <div class="col-md-4 course-field">
                <label>কোর্স সিলেক্ট করুন</label>
                <select name="items[${slideIndex}][${itemIndex}][course_id]" class="form-control">
                    <option value="">-- সিলেক্ট করুন --</option>
                    @foreach($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->plan ?? $batch->title ?? 'Unnamed Course' }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 custom-fields" style="display:none;">
                <label>কাস্টম নাম</label>
                <input type="text" name="items[${slideIndex}][${itemIndex}][custom_name]" class="form-control mb-2" placeholder="যেমন: Complete Grammar">

                <label>কাস্টম লিঙ্ক</label>
                <input type="url" name="items[${slideIndex}][${itemIndex}][custom_link]" class="form-control" placeholder="https://example.com">
            </div>

            <div class="col-md-4">
                <label>ইমেজ</label>
                <input type="file" name="item_image[${slideIndex}][${itemIndex}]" class="form-control">
            </div>

            <div class="col-md-1 d-flex align-items-end">
                <button type="button" onclick="this.closest('.item-row').remove()" class="btn btn-danger btn-sm">X</button>
            </div>
        </div>
    `;
}

function addItem(slideIndex) {
    const slideElement = document.querySelectorAll('.hero-slide-item')[slideIndex];
    const container = slideElement.querySelector('.items-container');
    const itemCount = container.querySelectorAll('.item-row').length;

    const newItem = document.createElement('div');
    newItem.className = 'row mb-3 item-row p-3 border';
    newItem.innerHTML = getItemHTML(slideIndex, itemCount);

    container.appendChild(newItem);
}

function toggleItemType(slideIndex, itemIndex) {
    const itemRow = document.querySelectorAll('.hero-slide-item')[slideIndex]
        .querySelectorAll('.item-row')[itemIndex];

    const courseField = itemRow.querySelector('.course-field');
    const customFields = itemRow.querySelector('.custom-fields');

    const selectedType = itemRow.querySelector(`input[name="items[${slideIndex}][${itemIndex}][type]"]:checked`).value;

    courseField.style.display = selectedType === 'course' ? 'block' : 'none';
    customFields.style.display = selectedType === 'custom' ? 'block' : 'none';
}

// Existing slides-এর জন্য toggle initialize করুন (যদি edit করা হয়)
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.item-row').forEach(function (row, index) {
        const matches = row.querySelector('input[type="radio"]:checked')?.name.match(/items\[(\d+)\]\[(\d+)\]\[type\]/);
        if (matches) {
            const slideIdx = matches[1];
            const itemIdx = matches[2];
            toggleItemType(slideIdx, itemIdx);
        }
    });
});
</script>
@endsection

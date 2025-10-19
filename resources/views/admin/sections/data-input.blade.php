@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h1>ডেটা ইনপুট: {{ $section->title }} ({{ $section->section_type }})</h1>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($section->section_type === 'mentor')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
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
                    <div class="col-md-2"><input type="file" name="mentor_image[]" class="form-control"></div>
                    <div class="col-md-3"><input type="url" name="mentor_youtube_url[]"
                            placeholder="YouTube URL (e.g., https://youtube.com/watch?v=abc)" class="form-control">
                    </div>
                    <div class="col-md-4"><textarea name="mentor_bio[]" placeholder="বায়ো/ইনফো"
                            class="form-control"></textarea></div>
                    <div class="col-md-1"><button type="button" onclick="this.closest('.mentor-item').remove()"
                            class="btn btn-danger btn-sm">রিমুভ</button></div>
                </div>
            </div>
            @else
            @foreach($section->dynamic_data as $mentor)
            <div class="mentor-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="row">
                    <div class="col-md-2">

                        <select name="mentor_name[]" class="form-control">
                            @foreach ($mentors as $ment)
                            <option @if($mentor['name']==(string) $ment->id)
                                selected
                                @endif

                                value="{{ $ment->id }}">{{ $ment->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-2">
                        <input type="file" name="mentor_image[]" class="form-control">
                        @if(isset($mentor['image']))
                        <img src="{{ asset('storage/' . $mentor['image']) }}" width="50" class="mt-1">
                        @endif
                    </div>
                    <div class="col-md-3"><input type="url" name="mentor_youtube_url[]"
                            value="{{ $mentor['youtube_url'] ?? '' }}" placeholder="YouTube URL" class="form-control">
                    </div>
                    <div class="col-md-4"><textarea name="mentor_bio[]"
                            class="form-control">{{ $mentor['bio'] ?? '' }}</textarea></div>
                    <div class="col-md-1"><button type="button" onclick="this.closest('.mentor-item').remove()"
                            class="btn btn-danger btn-sm">রিমুভ</button></div>
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
        {{ csrf_field() }}
        <h4>হোম স্লাইডার (টাইটেল, সাবটাইটেল, এনরোল টেক্সট/লিঙ্ক, ইমেজ অ্যাড করো)</h4>
        <div id="slides-container">
            @if(isset($section->dynamic_data) && !empty($section->dynamic_data))
            @foreach($section->dynamic_data as $slideIndex => $slide)
            <div class="slide-item mb-3" style="border:2px solid #ccc; padding:15px;">
                <h5>স্লাইড {{ $slideIndex + 1 }}</h5>
                <div class="row">
                    <div class="col-md-3"><input type="text" name="slide_title[]" value="{{ $slide['title'] }}"
                            placeholder="টাইটেল" class="form-control"></div>
                    <div class="col-md-3"><input type="text" name="slide_subtitle[]" value="{{ $slide['subtitle'] }}"
                            placeholder="সাবটাইটেল" class="form-control"></div>
                    <div class="col-md-3"><input type="text" name="slide_enroll_text[]"
                            value="{{ $slide['enroll_text'] }}" placeholder="এনরোল টেক্সট" class="form-control"></div>
                    <div class="col-md-3"><input type="url" name="slide_enroll_link[]"
                            value="{{ $slide['enroll_link'] }}" placeholder="এনরোল লিঙ্ক" class="form-control"></div>
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
                    class="btn btn-sm btn-danger">স্লাইড
                    রিমুভ</button>
            </div>
            @endforeach
            @else
            <!-- ডিফল্ট স্লাইড ফর্ম -->
            <div class="slide-item mb-3" style="border:2px solid #ccc; padding:15px;">
                <h5>স্লাইড 1</h5>
                <div class="row">
                    <div class="col-md-3"><input type="text" name="slide_title[]" placeholder="টাইটেল"
                            class="form-control">
                    </div>
                    <div class="col-md-3"><input type="text" name="slide_subtitle[]" placeholder="সাবটাইটেল"
                            class="form-control"></div>
                    <div class="col-md-3"><input type="text" name="slide_enroll_text[]" placeholder="এনরোল টেক্সট"
                            class="form-control"></div>
                    <div class="col-md-3"><input type="url" name="slide_enroll_link[]" placeholder="এনরোল লিঙ্ক"
                            class="form-control"></div>
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
        {{ csrf_field() }}


        <div id="batch-images-container">
            <div class="row batch-item">
                <div class="col-md-6">
                    <select name="batch_id[]" class="form-control">
                        @foreach ($batches as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->plan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5"><input type="file" name="mentor_image[]" class="form-control"></div>
                <div class="col-md-1"><button type="button" onclick="this.closest('.batch-item').remove()"
                        class="btn btn-danger btn-sm">রিমুভ</button></div>
            </div>
        </div>
        <button type="button" onclick="addBatchImageField()" class="btn btn-secondary mb-3">নতুন ব্যাচ ইমেজ ফিল্ড
            অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ</button>
    </form>
    @elseif($section->section_type === 'batch_category')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <h4>ব্যাচ ক্যাটাগরি সেকশন (মাল্টিপল ব্যাচ সিলেক্ট + ক্যাটাগরি + ইমেজ অ্যাড করো)</h4>
        <div id="batch-items-container">
            <div class="row batch-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="col-md-4">
                    <select name="batch_category_id[]" class="form-control">
                        @foreach ($batch_categories as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4"><input type="file" name="batch_image[]" class="form-control" accept="image/*"></div>
                <div class="col-md-1"><button type="button" onclick="this.closest('.batch-item').remove()"
                        class="btn btn-danger btn-sm">রিমুভ</button></div>
            </div>
        </div>
        <button type="button" onclick="addBatchItem()" class="btn btn-secondary mb-3">নতুন ব্যাচ + ক্যাটাগরি + ইমেজ
            অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ</button>
    </form>
    @elseif($section->section_type === 'books')
    <form action="{{ route('admin.sections.save-data', $section->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <h4>বুক সিলেকশন সেকশন (মাল্টিপল বুক সিলেক্ট + প্রত্যেকের ইমেজ অ্যাড করো)</h4>
        <div id="book-items-container">
            <div class="row book-item mb-3" style="border:1px solid #ccc; padding:10px;">
                <div class="col-md-3">
                    <select name="book_id[]" class="form-control">
                        @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->name }} - {{ $book->author }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3"><input type="file" name="book_image[]" class="form-control" accept="image/*"></div>
                <div class="col-md-5"><input type="text" name="book_name[]" class="form-control" accept="image/*"></div>
                <div class="col-md-1"><button type="button" onclick="this.closest('.book-item').remove()"
                        class="btn btn-danger btn-sm">রিমুভ</button></div>
            </div>
        </div>
        <button type="button" onclick="addBookItem()" class="btn btn-secondary mb-3">নতুন বুক + ইমেজ অ্যাড</button>
        <button type="submit" class="btn btn-success">সেভ</button>
    </form>
   
    @else
    <p>ডেটা রেডি নয়।</p>
    @endif

</div>
<script>
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
        </div>`;
    container.appendChild(newItem);
}
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
    <div class="col-md-3"><input type="text" name="slide_enroll_text[]" placeholder="এনরোল টেক্সট" class="form-control">
    </div>
    <div class="col-md-3"><input type="url" name="slide_enroll_link[]" placeholder="এনরোল লিঙ্ক" class="form-control">
    </div>
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
    <div class="col-md-5"><input type="file" name="mentor_image[]" class="form-control"></div>
    <div class="col-md-1"><button type="button" onclick="this.closest('.batch-item').remove()"
            class="btn btn-danger btn-sm">রিমুভ</button></div>
</div>
`;
container.appendChild(newItem);
}


function addBatchItem() {
const container = document.getElementById('batch-items-container');
const newItem = document.createElement('div');
newItem.className = 'row batch-item mb-3';
newItem.style = 'border:1px solid #ccc; padding:10px;';
newItem.innerHTML = `
<div class="row batch-item mb-3" style="border:1px solid #ccc; padding:10px;">
    <div class="col-md-4">
        <select name="batch_category_id[]" class="form-control">
            @foreach ($batch_categories as $batch)
            <option value="{{ $batch->id }}">{{ $batch->name }} </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4"><input type="file" name="batch_image[]" class="form-control" accept="image/*"></div>
    <div class="col-md-1"><button type="button" onclick="this.closest('.batch-item').remove()"
            class="btn btn-danger btn-sm">রিমুভ</button></div>
</div>
`;
container.appendChild(newItem);
}
function addBookItem() {
const container = document.getElementById('book-items-container');
const newItem = document.createElement('div');
newItem.className = 'row book-item mb-3';
newItem.style = 'border:1px solid #ccc; padding:10px;';
newItem.innerHTML = `
<div class="col-md-3">
    <select name="book_id[]" class="form-control">
        @foreach ($books as $book)
        <option value="{{ $book->id }}">{{ $book->name }} - {{ $book->author }}</option>
        @endforeach
    </select>
</div>
<div class="col-md-3"><input type="file" name="book_image[]" class="form-control" accept="image/*"></div>
<div class="col-md-5"><input type="text" name="book_name[]" class="form-control" accept="image/*"></div>
<div class="col-md-1"><button type="button" onclick="this.closest('.book-item').remove()"
        class="btn btn-danger btn-sm">রিমুভ</button></div>
`;
container.appendChild(newItem);
}

</script>
@endsection

@extends('layouts.register')



@section('content')
    @php
        $sections = \App\HomeSection::orderBy('order_num')->get();
    @endphp

    @foreach ($sections as $section)
        @if ($section->section_type == 'hero_slider' && $section->is_active == 1)
            <section class="home-banner-main" data-background="{{ asset('assets/images/home/hero-bg.png') }}">
                <div class="container ed-container-expand">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="title-box">
                                <h1 id="heroTitle">
                                    {{ $section->title }}
                                </h1>
                                <p>
                                    {{ $section->subtitle }}
                                </p>
                                <div class="banner-btn">
                                    <a href="#">find courses
                                        <span class="icon"><i class="fa-classic fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="banner-slider-wrapper">
                                <div class="swiper home-banner-slider">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="banner-parent-box bg-1">
                                                <div class="box-title">online course</div>
                                                <div class="heading">Admission is open for all courses in Online Batch 2025!
                                                </div>
                                                <div class="course-grid-parent">
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="enroll-link">
                                                    <a href="#">Click to enroll in 30+ free courses <i
                                                            class="fa-classic fa-regular fa-arrow-right"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="banner-parent-box bg-1">
                                                <div class="box-title">online course</div>
                                                <div class="heading">Admission is open for all courses in Online Batch 2025!
                                                </div>
                                                <div class="skill-grid-parent">
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c1.jpeg') }}"
                                                                alt="skill">
                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c2.jpeg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c3.jpg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c4.jpg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c5.jpg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="enroll-link">
                                                    <a href="#">Click to enroll in 30+ free courses <i
                                                            class="fa-classic fa-regular fa-arrow-right"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="banner-parent-box bg-1">
                                                <div class="box-title">online course</div>
                                                <div class="heading">Admission is open for all courses in Online Batch 2025!
                                                </div>
                                                <div class="course-grid-parent">
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="enroll-link">
                                                    <a href="#">Click to enroll in 30+ free courses <i
                                                            class="fa-classic fa-regular fa-arrow-right"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="banner-parent-box bg-1">
                                                <div class="box-title">online course</div>
                                                <div class="heading">Admission is open for all courses in Online Batch
                                                    2025!</div>
                                                <div class="skill-grid-parent">
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c1.jpeg') }}"
                                                                alt="skill">
                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c2.jpeg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c3.jpg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c4.jpg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c5.jpg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="enroll-link">
                                                    <a href="#">Click to enroll in 30+ free courses <i
                                                            class="fa-classic fa-regular fa-arrow-right"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="banner-parent-box bg-1">
                                                <div class="box-title">online course</div>
                                                <div class="heading">Admission is open for all courses in Online Batch
                                                    2025!</div>
                                                <div class="course-grid-parent">
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="single-course">
                                                        <a href="#">
                                                            <div class="inner-wrapper">
                                                                <div class="icon">
                                                                    <img src="{{ asset('assets/images/home/s.jpeg') }}"
                                                                        alt="skill">
                                                                </div>
                                                                <div class="text">Class 6,7,8</div>
                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="enroll-link">
                                                    <a href="#">Click to enroll in 30+ free courses <i
                                                            class="fa-classic fa-regular fa-arrow-right"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="banner-parent-box bg-1">
                                                <div class="box-title">online course</div>
                                                <div class="heading">Admission is open for all courses in Online Batch
                                                    2025!</div>
                                                <div class="skill-grid-parent">
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c1.jpeg') }}"
                                                                alt="skill">
                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c2.jpeg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c3.jpg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c4.jpg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                    <div class="single-skill">
                                                        <a href="#">
                                                            <img src="{{ asset('assets/images/home/c5.jpg') }}"
                                                                alt="skill">

                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="enroll-link">
                                                    <a href="#">Click to enroll in 30+ free courses <i
                                                            class="fa-classic fa-regular fa-arrow-right"></i> </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if (($section->section_type == 'locations' || $section->section_type == 'books') && $section->is_active == 1)
            <section class="offline-branch-main">
                <div class="container ed-container-expand">
                    @if ($section->section_type == 'locations' && $section->is_active == 1)
                        <div class="row align-items-center section-title-space">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="section-sub-title">
                                    <h6>{{ $section->title }}</h6>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="section_title">
                                    <h1>{{ $section->subtitle }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="branch-locations">

                                    @php
                                        // [{"name": "uttra", "map_location": "uttra"}, {"name": "panthopath", "map_location": "uttra"}]
                                        $loctionaData = $section->dynamic_data;
                                    @endphp
                                    <ul>
                                        @foreach ($loctionaData as $location)
                                            @php
                                                $location = (object) $location;
                                            @endphp
                                            <li>
                                                <a href="{{ $location->map_location }}" target="_blank">
                                                    <span class="icon"><i class="fa-regular fa-location-dot"></i></span>
                                                    <span class="text">{{ $location->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($section->section_type == 'books' && $section->is_active == 1)
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="branch-parent-box">
                                    @php
                                        // [{"name": "uttra", "map_location": "uttra"}, {"name": "panthopath", "map_location": "uttra"}]
                                        $bookData = $section->dynamic_data;
                                    @endphp
                                    @foreach ($bookData as $book)
                                        @php
                                            $book = (object) $book;
                                            $bookInfo = App\Book::find($book->book_id);
                                        @endphp
                                        <div class="singlecard-parent">
                                            <a href="#">
                                                <div class="image-box">
                                                    <img src="{{ asset('storage') . '/' . $book->image }}"
                                                        alt="skill">
                                                </div>
                                                <div class="content-box">
                                                    <div class="tags">{{ $book->book_name }}</div>
                                                    <div class="title">{{ $bookInfo->name }}</div>
                                                    <div class="desc">Access to 1,000+ Practice Materials</div>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa-light fa-chevron-right"></i>
                                                </div>
                                            </a>
                                            <div class="hover-box"></div>
                                            <div class="hover-box"></div>
                                            <div class="hover-box"></div>
                                            <div class="hover-box"></div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="double-button-group">
                                    <a href="#">Book a Free Class
                                        <i class="fa-classic fa-regular fa-arrow-right"></i>
                                    </a>
                                    <a href="#">see details
                                        <i class="fa-classic fa-regular fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
        @endif
        <div class="shape-1">
            <img src="{{ asset('assets/images/icons/feature-shape1.png') }}" alt="shape1">
        </div>
        <div class="shape-2 rotateme">
            <img src="{{ asset('assets/images/icons/feature-shape2.png') }}" alt="shape2">
        </div>
        </section>
    @endif


    @if ($section->section_type == 'mentor' && $section->is_active == 1)
        <section class="course-design-offer-area" data-background="{{ asset('assets/images/home/course-bg.png') }}">
            <div class="container ed-container-expand">
                <div class="row align-items-center section-title-space">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="section-sub-title">
                            <h6>{{ $section->title }}</h6>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="section_title">
                            <h1>{{ $section->subtitle }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $mentorData = $section->dynamic_data;
                    @endphp
                    @foreach ($mentorData as $mentor)
                        @php
                            $mentor = (object) $mentor;
                            $mentorInfo = App\Mentor::find($mentor->name);
                        @endphp
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="course-design-thumb">
                                <img src="{{ asset('storage') . '/' . (isset($mentor->image) ? $mentor->image : $mentorInfo->image) }}"
                                    alt="offer-video.png">
                                <div class="course-video-icon">

                                    <a class="popup-youtube" href="{{ $mentor->youtube_url }}">
                                        <i class="fa-solid fa-play"></i>
                                    </a>

                                </div>
                                <div class="contents">
                                    <h4> {{ $mentorInfo->name }} </h4>
                                    <p>{{ $mentor->bio }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="select-course-btn">
                            <a href="#" class="common-btn-design">Select Your Class
                                <span class="icon"><i class="fa-classic fa-regular fa-arrow-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif





    @if ($section->section_type == 'batch' && $section->is_active == 1)
        <section class="hsc-main">
            <div class="container ed-container-expand">
                <div class="row align-items-center section-title-space">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="section-sub-title">
                            <h6>{{ $section->title }}</h6>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="section_title">
                            <h1>{{ $section->subtitle }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $batchData = $section->dynamic_data;
                    @endphp

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="hsc-slider-parent">
                            <div class="swiper hsc-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($batchData as $batch)
                                        @php
                                            $batch = (object) $batch;
                                            $batchInfo = App\Batchpackage::find($batch->batch_id);
                                        @endphp
                                        <div class="swiper-slide">
                                            <div class="single-slide">
                                                <a href="#"></a>
                                                <div class="image-box">
                                                    <img src="{{ asset('storage') . '/' . (isset($batch->image) ? $batch->image : $batchInfo->image) }}"
                                                        alt="icon">
                                                </div>
                                                <div class="title">{{ $batchInfo->plan }}</div>
                                                <div class="see-more">
                                                    see details <i class="fa-classic fa-regular fa-arrow-right"></i>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape">
                <img src="{{ asset('assets/images/icons/hero-cricle-shape.png') }}" alt="shape">
            </div>
            <div class="shape-2">
                <img src="{{ asset('assets/images/icons/brand-arrow.png') }}" alt="shape2">
            </div>
        </section>
    @endif

    @if ($section->section_type == 'testimonial' && $section->is_active == 1)
        <section class="testimonial-main">
            <div class="container ed-container-expand">
                <div class="row align-items-center section-title-space">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="section-sub-title">
                            <h6>{{ $section->title }}</h6>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="section_title">
                            <h1>{{ $section->subtitle }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $testimonialData = $section->dynamic_data;
                    @endphp
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="testimonial-slider-wrapper">
                            <div class="swiper testimonial-slider">
                                <div class="swiper-wrapper">

                                    {{-- [{"problem_id": "6", "review_data": {"id": 6, "name": "Estiuk Ahammed Bhuiyan", "photo": "lc_imageHhtIUfKyp0oqNJB1.jpg", "review": "# বিপ্লব ভাই: আমার দেখা সবচেয়ে ডেডিকেটেড টিচার।। কোন ননমেডিকেল ও যদি উনার ক্লাস করে তবে ওরাও মেডিকেলের বইকে ক্লাস ওয়ানের  অ আ ক খ মনে করবে।। এত সহজ এবং প্রানবন্ত পড়াশুনা\r\n\r\n# কো অরডিনেটরস: ভাইয়ারা এত এত সহজ ভাবে মোটিভেট করেন যে,\r\n \"হতাশা\" উনাদের চেহারা দেখলেই পালাবে\r\n\r\n# পিউর বেসিকের একটা বিশাল অংশ জুড়ে থাকবে অফিস সহকারীরা।। অনেক বেশী হেল্পফুল।।\r\n\r\nইনশাল্লাহ একদিন দেশের অনেক ডেন্টাল কলেজের বিভাগীয় প্রধানরা নতুনদের পিওরবেসিকের গল্প দিয়ে মেডিকেলের ক্লাস শুরু করাবে।।।", "status": 1, "created_at": "2020-07-18 02:38:08", "updated_at": null}}, {"problem_id": "9", "review_data": {"id": 9, "name": "Jasmin Akther", "photo": "lc_imageoWyEF0LiAXfSW4A6.jpg", "review": "Pure basic is all about basic study;inspiration;hardworking and success...teaching process of dr.sarwer.biplob is outstanding...  Everyone in pure basic family are so friendly and helpful.  Many many blessings for pure basic group...", "status": 1, "created_at": "2020-07-18 02:49:13", "updated_at": null}}, {"problem_id": "11", "review_data": {"id": 11, "name": "Mashrufa Akhter Disha", "photo": "lc_imagezKL5sMrTWycf2ngI.jpg", "review": "Owner of Pure Basic,Sarwar Biplob vya is an ingenious and dedicated person,possesses excellent teaching ability which  makes him different from others.Best wishes for our mentor and pure basic team.", "status": 1, "created_at": "2020-07-18 02:52:29", "updated_at": null}}] --}}
                                    @foreach ($testimonialData as $data)
                                        @php
                                            $data = (object) $data;
                                            $data->review_data = (object) $data->review_data;
                                        @endphp
                                        <div class="swiper-slide">
                                            <div class="single-slide">
                                                <div class="commentor">
                                                    <div class="icon">
                                                        <img src="{{ asset('assets/images/') . '/' . $data->review_data->photo }}"
                                                            alt="author-1.webp">
                                                    </div>
                                                    <div class="details">
                                                        <div class="name">{{ $data->review_data->name }}</div>
                                                        <div class="desig">Teaching Assistant, Brac University</div>
                                                    </div>
                                                </div>
                                                <div class="comments">“ {{ $data->review_data->review }}”

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                                <div class="swiper-button-prev"><i class="fa fa-arrow-left"></i></div>
                                <div class="swiper-button-next"><i class="fa fa-arrow-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($section->section_type == 'batch_category' && $section->is_active == 1)
        <section class="skill-development-main" data-background="{{ asset('assets/images/home/skill.png') }}">
            <div class="container ed-container-expand">
                <div class="row align-items-center section-title-space">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="section-sub-title">
                            <h6>{{ $section->title }}</h6>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="section_title">
                            <h1>{{ $section->subtitle }}</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php
                        $batchCategoryData = $section->dynamic_data;
                    @endphp
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="skill-list-box">
                            <ul>
                                <li><i class="fa-light fa-circle-check"></i> The country’s best teacher</li>
                                <li><i class="fa-light fa-circle-check"></i> 500,000+ students</li>
                                <li><i class="fa-light fa-circle-check"></i> 70+ online courses</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="skill-slider-parent">
                            <div class="swiper skill-tab-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($batchCategoryData as $data)
                                        @php
                                            $data = (object) $data;
                                            $data->batch_category_data = (object) $data->batch_category_data;
                                        @endphp
                                        <div class="swiper-slide">
                                            <div class="single-skill-tab active">
                                                <div class="name">{{ $data->batch_category_data->name }}</div>
                                                <div class="course-count">20 Courses</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev"><i class="fa fa-arrow-left"></i></div>
                                <div class="swiper-button-next"><i class="fa fa-arrow-right"></i></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="linked-course-parent">
                            <div class="swiper linked-course-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="single-slide">
                                            <a href="#"></a>
                                            <div class="image-box">
                                                <img src="{{ asset('assets/images/home/hsc.jpeg') }}" alt="icon">
                                            </div>
                                            <div class="title">Business Innovation And Development</div>
                                            <p>Farabi Hafiz</p>
                                            <div class="see-more">
                                                see details <i class="fa-classic fa-regular fa-arrow-right"></i>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="swiper-button-prev"><i class="fa fa-arrow-left"></i></div>
                            <div class="swiper-button-next"><i class="fa fa-arrow-right"></i></div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
                <div class="row">
                    <div class="col-12">
                        <div class="show-all-courese">
                            <a href="#" class="common-btn-design">See all Courses
                                <span class="icon"><i class="fa-classic fa-regular fa-arrow-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @endif
    @if ($section->section_type == 'notice' && $section->is_active == 1)
        <section class="marquee-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="marquee">
                            <div class="marquee-block">
                                @foreach ($section->dynamic_data as $data)
                                        @php
                                            $data = (object) $data;
                                            $data->notice_data = (object) $data->notice_data;
                                        @endphp
                                <h3>
                                    <span>
                                        <img src="{{ asset('assets/images/icons/marquee-icon.png') }}" alt="icon">
                                    </span>
                                    {{$data->notice_data->notice}}
                                </h3>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if ($section->section_type == 'design_static' && $section->is_active == 1)
        <section class="counter-main">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                        <div class="left-box">
                            <h2>Advantages of our program</h2>
                            <div class="counter-grid-parent">
                                <div class="single-counter-box">
                                    <div class="icon">
                                        <img src="{{ asset('assets/images/icons/31.png') }}" alt="">
                                    </div>
                                    <div class="title">Students Enrolled</div>
                                    <div class="count" data-count="1000">1000+</div>
                                </div>
                                <div class="single-counter-box">
                                    <div class="icon">
                                        <img src="{{ asset('assets/images/icons/32.png') }}" alt="">
                                    </div>
                                    <div class="title">Certified Teachers</div>
                                    <div class="count" data-count="300">300+</div>
                                </div>
                                <div class="single-counter-box">
                                    <div class="icon">
                                        <img src="{{ asset('assets/images/icons/33.png') }}" alt="">
                                    </div>
                                    <div class="title">Premium Courses</div>
                                    <div class="count" data-count="100">100+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                        <div class="right-box">
                            <div class="right-box-inner">
                                <h2>The worlds best online education institude</h2>
                                <a class="" href="#">Explore More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @endforeach
@endsection

@section('js')
    <script>
        // code fwhere a seconde word of a linek get a extra color active color
        document.addEventListener('DOMContentLoaded', function() {
            const element = document.querySelector('#heroTitle');

            const words = element.textContent.trim().split(' ');

            if (words.length > 1) {
                const secondWord = words[1];
                const restOfText = words.slice(2).join(' ');

                element.innerHTML = `${words[0]} <span class="active-color">${secondWord}</span> ${restOfText}`;
            }
        });
    </script>
@endsection

@extends('layouts.register')



@section('content')
    @php
        $sections = \App\HomeSection::orderBy('order_num')->get();
    @endphp

    @foreach ($sections as $section)
        {{-- @if ($section->section_type == 'hero_slider' && $section->is_active == 1)
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
                                    <a href="{{ $section->primary_link }}">find courses
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
        @endif --}}


        @if ($section->section_type == 'hero_slider' && $section->is_active == 1)
        <section class="home-banner-main" data-background="{{ asset('assets/images/home/hero-bg.png') }}">
            <div class="container ed-container-expand">
                <div class="row">
                    <!-- Left Side: Main Title, Subtitle & Primary Button (shown once for all slides) -->
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="title-box">
                            <h1 id="heroTitle">
                                {{ $section->title }}
                            </h1>
                            <p>
                                {{ $section->subtitle ?? '' }}
                            </p>
                            <div class="banner-btn">
                                <a href="{{ $section->primary_link ?? '#' }}">
                                    find courses
                                    <span class="icon"><i class="fa-classic fa-regular fa-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
        
                    <!-- Right Side: Dynamic Swiper Slider -->
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="banner-slider-wrapper">
                            <div class="swiper home-banner-slider">
                                <div class="swiper-wrapper">
        
                                    @forelse ($section->dynamic_data ?? [] as $slideIndex => $slide)
        
                                    <div class="swiper-slide">
                                        <div class="banner-parent-box bg-1">
        
                                            <!-- Top Badge (e.g., "Online Course") -->
                                            <div class="box-title">
                                                {{ $slide['promotion_title'] ?? 'Online Course' }}
                                            </div>
        
                                            <!-- Main Heading of the Slide -->
                                            <div class="heading">
                                                {{ $slide['title'] ?? 'Admission is open for all courses in Online Batch 2025!'
                                                }}
                                            </div>
        
                                            <!-- 4 Course/Custom Cards Grid -->
                                            <div class="course-grid-parent">
        
                                                @php
                                                $items = $slide['items'] ?? [];
                                                $itemCount = count($items);
                                                $maxItems = 4; // Always show 4 cards (fill empty with hidden placeholders)
                                                @endphp
        
                                                @foreach ($items as $item)
                                                <div class="single-course">
                                                    <a href="{{ $item['type'] === 'course' ? ($item['course_link'] ?? '#') : ($item['custom_link'] ?? '#') }}"
                                                        target="_blank">
                                                        <div class="inner-wrapper">
                                                            <div class="icon">
                                                                <img src="{{ 
                                                                    isset($item['image']) 
                                                                        ? asset('storage/' . $item['image']) 
                                                                        : asset('assets/images/home/s.jpeg') 
                                                                }}" alt="{{ $item['course_name'] ?? $item['custom_name'] ?? 'Course' }}"
                                                                    class="img-fluid">
                                                            </div>
                                                            <div class="text">
                                                                @if ($item['type'] === 'course')
                                                                {{ $item['course_name'] ?? 'Course Name' }}
                                                                @else
                                                                {{ $item['custom_name'] ?? 'Custom Course' }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                @endforeach
        
                                                <!-- Fill remaining slots with invisible placeholders to maintain grid layout -->
                                                @for ($i = $itemCount; $i < $maxItems; $i++) <div
                                                    class="single-course opacity-0 pointer-events-none">
                                                    <div class="inner-wrapper">
                                                        <div class="icon">
                                                            <img src="{{ asset('assets/images/home/s.jpeg') }}" alt="">
                                                        </div>
                                                        <div class="text">Placeholder</div>
                                                    </div>
                                            </div>
                                            @endfor
        
                                        </div>
        
                                        <!-- Bottom Enroll Link -->
                                        <div class="enroll-link">
                                            <a href="{{ $slide['enroll_link'] ?? '#' }}">
                                                {{ $slide['enroll_text'] ?? 'Click to enroll in 30+ free courses' }}
                                                <i class="fa-classic fa-regular fa-arrow-right"></i>
                                            </a>
                                        </div>
        
                                    </div>
                                </div>
        
                                @empty
                                <!-- Fallback: If no slides in database, show one default slide -->
                                <div class="swiper-slide">
                                    <div class="banner-parent-box bg-1">
                                        <div class="box-title">Online Course</div>
                                        <div class="heading">Admission is open for all courses in Online Batch 2025!</div>
                                        <div class="course-grid-parent">
                                            @for ($i = 0; $i < 4; $i++) <div class="single-course">
                                                <a href="#">
                                                    <div class="inner-wrapper">
                                                        <div class="icon">
                                                            <img src="{{ asset('assets/images/home/s.jpeg') }}" alt="course">
                                                        </div>
                                                        <div class="text">Class 6,7,8</div>
                                                    </div>
                                                </a>
                                        </div>
                                        @endfor
                                    </div>
                                    <div class="enroll-link">
                                        <a href="#">Click to enroll in 30+ free courses <i
                                                class="fa-classic fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforelse
        
                        </div>
        
                        <!-- Swiper Pagination (dots) -->
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
                                    <a href="{{ $section->primary_link }}">see details
                                        <i class="fa-classic fa-regular fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
        @endif
        @if ($section->section_type == 'locations')
            <div class="shape-1">
                <img src="{{ asset('assets/images/icons/feature-shape1.png') }}" alt="shape1">
            </div>
            <div class="shape-2 rotateme">
                <img src="{{ asset('assets/images/icons/feature-shape2.png') }}" alt="shape2">
            </div>
        @endif
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
                            <a href="{{ $section->primary_link }}" class="common-btn-design">Select Your Class
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
                                        @if ($batchInfo)
                                            <div class="swiper-slide">
                                                <div class="single-slide">
                                                    <a href="{{ url('/batches/category/') . '/' . $batchInfo->id }}">

                                                    </a>
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
                                        @endif
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


                                    @foreach ($testimonialData as $data)
                                    
                                        @php
                                            $data = (object) $data;
                                            $data->review_data = (object) $data->review_data;
                                        @endphp
                                        <div class="swiper-slide">
                                            <div class="single-slide">
                                                <div class="commentor">
                                                    <div class="icon">
                                                        <img src="{{ asset('storage/') . '/' . $data->image }}"
                                                            alt="author-1.webp">
                                                    </div>
                                                    <div class="details">
                                                        <div class="name">{{ $data->review_data->name }}</div>
                                                        <div class="desig">
                                                            {{ $data->review_data->designation ?? ' ' }}

                                                        </div>
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
                                    @php
                                        $first = true; // Flag to track the first iteration for active class
                                        $firstCategory = null;
                                    @endphp
                                    @foreach ($batchCategoryData as $data)
                                        @php
                                            $data = (object) $data;
                                            $data->batch_category_data = (object) $data->batch_category_data;
                                            if ($first) {
                                                $firstCategory = $data->batch_category_data;
                                            }

                                        @endphp
                                        <div class="swiper-slide"
                                            onclick="fetchCategoryCourse({{ $data->batch_category_data->id }})">
                                            <div
                                                class="single-skill-tab {{ $first ? 'active' : '' }} single-skill-tab-{{ $data->batch_category_data->id }}">
                                                <div class="name">{{ $data->batch_category_data->name }}</div>
                                                <div class="course-count">
                                                    {{ $data->batch_category_data->total_course ?? 0 }} Courses</div>
                                                {{-- Assuming $data has courses;
                                    adjust if needed --}}
                                            </div>
                                        </div>

                                        @php
                                            $first = false; // Set flag to false after first iteration
                                        @endphp
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
                                <div class="swiper-wrapper" id="swiper-category-wrapper">



                                </div>
                                <div class="swiper-button-prev"><i class="fa fa-arrow-left"></i></div>
                                <div class="swiper-button-next"><i class="fa fa-arrow-right"></i></div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="show-all-courese">
                            <a href="{{ $section->primary_link }}" class="common-btn-design">See all Courses
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
                                            <img src="{{ asset('assets/images/icons/marquee-icon.png') }}"
                                                alt="icon">
                                        </span>
                                        {{ $data->notice_data->notice }}
                                    </h3>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if ($section->section_type == 'static_design' && $section->is_active == 1)

    @php
                        $static_design = $section->dynamic_data;
                    @endphp
        <section class="counter-main">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                        <div class="left-box">
                            <h2>{{ $section->title }}</h2>
                            <div class="counter-grid-parent">
                                <div class="single-counter-box">
                                    <div class="icon">
                                        <img src="{{ asset('assets/images/icons/31.png') }}" alt="">
                                    </div>
                                    @if(isset($static_design) && count($static_design))
                                    <div class="title">{{$static_design[0]['type']}}</div>
                                    <div class="count" data-count="{{$static_design[0]['label']}}">{{$static_design[0]['label']}}+</div>
                                    @endif
                                </div>
                                <div class="single-counter-box">
                                    <div class="icon">
                                        <img src="{{ asset('assets/images/icons/32.png') }}" alt="">
                                    </div>
                                    @if(isset($static_design) && count($static_design))
                                    <div class="title">{{$static_design[1]['type']}}</div>
                                    <div class="count" data-count="{{$static_design[1]['label']}}">{{$static_design[1]['label']}}+</div>
                                    @endif
                                </div>
                                <div class="single-counter-box">
                                    <div class="icon">
                                        <img src="{{ asset('assets/images/icons/33.png') }}" alt="">
                                    </div>
                                    @if(isset($static_design) && count($static_design))
                                    <div class="title">{{$static_design[2]['type']}}</div>
                                    <div class="count" data-count="{{$static_design[2]['label']}}">{{$static_design[2]['label']}}+</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                        <div class="right-box">
                            <div class="right-box-inner">
                                <h2>{{ $section->subtitle }}</h2>
                                <a class="" href="{{ $section->primary_link }}">Explore More</a>
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

        function fetchCategoryCourse(batch_category) {
            // Get CSRF token from meta tag (standard Laravel setup)
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            // AJAX GET request with CSRF header
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'appliction/json'
                }
            });

            $.get("{{ route('web.search') }}", {
                    batch_category: batch_category
                })
                .done(function(data) {
                    // Assuming data is HTML or structured content for the swiper
                    // Update the swiper wrapper with the fetched content
                    $('#swiper-category-wrapper').html(data);

                    $('.single-skill-tab').removeClass('active');
                    $('.single-skill-tab-' + batch_category).addClass('active');
                    var swiper = new Swiper('#linked-course-slider', {
                        // Your swiper config here, e.g.,
                        slidesPerView: 3,
                        spaceBetween: 30,
                        // etc.
                    });
                })
                .fail(function(xhr, status, error) {
                    console.error('Error fetching courses:', error);
                    // Handle error, e.g., show a message
                    $('#swiper-category-wrapperid').html('<p>Error loading courses. Please try again.</p>');
                });
        }


        @if ($firstCategory)

            fetchCategoryCourse({{ $firstCategory->id }})
        @endif
    </script>
@endsection

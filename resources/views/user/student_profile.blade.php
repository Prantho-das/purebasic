@extends('layouts.register')

@section('content')

    {{-- Page-specific stylesheet --}}
    <link rel="stylesheet" href="{{ asset('assets/css/student-profile.css') }}">

    <div class="student-profile-page">

        {{-- ══════════════════════════════════
             PROFILE COVER HERO
        ══════════════════════════════════ --}}
        <div class="profile-cover">
            <div class="container">
                <div class="profile-cover-inner">

                    {{-- Avatar (clicking camera opens Settings tab) --}}
                    <div class="profile-avatar-wrap">
                        <img src="{{ $profile->photo }}" alt="{{ $profile->name }}" class="profile-avatar" id="coverAvatarImg">
                        <div class="avatar-edit-badge" id="avatarEditBadge" title="Change photo">
                            <i class="fa-regular fa-camera"></i>
                        </div>
                    </div>

                    {{-- Name + meta --}}
                    <div class="profile-cover-meta">
                        <h1 class="profile-name">{{ $profile->name ?? 'Student' }}</h1>

                        @if ($profile->position || $profile->qualification)
                            <span class="profile-position-badge">
                                {{ implode(' · ', array_filter([$profile->position, $profile->qualification])) }}
                            </span>
                        @endif

                        <div class="profile-cover-contacts">
                            @if ($profile->email)
                                <span class="contact-pill">
                                    <i class="fa-regular fa-envelope"></i> {{ $profile->email }}
                                </span>
                            @endif
                            @if ($profile->mobile)
                                <span class="contact-pill">
                                    <i class="fa-regular fa-phone"></i> {{ $profile->mobile }}
                                </span>
                            @endif
                            @if ($profile->address)
                                <span class="contact-pill">
                                    <i class="fa-regular fa-location-dot"></i> {{ $profile->address }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Action buttons --}}
                    <div class="profile-cover-actions">
                        <button class="btn-edit-profile" id="btnEditProfile">
                            <i class="fa-regular fa-pen-to-square"></i> Edit Profile
                        </button>
                        <a href="/student/logout" class="btn-logout-profile">
                            <i class="fa-regular fa-arrow-right-from-bracket"></i> Logout
                        </a>
                    </div>

                </div>{{-- /profile-cover-inner --}}

                {{-- Tab bar — data-tab controls which panel shows --}}
                <div class="profile-tab-bar" id="profileTabBar">
                    <a href="#" class="profile-tab-item active" data-tab="overview">
                        <i class="fa-regular fa-grid-2"></i> Overview
                    </a>
                    <a href="#" class="profile-tab-item" data-tab="personal">
                        <i class="fa-regular fa-user"></i> Personal
                    </a>
                    <a href="#" class="profile-tab-item" data-tab="academic">
                        <i class="fa-regular fa-graduation-cap"></i> Academic
                    </a>
                    <a href="#" class="profile-tab-item" data-tab="courses">
                        <i class="fa-regular fa-book-open"></i> My Courses
                    </a>
                    <a href="#" class="profile-tab-item" data-tab="analytics">
                        <i class="fa-regular fa-chart-mixed"></i> Analytics
                    </a>
                    <a href="#" class="profile-tab-item" data-tab="settings" id="tabSettings">
                        <i class="fa-regular fa-gear"></i> Settings
                    </a>
                </div>
            </div>
        </div>{{-- /profile-cover --}}


        {{-- ══════════════════════════════════
             PROFILE BODY — TAB PANELS
        ══════════════════════════════════ --}}
        <div class="profile-body">
            <div class="container">

                @if (session()->has('profile'))
                    <div class="profile-success-alert">
                        <i class="fa-regular fa-circle-check"></i>
                        Profile updated successfully!
                    </div>
                @endif

                {{-- ─────────────────────────────
                     PANEL: Overview (default visible)
                ───────────────────────────── --}}
                <div class="tab-panel" id="panel-overview">
                    <div class="row">

                        {{-- Left sidebar --}}
                        <div class="col-lg-4 col-md-12">

                            {{-- Quick Overview --}}
                            <div class="profile-card profile-overview-card">
                                <div class="profile-card-header">
                                    <div class="card-header-icon"><i class="fa-regular fa-id-card"></i></div>
                                    <h5>Quick Overview</h5>
                                </div>
                                <div class="profile-card-body">

                                    @if ($profile->student_id)
                                        <div class="overview-stat">
                                            <div class="overview-stat-icon"><i class="fa-regular fa-hashtag"></i></div>
                                            <div class="overview-stat-text">
                                                <div class="stat-label">Student ID</div>
                                                <div class="stat-value">{{ $profile->student_id }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="overview-stat">
                                        <div class="overview-stat-icon"><i class="fa-regular fa-user-check"></i></div>
                                        <div class="overview-stat-text">
                                            <div class="stat-label">Account Status</div>
                                            <div class="stat-value">
                                                @if ($profile->status == 1)
                                                    <span class="profile-status-badge badge-active"><span
                                                            class="dot"></span> Active</span>
                                                @elseif($profile->is_approve == 0)
                                                    <span class="profile-status-badge badge-pending"><span
                                                            class="dot"></span> Pending</span>
                                                @else
                                                    <span class="profile-status-badge badge-inactive"><span
                                                            class="dot"></span> Inactive</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="overview-stat">
                                        <div class="overview-stat-icon"><i class="fa-regular fa-calendar-plus"></i></div>
                                        <div class="overview-stat-text">
                                            <div class="stat-label">Member Since</div>
                                            <div class="stat-value">
                                                {{ $profile->created_at ? \Carbon\Carbon::parse($profile->created_at)->format('M d, Y') : '—' }}
                                            </div>
                                        </div>
                                    </div>

                                    @if ($profile->whatsapp_number)
                                        <div class="overview-stat">
                                            <div class="overview-stat-icon"><i class="fa-brands fa-whatsapp"></i></div>
                                            <div class="overview-stat-text">
                                                <div class="stat-label">WhatsApp</div>
                                                <div class="stat-value">{{ $profile->whatsapp_number }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($profile->fb)
                                        <div class="overview-stat">
                                            <div class="overview-stat-icon"><i class="fa-brands fa-facebook-f"></i></div>
                                            <div class="overview-stat-text">
                                                <div class="stat-label">Facebook</div>
                                                <div class="stat-value">
                                                    <a href="{{ $profile->fb }}" target="_blank" rel="noopener">View
                                                        Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($profile->country)
                                        <div class="overview-stat">
                                            <div class="overview-stat-icon"><i class="fa-regular fa-globe"></i></div>
                                            <div class="overview-stat-text">
                                                <div class="stat-label">Country</div>
                                                <div class="stat-value">{{ $profile->country }}</div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($profile->taka)
                                        <div class="overview-stat">
                                            <div class="overview-stat-icon"><i class="fa-regular fa-wallet"></i></div>
                                            <div class="overview-stat-text">
                                                <div class="stat-label">Wallet Balance</div>
                                                <div class="stat-value">৳ {{ number_format($profile->taka) }}</div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>{{-- /quick overview --}}

                        </div>{{-- /col-lg-4 --}}

                        {{-- Right main --}}
                        <div class="col-lg-8 col-md-12">

                            {{-- Personal snapshot --}}
                            <div class="profile-card">
                                <div class="profile-card-header">
                                    <div class="card-header-icon"><i class="fa-regular fa-user"></i></div>
                                    <h5>Personal Information</h5>
                                    <a href="#" class="card-header-meta profile-tab-link" data-tab="personal"
                                        style="color:#02b3e4;font-weight:600">View all →</a>
                                </div>
                                <div class="profile-card-body">
                                    <div class="profile-info-grid">

                                        <div class="profile-info-item">
                                            <span class="info-label">Full Name</span>
                                            <span
                                                class="info-value {{ empty($profile->name) ? 'info-value--empty' : '' }}">{{ $profile->name ?? 'Not provided' }}</span>
                                        </div>

                                        <div class="profile-info-item">
                                            <span class="info-label">Email Address</span>
                                            <span
                                                class="info-value {{ empty($profile->email) ? 'info-value--empty' : '' }}">{{ $profile->email ?? 'Not provided' }}</span>
                                        </div>

                                        <div class="profile-info-item">
                                            <span class="info-label">Phone Number</span>
                                            <span
                                                class="info-value {{ empty($profile->mobile) ? 'info-value--empty' : '' }}">{{ $profile->mobile ?? 'Not provided' }}</span>
                                        </div>

                                        <div class="profile-info-item">
                                            <span class="info-label">Gender</span>
                                            <span
                                                class="info-value {{ empty($profile->gender) ? 'info-value--empty' : '' }}">{{ $profile->gender ?? 'Not provided' }}</span>
                                        </div>

                                        <div class="profile-info-item">
                                            <span class="info-label">Date of Birth</span>
                                            <span
                                                class="info-value {{ empty($profile->birth) ? 'info-value--empty' : '' }}">{{ $profile->birth ?? 'Not provided' }}</span>
                                        </div>

                                        <div class="profile-info-item">
                                            <span class="info-label">Country</span>
                                            <span
                                                class="info-value {{ empty($profile->country) ? 'info-value--empty' : '' }}">{{ $profile->country ?? 'Not provided' }}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Courses snapshot --}}
                            @php
                                $totalCourses = 0;
                                foreach ($courses as $chunk) {
                                    foreach ($chunk as $c) {
                                        if (!empty($c->course)) {
                                            $totalCourses++;
                                        }
                                    }
                                }
                            @endphp
                            <div class="profile-card">
                                <div class="profile-card-header">
                                    <div class="card-header-icon"><i class="fa-regular fa-book-open"></i></div>
                                    <h5>My Courses</h5>
                                    <span class="card-header-meta">{{ $totalCourses }} enrolled</span>
                                    <a href="#" class="profile-tab-link" data-tab="courses"
                                        style="color:#02b3e4;font-weight:600;font-size:12px;margin-left:12px">View all
                                        →</a>
                                </div>
                                <div class="profile-card-body">
                                    @if ($totalCourses === 0)
                                        <div class="profile-empty-state">
                                            <i class="fa-regular fa-folder-open"></i>
                                            <p>No enrollments yet. <a href="/batches/category/1">Browse courses</a>.</p>
                                        </div>
                                    @else
                                        {{-- Show first 2 courses only in overview --}}
                                        @php $shownCount = 0; @endphp
                                        @foreach ($courses as $chunk)
                                            @foreach ($chunk as $course)
                                                @if (!empty($course->course) && $shownCount < 2)
                                                    @php $shownCount++; @endphp
                                                    <div class="enrolled-course-item">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <p class="course-title">{{ $course->course->plan }}</p>
                                                            @if ($course->enroll_status == 1)
                                                                <span class="profile-status-badge badge-active"
                                                                    style="flex-shrink:0;margin-left:8px"><span
                                                                        class="dot"></span> Active</span>
                                                            @elseif($course->enroll_status == 0)
                                                                <span class="profile-status-badge badge-pending"
                                                                    style="flex-shrink:0;margin-left:8px"><span
                                                                        class="dot"></span> Pending</span>
                                                            @else
                                                                <span class="profile-status-badge badge-inactive"
                                                                    style="flex-shrink:0;margin-left:8px"><span
                                                                        class="dot"></span> Inactive</span>
                                                            @endif
                                                        </div>
                                                        <p class="course-graduation">{{ $course->course->graduation }}</p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        @if ($totalCourses > 2)
                                            <p style="text-align:center;font-size:12px;color:#6c757d;margin-top:8px">
                                                + {{ $totalCourses - 2 }} more &nbsp;
                                                <a href="#" class="profile-tab-link" data-tab="courses"
                                                    style="color:#02b3e4;font-weight:600">View all courses →</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>{{-- /col-lg-8 --}}
                    </div>{{-- /row --}}
                </div>{{-- /panel-overview --}}


                {{-- ─────────────────────────────
                     PANEL: Personal Information
                ───────────────────────────── --}}
                <div class="tab-panel" id="panel-personal" style="display:none">
                    <div class="profile-card">
                        <div class="profile-card-header">
                            <div class="card-header-icon"><i class="fa-regular fa-user"></i></div>
                            <h5>Personal Information</h5>
                            <button class="card-header-meta profile-tab-link btn-link-plain" data-tab="settings"
                                style="color:#02b3e4;font-weight:600;cursor:pointer">
                                <i class="fa-regular fa-pen-to-square"></i> Edit
                            </button>
                        </div>
                        <div class="profile-card-body">
                            <div class="profile-info-grid">

                                <div class="profile-info-item">
                                    <span class="info-label">Full Name</span>
                                    <span
                                        class="info-value {{ empty($profile->name) ? 'info-value--empty' : '' }}">{{ $profile->name ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Email Address</span>
                                    <span
                                        class="info-value {{ empty($profile->email) ? 'info-value--empty' : '' }}">{{ $profile->email ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Phone Number</span>
                                    <span
                                        class="info-value {{ empty($profile->mobile) ? 'info-value--empty' : '' }}">{{ $profile->mobile ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">WhatsApp</span>
                                    <span
                                        class="info-value {{ empty($profile->whatsapp_number) ? 'info-value--empty' : '' }}">{{ $profile->whatsapp_number ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Date of Birth</span>
                                    <span
                                        class="info-value {{ empty($profile->birth) ? 'info-value--empty' : '' }}">{{ $profile->birth ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Gender</span>
                                    <span
                                        class="info-value {{ empty($profile->gender) ? 'info-value--empty' : '' }}">{{ $profile->gender ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Country</span>
                                    <span
                                        class="info-value {{ empty($profile->country) ? 'info-value--empty' : '' }}">{{ $profile->country ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Address</span>
                                    <span
                                        class="info-value {{ empty($profile->address) ? 'info-value--empty' : '' }}">{{ $profile->address ?? 'Not provided' }}</span>
                                </div>

                                @if ($profile->fb)
                                    <div class="profile-info-item">
                                        <span class="info-label">Facebook</span>
                                        <span class="info-value">
                                            <a href="{{ $profile->fb }}" target="_blank" rel="noopener">
                                                <i class="fa-brands fa-facebook-f"></i> View Profile
                                            </a>
                                        </span>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>{{-- /panel-personal --}}


                {{-- ─────────────────────────────
                     PANEL: Academic & Professional
                ───────────────────────────── --}}
                <div class="tab-panel" id="panel-academic" style="display:none">
                    <div class="profile-card">
                        <div class="profile-card-header">
                            <div class="card-header-icon"><i class="fa-regular fa-graduation-cap"></i></div>
                            <h5>Academic &amp; Professional</h5>
                            <button class="card-header-meta profile-tab-link btn-link-plain" data-tab="settings"
                                style="color:#02b3e4;font-weight:600;cursor:pointer">
                                <i class="fa-regular fa-pen-to-square"></i> Edit
                            </button>
                        </div>
                        <div class="profile-card-body">
                            <div class="profile-info-grid">

                                <div class="profile-info-item">
                                    <span class="info-label">Title / Position</span>
                                    <span
                                        class="info-value {{ empty($profile->position) ? 'info-value--empty' : '' }}">{{ $profile->position ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Qualification / Degree</span>
                                    <span
                                        class="info-value {{ empty($profile->qualification) ? 'info-value--empty' : '' }}">{{ $profile->qualification ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Medical College</span>
                                    <span
                                        class="info-value {{ empty($profile->medical) ? 'info-value--empty' : '' }}">{{ $profile->medical ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">BMDC Registration</span>
                                    <span
                                        class="info-value {{ empty($profile->BMDC) ? 'info-value--empty' : '' }}">{{ $profile->BMDC ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Batch Year</span>
                                    <span
                                        class="info-value {{ empty($profile->batch) ? 'info-value--empty' : '' }}">{{ $profile->batch ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Session</span>
                                    <span
                                        class="info-value {{ empty($profile->sessionn) ? 'info-value--empty' : '' }}">{{ $profile->sessionn ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Level / Year</span>
                                    <span
                                        class="info-value {{ empty($profile->levell) ? 'info-value--empty' : '' }}">{{ $profile->levell ?? 'Not provided' }}</span>
                                </div>

                                @if ($profile->taka)
                                    <div class="profile-info-item">
                                        <span class="info-label">Wallet Balance</span>
                                        <span class="info-value">৳ {{ number_format($profile->taka) }}</span>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>{{-- /panel-academic --}}


                {{-- ─────────────────────────────
                     PANEL: My Courses
                ───────────────────────────── --}}
                <div class="tab-panel" id="panel-courses" style="display:none">
                    <div class="profile-card">
                        <div class="profile-card-header">
                            <div class="card-header-icon"><i class="fa-regular fa-book-open"></i></div>
                            <h5>My Courses</h5>
                            <span class="card-header-meta">{{ $totalCourses }} enrolled</span>
                        </div>
                        <div class="profile-card-body">

                            @if ($totalCourses === 0)
                                <div class="profile-empty-state">
                                    <i class="fa-regular fa-folder-open"></i>
                                    <p>No enrollments yet.<br>
                                        Browse <a href="/batches/category/1">available courses</a>.
                                    </p>
                                </div>
                            @else
                                @foreach ($courses as $chunk)
                                    @foreach ($chunk as $course)
                                        @if (!empty($course->course))
                                            @php
                                                $endStr = substr($course->subscription_end, 0, 10);
                                                $endNum = (int) $endStr;
                                                $remaining = 0;
                                                $totalDays = 365;
                                                $usedPct = 0;

                                                if ($course->enroll_status == 1 && $endNum > 0) {
                                                    $end = new DateTime($endStr);
                                                    $current = new DateTime(date('Y-m-d'));
                                                    $remaining = (int) $end->diff($current)->format('%a');
                                                    $usedPct = max(
                                                        0,
                                                        min(100, round((($totalDays - $remaining) / $totalDays) * 100)),
                                                    );
                                                }

                                                $daysClass =
                                                    $remaining <= 7
                                                        ? 'critical'
                                                        : ($remaining <= 15
                                                            ? 'warning'
                                                            : 'good');
                                            @endphp

                                            <div class="enrolled-course-item">
                                                <div class="d-flex justify-content-between align-items-start mb-1">
                                                    <p class="course-title">{{ $course->course->plan }}</p>
                                                    @if ($course->enroll_status == 1)
                                                        <span class="profile-status-badge badge-active"
                                                            style="margin-left:8px;flex-shrink:0"><span
                                                                class="dot"></span> Active</span>
                                                    @elseif($course->enroll_status == 0)
                                                        <span class="profile-status-badge badge-pending"
                                                            style="margin-left:8px;flex-shrink:0"><span
                                                                class="dot"></span> Pending</span>
                                                    @else
                                                        <span class="profile-status-badge badge-inactive"
                                                            style="margin-left:8px;flex-shrink:0"><span
                                                                class="dot"></span> Inactive</span>
                                                    @endif
                                                </div>

                                                <p class="course-graduation">{{ $course->course->graduation }}</p>

                                                <div class="course-meta-row">
                                                    <span><i class="fa-regular fa-money-bill" style="color:#02b3e4"></i>
                                                        Fees: {{ number_format($course->fees) }}</span>
                                                    <span><i class="fa-regular fa-circle-check" style="color:#1aab61"></i>
                                                        Paid: {{ number_format($course->paid) }}</span>
                                                </div>

                                                @if ($course->enroll_status == 1 && $endNum > 0)
                                                    <div class="course-subscription-bar">
                                                        <div class="sub-bar-fill" style="width: {{ $usedPct }}%">
                                                        </div>
                                                    </div>
                                                    <div class="course-meta-row">
                                                        <span>Ends: {{ $endStr }}</span>
                                                        <span
                                                            class="days-remaining {{ $daysClass }}">{{ $remaining }}d
                                                            left</span>
                                                    </div>
                                                    <div class="course-actions">
                                                        <a href="{{ url('batch/' . $course->batch_id . '/subjects') }}"
                                                            class="course-action-btn btn-lecture"><i
                                                                class="fa-regular fa-play"></i> Lecture</a>
                                                        <a href="{{ url('exam_by_batch', $course->batch_id) }}"
                                                            class="course-action-btn btn-exam"><i
                                                                class="fa-regular fa-file-pen"></i> Exam</a>
                                                        <a href="{{ url('schedule/batch/' . $course->batch_id) }}"
                                                            class="course-action-btn btn-schedule"><i
                                                                class="fa-regular fa-calendar"></i> Schedule</a>
                                                        <a href="{{ url('discussion/batch/' . $course->batch_id) }}"
                                                            class="course-action-btn btn-discussion"><i
                                                                class="fa-regular fa-comments"></i> Discussion</a>
                                                        <a href="{{ url('live/' . $course->batch_id) }}"
                                                            class="course-action-btn btn-live"><i
                                                                class="fa-regular fa-signal-stream"></i> Live</a>
                                                    </div>
                                                @elseif($course->enroll_status == 0)
                                                    <div class="course-actions">
                                                        <a href="{{ url('/payment/' . $course->batch_id) }}"
                                                            class="course-action-btn btn-payment">
                                                            <i class="fa-regular fa-credit-card"></i> Update Payment
                                                        </a>
                                                    </div>
                                                    <p style="font-size:11px;color:#e68900;margin-top:8px;margin-bottom:0">
                                                        <i class="fa-regular fa-clock"></i> Awaiting approval (up to 24
                                                        hrs)
                                                    </p>
                                                @else
                                                    <p style="font-size:11px;color:#d32f2f;margin-top:4px;margin-bottom:0">
                                                        <i class="fa-regular fa-triangle-exclamation"></i> Contact support
                                                        via WhatsApp
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>{{-- /panel-courses --}}


                {{-- ─────────────────────────────
                     PANEL: Analytics
                ───────────────────────────── --}}
                <div class="tab-panel" id="panel-analytics" style="display:none">

                    {{-- ── Lecture Progress ───────────────────────── --}}
                    @if (!empty($lectureAnalytics))
                        <div class="profile-card">
                            <div class="profile-card-header">
                                <div class="card-header-icon"><i class="fa-regular fa-play-circle"></i></div>
                                <h5>Lecture Progress</h5>
                            </div>
                            <div class="profile-card-body">

                                {{-- Progress bars per course --}}
                                <div class="an-lecture-grid" id="lect-prog-grid">
                                    @foreach ($lectureAnalytics as $stat)
                                        @php
                                            $wt  = $stat['watch_time']    ?? 0;
                                            $td  = $stat['total_duration'] ?? 0;
                                            $tp  = $stat['time_pct']       ?? $stat['pct'];
                                            $fmtS = fn(int $s) => $s <= 0 ? '0m'
                                                : (floor($s / 3600) > 0
                                                    ? floor($s / 3600) . 'h ' . floor(($s % 3600) / 60) . 'm'
                                                    : floor($s / 60) . 'm');
                                            $barClass   = $tp >= 80 ? 'an-fill-green'   : ($tp >= 40 ? 'an-fill-yellow'   : 'an-fill-blue');
                                            $badgeClass = $tp >= 80 ? 'an-badge-green'  : ($tp >= 40 ? 'an-badge-yellow'  : 'an-badge-gray');
                                        @endphp
                                        <div class="an-lecture-card {{ $loop->index >= 10 ? 'an-lm-hidden' : '' }}">
                                            <div class="an-lc-header">
                                                <span class="an-lc-title">{{ $stat['title'] }}</span>
                                                <span class="an-badge {{ $badgeClass }}">{{ $tp }}%</span>
                                            </div>
                                            <div class="an-prog-track">
                                                <div class="an-prog-fill {{ $barClass }}" style="width:{{ $tp }}%"></div>
                                            </div>
                                            <div class="an-lc-meta">
                                                <span><i class="fa-regular fa-clock"></i> Watched: <b>{{ $fmtS($wt) }}</b></span>
                                                <span><i class="fa-regular fa-hourglass-half"></i> Total duration: <b>{{ $td > 0 ? $fmtS($td) : '—' }}</b></span>
                                                <span><i class="fa-regular fa-film"></i> Lectures: <b>{{ $stat['watched'] }} / {{ $stat['total'] }}</b></span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if (count($lectureAnalytics) > 10)
                                    <div class="an-load-more-wrap">
                                        <button class="an-load-more-btn" data-grid="lect-prog-grid" data-shown="10">
                                            <i class="fa-regular fa-chevron-down"></i>
                                            Load More <span class="lm-count">({{ count($lectureAnalytics) - 10 }} more)</span>
                                        </button>
                                    </div>
                                @endif

                                {{-- Lecture bar chart --}}
                                @if (count($lectureAnalytics) > 0)
                                    <div class="an-chart-box" style="margin-top:20px">
                                        <p class="an-chart-label">Watched vs Total Lectures (per Course)</p>
                                        <canvas id="profileLectureChart" height="110"></canvas>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endif

{{-- ── Chapter Watch Time ─────────────────────── --}}
@if (!empty($chapterAnalytics))
    <div class="profile-card" style="margin-top:20px">
        <div class="profile-card-header">
            <div class="card-header-icon"><i class="fa-regular fa-layer-group"></i></div>
            <h5>Chapter Watch Time</h5>
        </div>
        <div class="profile-card-body">

            @foreach ($chapterAnalytics as $courseIdx => $courseData)
                <div class="an-course-group">
                    <div class="an-course-label">
                        <i class="fa-regular fa-book-open"></i> {{ $courseData['course'] }}
                    </div>

                    @foreach ($courseData['subjects'] as $subjectIdx => $subjectData)
                        @php $gridId = 'ch-grid-' . $courseIdx . '-' . $subjectIdx; @endphp
                        <div class="an-subject-group">
                            <div class="an-subject-label">
                                <i class="fa-regular fa-layer-group"></i>
                                {{ $subjectData['subject'] }}
                                <span style="color:#94a3b8;font-weight:400">({{ count($subjectData['chapters']) }} chapters)</span>
                            </div>

                            <div class="an-lecture-grid" id="{{ $gridId }}">
                                @foreach ($subjectData['chapters'] as $ch)
                                    @php
                                        $td  = $ch['total_duration'];
                                        $tw  = $ch['watched_seconds'];
                                        $pct = $ch['pct'];
                                        $fmtS = fn(int $s) => $s <= 0 ? '0m'
                                            : (floor($s / 3600) > 0
                                                ? floor($s / 3600) . 'h ' . floor(($s % 3600) / 60) . 'm'
                                                : floor($s / 60) . 'm');
                                    @endphp
                                    <div class="an-lecture-card {{ $loop->index >= 10 ? 'an-lm-hidden' : '' }}">
                                        <div class="an-lc-header">
                                            <span class="an-lc-title">{{ $ch['chapter'] }}</span>
                                            <span class="an-badge {{ $pct >= 80 ? 'an-badge-green' : ($pct >= 40 ? 'an-badge-yellow' : 'an-badge-gray') }}">{{ $pct }}%</span>
                                        </div>
                                        <div class="an-prog-track">
                                            <div class="an-prog-fill {{ $pct >= 80 ? 'an-fill-green' : ($pct >= 40 ? 'an-fill-yellow' : 'an-fill-blue') }}"
                                                style="width:{{ $pct }}%"></div>
                                        </div>
                                        <div class="an-lc-meta">
                                            <span><i class="fa-regular fa-clock"></i> Watched: <b>{{ $fmtS($tw) }}</b></span>
                                            <span><i class="fa-regular fa-hourglass-half"></i> Total: <b>{{ $td > 0 ? $fmtS($td) : '—' }}</b></span>
                                            <span><i class="fa-regular fa-film"></i> Lectures: <b>{{ $ch['lecture_count'] }}</b></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if (count($subjectData['chapters']) > 10)
                                <div class="an-load-more-wrap">
                                    <button class="an-load-more-btn" data-grid="{{ $gridId }}" data-shown="10">
                                        <i class="fa-regular fa-chevron-down"></i>
                                        Load More <span class="lm-count">({{ count($subjectData['chapters']) - 10 }} more)</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
@endif
                    {{-- ── Exam Performance ────────────────────────── --}}
                    <div class="profile-card" style="margin-top:20px">
                        <div class="profile-card-header">
                            <div class="card-header-icon"><i class="fa-regular fa-file-pen"></i></div>
                            <h5>Exam Performance</h5>
                        </div>
                        <div class="profile-card-body">

                            {{-- Stat cards --}}
                            <div class="an-stat-row">
                                <div class="an-stat-card">
                                    <div class="an-stat-icon an-blue"><i class="fa-regular fa-list-check"></i></div>
                                    <div>
                                        <div class="an-stat-val">{{ $examAnalytics['attempted'] }}</div>
                                        <div class="an-stat-lbl">Exams Taken</div>
                                    </div>
                                </div>
                                <div class="an-stat-card">
                                    <div class="an-stat-icon an-green"><i class="fa-regular fa-circle-check"></i></div>
                                    <div>
                                        <div class="an-stat-val">{{ $examAnalytics['totalCorrect'] }}</div>
                                        <div class="an-stat-lbl">Correct</div>
                                    </div>
                                </div>
                                <div class="an-stat-card">
                                    <div class="an-stat-icon an-red"><i class="fa-regular fa-circle-xmark"></i></div>
                                    <div>
                                        <div class="an-stat-val">{{ $examAnalytics['totalWrong'] }}</div>
                                        <div class="an-stat-lbl">Wrong</div>
                                    </div>
                                </div>
                                <div class="an-stat-card">
                                    <div class="an-stat-icon an-gray"><i class="fa-regular fa-minus-circle"></i></div>
                                    <div>
                                        <div class="an-stat-val">{{ $examAnalytics['totalUnanswered'] }}</div>
                                        <div class="an-stat-lbl">Unanswered</div>
                                    </div>
                                </div>
                                <div class="an-stat-card">
                                    <div class="an-stat-icon an-yellow"><i class="fa-regular fa-gauge-high"></i></div>
                                    <div>
                                        <div class="an-stat-val">{{ $examAnalytics['avgScore'] }}%</div>
                                        <div class="an-stat-lbl">Avg Score</div>
                                    </div>
                                </div>
                            </div>

                            @if ($examAnalytics['attempted'] > 0)
                                <div class="an-charts-row">
                                    <div class="an-chart-box an-chart-sm">
                                        <p class="an-chart-label">Answer Breakdown</p>
                                        <canvas id="profileExamPie"></canvas>
                                    </div>
                                    <div class="an-chart-box an-chart-lg">
                                        <p class="an-chart-label">Score % — Last 10 Exams</p>
                                        <canvas id="profileExamBar" height="120"></canvas>
                                    </div>
                                </div>
                            @else
                                <p style="text-align:center;color:#94a3b8;padding:24px 0;font-size:14px">
                                    No submitted exams yet. Complete an exam to see your analytics.
                                </p>
                            @endif

                        </div>
                    </div>

                </div>{{-- /panel-analytics --}}


                {{-- ─────────────────────────────
                     PANEL: Settings / Edit Profile
                ───────────────────────────── --}}
                <div class="tab-panel" id="panel-settings" style="display:none">
                    <div class="profile-card profile-edit-panel" id="editPanel">
                        <div class="profile-card-header">
                            <div class="card-header-icon"><i class="fa-regular fa-gear"></i></div>
                            <h5>Edit Profile</h5>
                        </div>
                        <div class="profile-card-body edit-panel-body">

                            <form action="{{ route('profileUp') }}" method="POST" enctype="multipart/form-data"
                                class="profile-form" id="editProfileForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $profile->id }}">

                                {{-- ── Profile Photo --}}
                                <p class="form-section-title"><i class="fa-regular fa-image"></i> Profile Photo</p>

                                <div class="avatar-upload-wrap">
                                    <img src="{{ $profile->photo }}" alt="Preview" class="avatar-preview"
                                        id="photoPreviewImg">
                                    <div class="upload-instructions">
                                        <label for="photoInput" class="upload-label">
                                            <i class="fa-regular fa-arrow-up-from-bracket"></i> Choose Photo
                                        </label>
                                        <input type="file" id="photoInput" name="photo"
                                            accept="image/jpeg,image/png,image/gif,image/webp" style="display:none">
                                        <p class="upload-hint">JPG, PNG or WebP. Max 2 MB.</p>
                                        <p class="upload-hint" id="photoFileName" style="color:#02b3e4;font-weight:600">
                                        </p>
                                    </div>
                                </div>

                                {{-- ── Personal Information --}}
                                <p class="form-section-title"><i class="fa-regular fa-user"></i> Personal Information</p>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $profile->name) }}" placeholder="Your full name">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $profile->email) }}" placeholder="you@example.com">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="mobile" class="form-control"
                                            value="{{ old('mobile', $profile->mobile) }}" placeholder="+880...">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">WhatsApp Number</label>
                                        <input type="text" name="whatsapp_number" class="form-control"
                                            value="{{ old('whatsapp_number', $profile->whatsapp_number) }}"
                                            placeholder="+880...">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" name="birth" class="form-control"
                                            value="{{ old('birth', $profile->birth) }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">— Select gender —</option>
                                            <option value="Male" {{ $profile->gender == 'Male' ? 'selected' : '' }}>
                                                Male</option>
                                            <option value="Female" {{ $profile->gender == 'Female' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="Other" {{ $profile->gender == 'Other' ? 'selected' : '' }}>
                                                Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Country</label>
                                        <input type="text" name="country" class="form-control"
                                            value="{{ old('country', $profile->country) }}" placeholder="Bangladesh">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Facebook Profile URL</label>
                                        <input type="url" name="fb" class="form-control"
                                            value="{{ old('fb', $profile->fb) }}"
                                            placeholder="https://facebook.com/...">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="form-label">Full Address</label>
                                        <textarea name="address" class="form-control" rows="2" placeholder="House, Road, City, District">{{ old('address', $profile->address) }}</textarea>
                                    </div>
                                </div>

                                {{-- ── Academic & Professional --}}
                                <p class="form-section-title"><i class="fa-regular fa-graduation-cap"></i> Academic &amp;
                                    Professional</p>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Title / Position</label>
                                        <input type="text" name="position" class="form-control"
                                            value="{{ old('position', $profile->position) }}"
                                            placeholder="e.g. Dr., Prof., Student">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Qualification / Degree</label>
                                        <input type="text" name="qualification" class="form-control"
                                            value="{{ old('qualification', $profile->qualification) }}"
                                            placeholder="e.g. MBBS, BDS">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Medical College</label>
                                        <input type="text" name="medical" class="form-control"
                                            value="{{ old('medical', $profile->medical) }}" placeholder="College name">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">BMDC Registration No.</label>
                                        <input type="text" name="BMDC" class="form-control"
                                            value="{{ old('BMDC', $profile->BMDC) }}" placeholder="A-XXXXX">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="form-label">Batch Year</label>
                                        <input type="text" name="batch" class="form-control"
                                            value="{{ old('batch', $profile->batch) }}" placeholder="e.g. 2022">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="form-label">Session</label>
                                        <input type="text" name="sessionn" class="form-control"
                                            value="{{ old('sessionn', $profile->sessionn) }}"
                                            placeholder="e.g. 2022–23">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="form-label">Level / Year</label>
                                        <input type="text" name="levell" class="form-control"
                                            value="{{ old('levell', $profile->levell) }}" placeholder="e.g. 3rd Year">
                                    </div>
                                </div>

                                {{-- Submit --}}
                                <div class="d-flex align-items-center gap-12" style="gap:12px;margin-top:8px">
                                    <button type="submit" class="btn-save-profile" id="btnSaveProfile">
                                        <i class="fa-regular fa-floppy-disk"></i> Save Changes
                                    </button>
                                    <button type="button" class="btn-cancel-edit profile-tab-link" data-tab="overview"
                                        style="background:none;border:none;color:#6c757d;font-size:14px;cursor:pointer;padding:0">
                                        Cancel
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>{{-- /panel-settings --}}

            </div>{{-- /container --}}
        </div>{{-- /profile-body --}}

    </div>{{-- /student-profile-page --}}

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        /* ── Analytics panel styles ───────────────────── */
        .an-lecture-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 12px;
            margin-bottom: 4px;
        }

        .an-lecture-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 16px;
        }

        .an-lc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 9px;
        }

        .an-lc-title {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 170px;
        }

        .an-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            flex-shrink: 0;
        }

        .an-badge-green {
            background: #dcfce7;
            color: #15803d;
        }

        .an-badge-yellow {
            background: #fef9c3;
            color: #a16207;
        }

        .an-badge-gray {
            background: #f1f5f9;
            color: #64748b;
        }

        .an-prog-track {
            height: 8px;
            background: #e2e8f0;
            border-radius: 99px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .an-prog-fill {
            height: 100%;
            border-radius: 99px;
            transition: width .6s ease;
        }

        .an-fill-green {
            background: #22c55e;
        }

        .an-fill-yellow {
            background: #eab308;
        }

        .an-fill-blue {
            background: #6366f1;
        }

        .an-lc-meta {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            font-size: 11px;
            color: #64748b;
        }

        .an-lc-meta i {
            color: #94a3b8;
            margin-right: 2px;
        }

        /* Stat row */
        .an-stat-row {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .an-stat-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .an-stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .an-blue {
            background: #eff6ff;
            color: #3b82f6;
        }

        .an-green {
            background: #f0fdf4;
            color: #22c55e;
        }

        .an-red {
            background: #fef2f2;
            color: #ef4444;
        }

        .an-gray {
            background: #f1f5f9;
            color: #64748b;
        }

        .an-yellow {
            background: #fffbeb;
            color: #f59e0b;
        }

        .an-stat-val {
            font-size: 20px;
            font-weight: 800;
            color: #1e293b;
            line-height: 1.1;
        }

        .an-stat-lbl {
            font-size: 10px;
            color: #64748b;
            font-weight: 500;
            margin-top: 1px;
        }

        /* Charts */
        .an-charts-row {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .an-chart-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 16px;
            flex: 1;
            min-width: 200px;
        }

        .an-chart-sm {
            max-width: 240px;
        }

        .an-chart-lg {
            flex: 2;
        }

.an-lm-hidden { display: none !important; }

.an-course-group { margin-bottom: 24px; }

.an-course-label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    color: #1e293b;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 8px 14px;
    margin-bottom: 12px;
}

.an-course-label i { color: #6366f1; }

.an-subject-group {
    margin-bottom: 16px;
    padding-left: 14px;
    border-left: 3px solid #e2e8f0;
}

.an-subject-label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 10px;
}

.an-subject-label i { color: #02b3e4; }

.an-load-more-wrap { text-align: center; padding-top: 16px; }

.an-load-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    color: #475569;
    font-size: 12px;
    font-weight: 600;
    padding: 8px 20px;
    cursor: pointer;
    transition: background .2s, color .2s;
}

.an-load-more-btn:hover { background: #e2e8f0; color: #1e293b; }

.an-load-more-btn .lm-count { color: #94a3b8; font-weight: 500; }
        .an-chart-label {
            font-size: 11px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin: 0 0 10px;
        }
    </style>
    <script>
        (function() {

            // ──────────────────────────────────────────────
            // TAB SWITCHING
            // ──────────────────────────────────────────────
            var panels = document.querySelectorAll('.tab-panel');
            var tabBtns = document.querySelectorAll('.profile-tab-item');

            function showTab(tabName) {
                // hide all panels
                panels.forEach(function(p) {
                    p.style.display = 'none';
                });

                // deactivate all tab buttons
                tabBtns.forEach(function(b) {
                    b.classList.remove('active');
                });

                // show target panel
                var target = document.getElementById('panel-' + tabName);
                if (target) target.style.display = 'block';

                // activate matching tab button
                tabBtns.forEach(function(b) {
                    if (b.getAttribute('data-tab') === tabName) b.classList.add('active');
                });

                // scroll to top of profile body
                var body = document.querySelector('.profile-body');
                if (body) body.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            // Tab bar clicks
            tabBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    showTab(this.getAttribute('data-tab'));
                });
            });

            // "View all →" and other inline tab links
            document.addEventListener('click', function(e) {
                var el = e.target.closest('.profile-tab-link');
                if (!el) return;
                e.preventDefault();
                showTab(el.getAttribute('data-tab'));
            });

            // ──────────────────────────────────────────────
            // EDIT PROFILE BUTTON & AVATAR CAMERA BADGE
            // ──────────────────────────────────────────────
            var btnEdit = document.getElementById('btnEditProfile');
            if (btnEdit) {
                btnEdit.addEventListener('click', function() {
                    showTab('settings');
                    // Wait for panel to show, then focus first name field
                    setTimeout(function() {
                        var firstInput = document.querySelector('#editProfileForm input[name="name"]');
                        if (firstInput) firstInput.focus();
                    }, 200);
                });
            }

            var avatarBadge = document.getElementById('avatarEditBadge');
            if (avatarBadge) {
                avatarBadge.addEventListener('click', function() {
                    showTab('settings');
                    // Trigger the file picker after panel opens
                    setTimeout(function() {
                        var photoInput = document.getElementById('photoInput');
                        if (photoInput) photoInput.click();
                    }, 250);
                });
            }

            // ──────────────────────────────────────────────
            // PROFILE PHOTO UPLOAD PREVIEW
            // ──────────────────────────────────────────────
            var photoInput = document.getElementById('photoInput');
            if (photoInput) {
                photoInput.addEventListener('change', function() {
                    var file = this.files[0];
                    if (!file) return;

                    // Show filename
                    var nameEl = document.getElementById('photoFileName');
                    if (nameEl) nameEl.textContent = file.name;

                    // Preview in form and cover avatar
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var preview = document.getElementById('photoPreviewImg');
                        var cover = document.getElementById('coverAvatarImg');
                        if (preview) preview.src = e.target.result;
                        if (cover) cover.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                });
            }

            // ──────────────────────────────────────────────
            // AUTO-OPEN SETTINGS TAB AFTER SAVE (flash message)
            // ──────────────────────────────────────────────
            @if (session()->has('profile'))
                // Profile was just updated — stay on overview (already default)
            @endif

            // If URL hash is #editPanel open settings tab
            if (window.location.hash === '#editPanel') {
                showTab('settings');
            }

            // ──────────────────────────────────────────────
            // SAVE BUTTON LOADING STATE
            // ──────────────────────────────────────────────
            var editForm = document.getElementById('editProfileForm');
            var saveBtn = document.getElementById('btnSaveProfile');
            if (editForm && saveBtn) {
                editForm.addEventListener('submit', function() {
                    saveBtn.disabled = true;
                    saveBtn.innerHTML = '<i class="fa-regular fa-spinner fa-spin"></i> Saving…';
                });
            }

// ──────────────────────────────────────────────
// LOAD MORE — analytics grids
// ──────────────────────────────────────────────
document.querySelectorAll('.an-load-more-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var grid   = document.getElementById(this.getAttribute('data-grid'));
        var cards  = Array.from(grid.querySelectorAll('.an-lecture-card'));
        var total  = cards.length;
        var hidden = cards.filter(function(c) { return c.classList.contains('an-lm-hidden'); });
        var shown  = parseInt(this.getAttribute('data-shown') || '10');

        if (hidden.length > 0) {
            hidden.slice(0, 10).forEach(function(c) { c.classList.remove('an-lm-hidden'); });
            var stillHidden = grid.querySelectorAll('.an-lecture-card.an-lm-hidden').length;
            this.setAttribute('data-shown', (shown + Math.min(10, hidden.length)).toString());
            if (stillHidden === 0) {
                this.innerHTML = '<i class="fa-regular fa-chevron-up"></i> Show Less';
            } else {
                this.innerHTML = '<i class="fa-regular fa-chevron-down"></i> Load More <span class="lm-count">(' + stillHidden + ' more)</span>';
            }
        } else {
            cards.forEach(function(c, i) { if (i >= 10) c.classList.add('an-lm-hidden'); });
            this.setAttribute('data-shown', '10');
            this.innerHTML = '<i class="fa-regular fa-chevron-down"></i> Load More <span class="lm-count">(' + (total - 10) + ' more)</span>';
        }
    });
});
            // ──────────────────────────────────────────────
            // ANALYTICS CHARTS
            // Initialise charts lazily when the Analytics tab is first opened
            // ──────────────────────────────────────────────
            var chartsReady = false;

            function initCharts() {
                if (chartsReady) return;
                chartsReady = true;

                @if (!empty($lectureAnalytics))
                    var lectureCtx = document.getElementById('profileLectureChart');
                    if (lectureCtx) {
                        new Chart(lectureCtx, {
                            type: 'bar',
                            data: {
                                labels: {!! json_encode(array_column($lectureAnalytics, 'title')) !!},
                                datasets: [{
                                        label: 'Watched',
                                        data: {!! json_encode(array_column($lectureAnalytics, 'watched')) !!},
                                        backgroundColor: '#6366f1',
                                        borderRadius: 5,
                                    },
                                    {
                                        label: 'Total',
                                        data: {!! json_encode(array_column($lectureAnalytics, 'total')) !!},
                                        backgroundColor: '#e2e8f0',
                                        borderRadius: 5,
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            precision: 0
                                        }
                                    }
                                }
                            }
                        });
                    }
                @endif

                @if ($examAnalytics['attempted'] > 0)
                    var pieCtx = document.getElementById('profileExamPie');
                    if (pieCtx) {
                        new Chart(pieCtx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Correct', 'Wrong', 'Unanswered'],
                                datasets: [{
                                    data: [
                                        {{ $examAnalytics['totalCorrect'] }},
                                        {{ $examAnalytics['totalWrong'] }},
                                        {{ $examAnalytics['totalUnanswered'] }},
                                    ],
                                    backgroundColor: ['#22c55e', '#ef4444', '#94a3b8'],
                                    borderWidth: 0,
                                }]
                            },
                            options: {
                                responsive: true,
                                cutout: '65%',
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            font: {
                                                size: 11
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }

                    var barCtx = document.getElementById('profileExamBar');
                    if (barCtx) {
                        var perExam = {!! json_encode($examAnalytics['perExam']) !!};
                        new Chart(barCtx, {
                            type: 'bar',
                            data: {
                                labels: perExam.map(function(e) {
                                    return e.name.length > 22 ? e.name.slice(0, 22) + '…' : e.name;
                                }),
                                datasets: [{
                                    label: 'Score %',
                                    data: perExam.map(function(e) {
                                        return e.score;
                                    }),
                                    backgroundColor: perExam.map(function(e) {
                                        return e.score >= 70 ? '#22c55e' : e.score >= 40 ?
                                            '#f59e0b' : '#ef4444';
                                    }),
                                    borderRadius: 5,
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    y: {
                                        min: 0,
                                        max: 100,
                                        ticks: {
                                            callback: function(v) {
                                                return v + '%';
                                            }
                                        }
                                    },
                                    x: {
                                        ticks: {
                                            font: {
                                                size: 10
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                @endif
            }

            // Trigger chart init when analytics tab is clicked
            document.querySelectorAll('[data-tab="analytics"]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    setTimeout(initCharts, 50);
                });
            });

        })();
    </script>
@endsection

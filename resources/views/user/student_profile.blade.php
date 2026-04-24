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
                        <img src="{{ $profile->photo }}" alt="{{ $profile->name }}"
                             class="profile-avatar" id="coverAvatarImg">
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
                                                    <span class="profile-status-badge badge-active"><span class="dot"></span> Active</span>
                                                @elseif($profile->is_approve == 0)
                                                    <span class="profile-status-badge badge-pending"><span class="dot"></span> Pending</span>
                                                @else
                                                    <span class="profile-status-badge badge-inactive"><span class="dot"></span> Inactive</span>
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
                                                    <a href="{{ $profile->fb }}" target="_blank" rel="noopener">View Profile</a>
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
                                    <a href="#" class="card-header-meta profile-tab-link" data-tab="personal" style="color:#02b3e4;font-weight:600">View all →</a>
                                </div>
                                <div class="profile-card-body">
                                    <div class="profile-info-grid">

                                        <div class="profile-info-item">
                                            <span class="info-label">Full Name</span>
                                            <span class="info-value {{ empty($profile->name) ? 'info-value--empty' : '' }}">{{ $profile->name ?? 'Not provided' }}</span>
                                        </div>

                                        <div class="profile-info-item">
                                            <span class="info-label">Email Address</span>
                                            <span class="info-value {{ empty($profile->email) ? 'info-value--empty' : '' }}">{{ $profile->email ?? 'Not provided' }}</span>
                                        </div>

                                        <div class="profile-info-item">
                                            <span class="info-label">Phone Number</span>
                                            <span class="info-value {{ empty($profile->mobile) ? 'info-value--empty' : '' }}">{{ $profile->mobile ?? 'Not provided' }}</span>
                                        </div>

                                        <div class="profile-info-item">
                                            <span class="info-label">Gender</span>
                                            <span class="info-value {{ empty($profile->gender) ? 'info-value--empty' : '' }}">{{ $profile->gender ?? 'Not provided' }}</span>
                                        </div>

                                        <div class="profile-info-item">
                                            <span class="info-label">Date of Birth</span>
                                            <span class="info-value {{ empty($profile->birth) ? 'info-value--empty' : '' }}">{{ $profile->birth ?? 'Not provided' }}</span>
                                        </div>

                                        <div class="profile-info-item">
                                            <span class="info-label">Country</span>
                                            <span class="info-value {{ empty($profile->country) ? 'info-value--empty' : '' }}">{{ $profile->country ?? 'Not provided' }}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Courses snapshot --}}
                            @php
                                $totalCourses = 0;
                                foreach ($courses as $chunk) {
                                    foreach ($chunk as $c) {
                                        if (!empty($c->course)) $totalCourses++;
                                    }
                                }
                            @endphp
                            <div class="profile-card">
                                <div class="profile-card-header">
                                    <div class="card-header-icon"><i class="fa-regular fa-book-open"></i></div>
                                    <h5>My Courses</h5>
                                    <span class="card-header-meta">{{ $totalCourses }} enrolled</span>
                                    <a href="#" class="profile-tab-link" data-tab="courses" style="color:#02b3e4;font-weight:600;font-size:12px;margin-left:12px">View all →</a>
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
                                                                <span class="profile-status-badge badge-active" style="flex-shrink:0;margin-left:8px"><span class="dot"></span> Active</span>
                                                            @elseif($course->enroll_status == 0)
                                                                <span class="profile-status-badge badge-pending" style="flex-shrink:0;margin-left:8px"><span class="dot"></span> Pending</span>
                                                            @else
                                                                <span class="profile-status-badge badge-inactive" style="flex-shrink:0;margin-left:8px"><span class="dot"></span> Inactive</span>
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
                                                <a href="#" class="profile-tab-link" data-tab="courses" style="color:#02b3e4;font-weight:600">View all courses →</a>
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
                                    <span class="info-value {{ empty($profile->name) ? 'info-value--empty' : '' }}">{{ $profile->name ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Email Address</span>
                                    <span class="info-value {{ empty($profile->email) ? 'info-value--empty' : '' }}">{{ $profile->email ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Phone Number</span>
                                    <span class="info-value {{ empty($profile->mobile) ? 'info-value--empty' : '' }}">{{ $profile->mobile ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">WhatsApp</span>
                                    <span class="info-value {{ empty($profile->whatsapp_number) ? 'info-value--empty' : '' }}">{{ $profile->whatsapp_number ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Date of Birth</span>
                                    <span class="info-value {{ empty($profile->birth) ? 'info-value--empty' : '' }}">{{ $profile->birth ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Gender</span>
                                    <span class="info-value {{ empty($profile->gender) ? 'info-value--empty' : '' }}">{{ $profile->gender ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Country</span>
                                    <span class="info-value {{ empty($profile->country) ? 'info-value--empty' : '' }}">{{ $profile->country ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Address</span>
                                    <span class="info-value {{ empty($profile->address) ? 'info-value--empty' : '' }}">{{ $profile->address ?? 'Not provided' }}</span>
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
                                    <span class="info-value {{ empty($profile->position) ? 'info-value--empty' : '' }}">{{ $profile->position ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Qualification / Degree</span>
                                    <span class="info-value {{ empty($profile->qualification) ? 'info-value--empty' : '' }}">{{ $profile->qualification ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Medical College</span>
                                    <span class="info-value {{ empty($profile->medical) ? 'info-value--empty' : '' }}">{{ $profile->medical ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">BMDC Registration</span>
                                    <span class="info-value {{ empty($profile->BMDC) ? 'info-value--empty' : '' }}">{{ $profile->BMDC ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Batch Year</span>
                                    <span class="info-value {{ empty($profile->batch) ? 'info-value--empty' : '' }}">{{ $profile->batch ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Session</span>
                                    <span class="info-value {{ empty($profile->sessionn) ? 'info-value--empty' : '' }}">{{ $profile->sessionn ?? 'Not provided' }}</span>
                                </div>

                                <div class="profile-info-item">
                                    <span class="info-label">Level / Year</span>
                                    <span class="info-value {{ empty($profile->levell) ? 'info-value--empty' : '' }}">{{ $profile->levell ?? 'Not provided' }}</span>
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
                                                $endStr   = substr($course->subscription_end, 0, 10);
                                                $endNum   = (int) $endStr;
                                                $remaining = 0;
                                                $totalDays = 365;
                                                $usedPct   = 0;

                                                if ($course->enroll_status == 1 && $endNum > 0) {
                                                    $end     = new DateTime($endStr);
                                                    $current = new DateTime(date('Y-m-d'));
                                                    $remaining = (int) $end->diff($current)->format('%a');
                                                    $usedPct   = max(0, min(100, round((($totalDays - $remaining) / $totalDays) * 100)));
                                                }

                                                $daysClass = $remaining <= 7 ? 'critical' : ($remaining <= 15 ? 'warning' : 'good');
                                            @endphp

                                            <div class="enrolled-course-item">
                                                <div class="d-flex justify-content-between align-items-start mb-1">
                                                    <p class="course-title">{{ $course->course->plan }}</p>
                                                    @if ($course->enroll_status == 1)
                                                        <span class="profile-status-badge badge-active" style="margin-left:8px;flex-shrink:0"><span class="dot"></span> Active</span>
                                                    @elseif($course->enroll_status == 0)
                                                        <span class="profile-status-badge badge-pending" style="margin-left:8px;flex-shrink:0"><span class="dot"></span> Pending</span>
                                                    @else
                                                        <span class="profile-status-badge badge-inactive" style="margin-left:8px;flex-shrink:0"><span class="dot"></span> Inactive</span>
                                                    @endif
                                                </div>

                                                <p class="course-graduation">{{ $course->course->graduation }}</p>

                                                <div class="course-meta-row">
                                                    <span><i class="fa-regular fa-money-bill" style="color:#02b3e4"></i> Fees: {{ number_format($course->fees) }}</span>
                                                    <span><i class="fa-regular fa-circle-check" style="color:#1aab61"></i> Paid: {{ number_format($course->paid) }}</span>
                                                </div>

                                                @if ($course->enroll_status == 1 && $endNum > 0)
                                                    <div class="course-subscription-bar">
                                                        <div class="sub-bar-fill" style="width: {{ $usedPct }}%"></div>
                                                    </div>
                                                    <div class="course-meta-row">
                                                        <span>Ends: {{ $endStr }}</span>
                                                        <span class="days-remaining {{ $daysClass }}">{{ $remaining }}d left</span>
                                                    </div>
                                                    <div class="course-actions">
                                                        <a href="{{ url('batch/' . $course->batch_id . '/subjects') }}" class="course-action-btn btn-lecture"><i class="fa-regular fa-play"></i> Lecture</a>
                                                        <a href="{{ url('exam_by_batch', $course->batch_id) }}" class="course-action-btn btn-exam"><i class="fa-regular fa-file-pen"></i> Exam</a>
                                                        <a href="{{ url('schedule/batch/' . $course->batch_id) }}" class="course-action-btn btn-schedule"><i class="fa-regular fa-calendar"></i> Schedule</a>
                                                        <a href="{{ url('discussion/batch/' . $course->batch_id) }}" class="course-action-btn btn-discussion"><i class="fa-regular fa-comments"></i> Discussion</a>
                                                        <a href="{{ url('live/' . $course->batch_id) }}" class="course-action-btn btn-live"><i class="fa-regular fa-signal-stream"></i> Live</a>
                                                    </div>
                                                @elseif($course->enroll_status == 0)
                                                    <div class="course-actions">
                                                        <a href="{{ url('/payment/' . $course->batch_id) }}" class="course-action-btn btn-payment">
                                                            <i class="fa-regular fa-credit-card"></i> Update Payment
                                                        </a>
                                                    </div>
                                                    <p style="font-size:11px;color:#e68900;margin-top:8px;margin-bottom:0">
                                                        <i class="fa-regular fa-clock"></i> Awaiting approval (up to 24 hrs)
                                                    </p>
                                                @else
                                                    <p style="font-size:11px;color:#d32f2f;margin-top:4px;margin-bottom:0">
                                                        <i class="fa-regular fa-triangle-exclamation"></i> Contact support via WhatsApp
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
                     PANEL: Settings / Edit Profile
                ───────────────────────────── --}}
                <div class="tab-panel" id="panel-settings" style="display:none">
                    <div class="profile-card profile-edit-panel" id="editPanel">
                        <div class="profile-card-header">
                            <div class="card-header-icon"><i class="fa-regular fa-gear"></i></div>
                            <h5>Edit Profile</h5>
                        </div>
                        <div class="profile-card-body edit-panel-body">

                            <form action="{{ route('profileUp') }}" method="POST"
                                  enctype="multipart/form-data" class="profile-form" id="editProfileForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $profile->id }}">

                                {{-- ── Profile Photo --}}
                                <p class="form-section-title"><i class="fa-regular fa-image"></i> Profile Photo</p>

                                <div class="avatar-upload-wrap">
                                    <img src="{{ $profile->photo }}" alt="Preview"
                                         class="avatar-preview" id="photoPreviewImg">
                                    <div class="upload-instructions">
                                        <label for="photoInput" class="upload-label">
                                            <i class="fa-regular fa-arrow-up-from-bracket"></i> Choose Photo
                                        </label>
                                        <input type="file" id="photoInput" name="photo"
                                               accept="image/jpeg,image/png,image/gif,image/webp"
                                               style="display:none">
                                        <p class="upload-hint">JPG, PNG or WebP. Max 2 MB.</p>
                                        <p class="upload-hint" id="photoFileName" style="color:#02b3e4;font-weight:600"></p>
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
                                               value="{{ old('whatsapp_number', $profile->whatsapp_number) }}" placeholder="+880...">
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
                                            <option value="Male"   {{ $profile->gender == 'Male'   ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $profile->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other"  {{ $profile->gender == 'Other'  ? 'selected' : '' }}>Other</option>
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
                                               value="{{ old('fb', $profile->fb) }}" placeholder="https://facebook.com/...">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="form-label">Full Address</label>
                                        <textarea name="address" class="form-control" rows="2"
                                                  placeholder="House, Road, City, District">{{ old('address', $profile->address) }}</textarea>
                                    </div>
                                </div>

                                {{-- ── Academic & Professional --}}
                                <p class="form-section-title"><i class="fa-regular fa-graduation-cap"></i> Academic &amp; Professional</p>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Title / Position</label>
                                        <input type="text" name="position" class="form-control"
                                               value="{{ old('position', $profile->position) }}" placeholder="e.g. Dr., Prof., Student">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="form-label">Qualification / Degree</label>
                                        <input type="text" name="qualification" class="form-control"
                                               value="{{ old('qualification', $profile->qualification) }}" placeholder="e.g. MBBS, BDS">
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
                                               value="{{ old('sessionn', $profile->sessionn) }}" placeholder="e.g. 2022–23">
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
    <script>
        (function () {

            // ──────────────────────────────────────────────
            // TAB SWITCHING
            // ──────────────────────────────────────────────
            var panels  = document.querySelectorAll('.tab-panel');
            var tabBtns = document.querySelectorAll('.profile-tab-item');

            function showTab(tabName) {
                // hide all panels
                panels.forEach(function (p) { p.style.display = 'none'; });

                // deactivate all tab buttons
                tabBtns.forEach(function (b) { b.classList.remove('active'); });

                // show target panel
                var target = document.getElementById('panel-' + tabName);
                if (target) target.style.display = 'block';

                // activate matching tab button
                tabBtns.forEach(function (b) {
                    if (b.getAttribute('data-tab') === tabName) b.classList.add('active');
                });

                // scroll to top of profile body
                var body = document.querySelector('.profile-body');
                if (body) body.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            // Tab bar clicks
            tabBtns.forEach(function (btn) {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    showTab(this.getAttribute('data-tab'));
                });
            });

            // "View all →" and other inline tab links
            document.addEventListener('click', function (e) {
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
                btnEdit.addEventListener('click', function () {
                    showTab('settings');
                    // Wait for panel to show, then focus first name field
                    setTimeout(function () {
                        var firstInput = document.querySelector('#editProfileForm input[name="name"]');
                        if (firstInput) firstInput.focus();
                    }, 200);
                });
            }

            var avatarBadge = document.getElementById('avatarEditBadge');
            if (avatarBadge) {
                avatarBadge.addEventListener('click', function () {
                    showTab('settings');
                    // Trigger the file picker after panel opens
                    setTimeout(function () {
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
                photoInput.addEventListener('change', function () {
                    var file = this.files[0];
                    if (!file) return;

                    // Show filename
                    var nameEl = document.getElementById('photoFileName');
                    if (nameEl) nameEl.textContent = file.name;

                    // Preview in form and cover avatar
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var preview = document.getElementById('photoPreviewImg');
                        var cover   = document.getElementById('coverAvatarImg');
                        if (preview) preview.src = e.target.result;
                        if (cover)   cover.src   = e.target.result;
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
            var saveBtn  = document.getElementById('btnSaveProfile');
            if (editForm && saveBtn) {
                editForm.addEventListener('submit', function () {
                    saveBtn.disabled = true;
                    saveBtn.innerHTML = '<i class="fa-regular fa-spinner fa-spin"></i> Saving…';
                });
            }

        })();
    </script>
@endsection

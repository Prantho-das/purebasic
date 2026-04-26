@extends('layouts.register')
@section('content')

    @php
        $batchTitle = \App\Batchpackage::where('batch_id', $batch_id)->value('title') ?? 'Course';
        $subjectInfo = \App\Category::find($subject_id);
        $subjectName = $subjectInfo ? $subjectInfo->name : 'Subject';
        $chapterName = $sheet->chapter ? $sheet->chapter->name : '';
        $hasNote1 = !empty($sheet->links);
        $hasNote2 = !empty($sheet->pdf);
        $hasPdf = !empty($sheet->v_link);
        $hasResources = $hasNote1 || $hasNote2 || $hasPdf;
    @endphp

    <style>
        .vp-page {
            background: #0d0f14;
            min-height: 100vh;
            font-family: "Poppins", sans-serif;
            display: flex;
            flex-direction: column;
        }

        /* ── Top bar */
        .vp-topbar {
            background: #13161e;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            padding: 12px 0;
            flex-shrink: 0;
        }

        .vp-topbar-inner {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .vp-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            font-weight: 600;
            padding: 7px 14px;
            text-decoration: none;
            flex-shrink: 0;
            transition: background 0.2s, color 0.2s;
        }

        .vp-back-btn:hover {
            background: rgba(2, 179, 228, 0.2);
            border-color: rgba(2, 179, 228, 0.4);
            color: #02b3e4;
            text-decoration: none;
        }

        .vp-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
            flex: 1;
        }

        .vp-breadcrumb a {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.45);
            text-decoration: none;
            transition: color 0.2s;
            white-space: nowrap;
        }

        .vp-breadcrumb a:hover {
            color: #02b3e4;
        }

        .vp-breadcrumb .bc-sep {
            color: rgba(255, 255, 255, 0.2);
            font-size: 10px;
        }

        .vp-breadcrumb .bc-current {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.75);
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 220px;
        }

        /* ── Main layout */
        .vp-body {
            flex: 1;
            display: flex;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            padding: 0 16px 40px;
            gap: 24px;
            align-items: flex-start;
        }

        /* ── Video column */
        .vp-video-col {
            flex: 1;
            min-width: 0;
            padding-top: 24px;
        }

        .vp-title {
            font-family: "Montserrat", sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            margin: 0 0 16px;
            line-height: 1.3;
        }

        /* Player wrapper — forces 16:9 */
        .vp-player-wrap {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.6);
        }

        .vp-player-wrap .plyr__video-embed,
        .vp-player-wrap #player {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .vp-loader {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
            z-index: 10;
            pointer-events: none;
            transition: opacity 0.4s;
        }

        .vp-loader.hidden {
            opacity: 0;
        }

        .vp-spinner {
            width: 48px;
            height: 48px;
            border: 4px solid rgba(255, 255, 255, 0.12);
            border-top-color: #02b3e4;
            border-radius: 50%;
            animation: vp-spin 0.8s linear infinite;
        }

        @keyframes vp-spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Meta row below player */
        .vp-meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .vp-meta-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .vp-meta-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 11px;
            font-weight: 600;
            padding: 4px 11px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .vp-meta-tag:hover {
            background: rgba(2, 179, 228, 0.15);
            border-color: rgba(2, 179, 228, 0.35);
            color: #02b3e4;
            text-decoration: none;
        }

        .vp-meta-tag.tag-chapter {
            border-color: rgba(124, 58, 237, 0.3);
            color: rgba(196, 181, 253, 0.9);
            background: rgba(124, 58, 237, 0.1);
        }

        .vp-meta-tag.tag-chapter:hover {
            background: rgba(124, 58, 237, 0.2);
            color: #c4b5fd;
        }

        /* Resources section */
        .vp-resources {
            margin-top: 20px;
        }

        .vp-resources-title {
            font-size: 13px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin: 0 0 12px;
        }

        .vp-resource-btns {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .vp-res-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: 1.5px solid;
            transition: all 0.2s;
            flex: 1;
            min-width: 120px;
            justify-content: center;
        }

        .vp-res-btn:hover {
            transform: translateY(-2px);
            text-decoration: none;
        }

        .vp-btn-note1 {
            background: rgba(26, 171, 97, 0.12);
            border-color: rgba(26, 171, 97, 0.3);
            color: #34d399;
        }

        .vp-btn-note1:hover {
            background: #1aab61;
            border-color: #1aab61;
            color: #fff;
        }

        .vp-btn-note2 {
            background: rgba(124, 58, 237, 0.12);
            border-color: rgba(124, 58, 237, 0.3);
            color: #c4b5fd;
        }

        .vp-btn-note2:hover {
            background: #7c3aed;
            border-color: #7c3aed;
            color: #fff;
        }

        .vp-btn-pdf {
            background: rgba(220, 38, 38, 0.1);
            border-color: rgba(220, 38, 38, 0.3);
            color: #fca5a5;
        }

        .vp-btn-pdf:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: #fff;
        }

        /* ── Sidebar */
        .vp-sidebar {
            width: 320px;
            flex-shrink: 0;
            padding-top: 24px;
        }

        .vp-sidebar-card {
            background: #13161e;
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 14px;
            overflow: hidden;
        }

        .vp-sidebar-header {
            padding: 16px 18px 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .vp-sidebar-header i {
            color: #02b3e4;
            font-size: 14px;
        }

        .vp-sidebar-header h4 {
            font-family: "Montserrat", sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            margin: 0;
        }

        .vp-sidebar-body {
            padding: 16px 18px;
        }

        .vp-info-row {
            display: flex;
            gap: 10px;
            margin-bottom: 14px;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .vp-info-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .vp-info-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(2, 179, 228, 0.1);
            border: 1px solid rgba(2, 179, 228, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #02b3e4;
            font-size: 13px;
            flex-shrink: 0;
        }

        .vp-info-icon.icon-purple {
            background: rgba(124, 58, 237, 0.1);
            border-color: rgba(124, 58, 237, 0.2);
            color: #c4b5fd;
        }

        .vp-info-icon.icon-green {
            background: rgba(26, 171, 97, 0.1);
            border-color: rgba(26, 171, 97, 0.2);
            color: #34d399;
        }

        .vp-info-label {
            font-size: 10px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.35);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin: 0 0 2px;
        }

        .vp-info-value {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.82);
            margin: 0;
            line-height: 1.35;
        }

        /* Nav buttons */
        .vp-nav-btns {
            padding: 14px 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            gap: 8px;
        }

        .vp-nav-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 12px;
            font-weight: 600;
            padding: 9px 10px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .vp-nav-btn:hover {
            background: rgba(2, 179, 228, 0.15);
            border-color: rgba(2, 179, 228, 0.35);
            color: #02b3e4;
            text-decoration: none;
        }

        @media (max-width: 900px) {
            .vp-body {
                flex-direction: column;
            }

            .vp-sidebar {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .vp-title {
                font-size: 17px;
            }

            .vp-resource-btns {
                flex-direction: column;
            }

            .vp-res-btn {
                flex: unset;
                width: 100%;
            }
        }
    </style>

    <div class="vp-page">

        {{-- Top bar --}}
        <div class="vp-topbar">
            <div class="container-fluid" style="max-width:1400px; padding: 0 16px">
                <div class="vp-topbar-inner">
                    <a href="javascript:history.back()" class="vp-back-btn">
                        <i class="fa-regular fa-arrow-left"></i> Back
                    </a>
                    <div class="vp-breadcrumb">
                        <a href="{{ url('/lecture/user/' . Session::get('id')) }}">
                            <i class="fa-regular fa-circle-play"></i> My Lectures
                        </a>
                        <span class="bc-sep"><i class="fa-regular fa-chevron-right"></i></span>
                        <a href="{{ url('/batch/' . $batch_id . '/subjects') }}">{{ $batchTitle }}</a>
                        <span class="bc-sep"><i class="fa-regular fa-chevron-right"></i></span>
                        <a
                            href="{{ url('/batch/' . $batch_id . '/subject/' . $subject_id . '/chapter') }}">{{ $subjectName }}</a>
                        @if ($chapterName)
                            <span class="bc-sep"><i class="fa-regular fa-chevron-right"></i></span>
                            <span class="bc-current">{{ $chapterName }}</span>
                        @endif
                        <span class="bc-sep"><i class="fa-regular fa-chevron-right"></i></span>
                        <span class="bc-current">{{ $sheet->title }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="vp-body">

            {{-- Video column --}}
            <div class="vp-video-col">
                <h1 class="vp-title">{{ $sheet->title }}</h1>

                {{-- Player --}}
                <div class="vp-player-wrap">
                    <div class="vp-loader" id="vp-loader">
                        <div class="vp-spinner"></div>
                    </div>
                    <div class="plyr__video-embed" id="player">
                        {!! $sheet->video !!}
                    </div>
                </div>

                {{-- Tags below player --}}
                <div class="vp-meta-row">
                    <div class="vp-meta-tags">
                        <a href="{{ url('/batch/' . $batch_id . '/subjects') }}" class="vp-meta-tag">
                            <i class="fa-regular fa-layer-group"></i> {{ $subjectName }}
                        </a>
                        @if ($chapterName)
                            <span class="vp-meta-tag tag-chapter">
                                <i class="fa-regular fa-bookmark"></i> {{ $chapterName }}
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Resources --}}
                @if ($hasResources)
                    <div class="vp-resources">
                        <p class="vp-resources-title"><i class="fa-regular fa-folder-open"
                                style="margin-right:6px"></i>Resources</p>
                        <div class="vp-resource-btns">
                            @if ($hasNote1)
                                <a href="{{ $sheet->links }}" target="_blank" class="vp-res-btn vp-btn-note1">
                                    <i class="fa-regular fa-file-lines"></i> Note 1
                                </a>
                            @endif
                            @if ($hasNote2)
                                <a href="{{ $sheet->pdf }}" target="_blank" class="vp-res-btn vp-btn-note2">
                                    <i class="fa-regular fa-file-lines"></i> Note 2
                                </a>
                            @endif
                            @if ($hasPdf)
                                <a href="{{ $sheet->v_link }}" target="_blank" class="vp-res-btn vp-btn-pdf">
                                    <i class="fa-regular fa-file-pdf"></i> PDF
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="vp-sidebar">
                <div class="vp-sidebar-card">
                    <div class="vp-sidebar-header">
                        <i class="fa-regular fa-circle-info"></i>
                        <h4>Lecture Info</h4>
                    </div>
                    <div class="vp-sidebar-body">

                        <div class="vp-info-row">
                            <div class="vp-info-icon">
                                <i class="fa-regular fa-book-open"></i>
                            </div>
                            <div>
                                <p class="vp-info-label">Course</p>
                                <p class="vp-info-value">{{ $batchTitle }}</p>
                            </div>
                        </div>

                        <div class="vp-info-row">
                            <div class="vp-info-icon icon-purple">
                                <i class="fa-regular fa-layer-group"></i>
                            </div>
                            <div>
                                <p class="vp-info-label">Subject</p>
                                <p class="vp-info-value">{{ $subjectName }}</p>
                            </div>
                        </div>

                        @if ($chapterName)
                            <div class="vp-info-row">
                                <div class="vp-info-icon icon-green">
                                    <i class="fa-regular fa-bookmark"></i>
                                </div>
                                <div>
                                    <p class="vp-info-label">Chapter</p>
                                    <p class="vp-info-value">{{ $chapterName }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="vp-info-row">
                            <div class="vp-info-icon"
                                style="background:rgba(217,119,6,0.1);border-color:rgba(217,119,6,0.2);color:#fbbf24">
                                <i class="fa-regular fa-film"></i>
                            </div>
                            <div>
                                <p class="vp-info-label">Lecture</p>
                                <p class="vp-info-value">{{ $sheet->title }}</p>
                            </div>
                        </div>

                    </div>

                    <div class="vp-nav-btns">
                        <a href="{{ url('/batch/' . $batch_id . '/subject/' . $subject_id . '/chapter') }}"
                            class="vp-nav-btn">
                            <i class="fa-regular fa-list"></i> All Chapters
                        </a>
                        <a href="{{ url('/batch/' . $batch_id . '/subjects') }}" class="vp-nav-btn">
                            <i class="fa-regular fa-layer-group"></i> Subjects
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css">
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script>
        const player = new Plyr('#player', {
            controls: ['play-large', 'rewind', 'play', 'fast-forward', 'progress', 'current-time', 'duration',
                'mute', 'volume', 'captions', 'settings', 'fullscreen'
            ],
            settings: ['captions', 'quality', 'speed', 'loop'],
            quality: {
                default: 720,
                options: [1080, 720, 576, 480, 360, 240]
            },
            youtube: {
                noCookie: false,
                rel: 0,
                showinfo: 0,
                iv_load_policy: 3,
                modestbranding: 1,
            },
            disableContextMenu: true,
        });

        const loader    = document.getElementById('vp-loader');
        const vpBatchId   = {{ (int) $batch_id }};
        const vpLectureId = {{ (int) $sheet->id }};
        const csrfToken   = document.querySelector('meta[name="csrf-token"]').content;

        // Hide loader once player is ready
        player.on('ready', () => loader.classList.add('hidden'));
        player.on('playing', () => loader.classList.add('hidden'));

        // Fetch saved position and resume
        player.on('ready', () => {
            fetch(`/watch/progress/${vpBatchId}/${vpLectureId}`)
                .then(r => r.json())
                .then(data => {
                    if (data.watched_seconds > 5) {
                        player.currentTime = data.watched_seconds;
                    }
                });
        });

        // Save progress
        function saveProgress() {
            const watched  = Math.floor(player.currentTime || 0);
            const duration = Math.floor(player.duration   || 0);
            if (watched <= 0) return;
            navigator.sendBeacon
                ? navigator.sendBeacon('/watch/progress/save', (() => {
                    const fd = new FormData();
                    fd.append('batch_id',        vpBatchId);
                    fd.append('lecture_id',       vpLectureId);
                    fd.append('watched_seconds',  watched);
                    fd.append('duration_seconds', duration);
                    fd.append('_token',           csrfToken);
                    return fd;
                })())
                : fetch('/watch/progress/save', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ batch_id: vpBatchId, lecture_id: vpLectureId, watched_seconds: watched, duration_seconds: duration })
                });
        }

        // Save every 10 s while playing
        let _lastSave = 0;
        player.on('timeupdate', () => {
            const t = Math.floor(player.currentTime || 0);
            if (t - _lastSave >= 10) { _lastSave = t; saveProgress(); }
        });

        player.on('pause', saveProgress);
        player.on('ended', saveProgress);
    </script>
@endsection

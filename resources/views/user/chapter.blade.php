@extends('layouts.register')
@section('content')

@php
    $batchTitle = \App\Batchpackage::where('batch_id', $batch_id)->value('title') ?? 'Course';

    /* Flatten + compute display names into an array so JS sort is not needed */
    $chapterList = [];
    foreach ($chapters as $sub_chapters) {
        foreach ($sub_chapters as $key => $chapter) {
            $chapterName = $chapter->name;
            $sortKey     = $key + 1;

            if (substr($chapterName, 0, 4) === 'Week' && $startsFrom !== 'null') {
                $from       = (int) $startsFrom;
                $weekNumber = (int) substr($chapterName, 5);
                if ($weekNumber >= $from) {
                    $weekNumber = $weekNumber + 1 - $from;
                } else {
                    $weekNumber = 21 + $weekNumber - $from;
                }
                $chapterName = 'Week ' . $weekNumber;
                $sortKey     = $weekNumber;
            }

            $chapterList[] = [
                'id'          => $chapter->id,
                'name'        => $chapterName,
                'literature'  => $chapter->literature ?? null,
                'sort'        => $sortKey,
            ];
        }
    }
    usort($chapterList, fn($a, $b) => $a['sort'] - $b['sort']);
    $totalChapters = count($chapterList);
@endphp

<style>
.portal-page { background: #f4f6f9; min-height: 100vh; padding-bottom: 60px; font-family: "Poppins", sans-serif; }

/* Breadcrumb */
.portal-breadcrumb {
    background: #fff; border-bottom: 1px solid #e8edf3;
    padding: 12px 0; position: sticky; top: 0; z-index: 50;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.portal-breadcrumb nav { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
.portal-breadcrumb nav a { font-size: 13px; color: #6c757d; text-decoration: none; transition: color 0.2s; }
.portal-breadcrumb nav a:hover { color: #02b3e4; }
.portal-breadcrumb nav .bc-sep { color: #c4cbd6; font-size: 11px; }
.portal-breadcrumb nav .bc-current { font-size: 13px; color: #011c1a; font-weight: 600; }

/* Hero */
.portal-hero {
    background: linear-gradient(135deg, #7c3aed 0%, #011c1a 100%);
    padding: 40px 0 32px; position: relative; overflow: hidden;
}
.portal-hero::before {
    content: ''; position: absolute; top: -50px; right: -60px;
    width: 240px; height: 240px; background: rgba(255,255,255,0.05); border-radius: 50%;
}
.portal-hero-inner { position: relative; z-index: 1; }
.portal-hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25);
    border-radius: 20px; color: #fff; font-size: 11px; font-weight: 600;
    letter-spacing: 0.5px; text-transform: uppercase; padding: 4px 12px; margin-bottom: 12px;
}
.portal-hero-title {
    font-family: "Montserrat", sans-serif; font-size: 26px; font-weight: 800;
    color: #fff; margin: 0 0 4px; line-height: 1.25;
}
.portal-hero-subject {
    color: rgba(255,255,255,0.6); font-size: 13px; margin: 0 0 18px;
}
.portal-hero-count {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.15); border-radius: 20px;
    color: #fff; font-size: 12px; font-weight: 600; padding: 5px 14px;
}

/* Chapter list */
.portal-section { padding: 32px 0 0; }
.portal-section-title {
    font-family: "Montserrat", sans-serif; font-size: 17px; font-weight: 700;
    color: #011c1a; margin: 0 0 20px; display: flex; align-items: center; gap: 10px;
}
.portal-section-title::after { content: ''; flex: 1; height: 1px; background: #e8edf3; }

.chapter-list { display: flex; flex-direction: column; gap: 12px; }

.chapter-card {
    background: #fff; border: 1px solid #edf1f7; border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    display: flex; align-items: center; gap: 16px;
    padding: 16px 20px; text-decoration: none;
    transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s;
    position: relative; overflow: hidden;
}
.chapter-card:hover {
    box-shadow: 0 6px 24px rgba(124,58,237,0.14);
    transform: translateX(4px);
    border-color: #c4b5fd;
    text-decoration: none;
}
.chapter-card::before {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0;
    width: 4px; background: #e8edf3; border-radius: 12px 0 0 12px;
    transition: background 0.2s;
}
.chapter-card:hover::before { background: linear-gradient(180deg, #7c3aed, #02b3e4); }

.chapter-num {
    width: 36px; height: 36px; border-radius: 8px;
    background: #f4f6f9; border: 1.5px solid #e8edf3;
    display: flex; align-items: center; justify-content: center;
    font-family: "Montserrat", sans-serif; font-size: 13px; font-weight: 800;
    color: #6c757d; flex-shrink: 0; transition: background 0.2s, color 0.2s;
}
.chapter-card:hover .chapter-num {
    background: #f0edfe; border-color: #c4b5fd; color: #7c3aed;
}
.chapter-info { flex: 1; }
.chapter-name {
    font-family: "Montserrat", sans-serif; font-size: 14px; font-weight: 700;
    color: #011c1a; margin: 0 0 2px; line-height: 1.35;
}
.chapter-meta { font-size: 11px; color: #9aa3af; }
.chapter-lit-badge {
    display: inline-flex; align-items: center; gap: 4px;
    background: rgba(26,171,97,0.1); border: 1px solid rgba(26,171,97,0.2);
    border-radius: 20px; color: #1aab61; font-size: 11px; font-weight: 600;
    padding: 3px 10px; text-decoration: none; flex-shrink: 0;
    transition: background 0.2s;
}
.chapter-lit-badge:hover { background: rgba(26,171,97,0.18); text-decoration: none; color: #1aab61; }
.chapter-arrow {
    width: 30px; height: 30px; border-radius: 50%;
    background: #f4f6f9; border: 1.5px solid #e8edf3;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; color: #9aa3af; flex-shrink: 0;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.chapter-card:hover .chapter-arrow {
    background: #f0edfe; border-color: #c4b5fd; color: #7c3aed;
}

@media (max-width: 576px) {
    .portal-hero-title { font-size: 20px; }
    .chapter-card { padding: 14px 16px; gap: 12px; }
}
</style>

<div class="portal-page">

    {{-- Breadcrumb --}}
    <div class="portal-breadcrumb">
        <div class="container">
            <nav>
                <a href="{{ url('/lecture/user/' . Session::get('id')) }}">
                    <i class="fa-regular fa-circle-play"></i> My Lectures
                </a>
                <span class="bc-sep"><i class="fa-regular fa-chevron-right"></i></span>
                <a href="{{ url('/batch/' . $batch_id . '/subjects') }}">{{ $batchTitle }}</a>
                <span class="bc-sep"><i class="fa-regular fa-chevron-right"></i></span>
                <span class="bc-current">{{ $subject_info->name }}</span>
            </nav>
        </div>
    </div>

    {{-- Hero --}}
    <div class="portal-hero">
        <div class="container">
            <div class="portal-hero-inner">
                <div class="portal-hero-eyebrow">
                    <i class="fa-regular fa-list"></i> Chapters
                </div>
                <h1 class="portal-hero-title">{{ $subject_info->name }}</h1>
                <p class="portal-hero-subject">{{ $batchTitle }}</p>
                <span class="portal-hero-count">
                    <i class="fa-regular fa-bookmark"></i>
                    {{ $totalChapters }} Chapter{{ $totalChapters != 1 ? 's' : '' }}
                </span>
            </div>
        </div>
    </div>

    {{-- Chapter list --}}
    <div class="portal-section">
        <div class="container">
            <div class="portal-section-title">
                <i class="fa-regular fa-list" style="color:#7c3aed"></i> All Chapters
            </div>

            <div class="chapter-list">
                @foreach($chapterList as $i => $ch)
                    <a href="{{ route('chapter_classes', ['batch_id' => $batch_id, 'subject_id' => $subject_id, 'chapter_id' => $ch['id']]) }}"
                       class="chapter-card">
                        <div class="chapter-num">{{ $i + 1 }}</div>
                        <div class="chapter-info">
                            <p class="chapter-name">{{ $ch['name'] }}</p>
                            <p class="chapter-meta">Click to view lectures</p>
                        </div>
                        @if(!empty($ch['literature']))
                            <a href="{{ $ch['literature'] }}" target="_blank"
                               onclick="event.stopPropagation()"
                               class="chapter-lit-badge">
                                <i class="fa-regular fa-file-lines"></i> Literature
                            </a>
                        @endif
                        <div class="chapter-arrow">
                            <i class="fa-regular fa-chevron-right"></i>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>

</div>

@endsection

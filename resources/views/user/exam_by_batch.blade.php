@extends('layouts.register')
@section('content')

@php
    $totalExams  = $exams_raw->total();
    $batchName   = $batch_info->plan ?? 'Exam';
@endphp

<style>
.ep-page { background: #f4f6f9; min-height: 100vh; padding-bottom: 60px; font-family: "Poppins", sans-serif; }

/* Breadcrumb */
.ep-breadcrumb {
    background: #fff; border-bottom: 1px solid #e8edf3;
    padding: 12px 0; position: sticky; top: 0; z-index: 50;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.ep-breadcrumb nav { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
.ep-breadcrumb nav a { font-size: 13px; color: #6c757d; text-decoration: none; transition: color 0.2s; }
.ep-breadcrumb nav a:hover { color: #1aab61; }
.ep-breadcrumb nav .bc-sep { color: #c4cbd6; font-size: 11px; }
.ep-breadcrumb nav .bc-current { font-size: 13px; color: #011c1a; font-weight: 600; }

/* Hero */
.ep-hero {
    background: linear-gradient(135deg, #1aab61 0%, #011c1a 100%);
    padding: 44px 0 32px; position: relative; overflow: hidden;
}
.ep-hero::before {
    content: ''; position: absolute; top: -50px; right: -60px;
    width: 260px; height: 260px; background: rgba(255,255,255,0.05); border-radius: 50%;
}
.ep-hero::after {
    content: ''; position: absolute; bottom: -70px; left: -40px;
    width: 180px; height: 180px; background: rgba(255,255,255,0.04); border-radius: 50%;
}
.ep-hero-inner { position: relative; z-index: 1; }
.ep-hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25);
    border-radius: 20px; color: #fff; font-size: 11px; font-weight: 600;
    letter-spacing: 0.5px; text-transform: uppercase; padding: 4px 12px; margin-bottom: 12px;
}
.ep-hero-title {
    font-family: "Montserrat", sans-serif; font-size: 28px; font-weight: 800;
    color: #fff; margin: 0 0 6px; line-height: 1.25;
}
.ep-hero-sub { color: rgba(255,255,255,0.65); font-size: 13px; margin: 0 0 20px; }
.ep-hero-stats { display: flex; gap: 16px; flex-wrap: wrap; }
.ep-hero-stat {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);
    border-radius: 20px; color: #fff; font-size: 12px; font-weight: 600; padding: 5px 14px;
}

/* Free instructions banner */
.ep-instructions-banner {
    background: #fffbeb; border: 1px solid #fcd34d;
    border-radius: 12px; padding: 16px 20px; margin-bottom: 24px;
    display: flex; align-items: flex-start; gap: 14px;
}
.ep-instructions-icon {
    width: 38px; height: 38px; border-radius: 10px;
    background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.3);
    display: flex; align-items: center; justify-content: center;
    color: #d97706; font-size: 16px; flex-shrink: 0;
}
.ep-instructions-text h4 {
    font-family: "Montserrat", sans-serif; font-size: 14px; font-weight: 700;
    color: #92400e; margin: 0 0 4px;
}
.ep-instructions-text p { font-size: 13px; color: #78350f; margin: 0 0 10px; }
.ep-instructions-link {
    display: inline-flex; align-items: center; gap: 6px;
    background: #d97706; color: #fff; padding: 7px 16px;
    border-radius: 8px; font-size: 12px; font-weight: 600; text-decoration: none;
    transition: background 0.2s;
}
.ep-instructions-link:hover { background: #b45309; color: #fff; text-decoration: none; }

/* Section */
.ep-section { padding: 32px 0 0; }
.ep-section-title {
    font-family: "Montserrat", sans-serif; font-size: 17px; font-weight: 700;
    color: #011c1a; margin: 0 0 20px; display: flex; align-items: center; gap: 10px;
}
.ep-section-title::after { content: ''; flex: 1; height: 1px; background: #e8edf3; }

/* Exam cards */
.exam-cards-list { display: flex; flex-direction: column; gap: 12px; }

.exam-item-card {
    background: #fff; border: 1px solid #edf1f7; border-radius: 14px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    display: flex; align-items: center; gap: 16px; padding: 18px 22px;
    transition: box-shadow 0.22s, border-color 0.22s, transform 0.22s;
    position: relative; overflow: hidden;
}
.exam-item-card:hover {
    box-shadow: 0 6px 28px rgba(26,171,97,0.14);
    border-color: #6ee7b7;
    transform: translateX(3px);
}
.exam-item-card::before {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0;
    width: 4px; border-radius: 14px 0 0 14px;
    background: #e8edf3; transition: background 0.2s;
}
.exam-item-card:hover::before { background: linear-gradient(180deg, #1aab61, #02b3e4); }

/* Serial badge */
.exam-serial {
    width: 38px; height: 38px; border-radius: 10px;
    background: #f4f6f9; border: 1.5px solid #e8edf3;
    display: flex; align-items: center; justify-content: center;
    font-family: "Montserrat", sans-serif; font-size: 13px; font-weight: 800;
    color: #6c757d; flex-shrink: 0;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.exam-item-card:hover .exam-serial {
    background: rgba(26,171,97,0.1); border-color: #6ee7b7; color: #1aab61;
}

/* Info */
.exam-item-info { flex: 1; min-width: 0; }
.exam-item-name {
    font-family: "Montserrat", sans-serif; font-size: 14px; font-weight: 700;
    color: #011c1a; margin: 0 0 8px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.exam-item-meta { display: flex; gap: 10px; flex-wrap: wrap; }
.exam-meta-chip {
    display: inline-flex; align-items: center; gap: 5px;
    background: #f4f6f9; border: 1px solid #e8edf3;
    border-radius: 20px; font-size: 11px; font-weight: 600; color: #6c757d;
    padding: 3px 10px;
}
.exam-meta-chip i { font-size: 10px; }
.chip-marks { border-color: rgba(2,179,228,0.3);  color: #0196c0;  background: rgba(2,179,228,0.07); }
.chip-time  { border-color: rgba(124,58,237,0.3); color: #7c3aed;  background: rgba(124,58,237,0.07); }

/* Start button */
.exam-start-btn {
    display: inline-flex; align-items: center; gap: 7px;
    background: linear-gradient(135deg, #1aab61, #118a4d);
    color: #fff; padding: 9px 20px; border-radius: 10px;
    font-size: 13px; font-weight: 700; text-decoration: none; flex-shrink: 0;
    transition: all 0.2s; box-shadow: 0 2px 8px rgba(26,171,97,0.3);
}
.exam-start-btn:hover {
    background: linear-gradient(135deg, #118a4d, #011c1a);
    color: #fff; text-decoration: none;
    transform: translateY(-2px); box-shadow: 0 4px 16px rgba(26,171,97,0.4);
}
.exam-start-btn i { font-size: 11px; }

/* Empty state */
.ep-empty {
    text-align: center; padding: 72px 24px; background: #fff;
    border-radius: 14px; border: 2px dashed #d1d9e6;
}
.ep-empty i { font-size: 40px; color: #c4cbd6; display: block; margin-bottom: 16px; }
.ep-empty h3 { font-family: "Montserrat", sans-serif; font-size: 17px; font-weight: 700; color: #4a5568; margin: 0 0 6px; }
.ep-empty p { font-size: 13px; color: #9aa3af; margin: 0; }

/* Pagination */
.ep-pagination { margin-top: 28px; display: flex; justify-content: center; }
.ep-pagination .pagination { gap: 4px; }
.ep-pagination .page-link {
    border-radius: 8px !important; border: 1.5px solid #e8edf3;
    color: #4a5568; font-size: 13px; font-weight: 600;
    padding: 6px 12px; transition: all 0.2s;
}
.ep-pagination .page-link:hover { background: rgba(26,171,97,0.08); border-color: #6ee7b7; color: #1aab61; }
.ep-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #1aab61, #118a4d);
    border-color: transparent; color: #fff;
}

@media (max-width: 576px) {
    .ep-hero-title { font-size: 22px; }
    .exam-item-card { flex-wrap: wrap; gap: 12px; padding: 16px; }
    .exam-start-btn { width: 100%; justify-content: center; }
}
</style>

<div class="ep-page">

    {{-- Breadcrumb --}}
    <div class="ep-breadcrumb">
        <div class="container">
            <nav>
                <a href="{{ url('/exam/user/' . Session::get('id')) }}">
                    <i class="fa-regular fa-file-pen"></i> My Exams
                </a>
                <span class="bc-sep"><i class="fa-regular fa-chevron-right"></i></span>
                <span class="bc-current">{{ $batchName }}</span>
            </nav>
        </div>
    </div>

    {{-- Hero --}}
    <div class="ep-hero">
        <div class="container">
            <div class="ep-hero-inner">
                <div class="ep-hero-eyebrow">
                    <i class="fa-regular fa-list-check"></i> Model Tests
                </div>
                <h1 class="ep-hero-title">{{ $batchName }}</h1>
                <p class="ep-hero-sub">Select an exam below to begin your test session.</p>
                <div class="ep-hero-stats">
                    <span class="ep-hero-stat">
                        <i class="fa-regular fa-file-pen"></i> {{ $totalExams }} Exam{{ $totalExams != 1 ? 's' : '' }}
                    </span>
                    @if($free)
                        <span class="ep-hero-stat">
                            <i class="fa-regular fa-unlock"></i> Free Access
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="ep-section">
        <div class="container">

            {{-- Free instructions banner --}}
            @if($free)
                <div class="ep-instructions-banner">
                    <div class="ep-instructions-icon">
                        <i class="fa-regular fa-circle-info"></i>
                    </div>
                    <div class="ep-instructions-text">
                        <h4>Before You Begin</h4>
                        <p>Please read the exam instructions carefully before attempting any free exam.</p>
                        <a href="/help" class="ep-instructions-link">
                            <i class="fa-regular fa-book-open"></i> Read Instructions
                        </a>
                    </div>
                </div>
            @endif

            <div class="ep-section-title">
                <i class="fa-regular fa-list-check" style="color:#1aab61"></i> Available Exams
            </div>

            @if($exams_raw->isEmpty())
                <div class="ep-empty">
                    <i class="fa-regular fa-folder-open"></i>
                    <h3>No Exams Available</h3>
                    <p>No model tests have been assigned to this course yet.</p>
                </div>
            @else
                @php $startNum = ($exams_raw->perPage() * ($exams_raw->currentPage() - 1)) + 1; @endphp
                <div class="exam-cards-list">
                    @foreach($exams_raw as $exam)
                        <div class="exam-item-card">
                            <div class="exam-serial">{{ $startNum++ }}</div>
                            <div class="exam-item-info">
                                <p class="exam-item-name">{{ $exam->name }}</p>
                                <div class="exam-item-meta">
                                    <span class="exam-meta-chip chip-marks">
                                        <i class="fa-regular fa-star"></i>
                                        {{ $exam->exam_in_minutes }} Marks
                                    </span>
                                    <span class="exam-meta-chip chip-time">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $exam->ex_time }} Minutes
                                    </span>
                                </div>
                            </div>
                            <a href="{{ url('/spacialmodeltest-examm/' . $exam->id) }}"
                               class="exam-start-btn">
                                <i class="fa-solid fa-play"></i> Start Exam
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="ep-pagination">
                    {{ $exams_raw->links() }}
                </div>
            @endif

        </div>
    </div>

</div>

@endsection

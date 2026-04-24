@extends('layouts.register')

@section('content')

<style>
/* ── Page shell */
.exam-page {
    background: #f4f6f9;
    min-height: 100vh;
    padding-bottom: 60px;
    font-family: "Poppins", sans-serif;
}

/* ── Hero banner */
.exam-hero {
    background: linear-gradient(135deg, #1aab61 0%, #011c1a 100%);
    padding: 52px 0 36px;
    position: relative;
    overflow: hidden;
}
.exam-hero::before {
    content: '';
    position: absolute;
    top: -60px; right: -80px;
    width: 300px; height: 300px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
}
.exam-hero::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -40px;
    width: 200px; height: 200px;
    background: rgba(255,255,255,0.04);
    border-radius: 50%;
}
.exam-hero-inner {
    position: relative;
    z-index: 1;
}
.exam-hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 20px;
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    padding: 5px 14px;
    margin-bottom: 16px;
}
.exam-hero-title {
    font-family: "Montserrat", sans-serif;
    font-size: 32px;
    font-weight: 800;
    color: #fff;
    margin: 0 0 10px;
    line-height: 1.2;
}
.exam-hero-sub {
    color: rgba(255,255,255,0.78);
    font-size: 14px;
    margin: 0;
}
.exam-hero-stats {
    display: flex;
    gap: 28px;
    margin-top: 24px;
    flex-wrap: wrap;
}
.exam-hero-stat-value {
    font-family: "Montserrat", sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: #fff;
    line-height: 1;
}
.exam-hero-stat-label {
    font-size: 11px;
    color: rgba(255,255,255,0.65);
    font-weight: 500;
    margin-top: 4px;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

/* ── Free exams strip */
.free-exams-strip {
    background: #fff;
    border-bottom: 1px solid #e8edf3;
    padding: 14px 0;
}
.free-exams-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}
.free-exams-text {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #4a5568;
}
.free-exams-text i { color: #1aab61; font-size: 18px; }
.free-exams-text strong { color: #011c1a; }
.free-exam-btn-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}
.free-exam-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    border: 1.5px solid #1aab61;
    color: #1aab61;
    background: transparent;
    transition: all 0.2s;
}
.free-exam-btn:hover {
    background: #1aab61;
    color: #fff;
    text-decoration: none;
}

/* ── Section heading */
.exam-section-heading {
    margin: 40px 0 24px;
}
.exam-section-heading h2 {
    font-family: "Montserrat", sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #011c1a;
    margin: 0 0 4px;
}
.exam-section-heading p {
    font-size: 13px;
    color: #6c757d;
    margin: 0;
}

/* ── Cards grid */
.exam-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

/* ── Individual exam card */
.exam-course-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.06);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.25s, transform 0.25s;
    border: 1px solid #edf1f7;
}
.exam-course-card:hover {
    box-shadow: 0 8px 32px rgba(26,171,97,0.14);
    transform: translateY(-3px);
}
.exam-card-stripe {
    height: 5px;
    background: linear-gradient(90deg, #1aab61, #02b3e4);
}
.exam-card-stripe.stripe-warning { background: linear-gradient(90deg, #f59e0b, #ef4444); }
.exam-card-stripe.stripe-danger  { background: linear-gradient(90deg, #ef4444, #b91c1c); }

.exam-card-body {
    padding: 22px 24px 18px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.exam-card-title {
    font-family: "Montserrat", sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: #011c1a;
    margin: 0 0 6px;
    line-height: 1.35;
}
.exam-card-meta {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #6c757d;
    margin-bottom: 16px;
}
.exam-card-meta i { color: #1aab61; font-size: 13px; }

/* Subscription bar */
.exam-sub-info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
}
.exam-sub-info-label {
    font-size: 11px;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}
.exam-days-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
}
.exam-days-badge.good    { background: rgba(26,171,97,0.1);  color: #1aab61; }
.exam-days-badge.warning { background: rgba(245,158,11,0.12); color: #d97706; }
.exam-days-badge.danger  { background: rgba(239,68,68,0.1);  color: #dc2626; }

.exam-progress-bar {
    width: 100%;
    height: 6px;
    background: #edf1f7;
    border-radius: 3px;
    overflow: hidden;
    margin-bottom: 6px;
}
.exam-progress-fill {
    height: 100%;
    border-radius: 3px;
    background: linear-gradient(90deg, #1aab61, #02b3e4);
    transition: width 0.6s ease;
}
.exam-progress-fill.fill-warning { background: linear-gradient(90deg, #f59e0b, #ef4444); }
.exam-progress-fill.fill-danger  { background: linear-gradient(90deg, #ef4444, #b91c1c); }
.exam-sub-end-date {
    font-size: 11px;
    color: #9aa3af;
    text-align: right;
    margin-bottom: 20px;
}

/* Info chips row */
.exam-info-chips {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 18px;
}
.exam-info-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #f4f6f9;
    border: 1px solid #e8edf3;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    color: #4a5568;
    padding: 4px 10px;
}
.exam-info-chip i { color: #1aab61; font-size: 11px; }

/* Action buttons */
.exam-card-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid #f0f4f8;
}
.exam-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 18px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    border: 1.5px solid transparent;
    transition: all 0.2s;
    flex: 1;
    justify-content: center;
}
.btn-exam-primary {
    background: linear-gradient(135deg, #1aab61, #118a4d);
    color: #fff;
    border-color: transparent;
}
.btn-exam-primary:hover {
    background: linear-gradient(135deg, #118a4d, #011c1a);
    color: #fff;
    text-decoration: none;
    transform: translateY(-1px);
}
.btn-history-pill {
    background: transparent;
    border-color: #d1d9e6;
    color: #4a5568;
}
.btn-history-pill:hover {
    border-color: #1aab61;
    color: #1aab61;
    text-decoration: none;
}

/* ── Empty state */
.exam-empty {
    text-align: center;
    padding: 80px 24px;
    background: #fff;
    border-radius: 16px;
    border: 2px dashed #d1d9e6;
}
.exam-empty-icon {
    width: 80px;
    height: 80px;
    background: rgba(26,171,97,0.08);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.exam-empty-icon i {
    font-size: 32px;
    color: #1aab61;
}
.exam-empty h3 {
    font-family: "Montserrat", sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #011c1a;
    margin: 0 0 8px;
}
.exam-empty p {
    font-size: 13px;
    color: #6c757d;
    margin: 0 0 24px;
}
.btn-browse-exam {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #1aab61, #118a4d);
    color: #fff;
    padding: 11px 28px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}
.btn-browse-exam:hover {
    background: linear-gradient(135deg, #118a4d, #011c1a);
    color: #fff;
    text-decoration: none;
}

@media (max-width: 576px) {
    .exam-hero-title { font-size: 24px; }
    .exam-cards-grid { grid-template-columns: 1fr; }
    .exam-card-actions { flex-direction: column; }
    .exam-action-btn { flex: unset; width: 100%; }
}
</style>

<div class="exam-page">

    {{-- ── Hero Banner ── --}}
    <div class="exam-hero">
        <div class="container">
            <div class="exam-hero-inner">
                <div class="exam-hero-eyebrow">
                    <i class="fa-regular fa-file-pen"></i> My Exams
                </div>
                <h1 class="exam-hero-title">Take Exam</h1>
                <p class="exam-hero-sub">Test your knowledge with model tests from your enrolled courses.</p>

                @php
                    $totalBatches = count($enrolledBatches);
                    $activeCount = 0;
                    foreach ($enrolledBatches as $b) {
                        if (!empty($b->subscription_end)) {
                            $dEnd = new DateTime(substr($b->subscription_end, 0, 10));
                            $dNow = new DateTime(date('Y-m-d'));
                            if ($dEnd >= $dNow) $activeCount++;
                        }
                    }
                @endphp

                <div class="exam-hero-stats">
                    <div>
                        <div class="exam-hero-stat-value">{{ $totalBatches }}</div>
                        <div class="exam-hero-stat-label">Enrolled</div>
                    </div>
                    <div>
                        <div class="exam-hero-stat-value">{{ $activeCount }}</div>
                        <div class="exam-hero-stat-label">Active</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Free Exams Strip ── --}}
    <div class="free-exams-strip">
        <div class="container">
            <div class="free-exams-inner">
                <div class="free-exams-text">
                    <i class="fa-regular fa-list-check"></i>
                    <span><strong>Free Exams</strong> — Practice without enrollment</span>
                </div>
                <div class="free-exam-btn-group">
                    <a href="{{ url('/free_exam/batch/1') }}" class="free-exam-btn">
                        <i class="fa-regular fa-stethoscope"></i> Medicine
                    </a>
                    <a href="{{ url('/free_exam/batch/2') }}" class="free-exam-btn">
                        <i class="fa-regular fa-tooth"></i> Dentistry
                    </a>
                    <a href="{{ url('/free_exam/batch/3') }}" class="free-exam-btn">
                        <i class="fa-regular fa-landmark"></i> BCS
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Main Content ── --}}
    <div class="container">

        @if($enrolledBatches->isEmpty())

            <div class="exam-section-heading">
                <h2>Your Courses</h2>
            </div>
            <div class="exam-empty">
                <div class="exam-empty-icon">
                    <i class="fa-regular fa-file-pen"></i>
                </div>
                <h3>No Active Enrollments</h3>
                <p>Enroll in a course to start taking exams.</p>
                <a href="{{ url('/batches') }}" class="btn-browse-exam">
                    <i class="fa-regular fa-search"></i> Browse Courses
                </a>
            </div>

        @else

            <div class="exam-section-heading">
                <h2>Your Enrolled Courses</h2>
                <p>{{ $activeCount }} active subscription{{ $activeCount != 1 ? 's' : '' }}</p>
            </div>

            <div class="exam-cards-grid">
                @foreach($enrolledBatches as $batch)
                    @php
                        $endStr   = substr($batch->subscription_end, 0, 10);
                        $endDate  = new DateTime($endStr);
                        $nowDate  = new DateTime(date('Y-m-d'));
                        $remaining = (int) $endDate->diff($nowDate)->format('%a');
                        $totalDays = 365;
                        $usedPct   = max(0, min(100, round((($totalDays - $remaining) / $totalDays) * 100)));

                        if ($remaining <= 7) {
                            $daysClass = 'danger';
                        } elseif ($remaining <= 15) {
                            $daysClass = 'warning';
                        } else {
                            $daysClass = 'good';
                        }
                        $stripeClass = $daysClass === 'good' ? '' : ($daysClass === 'warning' ? 'stripe-warning' : 'stripe-danger');
                        $fillClass   = $daysClass === 'good' ? '' : ($daysClass === 'warning' ? 'fill-warning' : 'fill-danger');
                    @endphp

                    <div class="exam-course-card">
                        <div class="exam-card-stripe {{ $stripeClass }}"></div>
                        <div class="exam-card-body">
                            <h3 class="exam-card-title">{{ $batch->title }}</h3>
                            <div class="exam-card-meta">
                                <i class="fa-regular fa-calendar-clock"></i>
                                Subscription active until {{ $endStr }}
                            </div>

                            {{-- Subscription progress --}}
                            <div class="exam-sub-info-row">
                                <span class="exam-sub-info-label">Time Remaining</span>
                                <span class="exam-days-badge {{ $daysClass }}">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $remaining }} day{{ $remaining != 1 ? 's' : '' }}
                                </span>
                            </div>
                            <div class="exam-progress-bar">
                                <div class="exam-progress-fill {{ $fillClass }}" style="width: {{ $usedPct }}%"></div>
                            </div>
                            <div class="exam-sub-end-date">Ends {{ $endStr }}</div>

                            {{-- Info chips --}}
                            <div class="exam-info-chips">
                                <span class="exam-info-chip">
                                    <i class="fa-regular fa-graduation-cap"></i> Model Tests Available
                                </span>
                                <span class="exam-info-chip">
                                    <i class="fa-regular fa-chart-bar"></i> Track Results
                                </span>
                            </div>

                            {{-- Actions --}}
                            <div class="exam-card-actions">
                                <a href="{{ url('exam_by_batch/' . $batch->batch_id) }}"
                                   class="exam-action-btn btn-exam-primary">
                                    <i class="fa-regular fa-play"></i> Start Exam
                                </a>
                                <a href="{{ url('/my_exam_history/' . $batch->batch_id) }}"
                                   class="exam-action-btn btn-history-pill">
                                    <i class="fa-regular fa-clock-rotate-left"></i> History
                                </a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

        @endif

    </div>
</div>

@endsection

@extends('layouts.register')

@section('content')

<style>
/* ── Page shell */
.learning-page {
    background: #f4f6f9;
    min-height: 100vh;
    padding-bottom: 60px;
    font-family: "Poppins", sans-serif;
}

/* ── Hero banner */
.learning-hero {
    background: linear-gradient(135deg, #02b3e4 0%, #011c1a 100%);
    padding: 52px 0 36px;
    position: relative;
    overflow: hidden;
}
.learning-hero::before {
    content: '';
    position: absolute;
    top: -60px; right: -80px;
    width: 320px; height: 320px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
}
.learning-hero::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -40px;
    width: 200px; height: 200px;
    background: rgba(255,255,255,0.04);
    border-radius: 50%;
}
.learning-hero-inner {
    position: relative;
    z-index: 1;
}
.learning-hero-eyebrow {
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
.learning-hero-title {
    font-family: "Montserrat", sans-serif;
    font-size: 32px;
    font-weight: 800;
    color: #fff;
    margin: 0 0 10px;
    line-height: 1.2;
}
.learning-hero-sub {
    color: rgba(255,255,255,0.78);
    font-size: 14px;
    margin: 0;
}
.learning-hero-stats {
    display: flex;
    gap: 28px;
    margin-top: 24px;
    flex-wrap: wrap;
}
.hero-stat {
    text-align: center;
}
.hero-stat-value {
    font-family: "Montserrat", sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: #fff;
    line-height: 1;
}
.hero-stat-label {
    font-size: 11px;
    color: rgba(255,255,255,0.65);
    font-weight: 500;
    margin-top: 4px;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

/* ── Free lecture CTA strip */
.free-lectures-strip {
    background: #fff;
    border-bottom: 1px solid #e8edf3;
    padding: 14px 0;
}
.free-lectures-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}
.free-lectures-text {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #4a5568;
}
.free-lectures-text i { color: #02b3e4; font-size: 18px; }
.free-lectures-text strong { color: #011c1a; }
.free-btn-group {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}
.free-faculty-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    border: 1.5px solid #02b3e4;
    color: #02b3e4;
    background: transparent;
    transition: all 0.2s;
}
.free-faculty-btn:hover {
    background: #02b3e4;
    color: #fff;
    text-decoration: none;
}

/* ── Section heading */
.section-heading {
    margin: 40px 0 24px;
}
.section-heading h2 {
    font-family: "Montserrat", sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #011c1a;
    margin: 0 0 4px;
}
.section-heading p {
    font-size: 13px;
    color: #6c757d;
    margin: 0;
}

/* ── Course cards grid */
.course-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

/* ── Individual course card */
.lec-course-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.06);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.25s, transform 0.25s;
    border: 1px solid #edf1f7;
}
.lec-course-card:hover {
    box-shadow: 0 8px 32px rgba(2,179,228,0.14);
    transform: translateY(-3px);
}

/* Card accent stripe */
.lec-card-stripe {
    height: 5px;
    background: linear-gradient(90deg, #02b3e4, #1aab61);
}
.lec-card-stripe.stripe-warning { background: linear-gradient(90deg, #f59e0b, #ef4444); }
.lec-card-stripe.stripe-danger  { background: linear-gradient(90deg, #ef4444, #b91c1c); }

.lec-card-body {
    padding: 22px 24px 18px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.lec-card-title {
    font-family: "Montserrat", sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: #011c1a;
    margin: 0 0 6px;
    line-height: 1.35;
}
.lec-card-meta {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #6c757d;
    margin-bottom: 16px;
}
.lec-card-meta i { color: #02b3e4; font-size: 13px; }

/* Subscription bar */
.sub-info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
}
.sub-info-label {
    font-size: 11px;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}
.days-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
}
.days-badge.good    { background: rgba(26,171,97,0.1);  color: #1aab61; }
.days-badge.warning { background: rgba(245,158,11,0.12); color: #d97706; }
.days-badge.danger  { background: rgba(239,68,68,0.1);  color: #dc2626; }

.lec-progress-bar {
    width: 100%;
    height: 6px;
    background: #edf1f7;
    border-radius: 3px;
    overflow: hidden;
    margin-bottom: 6px;
}
.lec-progress-fill {
    height: 100%;
    border-radius: 3px;
    background: linear-gradient(90deg, #02b3e4, #1aab61);
    transition: width 0.6s ease;
}
.lec-progress-fill.fill-warning { background: linear-gradient(90deg, #f59e0b, #ef4444); }
.lec-progress-fill.fill-danger  { background: linear-gradient(90deg, #ef4444, #b91c1c); }
.sub-end-date {
    font-size: 11px;
    color: #9aa3af;
    text-align: right;
    margin-bottom: 20px;
}

/* Action buttons */
.lec-card-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid #f0f4f8;
}
.lec-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    border: 1.5px solid transparent;
    transition: all 0.2s;
    flex: 1;
    justify-content: center;
    min-width: 80px;
}
.btn-lectures-primary {
    background: linear-gradient(135deg, #02b3e4, #0196c0);
    color: #fff;
    border-color: transparent;
}
.btn-lectures-primary:hover {
    background: linear-gradient(135deg, #0196c0, #011c1a);
    color: #fff;
    text-decoration: none;
    transform: translateY(-1px);
}
.btn-schedule-pill {
    background: transparent;
    border-color: #d1d9e6;
    color: #4a5568;
}
.btn-schedule-pill:hover {
    border-color: #02b3e4;
    color: #02b3e4;
    text-decoration: none;
}

/* ── Empty state */
.learning-empty {
    text-align: center;
    padding: 80px 24px;
    background: #fff;
    border-radius: 16px;
    border: 2px dashed #d1d9e6;
}
.learning-empty-icon {
    width: 80px;
    height: 80px;
    background: rgba(2,179,228,0.08);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.learning-empty-icon i {
    font-size: 32px;
    color: #02b3e4;
}
.learning-empty h3 {
    font-family: "Montserrat", sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #011c1a;
    margin: 0 0 8px;
}
.learning-empty p {
    font-size: 13px;
    color: #6c757d;
    margin: 0 0 24px;
}
.btn-browse {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #02b3e4, #0196c0);
    color: #fff;
    padding: 11px 28px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}
.btn-browse:hover {
    background: linear-gradient(135deg, #0196c0, #011c1a);
    color: #fff;
    text-decoration: none;
}

@media (max-width: 576px) {
    .learning-hero-title { font-size: 24px; }
    .course-cards-grid { grid-template-columns: 1fr; }
    .lec-card-actions { flex-direction: column; }
    .lec-action-btn { flex: unset; width: 100%; }
}
</style>

<div class="learning-page">

    {{-- ── Hero Banner ── --}}
    <div class="learning-hero">
        <div class="container">
            <div class="learning-hero-inner">
                <div class="learning-hero-eyebrow">
                    <i class="fa-regular fa-circle-play"></i> My Lectures
                </div>
                <h1 class="learning-hero-title">Watch Lectures</h1>
                <p class="learning-hero-sub">Access your enrolled course lectures and continue learning.</p>

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

                <div class="learning-hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-value">{{ $totalBatches }}</div>
                        <div class="hero-stat-label">Enrolled</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-value">{{ $activeCount }}</div>
                        <div class="hero-stat-label">Active</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Free Lectures Strip ── --}}
    <div class="free-lectures-strip">
        <div class="container">
            <div class="free-lectures-inner">
                <div class="free-lectures-text">
                    <i class="fa-regular fa-video"></i>
                    <span><strong>Free Lectures</strong> — Browse without enrollment</span>
                </div>
                <div class="free-btn-group">
                    <a href="{{ url('/free_lectures/batch/1') }}" class="free-faculty-btn">
                        <i class="fa-regular fa-stethoscope"></i> Medicine
                    </a>
                    <a href="{{ url('/free_lectures/batch/2') }}" class="free-faculty-btn">
                        <i class="fa-regular fa-tooth"></i> Dentistry
                    </a>
                    <a href="{{ url('/free_lectures/batch/3') }}" class="free-faculty-btn">
                        <i class="fa-regular fa-landmark"></i> BCS
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Main Content ── --}}
    <div class="container">

        @if($enrolledBatches->isEmpty())

            <div class="section-heading">
                <h2>Your Courses</h2>
            </div>
            <div class="learning-empty">
                <div class="learning-empty-icon">
                    <i class="fa-regular fa-book-open"></i>
                </div>
                <h3>No Active Enrollments</h3>
                <p>Enroll in a course to start watching lectures.</p>
                <a href="{{ url('/batches') }}" class="btn-browse">
                    <i class="fa-regular fa-search"></i> Browse Courses
                </a>
            </div>

        @else

            <div class="section-heading">
                <h2>Your Enrolled Courses</h2>
                <p>{{ $activeCount }} active subscription{{ $activeCount != 1 ? 's' : '' }}</p>
            </div>

            <div class="course-cards-grid">
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

                    <div class="lec-course-card">
                        <div class="lec-card-stripe {{ $stripeClass }}"></div>
                        <div class="lec-card-body">
                            <h3 class="lec-card-title">{{ $batch->title }}</h3>
                            <div class="lec-card-meta">
                                <i class="fa-regular fa-calendar-clock"></i>
                                Subscription active until {{ $endStr }}
                            </div>

                            {{-- Progress bar --}}
                            <div class="sub-info-row">
                                <span class="sub-info-label">Time Remaining</span>
                                <span class="days-badge {{ $daysClass }}">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $remaining }} day{{ $remaining != 1 ? 's' : '' }}
                                </span>
                            </div>
                            <div class="lec-progress-bar">
                                <div class="lec-progress-fill {{ $fillClass }}" style="width: {{ $usedPct }}%"></div>
                            </div>
                            <div class="sub-end-date">Ends {{ $endStr }}</div>

                            {{-- Actions --}}
                            <div class="lec-card-actions">
                                <a href="{{ url('batch/' . $batch->batch_id . '/subjects') }}"
                                   class="lec-action-btn btn-lectures-primary">
                                    <i class="fa-regular fa-circle-play"></i> Go to Lectures
                                </a>
                                @if(!empty($batch->fild_5))
                                    <a href="{{ $batch->fild_5 }}" target="_blank"
                                       class="lec-action-btn btn-schedule-pill">
                                        <i class="fa-regular fa-calendar-lines"></i> Schedule
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

        @endif

    </div>
</div>

@endsection

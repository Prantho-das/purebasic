@extends('layouts.register')
@section('content')

@php
    $totalQ      = $modelTestAnswer->total_mcq + $modelTestAnswer->total_sba;
    $isPassed    = $modelTestAnswer->pass_status === 'Passed';
    $isRegular   = $modelTest->exam_pattern === 'Regular exam';
    $isLecture   = $modelTest->exam_pattern === 'Lecture';
    $pct         = $modelTestAnswer->percentage ?? 0;
    $point       = $modelTestAnswer->point ?? 0;
    $totalMark   = $modelTest->exam_in_minutes;
@endphp

<style>
.result-page { background: #f0f2f5; min-height: 100vh; padding-bottom: 60px; font-family: "Poppins", sans-serif; }

/* ── Top bar */
.result-topbar {
    background: #fff; border-bottom: 2px solid #e8edf3;
    padding: 0 24px; height: 60px;
    display: flex; align-items: center; gap: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}
.result-topbar a {
    display: inline-flex; align-items: center; gap: 7px;
    background: #f4f6f9; border: 1.5px solid #e8edf3; border-radius: 8px;
    color: #4a5568; font-size: 13px; font-weight: 600; padding: 7px 14px;
    text-decoration: none; transition: all 0.2s;
}
.result-topbar a:hover { background: rgba(26,171,97,0.08); border-color: #6ee7b7; color: #1aab61; text-decoration: none; }
.result-topbar-title {
    font-family: "Montserrat", sans-serif; font-size: 15px; font-weight: 800;
    color: #011c1a; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

/* ── Score card */
.result-score-section {
    background: {{ $isPassed ? 'linear-gradient(135deg, #1aab61 0%, #011c1a 100%)' : 'linear-gradient(135deg, #dc2626 0%, #011c1a 100%)' }};
    padding: 44px 0 36px; position: relative; overflow: hidden;
}
.result-score-section::before {
    content: ''; position: absolute; top:-60px; right:-80px;
    width:280px; height:280px; background:rgba(255,255,255,0.05); border-radius:50%;
}
.result-score-inner { position: relative; z-index: 1; }

/* Circular progress */
.score-circle-wrap {
    display: flex; flex-direction: column; align-items: center; margin-bottom: 28px;
}
.score-circle {
    width: 140px; height: 140px; position: relative; margin-bottom: 16px;
}
.score-circle svg { width: 100%; height: 100%; transform: rotate(-90deg); }
.score-bg { fill: none; stroke: rgba(255,255,255,0.15); stroke-width: 10; }
.score-fill {
    fill: none; stroke: #fff; stroke-width: 10;
    stroke-linecap: round;
    stroke-dasharray: 345;
    stroke-dashoffset: {{ 345 - round(345 * $pct / 100) }};
    transition: stroke-dashoffset 1.2s ease;
}
.score-circle-inner {
    position: absolute; inset: 0;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
}
.score-pct {
    font-family: "Montserrat", sans-serif; font-size: 28px; font-weight: 900;
    color: #fff; line-height: 1;
}
.score-pct-label { font-size: 11px; color: rgba(255,255,255,0.7); font-weight: 600; }

.result-pass-badge {
    display: inline-flex; align-items: center; gap: 8px;
    border: 2px solid rgba(255,255,255,0.4); border-radius: 30px;
    color: #fff; font-family: "Montserrat", sans-serif;
    font-size: 16px; font-weight: 800; padding: 8px 24px;
    background: rgba(255,255,255,0.15);
}

/* Stats grid */
.score-stats-grid {
    display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px;
    background: rgba(255,255,255,0.08); border-radius: 14px; padding: 18px 20px;
}
.score-stat { text-align: center; }
.score-stat-val {
    font-family: "Montserrat", sans-serif; font-size: 22px; font-weight: 900;
    color: #fff; line-height: 1;
}
.score-stat-label {
    font-size: 11px; color: rgba(255,255,255,0.6); font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.4px; margin-top: 4px;
}
.score-stat-divider {
    width: 1px; background: rgba(255,255,255,0.2); margin: 4px auto 0;
}

/* Mark breakdown */
.mark-breakdown {
    background: rgba(255,255,255,0.1); border-radius: 12px;
    padding: 16px 20px; margin-top: 16px;
}
.mark-breakdown-title {
    font-size: 12px; font-weight: 700; color: rgba(255,255,255,0.6);
    text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 12px;
}
.mark-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.08);
}
.mark-row:last-child { border-bottom: none; padding-bottom: 0; }
.mark-label { font-size: 13px; color: rgba(255,255,255,0.8); font-weight: 500; }
.mark-value {
    font-family: "Montserrat", sans-serif; font-size: 14px; font-weight: 800; color: #fff;
}

/* ── Legend */
.result-legend {
    background: #fff; border: 1px solid #e8edf3; border-radius: 12px;
    padding: 14px 18px; margin: 24px 0; display: flex; align-items: center; gap: 20px; flex-wrap: wrap;
}
.legend-pill {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 12px; font-weight: 600; color: #4a5568;
}
.lp-dot {
    width: 14px; height: 14px; border-radius: 3px; flex-shrink: 0;
}
.lp-correct-you  { background: rgba(26,171,97,0.25);  border: 1.5px solid #1aab61; }
.lp-wrong-you    { background: rgba(220,38,38,0.15);   border: 1.5px solid #dc2626; }
.lp-correct-only { background: rgba(2,179,228,0.15);   border: 1.5px solid #02b3e4; }

/* ── Answer review cards */
.review-section { margin-top: 4px; }
.review-section-title {
    font-family: "Montserrat", sans-serif; font-size: 17px; font-weight: 700;
    color: #011c1a; margin: 0 0 16px; display: flex; align-items: center; gap: 10px;
}
.review-section-title::after { content: ''; flex: 1; height: 1px; background: #e8edf3; }

.review-q-card {
    background: #fff; border: 1px solid #edf1f7; border-radius: 14px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04); margin-bottom: 14px; overflow: hidden;
}
.review-q-header {
    padding: 14px 20px; border-bottom: 1px solid #f0f4f8;
    display: flex; align-items: center; gap: 10px;
}
.review-q-num {
    background: #f4f6f9; border: 1.5px solid #e8edf3;
    border-radius: 8px; width: 34px; height: 34px;
    display: flex; align-items: center; justify-content: center;
    font-family: "Montserrat", sans-serif; font-size: 12px; font-weight: 800; color: #6c757d;
    flex-shrink: 0;
}
.review-q-type {
    font-size: 10px; font-weight: 700; padding: 3px 9px; border-radius: 20px; flex-shrink: 0;
}
.type-sba { background: rgba(2,179,228,0.1); color: #0196c0; border: 1px solid rgba(2,179,228,0.25); }
.type-mcq { background: rgba(124,58,237,0.08); color: #7c3aed; border: 1px solid rgba(124,58,237,0.2); }
.review-q-text {
    font-family: "Montserrat", sans-serif; font-size: 14px; font-weight: 700;
    color: #011c1a; flex: 1; line-height: 1.45;
}

.review-q-body { padding: 16px 20px; }
.review-option {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 10px 14px; border-radius: 10px; margin-bottom: 8px;
    border: 1.5px solid #edf1f7; background: #fafbfc;
}
.review-option:last-child { margin-bottom: 0; }
.review-option.opt-correct-answered {
    background: rgba(26,171,97,0.08); border-color: #6ee7b7;
}
.review-option.opt-wrong-answered {
    background: rgba(220,38,38,0.06); border-color: #fca5a5;
}
.review-option.opt-correct-missed {
    background: rgba(2,179,228,0.07); border-color: rgba(2,179,228,0.3);
}
.opt-tf-badges { display: flex; gap: 4px; flex-shrink: 0; }
.tf-badge {
    width: 20px; height: 20px; border-radius: 4px;
    display: flex; align-items: center; justify-content: center;
    font-size: 9px; font-weight: 800;
}
.tf-t-true  { background: rgba(26,171,97,0.2);  color: #1aab61; }
.tf-t-false { background: #f4f6f9; color: #9aa3af; }
.tf-f-true  { background: rgba(220,38,38,0.12); color: #dc2626; }
.tf-f-false { background: #f4f6f9; color: #9aa3af; }
.review-opt-letter {
    width: 24px; height: 24px; border-radius: 6px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-family: "Montserrat", sans-serif; font-size: 10px; font-weight: 800;
    background: #f4f6f9; color: #6c757d;
}
.review-option.opt-correct-answered .review-opt-letter { background: rgba(26,171,97,0.2); color: #1aab61; }
.review-option.opt-wrong-answered   .review-opt-letter { background: rgba(220,38,38,0.15); color: #dc2626; }
.review-option.opt-correct-missed   .review-opt-letter { background: rgba(2,179,228,0.15); color: #0196c0; }

.review-opt-text { font-size: 13px; color: #2d3748; font-weight: 500; flex: 1; line-height: 1.5; }
.review-opt-mark { font-size: 14px; flex-shrink: 0; }

/* Result actions row */
.review-q-actions {
    padding: 12px 20px; border-top: 1px solid #f0f4f8;
    display: flex; gap: 8px; flex-wrap: wrap;
}
.review-action-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: 600;
    text-decoration: none; border: 1.5px solid; cursor: pointer; transition: all 0.18s;
    background: none;
}
.btn-details {
    border-color: rgba(2,179,228,0.3); color: #0196c0;
    background: rgba(2,179,228,0.07);
}
.btn-details:hover { background: #02b3e4; color: #fff; text-decoration: none; }
.btn-video {
    border-color: rgba(124,58,237,0.3); color: #7c3aed;
    background: rgba(124,58,237,0.07);
}
.btn-video:hover { background: #7c3aed; color: #fff; text-decoration: none; }

/* Details panel */
.review-details-panel {
    display: none; padding: 14px 20px; background: #f8fafc;
    border-top: 1px solid #f0f4f8; font-size: 13px; color: #4a5568;
    line-height: 1.7;
}
.review-details-panel.open { display: block; }
.review-details-panel img { max-width: 100%; border-radius: 8px; margin: 8px 0; }

/* Home button */
.result-home-btn {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, #1aab61, #118a4d);
    color: #fff; padding: 12px 28px; border-radius: 10px;
    font-size: 14px; font-weight: 700; text-decoration: none; transition: all 0.2s;
    box-shadow: 0 4px 16px rgba(26,171,97,0.3);
}
.result-home-btn:hover { background: linear-gradient(135deg, #118a4d, #011c1a); color: #fff; text-decoration: none; }

@media (max-width: 576px) {
    .score-stats-grid { grid-template-columns: repeat(2, 1fr); }
    .review-q-header  { flex-wrap: wrap; }
}
</style>

<div class="result-page">

    {{-- Top bar --}}
    <div class="result-topbar">
        <a href="{{ url('/exam/user/' . Session::get('id')) }}">
            <i class="fa-regular fa-arrow-left"></i> My Exams
        </a>
        <p class="result-topbar-title">{{ $modelTest->name }} — Results</p>
    </div>

    {{-- Score card --}}
    <div class="result-score-section">
        <div class="container">
            <div class="result-score-inner">

                <div class="score-circle-wrap">
                    <div class="score-circle">
                        <svg viewBox="0 0 120 120">
                            <circle class="score-bg" cx="60" cy="60" r="55"/>
                            <circle class="score-fill" cx="60" cy="60" r="55"/>
                        </svg>
                        <div class="score-circle-inner">
                            <span class="score-pct">{{ $pct }}%</span>
                            <span class="score-pct-label">Score</span>
                        </div>
                    </div>
                    <div class="result-pass-badge">
                        @if($isPassed)
                            <i class="fa-solid fa-circle-check"></i> Passed
                        @else
                            <i class="fa-regular fa-circle-xmark"></i> Failed
                        @endif
                    </div>
                </div>

                {{-- Stats --}}
                <div class="score-stats-grid">
                    <div class="score-stat">
                        <div class="score-stat-val">{{ $totalQ }}</div>
                        <div class="score-stat-label">Total Q</div>
                    </div>
                    <div class="score-stat">
                        <div class="score-stat-val">{{ $modelTestAnswer->answered_questions }}</div>
                        <div class="score-stat-label">Answered</div>
                    </div>
                    <div class="score-stat">
                        <div class="score-stat-val">{{ $modelTestAnswer->right_answers }}</div>
                        <div class="score-stat-label">Correct</div>
                    </div>
                    <div class="score-stat">
                        <div class="score-stat-val">{{ $modelTestAnswer->wrong_answers }}</div>
                        <div class="score-stat-label">Wrong</div>
                    </div>
                </div>

                {{-- Mark breakdown --}}
                <div class="mark-breakdown">
                    <p class="mark-breakdown-title">Score Breakdown</p>

                    @if($modelTestAnswer->total_mcq > 0)
                        <div class="mark-row">
                            <span class="mark-label">MCQ Correct</span>
                            <span class="mark-value">{{ $modelTestAnswer->right_mcq }} / {{ $modelTestAnswer->total_mcq * 5 }} opts</span>
                        </div>
                    @endif
                    @if($modelTestAnswer->total_sba > 0)
                        <div class="mark-row">
                            <span class="mark-label">SBA Correct</span>
                            <span class="mark-value">{{ $modelTestAnswer->right_sba }} / {{ $modelTestAnswer->total_sba }}</span>
                        </div>
                    @endif
                    @if($isRegular)
                        <div class="mark-row">
                            <span class="mark-label">FCPS Standard</span>
                            <span class="mark-value">{{ $point }} / {{ $totalMark }}</span>
                        </div>
                        <div class="mark-row">
                            <span class="mark-label">MS/MD/DDS Standard</span>
                            <span class="mark-value">{{ $modelTestAnswer->point_1 }} / {{ round($totalMark / 2) }}</span>
                        </div>
                    @elseif(!$isLecture)
                        <div class="mark-row">
                            <span class="mark-label">Obtained Marks</span>
                            <span class="mark-value">{{ $point }} / {{ $totalMark }}</span>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- Review section --}}
    <div class="container" style="padding-top: 28px;">

        {{-- Legend --}}
        <div class="result-legend">
            <div class="legend-pill">
                <div class="lp-dot lp-correct-you"></div> Answered correctly
            </div>
            <div class="legend-pill">
                <div class="lp-dot lp-wrong-you"></div> Answered incorrectly
            </div>
            <div class="legend-pill">
                <div class="lp-dot lp-correct-only"></div> Correct (not chosen)
            </div>
        </div>

        <div class="review-section">
            <div class="review-section-title">
                <i class="fa-regular fa-clipboard-list" style="color:#1aab61"></i> Detailed Review
            </div>

            @foreach($modelTest->questions as $key => $data)
                @php
                    $options   = App\Option::where('question_id', $data->id)->get();
                    $letters   = ['A','B','C','D','E','F','G','H'];
                    $qSegments = explode('\n', $data->question);
                    $details   = explode('\n', $data->detailss ?? '');
                @endphp

                <div class="review-q-card">
                    <div class="review-q-header">
                        <div class="review-q-num">{{ $key + 1 }}</div>
                        <span class="review-q-type {{ $data->is_multi == 1 ? 'type-mcq' : 'type-sba' }}">
                            {{ $data->is_multi == 1 ? 'MCQ' : 'SBA' }}
                        </span>
                        <div class="review-q-text">
                            @foreach($qSegments as $seg)
                                @if(str_starts_with($seg, 'src:'))
                                    <img src="/{{ str_replace('src:', '', $seg) }}" style="max-width:100%;border-radius:6px;margin:4px 0">
                                @else
                                    {{ $seg }}
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="review-q-body">
                        @foreach($options as $ki => $option)
                            @php
                                $isAnswered    = in_array($option->id, $answeredOptions);
                                $isCorrect     = $option->correct_or_not == 1;
                                $letter        = $letters[$ki] ?? ($ki + 1);

                                if ($data->is_multi == 1) {
                                    /* MCQ: T/F options */
                                    if ($isAnswered && $isCorrect)  { $cls = 'opt-correct-answered'; $mark = '✓'; }
                                    elseif ($isAnswered && !$isCorrect) { $cls = 'opt-wrong-answered';   $mark = '✗'; }
                                    elseif (!$isAnswered && $isCorrect) { $cls = 'opt-correct-missed';   $mark = '!'; }
                                    else                               { $cls = '';                      $mark = ''; }
                                } else {
                                    /* SBA */
                                    if ($isAnswered && $isCorrect)      { $cls = 'opt-correct-answered'; $mark = '✓'; }
                                    elseif ($isAnswered && !$isCorrect) { $cls = 'opt-wrong-answered';   $mark = '✗'; }
                                    elseif (!$isAnswered && $isCorrect) { $cls = 'opt-correct-missed';   $mark = ''; }
                                    else                                { $cls = '';                     $mark = ''; }
                                }

                                /* Split SBA option text (format "A. text") */
                                $optText = $option->option;
                                if ($data->is_multi == 0) {
                                    $parts   = explode('.', $optText, 2);
                                    $optText = count($parts) > 1 ? trim($parts[1]) : $optText;
                                }
                                $optSegs = explode('\n', $optText);
                            @endphp

                            <div class="review-option {{ $cls }}">
                                @if($data->is_multi == 1)
                                    <div class="opt-tf-badges">
                                        <div class="tf-badge {{ $isCorrect ? 'tf-t-true' : 'tf-t-false' }}">T</div>
                                        <div class="tf-badge {{ !$isCorrect ? 'tf-f-true' : 'tf-f-false' }}">F</div>
                                    </div>
                                @endif
                                <div class="review-opt-letter">{{ $letter }}</div>
                                <div class="review-opt-text">
                                    @foreach($optSegs as $optSeg)
                                        @if(str_starts_with($optSeg, 'src:'))
                                            <img src="/{{ str_replace('src:', '', $optSeg) }}" style="max-width:100%;border-radius:6px">
                                        @else
                                            {{ $optSeg }}
                                        @endif
                                    @endforeach
                                </div>
                                @if($mark)
                                    <span class="review-opt-mark">
                                        @if($mark === '✓') <i class="fa-solid fa-circle-check" style="color:#1aab61;font-size:16px"></i>
                                        @elseif($mark === '✗') <i class="fa-solid fa-circle-xmark" style="color:#dc2626;font-size:16px"></i>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Actions + details --}}
                    <div class="review-q-actions">
                        @if(!empty(array_filter($details)))
                            <button class="review-action-btn btn-details"
                                    onclick="toggleDetails('detail-{{ $key }}', this)">
                                <i class="fa-regular fa-circle-info"></i> Explanation
                            </button>
                        @endif
                        @if($data->solve_link)
                            <a href="{{ url('/solve_video/' . $modelTest->id . '/' . $data->id) }}"
                               class="review-action-btn btn-video">
                                <i class="fa-regular fa-circle-play"></i> Video Solution
                            </a>
                        @endif
                    </div>

                    <div class="review-details-panel" id="detail-{{ $key }}">
                        @foreach($details as $dSeg)
                            @if(str_starts_with($dSeg, 'src:'))
                                <img src="/{{ str_replace('src:', '', $dSeg) }}">
                            @else
                                {{ $dSeg }}<br>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach

            {{-- Done button --}}
            <div style="text-align:center; margin-top: 32px;">
                <a href="{{ url('/exam/user/' . Session::get('id')) }}" class="result-home-btn">
                    <i class="fa-regular fa-house"></i> Back to My Exams
                </a>
            </div>

        </div>
    </div>

</div>

<script>
function toggleDetails(id, btn) {
    var panel = document.getElementById(id);
    panel.classList.toggle('open');
    var isOpen = panel.classList.contains('open');
    btn.innerHTML = isOpen
        ? '<i class="fa-regular fa-chevron-up"></i> Hide Explanation'
        : '<i class="fa-regular fa-circle-info"></i> Explanation';
}
</script>

@endsection

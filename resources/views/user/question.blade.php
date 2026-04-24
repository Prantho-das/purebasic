@extends('layouts.register')
@section('content')

@php
    $totalQ = $modelTest->questions->count();
@endphp

<style>
/* ── Exam shell — light focused mode */
*, *::before, *::after { box-sizing: border-box; }

.exam-shell {
    background: #f0f2f5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    font-family: "Poppins", sans-serif;
}

/* ── Top bar */
.exam-topbar {
    background: #fff;
    border-bottom: 2px solid #e8edf3;
    padding: 0 24px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    flex-shrink: 0;
}
.exam-topbar-left { display: flex; align-items: center; gap: 14px; }
.exam-topbar-icon {
    width: 36px; height: 36px; background: linear-gradient(135deg, #1aab61, #118a4d);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 14px; flex-shrink: 0;
}
.exam-topbar-title {
    font-family: "Montserrat", sans-serif; font-size: 15px; font-weight: 800;
    color: #011c1a; margin: 0; white-space: nowrap; overflow: hidden;
    text-overflow: ellipsis; max-width: 360px;
}
.exam-topbar-sub { font-size: 11px; color: #6c757d; margin: 0; }

/* Timer */
.exam-timer {
    display: flex; align-items: center; gap: 10px;
    background: #f4f6f9; border: 2px solid #e8edf3;
    border-radius: 12px; padding: 8px 18px;
    transition: background 0.3s, border-color 0.3s;
}
.exam-timer.timer-warn  { background: #fffbeb; border-color: #fcd34d; }
.exam-timer.timer-crit  { background: #fef2f2; border-color: #fca5a5; animation: pulse-red 1s infinite; }
@keyframes pulse-red {
    0%, 100% { border-color: #fca5a5; }
    50%       { border-color: #ef4444; }
}
.timer-icon { font-size: 16px; color: #6c757d; }
.timer-warn .timer-icon  { color: #d97706; }
.timer-crit .timer-icon  { color: #dc2626; }
#counter {
    font-family: "Montserrat", sans-serif; font-size: 18px; font-weight: 800;
    color: #011c1a; letter-spacing: 1px; margin: 0;
}
.timer-warn #counter  { color: #d97706; }
.timer-crit #counter  { color: #dc2626; }

/* ── Body */
.exam-body {
    flex: 1; display: flex; gap: 0; max-width: 1300px;
    margin: 0 auto; width: 100%; padding: 24px 16px 40px;
    gap: 20px; align-items: flex-start;
}

/* ── Question panel */
.exam-question-panel { flex: 1; min-width: 0; }

.exam-q-card {
    background: #fff; border: 1px solid #edf1f7;
    border-radius: 16px; box-shadow: 0 2px 16px rgba(0,0,0,0.06);
    overflow: hidden;
}

.exam-q-header {
    padding: 16px 22px 14px;
    border-bottom: 1px solid #f0f4f8;
    display: flex; align-items: center; gap: 12px;
}
.exam-q-num-badge {
    background: linear-gradient(135deg, #1aab61, #118a4d);
    color: #fff; font-family: "Montserrat", sans-serif;
    font-size: 12px; font-weight: 800; padding: 4px 12px;
    border-radius: 20px; flex-shrink: 0;
}
.exam-q-type-badge {
    background: rgba(2,179,228,0.1); border: 1px solid rgba(2,179,228,0.25);
    color: #0196c0; font-size: 11px; font-weight: 700;
    padding: 3px 10px; border-radius: 20px; flex-shrink: 0;
}
.exam-q-type-badge.mcq-badge {
    background: rgba(124,58,237,0.08); border-color: rgba(124,58,237,0.2); color: #7c3aed;
}
.exam-q-progress {
    flex: 1; height: 6px; background: #f0f4f8; border-radius: 3px; overflow: hidden;
}
.exam-q-progress-fill {
    height: 100%; background: linear-gradient(90deg, #1aab61, #02b3e4);
    border-radius: 3px; transition: width 0.4s ease;
}

/* Question body */
.exam-q-body { padding: 22px 22px 16px; }
.exam-q-text {
    font-family: "Montserrat", sans-serif; font-size: 16px; font-weight: 700;
    color: #011c1a; line-height: 1.65; margin: 0 0 22px;
}
.exam-q-text img { max-width: 100%; border-radius: 8px; margin: 8px 0; }

/* Options */
.exam-options { display: flex; flex-direction: column; gap: 10px; }

.exam-option-label {
    display: flex; align-items: flex-start; gap: 14px;
    background: #f8fafc; border: 2px solid #e8edf3;
    border-radius: 12px; padding: 14px 16px; cursor: pointer;
    transition: all 0.18s; position: relative;
}
.exam-option-label:hover {
    border-color: #6ee7b7; background: #f0fdf4;
}
.exam-option-label.selected {
    border-color: #1aab61; background: #f0fdf4;
}
.exam-option-label.selected .opt-marker {
    background: #1aab61; border-color: #1aab61; color: #fff;
}

/* Hide native input */
.exam-option-label input[type="radio"],
.exam-option-label input[type="checkbox"] {
    position: absolute; opacity: 0; width: 0; height: 0;
}

.opt-marker {
    width: 28px; height: 28px; border-radius: 50%;
    border: 2px solid #d1d9e6; background: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 800; color: #6c757d; flex-shrink: 0;
    font-family: "Montserrat", sans-serif; transition: all 0.18s;
}
.exam-option-label.checkbox-opt .opt-marker { border-radius: 6px; }
.opt-text {
    font-size: 14px; color: #1a2332; font-weight: 500; line-height: 1.5;
    flex: 1;
}
.opt-text img { max-width: 100%; border-radius: 6px; }

/* ── Bottom nav */
.exam-nav-bar {
    background: #fff; border-top: 1px solid #e8edf3;
    padding: 14px 22px; display: flex;
    align-items: center; justify-content: space-between; gap: 12px;
    border-radius: 0 0 16px 16px;
}
.exam-nav-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: 700;
    border: 2px solid transparent; cursor: pointer; transition: all 0.2s;
    text-decoration: none;
}
.btn-prev {
    background: #f4f6f9; border-color: #e8edf3; color: #4a5568;
}
.btn-prev:hover { background: #e8edf3; color: #011c1a; }
.btn-next {
    background: linear-gradient(135deg, #02b3e4, #0196c0); color: #fff; border-color: transparent;
}
.btn-next:hover { background: linear-gradient(135deg, #0196c0, #011c1a); color: #fff; }
.btn-finish {
    background: linear-gradient(135deg, #1aab61, #118a4d); color: #fff; border-color: transparent;
}
.btn-finish:hover { background: linear-gradient(135deg, #118a4d, #011c1a); color: #fff; }

/* ── Sidebar */
.exam-sidebar { width: 260px; flex-shrink: 0; }

.exam-sidebar-card {
    background: #fff; border: 1px solid #edf1f7;
    border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    overflow: hidden; position: sticky; top: 80px;
}
.exam-sidebar-header {
    padding: 14px 16px 12px; border-bottom: 1px solid #f0f4f8;
    display: flex; align-items: center; gap: 8px;
}
.exam-sidebar-header i { color: #1aab61; font-size: 13px; }
.exam-sidebar-header h4 {
    font-family: "Montserrat", sans-serif; font-size: 13px; font-weight: 800;
    color: #011c1a; margin: 0;
}

/* Question navigator grid */
.q-navigator {
    padding: 14px 14px 6px;
    display: grid; grid-template-columns: repeat(5, 1fr); gap: 6px;
}
.q-nav-btn {
    width: 100%; aspect-ratio: 1; border: 2px solid #e8edf3;
    border-radius: 8px; background: #f8fafc;
    font-family: "Montserrat", sans-serif; font-size: 11px; font-weight: 800;
    color: #6c757d; cursor: pointer; transition: all 0.18s;
    display: flex; align-items: center; justify-content: center;
}
.q-nav-btn:hover    { background: #f0fdf4; border-color: #6ee7b7; color: #1aab61; }
.q-nav-btn.current  { background: linear-gradient(135deg, #02b3e4, #0196c0); border-color: transparent; color: #fff; }
.q-nav-btn.answered { background: linear-gradient(135deg, #1aab61, #118a4d); border-color: transparent; color: #fff; }
.q-nav-btn.answered.current { background: linear-gradient(135deg, #02b3e4, #0196c0); }

/* Legend */
.q-nav-legend {
    padding: 8px 14px 14px; display: flex; flex-direction: column; gap: 6px;
}
.legend-item {
    display: flex; align-items: center; gap: 8px;
    font-size: 11px; color: #6c757d;
}
.legend-dot {
    width: 12px; height: 12px; border-radius: 3px; flex-shrink: 0;
}
.dot-current  { background: #02b3e4; }
.dot-answered { background: #1aab61; }
.dot-unanswered { background: #e8edf3; border: 1.5px solid #c4cbd6; }

/* Stats row */
.q-stats {
    padding: 14px 16px; border-top: 1px solid #f0f4f8;
    display: grid; grid-template-columns: 1fr 1fr; gap: 8px;
}
.q-stat-box {
    background: #f8fafc; border: 1px solid #e8edf3; border-radius: 8px;
    padding: 8px 10px; text-align: center;
}
.q-stat-val {
    font-family: "Montserrat", sans-serif; font-size: 18px; font-weight: 800; color: #011c1a;
    line-height: 1;
}
.q-stat-val.val-green { color: #1aab61; }
.q-stat-label { font-size: 10px; color: #9aa3af; font-weight: 600; text-transform: uppercase; margin-top: 2px; }

/* ── Confirm modal */
.exam-modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(1,28,26,0.65); z-index: 999;
    align-items: center; justify-content: center;
    backdrop-filter: blur(4px);
}
.exam-modal-overlay.open { display: flex; }
.exam-modal-box {
    background: #fff; border-radius: 20px;
    padding: 32px 36px; max-width: 440px; width: 90%;
    box-shadow: 0 24px 80px rgba(0,0,0,0.25);
    text-align: center; animation: modalIn 0.25s ease;
}
@keyframes modalIn {
    from { opacity:0; transform: scale(0.92) translateY(16px); }
    to   { opacity:1; transform: scale(1)    translateY(0); }
}
.exam-modal-icon {
    width: 64px; height: 64px; border-radius: 50%;
    background: rgba(26,171,97,0.1); border: 2px solid rgba(26,171,97,0.2);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 18px; font-size: 26px; color: #1aab61;
}
.exam-modal-title {
    font-family: "Montserrat", sans-serif; font-size: 20px; font-weight: 800;
    color: #011c1a; margin: 0 0 8px;
}
.exam-modal-sub { font-size: 14px; color: #6c757d; margin: 0 0 24px; }
.exam-modal-stats {
    display: flex; gap: 12px; margin-bottom: 24px;
    background: #f8fafc; border-radius: 10px; padding: 12px 16px;
}
.modal-stat { flex: 1; text-align: center; }
.modal-stat-val {
    font-family: "Montserrat", sans-serif; font-size: 20px; font-weight: 800; color: #011c1a;
}
.modal-stat-val.green { color: #1aab61; }
.modal-stat-val.orange { color: #d97706; }
.modal-stat-label { font-size: 11px; color: #9aa3af; font-weight: 600; text-transform: uppercase; }
.exam-modal-actions { display: flex; gap: 10px; }
.btn-modal-confirm {
    flex: 1; padding: 12px; border-radius: 10px; border: none; cursor: pointer;
    background: linear-gradient(135deg, #1aab61, #118a4d); color: #fff;
    font-family: "Poppins", sans-serif; font-size: 14px; font-weight: 700;
    transition: all 0.2s;
}
.btn-modal-confirm:hover { background: linear-gradient(135deg, #118a4d, #011c1a); }
.btn-modal-cancel {
    flex: 1; padding: 12px; border-radius: 10px; cursor: pointer;
    background: #f4f6f9; border: 2px solid #e8edf3; color: #4a5568;
    font-family: "Poppins", sans-serif; font-size: 14px; font-weight: 700;
    transition: all 0.2s;
}
.btn-modal-cancel:hover { background: #e8edf3; color: #011c1a; }

/* Regular exam extra questions */
.exam-extra-section {
    background: #fff; border: 1px solid #edf1f7;
    border-radius: 16px; padding: 22px; margin-bottom: 16px;
}
.exam-extra-title {
    font-family: "Montserrat", sans-serif; font-size: 15px; font-weight: 800;
    color: #011c1a; margin: 0 0 14px; display: flex; align-items: center; gap: 8px;
}
.exam-extra-title i { color: #1aab61; }
.exam-extra-options { display: flex; flex-wrap: wrap; gap: 10px; }
.exam-extra-opt {
    display: flex; align-items: center; gap: 10px;
    background: #f8fafc; border: 2px solid #e8edf3; border-radius: 10px;
    padding: 10px 16px; cursor: pointer; transition: all 0.18s; flex: 1; min-width: 140px;
}
.exam-extra-opt:has(input:checked),
.exam-extra-opt.checked {
    border-color: #1aab61; background: #f0fdf4;
}
.exam-extra-opt input { accent-color: #1aab61; width: 16px; height: 16px; cursor: pointer; }
.exam-extra-opt span { font-size: 13px; font-weight: 600; color: #4a5568; }

@media (max-width: 900px) {
    .exam-body { flex-direction: column; }
    .exam-sidebar { width: 100%; }
    .exam-sidebar-card { position: static; }
    .q-navigator { grid-template-columns: repeat(8, 1fr); }
}
@media (max-width: 576px) {
    .exam-topbar { padding: 0 12px; }
    .exam-topbar-title { max-width: 180px; font-size: 13px; }
    .exam-q-body { padding: 16px; }
    .exam-q-text { font-size: 14px; }
    .q-navigator { grid-template-columns: repeat(6, 1fr); }
}
</style>

<div class="exam-shell">

    {{-- TOP BAR --}}
    <div class="exam-topbar">
        <div class="exam-topbar-left">
            <div class="exam-topbar-icon"><i class="fa-solid fa-file-pen"></i></div>
            <div>
                <p class="exam-topbar-title">{{ $modelTest->name }}</p>
                <p class="exam-topbar-sub">{{ $totalQ }} Questions &bull; {{ $modelTest->exam_in_minutes }} Marks</p>
            </div>
        </div>

        <div class="exam-timer" id="examTimer">
            <i class="fa-regular fa-clock timer-icon"></i>
            <h3 id="counter">{{ $modelTest->ex_time }}:00</h3>
        </div>
    </div>

    {{-- BODY --}}
    <div class="exam-body">

        {{-- Question panel --}}
        <div class="exam-question-panel" id="questionContainer">

            {{-- Regular exam extra questions (candidate type, discipline) shown first as separate cards --}}
            @if($modelTest->exam_pattern == "Regular exam")
                <div class="exam-extra-section">
                    <p class="exam-extra-title"><i class="fa-regular fa-user-tag"></i> Select Candidate Type</p>
                    <div class="exam-extra-options">
                        @foreach(['Government', 'Private'] as $ct)
                            <label class="exam-extra-opt" id="ct-{{ $ct }}">
                                <input type="radio" name="candidate" value="{{ $ct }}"
                                       form="question_paper"
                                       onchange="document.querySelectorAll('.exam-extra-opt[id^=ct-]').forEach(e=>e.classList.remove('checked')); this.closest('.exam-extra-opt').classList.add('checked')">
                                <span>{{ $ct }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="exam-extra-section">
                    <p class="exam-extra-title"><i class="fa-regular fa-stethoscope"></i> Select Discipline</p>
                    <div class="exam-extra-options">
                        @foreach(['Oral & Maxillofacial Surgery','Orthodontics','Prosthodontics','Conservative Dentistry & Endodontics','Pedodontics','Oral & Maxillofacial Pathology','Periodontology','Oral Anatomy','Dental Pharmacology','Dental Materials'] as $disc)
                            <label class="exam-extra-opt" id="disc-{{ Str::slug($disc) }}">
                                <input type="radio" name="discipline" value="{{ $disc }}"
                                       form="question_paper"
                                       onchange="document.querySelectorAll('.exam-extra-opt[id^=disc-]').forEach(e=>e.classList.remove('checked')); this.closest('.exam-extra-opt').classList.add('checked')">
                                <span>{{ $disc }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Question card --}}
            <div class="exam-q-card">

                {{-- Header --}}
                <div class="exam-q-header">
                    <span class="exam-q-num-badge" id="qNumBadge">Question 1 / {{ $totalQ }}</span>
                    <span class="exam-q-type-badge" id="qTypeBadge">SBA</span>
                    <div class="exam-q-progress">
                        <div class="exam-q-progress-fill" id="qProgress" style="width: {{ $totalQ > 0 ? round(1/$totalQ*100) : 0 }}%"></div>
                    </div>
                </div>

                {{-- The form (hidden; inputs inside .question divs) --}}
                <form method="post" id="question_paper"
                      action="{{ url('/answerQuestionModeltest') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $modelTest->id }}"           name="modeltest_id">
                    <input type="hidden" value="{{ $modelTest->exam_pattern }}" name="modeltest_exam_pattern">
                    <input type="hidden" value="{{ $modelTest->exam_in_minutes }}" name="modeltest_total_mark">

                    <div class="exam-q-body">
                        @foreach($modelTest->questions as $key => $data)
                            @php
                                $segments = explode('\n', $data->question);
                                $options  = App\Option::where('question_id', $data->id)->get();
                                $letters  = ['A','B','C','D','E','F','G','H'];
                            @endphp

                            <div class="question" data-index="{{ $key }}" data-is-multi="{{ $data->is_multi }}" style="display:none">
                                <input type="hidden" value="{{ $data->id }}"
                                       name="questions[{{ $key }}][questionId]">

                                {{-- Question text --}}
                                <p class="exam-q-text">
                                    @foreach($segments as $seg)
                                        @if(str_starts_with($seg, 'src:'))
                                            <img src="/{{ str_replace('src:', '', $seg) }}" style="max-width:100%;border-radius:8px;margin:8px 0">
                                        @else
                                            {{ $seg }}<br>
                                        @endif
                                    @endforeach
                                </p>

                                {{-- Options --}}
                                <div class="exam-options">
                                    @foreach($options as $ki => $option)
                                        @php
                                            $optSegs = explode('\n', $option->option);
                                            $inputType = $data->is_multi == 1 ? 'checkbox' : 'radio';
                                            $inputName = "questions[{$key}][option][" . ($data->is_multi == 1 ? $ki : $key) . "]";
                                            $letter = $letters[$ki] ?? ($ki + 1);
                                        @endphp

                                        <label class="exam-option-label {{ $data->is_multi == 1 ? 'checkbox-opt' : '' }}"
                                               data-q="{{ $key }}"
                                               onclick="handleOptionClick(this, {{ $key }}, {{ $data->is_multi }})">
                                            <input type="{{ $inputType }}"
                                                   name="{{ $inputName }}"
                                                   value="{{ $option->id }}">
                                            <div class="opt-marker">{{ $letter }}</div>
                                            <div class="opt-text">
                                                @foreach($optSegs as $optSeg)
                                                    @if(str_starts_with($optSeg, 'src:'))
                                                        <img src="/{{ str_replace('src:', '', $optSeg) }}" style="max-width:100%;border-radius:6px">
                                                    @else
                                                        {{ $optSeg }}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>

                {{-- Nav bar --}}
                <div class="exam-nav-bar">
                    <button type="button" class="exam-nav-btn btn-prev" onclick="navigate(-1)">
                        <i class="fa-regular fa-arrow-left"></i> Previous
                    </button>
                    <button type="button" class="exam-nav-btn btn-finish" onclick="openConfirmModal()">
                        <i class="fa-regular fa-flag-checkered"></i> Finish Exam
                    </button>
                    <button type="button" class="exam-nav-btn btn-next" onclick="navigate(1)">
                        Next <i class="fa-regular fa-arrow-right"></i>
                    </button>
                </div>

            </div>{{-- /exam-q-card --}}
        </div>{{-- /exam-question-panel --}}

        {{-- Sidebar --}}
        <div class="exam-sidebar">
            <div class="exam-sidebar-card">
                <div class="exam-sidebar-header">
                    <i class="fa-regular fa-grid-2"></i>
                    <h4>Question Navigator</h4>
                </div>

                <div class="q-navigator" id="qNavigator">
                    @for($n = 1; $n <= $totalQ; $n++)
                        <button type="button"
                                class="q-nav-btn {{ $n === 1 ? 'current' : '' }}"
                                data-nav="{{ $n }}"
                                onclick="goToQuestion({{ $n }})">{{ $n }}</button>
                    @endfor
                </div>

                <div class="q-nav-legend">
                    <div class="legend-item">
                        <div class="legend-dot dot-current"></div> Current question
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot dot-answered"></div> Answered
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot dot-unanswered"></div> Not answered
                    </div>
                </div>

                <div class="q-stats">
                    <div class="q-stat-box">
                        <div class="q-stat-val val-green" id="statAnswered">0</div>
                        <div class="q-stat-label">Answered</div>
                    </div>
                    <div class="q-stat-box">
                        <div class="q-stat-val" id="statRemaining">{{ $totalQ }}</div>
                        <div class="q-stat-label">Remaining</div>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- /exam-body --}}
</div>{{-- /exam-shell --}}

{{-- Confirm submit modal --}}
<div class="exam-modal-overlay" id="confirmModal">
    <div class="exam-modal-box">
        <div class="exam-modal-icon">
            <i class="fa-regular fa-flag-checkered"></i>
        </div>
        <h3 class="exam-modal-title">Submit Exam?</h3>
        <p class="exam-modal-sub">Your answers will be submitted and you cannot make changes after this.</p>
        <div class="exam-modal-stats">
            <div class="modal-stat">
                <div class="modal-stat-val green" id="modalAnswered">0</div>
                <div class="modal-stat-label">Answered</div>
            </div>
            <div class="modal-stat">
                <div class="modal-stat-val orange" id="modalUnanswered">{{ $totalQ }}</div>
                <div class="modal-stat-label">Unanswered</div>
            </div>
            <div class="modal-stat">
                <div class="modal-stat-val" id="modalTotal">{{ $totalQ }}</div>
                <div class="modal-stat-label">Total</div>
            </div>
        </div>
        <div class="exam-modal-actions">
            <button class="btn-modal-cancel" onclick="closeConfirmModal()">
                <i class="fa-regular fa-arrow-left"></i> Continue Exam
            </button>
            <button class="btn-modal-confirm" onclick="submitExam()">
                <i class="fa-regular fa-check"></i> Yes, Submit
            </button>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
(function () {
    const TOTAL  = {{ $totalQ }};
    let current  = 1;          // 1-based
    let answered = new Set();  // 1-based indices of answered questions

    /* ── Initial display */
    showQuestion(1);

    /* ── Navigate */
    window.navigate = function (dir) {
        const next = current + dir;
        if (next >= 1 && next <= TOTAL) goToQuestion(next);
    };

    window.goToQuestion = function (n) {
        hideQuestion(current);
        current = n;
        showQuestion(n);
        updateNavigator();
    };

    function showQuestion(n) {
        const el = document.querySelector('.question[data-index="' + (n - 1) + '"]');
        if (el) el.style.display = 'block';
        document.getElementById('qNumBadge').textContent = 'Question ' + n + ' / ' + TOTAL;

        /* type badge */
        const isMulti = el ? el.dataset.isMulti === '1' : false;
        const badge   = document.getElementById('qTypeBadge');
        badge.textContent = isMulti ? 'MCQ' : 'SBA';
        badge.className   = 'exam-q-type-badge' + (isMulti ? ' mcq-badge' : '');

        /* progress */
        const pct = Math.round(n / TOTAL * 100);
        document.getElementById('qProgress').style.width = pct + '%';
    }

    function hideQuestion(n) {
        const el = document.querySelector('.question[data-index="' + (n - 1) + '"]');
        if (el) el.style.display = 'none';
    }

    /* ── Option click handler */
    window.handleOptionClick = function (label, qKey, isMulti) {
        const qNum = qKey + 1;
        if (isMulti == 1) {
            /* checkbox: toggle selected class */
            const input = label.querySelector('input');
            setTimeout(function () {
                label.classList.toggle('selected', input.checked);
                /* update answered based on any checked in this question */
                const anyChecked = document.querySelectorAll(
                    '.question[data-index="' + qKey + '"] input:checked').length > 0;
                if (anyChecked) answered.add(qNum); else answered.delete(qNum);
                updateStats();
                updateNavigator();
            }, 0);
        } else {
            /* radio: clear siblings first */
            const parent = label.closest('.exam-options');
            parent.querySelectorAll('.exam-option-label').forEach(function (l) {
                l.classList.remove('selected');
            });
            label.classList.add('selected');
            answered.add(qNum);
            updateStats();
            updateNavigator();
        }
    };

    /* ── Navigator */
    function updateNavigator() {
        document.querySelectorAll('.q-nav-btn').forEach(function (btn) {
            const n = parseInt(btn.dataset.nav);
            btn.className = 'q-nav-btn';
            if (answered.has(n))  btn.classList.add('answered');
            if (n === current)    btn.classList.add('current');
        });
    }

    function updateStats() {
        const ans = answered.size;
        const rem = TOTAL - ans;
        document.getElementById('statAnswered').textContent  = ans;
        document.getElementById('statRemaining').textContent = rem;
        document.getElementById('modalAnswered').textContent   = ans;
        document.getElementById('modalUnanswered').textContent = rem;
    }

    /* ── Confirm modal */
    window.openConfirmModal = function () {
        updateStats();
        document.getElementById('confirmModal').classList.add('open');
    };
    window.closeConfirmModal = function () {
        document.getElementById('confirmModal').classList.remove('open');
    };
    window.submitExam = function () {
        document.getElementById('question_paper').submit();
    };

    /* ── Auto-submit on timeout */
    let remaining = {{ $modelTest->ex_time }} * 60;
    const timerEl  = document.getElementById('counter');
    const timerBox = document.getElementById('examTimer');

    const tick = setInterval(function () {
        remaining--;
        if (remaining <= 0) {
            clearInterval(tick);
            document.getElementById('question_paper').submit();
            return;
        }
        const m = Math.floor(remaining / 60);
        const s = remaining % 60;
        timerEl.textContent = m + ':' + (s < 10 ? '0' : '') + s;

        timerBox.classList.remove('timer-warn', 'timer-crit');
        if      (remaining <= 60)  timerBox.classList.add('timer-crit');
        else if (remaining <= 300) timerBox.classList.add('timer-warn');
    }, 1000);

    /* ── Close modal on overlay click */
    document.getElementById('confirmModal').addEventListener('click', function (e) {
        if (e.target === this) closeConfirmModal();
    });
})();
</script>
@endsection

@extends('layouts.admin')
@section('content')

    @php
        $fmtSec = function (int $s) {
            if ($s <= 0) {
                return '0m';
            }
            $h = floor($s / 3600);
            $m = floor(($s % 3600) / 60);
            return $h > 0 ? "{$h}h {$m}m" : "{$m}m";
        };
    @endphp

    <style>
        /* ── Layout ──────────────────────────────────────── */
        .an-page {
            padding: 24px 20px;
        }

        .an-breadcrumb {
            margin-bottom: 20px;
        }

        .an-breadcrumb a {
            color: #4e73df;
            text-decoration: none;
        }

        .an-breadcrumb span {
            color: #858796;
        }

        /* ── Filter Card ─────────────────────────────────── */
        .an-filter-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
            padding: 20px 24px;
            margin-bottom: 24px;
        }

        .an-filter-title {
            font-size: 15px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .an-filter-title i {
            color: #4e73df;
        }

        .an-filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 12px;
            align-items: end;
        }

        .an-filter-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .an-filter-group select,
        .an-filter-group input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #d1d3e2;
            border-radius: 7px;
            font-size: 13px;
            color: #3a3b45;
            background: #f8f9fc;
            transition: border-color .2s;
            appearance: none;
            -webkit-appearance: none;
        }

        .an-filter-group select:focus,
        .an-filter-group input:focus {
            border-color: #4e73df;
            outline: none;
            background: #fff;
        }

        .an-filter-actions {
            display: flex;
            gap: 8px;
            align-items: flex-end;
        }

        .an-btn-apply {
            padding: 8px 20px;
            background: #4e73df;
            color: #fff;
            border: none;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
            white-space: nowrap;
        }

        .an-btn-apply:hover {
            background: #2e59d9;
        }

        .an-btn-reset {
            padding: 8px 16px;
            background: #f0f2f8;
            color: #6c757d;
            border: 1px solid #d1d3e2;
            border-radius: 7px;
            font-size: 13px;
            cursor: pointer;
            transition: all .2s;
            white-space: nowrap;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .an-btn-reset:hover {
            background: #e2e6ea;
            color: #3a3b45;
            text-decoration: none;
        }

        /* Active filters badge */
        .an-active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 12px;
        }

        .an-filter-badge {
            background: #e8f0fe;
            color: #3c5fc4;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* ── Stats Grid ───────────────────────────────────── */
        .an-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .an-stat-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .an-stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .an-icon-blue {
            background: #e8f0fe;
            color: #4e73df;
        }

        .an-icon-green {
            background: #e6f9f0;
            color: #1cc88a;
        }

        .an-icon-orange {
            background: #fff3e0;
            color: #f6c23e;
        }

        .an-icon-red {
            background: #fdecea;
            color: #e74a3b;
        }

        .an-icon-purple {
            background: #f0e8ff;
            color: #6f42c1;
        }

        .an-stat-val {
            font-size: 22px;
            font-weight: 800;
            color: #2d3748;
            line-height: 1.1;
        }

        .an-stat-lbl {
            font-size: 12px;
            color: #858796;
            font-weight: 500;
            margin-top: 2px;
        }

        /* ── Section Card ─────────────────────────────────── */
        .an-section {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .an-section-head {
            padding: 16px 22px;
            border-bottom: 1px solid #e3e6f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }

        .an-section-head h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .an-section-head h5 i {
            color: #4e73df;
        }

        .an-section-body {
            padding: 20px 22px;
        }

        /* ── Top 10 Cards ─────────────────────────────────── */
        .an-top10-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 14px;
        }

        .an-top-card {
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: box-shadow .2s;
        }

        .an-top-card:hover {
            box-shadow: 0 4px 16px rgba(78, 115, 223, .12);
        }

        .an-rank {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .rank-1 {
            background: #fff3cd;
            color: #856404;
            border: 2px solid #ffc107;
        }

        .rank-2 {
            background: #f0f0f0;
            color: #495057;
            border: 2px solid #adb5bd;
        }

        .rank-3 {
            background: #fff0e8;
            color: #7d4000;
            border: 2px solid #fd7e14;
        }

        .rank-other {
            background: #e8f0fe;
            color: #4e73df;
            border: 2px solid #c5d3f7;
        }

        .an-top-info {
            flex: 1;
            min-width: 0;
        }

        .an-top-name {
            font-size: 14px;
            font-weight: 700;
            color: #2d3748;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .an-top-mobile {
            font-size: 12px;
            color: #858796;
            margin-top: 1px;
        }

        .an-top-scores {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 3px;
            flex-shrink: 0;
        }

        .an-score-pill {
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 12px;
            white-space: nowrap;
        }

        .pill-blue {
            background: #e8f0fe;
            color: #3c5fc4;
        }

        .pill-green {
            background: #e6f9f0;
            color: #0f9b61;
        }

        .pill-gold {
            background: #fff8e1;
            color: #a07000;
        }

        /* ── Chart row ────────────────────────────────────── */
        .an-charts-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .an-chart-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .07);
            padding: 20px;
        }

        .an-chart-label {
            font-size: 13px;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 12px;
        }

        /* ── Table ────────────────────────────────────────── */
        .an-table-wrap {
            overflow-x: auto;
        }

        table.an-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        table.an-table thead th {
            background: #f8f9fc;
            color: #6c757d;
            font-weight: 700;
            padding: 10px 14px;
            text-align: left;
            border-bottom: 2px solid #e3e6f0;
            white-space: nowrap;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        table.an-table tbody tr {
            border-bottom: 1px solid #f0f2f8;
            transition: background .15s;
        }

        table.an-table tbody tr:hover {
            background: #f8f9fc;
        }

        table.an-table tbody td {
            padding: 10px 14px;
            color: #3a3b45;
            vertical-align: middle;
        }

        .an-prog-bar {
            height: 6px;
            background: #e3e6f0;
            border-radius: 4px;
            min-width: 60px;
        }

        .an-prog-fill {
            height: 100%;
            border-radius: 4px;
        }

        .fill-green {
            background: #1cc88a;
        }

        .fill-yellow {
            background: #f6c23e;
        }

        .fill-blue {
            background: #4e73df;
        }

        .fill-red {
            background: #e74a3b;
        }

        .an-badge {
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .badge-green {
            background: #e6f9f0;
            color: #0f9b61;
        }

        .badge-yellow {
            background: #fff8e1;
            color: #a07000;
        }

        .badge-blue {
            background: #e8f0fe;
            color: #3c5fc4;
        }

        .badge-gray {
            background: #f0f2f8;
            color: #858796;
        }

        .an-link {
            color: #4e73df;
            font-size: 12px;
            text-decoration: none;
        }

        .an-link:hover {
            text-decoration: underline;
        }

        /* ── Table quick-filter bar ──────────────────────── */
        .an-tbl-filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-end;
            padding: 16px 22px 0;
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 16px;
            background: #f8f9fc;
        }
        .an-tbl-filter-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 150px;
        }
        .an-tbl-filter-item label {
            font-size: 11px;
            font-weight: 700;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: .4px;
        }
        .an-tbl-filter-item select {
            padding: 6px 10px;
            border: 1px solid #d1d3e2;
            border-radius: 6px;
            font-size: 12px;
            color: #3a3b45;
            background: #fff;
            cursor: pointer;
        }
        .an-tbl-filter-item select:focus { border-color: #4e73df; outline: none; }

        /* ── No data ──────────────────────────────────────── */
        .an-empty {
            text-align: center;
            padding: 48px 20px;
            color: #858796;
        }

        .an-empty i {
            font-size: 40px;
            margin-bottom: 12px;
            opacity: .4;
        }

        .an-empty p {
            font-size: 14px;
            margin: 0;
        }

        /* ── Responsive ───────────────────────────────────── */
        @media (max-width: 768px) {
            .an-filter-grid {
                grid-template-columns: 1fr 1fr;
            }

            .an-stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .an-charts-row {
                grid-template-columns: 1fr;
            }

            .an-top10-grid {
                grid-template-columns: 1fr;
            }

            .an-page {
                padding: 16px 12px;
            }
        }

        @media (max-width: 480px) {
            .an-filter-grid {
                grid-template-columns: 1fr;
            }

            .an-stats-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

    <div id="content-wrapper">
        <div class="an-page">

            {{-- Breadcrumb --}}
            <ol class="breadcrumb an-breadcrumb" style="background:transparent;padding:0;margin-bottom:16px">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" style="color:#858796">Student Analytics</li>
            </ol>

            {{-- ── Filter Card ─────────────────────────────── --}}
            <div class="an-filter-card">
                <div class="an-filter-title">
                    <i class="fas fa-filter"></i> Filter Analytics
                </div>
                <form method="GET" action="{{ url('admin/analytics') }}" id="filterForm">
                    <div class="an-filter-grid">
                        {{-- Batch --}}
                        <div class="an-filter-group">
                            <label>Batch / Course</label>
                            <select name="batch_id" id="sel-batch">
                                <option value="">All Batches</option>
                                @foreach ($batches as $b)
                                    <option value="{{ $b->batch_id }}" {{ $batchId == $b->batch_id ? 'selected' : '' }}>
                                        {{ $b->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Subject --}}
                        <div class="an-filter-group">
                            <label>Subject</label>
                            <select name="subject" id="sel-subject">
                                <option value="">All Subjects</option>
                                @foreach ($subjects as $sub)
                                    <option value="{{ $sub }}" {{ $subject == $sub ? 'selected' : '' }}>{{ $sub }}</option>
                                @endforeach
                                @if ($subject && $subjects->isEmpty())
                                    <option value="{{ $subject }}" selected>{{ $subject }}</option>
                                @endif
                            </select>
                        </div>

                        {{-- Chapter --}}
                        <div class="an-filter-group">
                            <label>Chapter</label>
                            <select name="chapter_id" id="sel-chapter">
                                <option value="">All Chapters</option>
                                @foreach ($chapters as $ch)
                                    <option value="{{ $ch->id }}" {{ $chapterId == $ch->id ? 'selected' : '' }}>
                                        {{ $ch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Lecture --}}
                        <div class="an-filter-group">
                            <label>Lecture</label>
                            <select name="lecture_id" id="sel-lecture">
                                <option value="">All Lectures</option>
                                @foreach ($lectures as $lec)
                                    <option value="{{ $lec->id }}" {{ $lectureId == $lec->id ? 'selected' : '' }}>
                                        {{ $lec->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Exam --}}
                        <div class="an-filter-group">
                            <label>Exam</label>
                            <select name="exam_id" id="sel-exam">
                                <option value="">All Exams</option>
                                @foreach ($exams as $ex)
                                    <option value="{{ $ex->id }}" {{ $examId == $ex->id ? 'selected' : '' }}>
                                        {{ $ex->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Actions --}}
                        <div class="an-filter-actions">
                            <button type="submit" class="an-btn-apply"><i class="fas fa-search"></i> Apply</button>
                            <a href="{{ url('admin/analytics') }}" class="an-btn-reset"><i class="fas fa-times"></i> Reset</a>
                        </div>
                    </div>
                </form>

                {{-- Active filter badges --}}
                @php
                    $activeFilters = [];
                    if ($batchId) {
                        $activeFilters[] = [
                            'Batch',
                            optional($batches->where('batch_id', $batchId)->first())->title ?? $batchId,
                        ];
                    }
                    if ($subject) {
                        $activeFilters[] = ['Subject', $subject];
                    }
                    if ($chapterId) {
                        $activeFilters[] = [
                            'Chapter',
                            optional($chapters->where('id', $chapterId)->first())->name ?? $chapterId,
                        ];
                    }
                    if ($lectureId) {
                        $activeFilters[] = [
                            'Lecture',
                            optional($lectures->where('id', $lectureId)->first())->title ?? $lectureId,
                        ];
                    }
                    if ($examId) {
                        $activeFilters[] = ['Exam', optional($exams->where('id', $examId)->first())->name ?? $examId];
                    }
                @endphp
                @if (count($activeFilters) > 0)
                    <div class="an-active-filters">
                        @foreach ($activeFilters as $f)
                            @php $label = mb_strlen($f[1]) > 30 ? mb_substr($f[1], 0, 30).'…' : $f[1]; @endphp
                            <span class="an-filter-badge"><i class="fas fa-tag"></i> {{ $f[0] }}: {{ $label }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ── Overview Stats ───────────────────────────── --}}
            <div class="an-stats-grid">
                <div class="an-stat-card">
                    <div class="an-stat-icon an-icon-blue"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="an-stat-val">{{ number_format($overallStats['totalStudents']) }}</div>
                        <div class="an-stat-lbl">Total Students</div>
                    </div>
                </div>
                <div class="an-stat-card">
                    <div class="an-stat-icon an-icon-green"><i class="fas fa-play-circle"></i></div>
                    <div>
                        <div class="an-stat-val">{{ $fmtSec($overallStats['totalWatchTime']) }}</div>
                        <div class="an-stat-lbl">Total Watch Time</div>
                    </div>
                </div>
                <div class="an-stat-card">
                    <div class="an-stat-icon an-icon-orange"><i class="fas fa-chart-line"></i></div>
                    <div>
                        <div class="an-stat-val">{{ $overallStats['avgWatchPct'] }}%</div>
                        <div class="an-stat-lbl">Avg Lecture Completion</div>
                    </div>
                </div>
                <div class="an-stat-card">
                    <div class="an-stat-icon an-icon-purple"><i class="fas fa-file-alt"></i></div>
                    <div>
                        <div class="an-stat-val">{{ number_format($overallStats['totalExamsTaken']) }}</div>
                        <div class="an-stat-lbl">Total Exams Taken</div>
                    </div>
                </div>
                <div class="an-stat-card">
                    <div class="an-stat-icon an-icon-red"><i class="fas fa-star"></i></div>
                    <div>
                        <div class="an-stat-val">{{ $overallStats['avgExamScore'] }}%</div>
                        <div class="an-stat-lbl">Avg Exam Score</div>
                    </div>
                </div>
            </div>

            @if ($overallStats['totalStudents'] === 0)
                <div class="an-section">
                    <div class="an-empty">
                        <i class="fas fa-chart-bar d-block"></i>
                        <p>No student data found for the selected filters.</p>
                    </div>
                </div>
            @else
                {{-- ── Charts Row ────────────────────────────────── --}}
                @php
                    $chartLabels = array_column(array_slice($studentAnalytics, 0, 20), 'name');
                    $chartWatch = array_column(array_slice($studentAnalytics, 0, 20), 'watch_pct');
                    $chartExam = array_column(array_slice($studentAnalytics, 0, 20), 'avg_score');
                @endphp
                <div class="an-charts-row">
                    <div class="an-chart-card">
                        <div class="an-chart-label"><i class="fas fa-play-circle" style="color:#4e73df"></i> Top 20 —
                            Lecture Completion %</div>
                        <canvas id="chartWatch" height="160"></canvas>
                    </div>
                    <div class="an-chart-card">
                        <div class="an-chart-label"><i class="fas fa-graduation-cap" style="color:#1cc88a"></i> Top 20 — Avg
                            Exam Score %</div>
                        <canvas id="chartExam" height="160"></canvas>
                    </div>
                </div>

                {{-- ── Top 10 Students ──────────────────────────── --}}
                <div class="an-section">
                    <div class="an-section-head">
                        <h5><i class="fas fa-trophy"></i> Top 10 Students</h5>
                        <span style="font-size:12px;color:#858796">Ranked by exam score (60%) + lecture completion
                            (40%)</span>
                    </div>
                    <div class="an-section-body">
                        @if (count($top10) === 0)
                            <div class="an-empty">
                                <p>No students found.</p>
                            </div>
                        @else
                            <div class="an-top10-grid">
                                @foreach ($top10 as $i => $s)
                                    @php
                                        $rank = $i + 1;
                                        $rankClass =
                                            $rank === 1
                                                ? 'rank-1'
                                                : ($rank === 2
                                                    ? 'rank-2'
                                                    : ($rank === 3
                                                        ? 'rank-3'
                                                        : 'rank-other'));
                                        $wPct = $s['watch_pct'];
                                        $ePct = $s['avg_score'];
                                        $watchBadge =
                                            $wPct >= 80 ? 'badge-green' : ($wPct >= 40 ? 'badge-yellow' : 'badge-blue');
                                        $examBadge =
                                            $ePct >= 80 ? 'badge-green' : ($ePct >= 50 ? 'badge-yellow' : 'badge-blue');
                                    @endphp
                                    <div class="an-top-card">
                                        <div class="an-rank {{ $rankClass }}">#{{ $rank }}</div>
                                        <div class="an-top-info">
                                            <div class="an-top-name">{{ $s['name'] }}</div>
                                            <div class="an-top-mobile"><i class="fas fa-phone-alt"
                                                    style="font-size:10px"></i> {{ $s['mobile'] }}</div>
                                        </div>
                                        <div class="an-top-scores">
                                            <span class="an-score-pill pill-blue">Watch {{ $wPct }}%</span>
                                            <span class="an-score-pill pill-green">Exam {{ $ePct }}%</span>
                                            <span class="an-score-pill pill-gold">Score {{ $s['composite_score'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- ── All Students Table ───────────────────────── --}}
                <div class="an-section">
                    <div class="an-section-head">
                        <h5><i class="fas fa-list-ul"></i> All Students Analytics</h5>
                        <span style="font-size:12px;color:#858796">{{ count($studentAnalytics) }} students &nbsp;·&nbsp; sorted by performance score</span>
                    </div>

                    {{-- Table quick-filter bar --}}
                    <div class="an-tbl-filter-bar">
                        <div class="an-tbl-filter-item">
                            <label>Batch / Course</label>
                            <select id="tbl-batch-filter">
                                <option value="">All Batches</option>
                                @foreach($batches as $b)
                                    <option value="{{ $b->title }}">{{ $b->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="an-tbl-filter-item">
                            <label>Min Lecture %</label>
                            <select id="tbl-watch-filter">
                                <option value="0">Any</option>
                                <option value="25">≥ 25%</option>
                                <option value="50">≥ 50%</option>
                                <option value="75">≥ 75%</option>
                                <option value="100">100%</option>
                            </select>
                        </div>
                        <div class="an-tbl-filter-item">
                            <label>Min Exam Score</label>
                            <select id="tbl-exam-filter">
                                <option value="0">Any</option>
                                <option value="25">≥ 25%</option>
                                <option value="50">≥ 50%</option>
                                <option value="75">≥ 75%</option>
                            </select>
                        </div>
                        <div class="an-tbl-filter-item">
                            <label>Has Exams</label>
                            <select id="tbl-hasexam-filter">
                                <option value="">All</option>
                                <option value="yes">Has Exams</option>
                                <option value="no">No Exams</option>
                            </select>
                        </div>
                        <div class="an-tbl-filter-item" style="align-self:flex-end">
                            <button class="an-btn-reset" id="tbl-clear-filter" type="button" style="width:100%">
                                <i class="fas fa-times"></i> Clear
                            </button>
                        </div>
                    </div>

                    <div class="an-section-body" style="padding:0">
                        <div class="an-table-wrap">
                            <table class="an-table" id="studentsTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Batch / Course</th>
                                        <th>Watch Time</th>
                                        <th>Lecture %</th>
                                        <th>Exams</th>
                                        <th>Correct</th>
                                        <th>Wrong</th>
                                        <th>Avg Score</th>
                                        <th>Perf. Score</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentAnalytics as $i => $s)
                                        @php
                                            $wp = $s['watch_pct'];
                                            $ep = $s['avg_score'];
                                            $wfill  = $wp >= 80 ? 'fill-green'  : ($wp >= 40 ? 'fill-yellow'  : 'fill-blue');
                                            $efill  = $ep >= 80 ? 'fill-green'  : ($ep >= 50 ? 'fill-yellow'  : 'fill-red');
                                            $wbadge = $wp >= 80 ? 'badge-green' : ($wp >= 40 ? 'badge-yellow' : 'badge-gray');
                                            $ebadge = $ep >= 80 ? 'badge-green' : ($ep >= 50 ? 'badge-yellow' : 'badge-gray');
                                        @endphp
                                        <tr
                                            data-batches="{{ $s['batches'] }}"
                                            data-watch="{{ $wp }}"
                                            data-exam="{{ $ep }}"
                                            data-hasexam="{{ $s['exam_count'] > 0 ? 'yes' : 'no' }}"
                                        >
                                            <td style="color:#858796;font-weight:600">{{ $i + 1 }}</td>
                                            <td style="font-weight:600;color:#2d3748">{{ $s['name'] }}</td>
                                            <td style="color:#6c757d">{{ $s['mobile'] }}</td>
                                            <td style="color:#495057;font-size:12px">
                                                @if($s['batches'])
                                                    @foreach(explode(', ', $s['batches']) as $bn)
                                                        <span class="an-badge badge-blue" style="margin:1px 2px;display:inline-block">{{ $bn }}</span>
                                                    @endforeach
                                                @else
                                                    <span style="color:#adb5bd">—</span>
                                                @endif
                                            </td>
                                            <td style="color:#495057">{{ $fmtSec($s['watched_seconds']) }}</td>
                                            <td>
                                                <div style="display:flex;align-items:center;gap:8px;min-width:100px">
                                                    <div class="an-prog-bar" style="flex:1">
                                                        <div class="an-prog-fill {{ $wfill }}" style="width:{{ $wp }}%"></div>
                                                    </div>
                                                    <span class="an-badge {{ $wbadge }}">{{ $wp }}%</span>
                                                </div>
                                            </td>
                                            <td style="text-align:center;font-weight:700;color:#4e73df">{{ $s['exam_count'] }}</td>
                                            <td style="color:#1cc88a;font-weight:600">{{ $s['total_correct'] }}</td>
                                            <td style="color:#e74a3b;font-weight:600">{{ $s['total_wrong'] }}</td>
                                            <td>
                                                <div style="display:flex;align-items:center;gap:8px;min-width:100px">
                                                    <div class="an-prog-bar" style="flex:1">
                                                        <div class="an-prog-fill {{ $efill }}" style="width:{{ $ep }}%"></div>
                                                    </div>
                                                    <span class="an-badge {{ $ebadge }}">{{ $ep }}%</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="an-badge {{ $s['composite_score'] >= 70 ? 'badge-green' : ($s['composite_score'] >= 40 ? 'badge-yellow' : 'badge-blue') }}">
                                                    {{ $s['composite_score'] }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/student_info/' . $s['id']) }}" class="an-link">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @endif {{-- end if students exist --}}

        </div>
    </div>

@endsection

@section('admin_js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        /* Select2 theme to match filter design */
        .select2-container--default .select2-selection--single {
            height: 36px;
            border: 1px solid #d1d3e2;
            border-radius: 7px;
            background: #f8f9fc;
            font-size: 13px;
            color: #3a3b45;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 34px;
            padding-left: 10px;
            color: #3a3b45;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 34px;
            right: 6px;
        }
        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: #4e73df;
            background: #fff;
            outline: none;
        }
        .select2-dropdown {
            border: 1px solid #d1d3e2;
            border-radius: 7px;
            box-shadow: 0 4px 16px rgba(0,0,0,.1);
            font-size: 13px;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #d1d3e2;
            border-radius: 5px;
            padding: 5px 8px;
            font-size: 13px;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #4e73df;
        }
        .select2-container { width: 100% !important; }
        /* Loading spinner inside select */
        .sel-loading .select2-selection__rendered::before {
            content: 'Loading...';
            color: #aaa;
            font-style: italic;
        }
    </style>

    <script>
        (function () {
            var SUBJECTS_URL = '{{ url("admin/analytics/subjects") }}';
            var LECTURES_URL = '{{ url("admin/analytics/lectures") }}';

            /* ── Select2 init ─────────────────────────── */
            function initSelect2(selector, placeholder) {
                $(selector).select2({
                    placeholder: placeholder,
                    allowClear: true,
                    width: '100%'
                });
            }

            initSelect2('#sel-batch',    'All Batches');
            initSelect2('#sel-subject',  'All Subjects');
            initSelect2('#sel-chapter',  'All Chapters');
            initSelect2('#sel-lecture',  'All Lectures');
            initSelect2('#sel-exam',     'All Exams');

            /* ── Dependent dropdown helpers ───────────── */
            function resetSelect(selector, placeholder) {
                $(selector).empty().append('<option value="">' + placeholder + '</option>').trigger('change');
            }

            function loadSubjects(batchId, selectedSubject) {
                resetSelect('#sel-subject', 'All Subjects');
                if (!batchId) return;

                $.getJSON(SUBJECTS_URL, { batch_id: batchId }, function (data) {
                    $.each(data, function (i, sub) {
                        var opt = $('<option>').val(sub).text(sub);
                        if (sub === selectedSubject) opt.prop('selected', true);
                        $('#sel-subject').append(opt);
                    });
                    $('#sel-subject').trigger('change.select2');
                });
            }

            function loadLectures(batchId, subject, chapterId, selectedLecture) {
                resetSelect('#sel-lecture', 'All Lectures');
                if (!batchId && !subject && !chapterId) return;

                var params = {};
                if (batchId)   params.batch_id   = batchId;
                if (subject)   params.subject     = subject;
                if (chapterId) params.chapter_id  = chapterId;

                $.getJSON(LECTURES_URL, params, function (data) {
                    $.each(data, function (i, lec) {
                        var opt = $('<option>').val(lec.id).text(lec.title);
                        if (lec.id == selectedLecture) opt.prop('selected', true);
                        $('#sel-lecture').append(opt);
                    });
                    $('#sel-lecture').trigger('change.select2');
                });
            }

            /* ── Cascade: batch → subjects + lectures ── */
            var _initBatch   = '{{ $batchId }}';
            var _initSubject = @json($subject ?? '');
            var _initChapter = '{{ $chapterId }}';
            var _initLecture = '{{ $lectureId }}';

            $('#sel-batch').on('change', function () {
                var batchId = $(this).val();
                loadSubjects(batchId, '');
                loadLectures(batchId, '', $('#sel-chapter').val(), '');
            });

            $('#sel-subject').on('change', function () {
                loadLectures($('#sel-batch').val(), $(this).val(), $('#sel-chapter').val(), '');
            });

            $('#sel-chapter').on('change', function () {
                loadLectures($('#sel-batch').val(), $('#sel-subject').val(), $(this).val(), '');
            });

            /* On initial load with a batch already selected, reload subjects
               so the dropdown is populated (server already rendered selected item,
               but we refresh so all options are present for switching) */
            if (_initBatch) {
                $.getJSON(SUBJECTS_URL, { batch_id: _initBatch }, function (data) {
                    var currentVal = $('#sel-subject').val();
                    $('#sel-subject').empty().append('<option value="">All Subjects</option>');
                    $.each(data, function (i, sub) {
                        var opt = $('<option>').val(sub).text(sub);
                        if (sub === currentVal) opt.prop('selected', true);
                        $('#sel-subject').append(opt);
                    });
                    $('#sel-subject').trigger('change.select2');
                });
            }

            if (_initBatch || _initSubject || _initChapter) {
                $.getJSON(LECTURES_URL, {
                    batch_id:   _initBatch,
                    subject:    _initSubject,
                    chapter_id: _initChapter
                }, function (data) {
                    var currentVal = $('#sel-lecture').val();
                    $('#sel-lecture').empty().append('<option value="">All Lectures</option>');
                    $.each(data, function (i, lec) {
                        var opt = $('<option>').val(lec.id).text(lec.title);
                        if (lec.id == currentVal || lec.id == _initLecture) opt.prop('selected', true);
                        $('#sel-lecture').append(opt);
                    });
                    $('#sel-lecture').trigger('change.select2');
                });
            }

            /* ── Charts ───────────────────────────────── */
            var labels  = @json($chartLabels ?? []);
            var watches = @json($chartWatch  ?? []);
            var exams   = @json($chartExam   ?? []);

            function makeGradient(ctx, c1, c2) {
                var g = ctx.createLinearGradient(0, 0, 0, 250);
                g.addColorStop(0, c1); g.addColorStop(1, c2);
                return g;
            }

            var chartOpts = {
                responsive: true,
                legend: { display: false },
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true, max: 100, fontSize: 11, callback: function(v){ return v+'%'; } }, gridLines: { color: '#f0f2f8' } }],
                    xAxes: [{ ticks: { maxRotation: 35, fontSize: 10 }, gridLines: { display: false } }]
                }
            };

            if (document.getElementById('chartWatch') && labels.length > 0) {
                var ctx1 = document.getElementById('chartWatch').getContext('2d');
                new Chart(ctx1, { type: 'bar', data: { labels: labels, datasets: [{ label: 'Lecture %', data: watches, backgroundColor: makeGradient(ctx1,'rgba(78,115,223,0.85)','rgba(78,115,223,0.3)'), borderColor: 'rgba(78,115,223,1)', borderWidth: 1 }] }, options: chartOpts });
            }

            if (document.getElementById('chartExam') && labels.length > 0) {
                var ctx2 = document.getElementById('chartExam').getContext('2d');
                new Chart(ctx2, { type: 'bar', data: { labels: labels, datasets: [{ label: 'Exam %', data: exams, backgroundColor: makeGradient(ctx2,'rgba(28,200,138,0.85)','rgba(28,200,138,0.3)'), borderColor: 'rgba(28,200,138,1)', borderWidth: 1 }] }, options: chartOpts });
            }

            /* ── DataTable ────────────────────────────── */
            var dtTable = null;
            if (document.getElementById('studentsTable')) {
                dtTable = $('#studentsTable').DataTable({
                    pageLength: 25,
                    ordering: true,
                    order: [[10, 'desc']],
                    columnDefs: [{ orderable: false, targets: [11] }],
                    language: {
                        search: 'Search:',
                        lengthMenu: 'Show _MENU_ students',
                        info: 'Showing _START_ to _END_ of _TOTAL_ students',
                        infoFiltered: '(filtered from _MAX_ total)',
                    },
                    dom: '<"row mb-2"<"col-sm-6"l><"col-sm-6"f>>rtip'
                });
            }

            /* ── Table quick-filter (data-* attributes) ── */
            function applyTableFilters() {
                if (!dtTable) return;
                var batchVal = ($('#tbl-batch-filter').val() || '').toLowerCase();
                var watchMin = parseInt($('#tbl-watch-filter').val(), 10) || 0;
                var examMin  = parseInt($('#tbl-exam-filter').val(),  10) || 0;
                var hasExam  = $('#tbl-hasexam-filter').val();

                $.fn.dataTable.ext.search.length = 0;
                $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                    if (settings.nTable.id !== 'studentsTable') return true;
                    var row     = dtTable.row(dataIndex).node();
                    var batches = ($(row).data('batches') || '').toLowerCase();
                    var watch   = parseInt($(row).data('watch'),  10) || 0;
                    var exam    = parseInt($(row).data('exam'),   10) || 0;
                    var he      = $(row).data('hasexam') || 'no';

                    if (batchVal && batches.indexOf(batchVal) === -1) return false;
                    if (watch < watchMin) return false;
                    if (exam  < examMin)  return false;
                    if (hasExam && hasExam !== he) return false;
                    return true;
                });
                dtTable.draw();
            }

            $('#tbl-batch-filter, #tbl-watch-filter, #tbl-exam-filter, #tbl-hasexam-filter').on('change', applyTableFilters);
            $('#tbl-clear-filter').on('click', function () {
                $('#tbl-batch-filter, #tbl-hasexam-filter').val('');
                $('#tbl-watch-filter, #tbl-exam-filter').val('0');
                applyTableFilters();
            });
        })();
    </script>
@endsection

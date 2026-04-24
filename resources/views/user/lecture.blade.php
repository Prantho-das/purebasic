@extends('layouts.register')
@section('content')

@php
    $batchTitle   = \App\Batchpackage::where('batch_id', $batch_id)->value('title') ?? 'Course';
    $subjectInfo  = \App\Category::find($subject_id);
    $subjectName  = $subjectInfo ? $subjectInfo->name : 'Subject';
    $chapterModel = \App\Chapter::find($chapter_id);
    $rawChName    = $chapterModel ? $chapterModel->name : 'Chapter';

    /* Compute display chapter name using same week logic */
    $displayChapterName = $rawChName;
    if (substr($rawChName, 0, 4) === 'Week' && $startsFrom !== 'null') {
        $from       = (int) $startsFrom;
        $weekNumber = (int) substr($rawChName, 5);
        if ($weekNumber >= $from) {
            $displayChapterName = 'Week ' . ($weekNumber + 1 - $from);
        } else {
            $displayChapterName = 'Week ' . (20 + $weekNumber - $from);
        }
    }

    $totalLectures = $info->count();
    $hasVideo      = $info->filter(fn($d) => !empty($d->video) || !empty($d->youtube_video_id))->count();
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
    background: linear-gradient(135deg, #d97706 0%, #011c1a 100%);
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
.portal-hero-sub { color: rgba(255,255,255,0.65); font-size: 13px; margin: 0 0 18px; }
.portal-hero-stats { display: flex; gap: 20px; flex-wrap: wrap; }
.portal-hero-stat {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.15); border-radius: 20px;
    color: #fff; font-size: 12px; font-weight: 600; padding: 5px 14px;
}

/* Section */
.portal-section { padding: 32px 0 0; }
.portal-section-title {
    font-family: "Montserrat", sans-serif; font-size: 17px; font-weight: 700;
    color: #011c1a; margin: 0 0 20px; display: flex; align-items: center; gap: 10px;
}
.portal-section-title::after { content: ''; flex: 1; height: 1px; background: #e8edf3; }

/* Lecture cards */
.lecture-list { display: flex; flex-direction: column; gap: 14px; }

.lec-item {
    background: #fff; border: 1px solid #edf1f7; border-radius: 14px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    display: flex; gap: 16px; padding: 18px 20px;
    transition: box-shadow 0.22s, border-color 0.22s;
    position: relative; overflow: hidden;
}
.lec-item:hover {
    box-shadow: 0 6px 28px rgba(217,119,6,0.13);
    border-color: #fcd34d;
}
.lec-item::before {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0;
    width: 4px; border-radius: 14px 0 0 14px;
    background: #e8edf3; transition: background 0.2s;
}
.lec-item:hover::before { background: linear-gradient(180deg, #d97706, #f59e0b); }

/* Thumbnail / play area */
.lec-thumb {
    width: 80px; height: 56px; border-radius: 8px;
    background: #f4f6f9; border: 1.5px solid #e8edf3;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; overflow: hidden; position: relative;
    text-decoration: none;
}
.lec-thumb-play {
    width: 32px; height: 32px; border-radius: 50%;
    background: linear-gradient(135deg, #02b3e4, #0196c0);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 12px; flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(2,179,228,0.35);
    transition: transform 0.2s, box-shadow 0.2s;
}
.lec-thumb:hover .lec-thumb-play {
    transform: scale(1.1);
    box-shadow: 0 4px 14px rgba(2,179,228,0.45);
}
.lec-thumb-noplay {
    color: #c4cbd6; font-size: 22px;
}

/* Content */
.lec-content { flex: 1; min-width: 0; }
.lec-title {
    font-family: "Montserrat", sans-serif; font-size: 14px; font-weight: 700;
    color: #011c1a; margin: 0 0 6px; line-height: 1.4;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.lec-item:hover .lec-title { color: #02b3e4; }

/* Tags row */
.lec-tags { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 10px; }
.lec-tag {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 11px; font-weight: 500; padding: 2px 8px;
    border-radius: 20px; text-decoration: none;
}
.lec-tag-subject {
    background: rgba(2,179,228,0.1); color: #0196c0;
    border: 1px solid rgba(2,179,228,0.2);
}
.lec-tag-subject:hover { background: rgba(2,179,228,0.18); color: #0196c0; text-decoration: none; }
.lec-tag-chapter {
    background: rgba(124,58,237,0.08); color: #7c3aed;
    border: 1px solid rgba(124,58,237,0.15);
}
.lec-tag-chapter:hover { background: rgba(124,58,237,0.14); color: #7c3aed; text-decoration: none; }

/* Action row */
.lec-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.lec-action-btn {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 12px; border-radius: 20px;
    font-size: 11px; font-weight: 600; text-decoration: none;
    border: 1.5px solid; transition: all 0.18s;
}
.lec-btn-play {
    background: linear-gradient(135deg, #02b3e4, #0196c0); border-color: transparent;
    color: #fff; padding: 6px 14px;
}
.lec-btn-play:hover { background: linear-gradient(135deg, #0196c0, #011c1a); color: #fff; text-decoration: none; }
.lec-btn-note1  { background: rgba(26,171,97,0.08);  border-color: rgba(26,171,97,0.25);  color: #1aab61; }
.lec-btn-note1:hover  { background: #1aab61; color: #fff; text-decoration: none; border-color: #1aab61; }
.lec-btn-note2  { background: rgba(124,58,237,0.08); border-color: rgba(124,58,237,0.25); color: #7c3aed; }
.lec-btn-note2:hover  { background: #7c3aed; color: #fff; text-decoration: none; border-color: #7c3aed; }
.lec-btn-pdf    { background: rgba(220,38,38,0.07);  border-color: rgba(220,38,38,0.2);   color: #dc2626; }
.lec-btn-pdf:hover    { background: #dc2626; color: #fff; text-decoration: none; border-color: #dc2626; }
.lec-btn-quiz   { background: rgba(217,119,6,0.09);  border-color: rgba(217,119,6,0.25);  color: #d97706; }
.lec-btn-quiz:hover   { background: #d97706; color: #fff; text-decoration: none; border-color: #d97706; }

/* Bookmark */
.lec-bookmark {
    background: none; border: 1.5px solid #e8edf3; border-radius: 8px;
    width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;
    color: #9aa3af; cursor: pointer; font-size: 14px; flex-shrink: 0;
    transition: background 0.18s, border-color 0.18s, color 0.18s;
    padding: 0; align-self: flex-start;
}
.lec-bookmark:hover, .lec-bookmark.bookmarked {
    background: rgba(245,158,11,0.1); border-color: #f59e0b; color: #f59e0b;
}

/* Empty state */
.lec-empty {
    text-align: center; padding: 64px 24px; background: #fff;
    border-radius: 14px; border: 2px dashed #d1d9e6;
}
.lec-empty i { font-size: 40px; color: #c4cbd6; margin-bottom: 16px; display: block; }
.lec-empty h3 { font-family: "Montserrat", sans-serif; font-size: 17px; font-weight: 700; color: #4a5568; margin: 0 0 8px; }
.lec-empty p  { font-size: 13px; color: #9aa3af; margin: 0; }

@media (max-width: 576px) {
    .portal-hero-title { font-size: 20px; }
    .lec-item { flex-direction: column; gap: 12px; }
    .lec-thumb { width: 100%; height: 120px; border-radius: 10px; }
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
                <a href="{{ url('/batch/' . $batch_id . '/subject/' . $subject_id . '/chapter') }}">{{ $subjectName }}</a>
                <span class="bc-sep"><i class="fa-regular fa-chevron-right"></i></span>
                <span class="bc-current">{{ $displayChapterName }}</span>
            </nav>
        </div>
    </div>

    {{-- Hero --}}
    <div class="portal-hero">
        <div class="container">
            <div class="portal-hero-inner">
                <div class="portal-hero-eyebrow">
                    <i class="fa-regular fa-video"></i> Lectures
                </div>
                <h1 class="portal-hero-title">{{ $displayChapterName }}</h1>
                <p class="portal-hero-sub">{{ $subjectName }} &mdash; {{ $batchTitle }}</p>
                <div class="portal-hero-stats">
                    <span class="portal-hero-stat">
                        <i class="fa-regular fa-film"></i> {{ $totalLectures }} Lecture{{ $totalLectures != 1 ? 's' : '' }}
                    </span>
                    @if($hasVideo > 0)
                        <span class="portal-hero-stat">
                            <i class="fa-regular fa-circle-play"></i> {{ $hasVideo }} with Video
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Lecture list --}}
    <div class="portal-section">
        <div class="container">
            <div class="portal-section-title">
                <i class="fa-regular fa-film" style="color:#d97706"></i> Lectures
            </div>

            @if($info->isEmpty())
                <div class="lec-empty">
                    <i class="fa-regular fa-video-slash"></i>
                    <h3>No lectures found</h3>
                    <p>No lectures are available for this chapter yet.</p>
                </div>
            @else
                <div class="lecture-list">
                    @foreach($info as $key => $data)
                        @php
                            $chapterName = $data->chapter->name;
                            if (substr($chapterName, 0, 4) === 'Week' && $startsFrom !== 'null') {
                                $from = (int) $startsFrom;
                                $weekNumber = (int) substr($chapterName, 5);
                                $chapterName = $weekNumber >= $from
                                    ? 'Week ' . ($weekNumber + 1 - $from)
                                    : 'Week ' . (20 + $weekNumber - $from);
                            }
                            $dataInfo = [
                                'title'   => $data->title,
                                'batchId' => $batch_id,
                                'classId' => $data->id,
                            ];
                            if (!empty($data->links))  $dataInfo['note1'] = 'note1';
                            if (!empty($data->pdf))    $dataInfo['note2'] = 'note2';
                            if (!empty($data->v_link)) $dataInfo['pdf']   = 'pdf';
                            $hasVid = !empty($data->video) || !empty($data->youtube_video_id);
                        @endphp

                        <div class="lec-item">

                            {{-- Thumbnail / play --}}
                            @if($hasVid)
                                <a href="{{ route('lecture_video', ['batch_id' => $batch_id, 'id' => $data->id]) }}"
                                   class="lec-thumb"
                                   onclick="watchHistory({{ json_encode($dataInfo) }})">
                                    <div class="lec-thumb-play">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </a>
                            @else
                                <div class="lec-thumb">
                                    <i class="fa-regular fa-file-lines lec-thumb-noplay"></i>
                                </div>
                            @endif

                            {{-- Content --}}
                            <div class="lec-content">
                                <p class="lec-title">{{ ($key + 1) . '. ' . $data->title }}</p>

                                <div class="lec-tags">
                                    <a href="{{ url('/batch/' . $batch_id . '/subjects') }}"
                                       class="lec-tag lec-tag-subject">
                                        <i class="fa-regular fa-layer-group"></i> {{ $data->category }}
                                    </a>
                                    <a href="{{ url('/batch/' . $batch_id . '/subject/' . $subject_id . '/chapter') }}"
                                       class="lec-tag lec-tag-chapter">
                                        <i class="fa-regular fa-bookmark"></i> {{ $chapterName }}
                                    </a>
                                </div>

                                <div class="lec-actions">
                                    @if($hasVid)
                                        <a href="{{ route('lecture_video', ['batch_id' => $batch_id, 'id' => $data->id]) }}"
                                           class="lec-action-btn lec-btn-play"
                                           onclick="watchHistory({{ json_encode($dataInfo) }})">
                                            <i class="fa-solid fa-play"></i> Watch
                                        </a>
                                    @endif
                                    @if(!empty($data->links))
                                        <a href="{{ $data->links }}" target="_blank" class="lec-action-btn lec-btn-note1">
                                            <i class="fa-regular fa-file-lines"></i> Note 1
                                        </a>
                                    @endif
                                    @if(!empty($data->pdf))
                                        <a href="{{ $data->pdf }}" target="_blank" class="lec-action-btn lec-btn-note2">
                                            <i class="fa-regular fa-file-lines"></i> Note 2
                                        </a>
                                    @endif
                                    @if(!empty($data->v_link))
                                        <a href="{{ $data->v_link }}" target="_blank" class="lec-action-btn lec-btn-pdf">
                                            <i class="fa-regular fa-file-pdf"></i> PDF
                                        </a>
                                    @endif
                                    @if(!empty($data->isExam))
                                        <a href="{{ url('/batch/' . $batch_id . '/class/' . $data->id . '/quiz/' . $data->isExam) }}"
                                           class="lec-action-btn lec-btn-quiz">
                                            <i class="fa-regular fa-file-pen"></i> Quiz
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{-- Bookmark --}}
                            <button class="lec-bookmark" id="bm-{{ $data->id }}"
                                    onclick="toggleBookmark({{ json_encode($dataInfo) }})"
                                    title="Bookmark">
                                <i class="fa-regular fa-bookmark" id="bm-icon-{{ $data->id }}"></i>
                            </button>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

</div>

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var bookmarks = JSON.parse(localStorage.getItem('videoBookmark') || '[]');
    bookmarks.forEach(function (b) {
        var btn  = document.getElementById('bm-' + b.classId);
        var icon = document.getElementById('bm-icon-' + b.classId);
        if (btn)  btn.classList.add('bookmarked');
        if (icon) { icon.classList.remove('fa-regular'); icon.classList.add('fa-solid'); }
    });
});

function addVideoBookmark(dataInfo) {
    var list = JSON.parse(localStorage.getItem('videoBookmark') || '[]');
    list.unshift(dataInfo);
    localStorage.setItem('videoBookmark', JSON.stringify(list));
}
function removeVideoBookmark(classId) {
    var list = JSON.parse(localStorage.getItem('videoBookmark') || '[]');
    list = list.filter(function (b) { return b.classId != classId; });
    localStorage.setItem('videoBookmark', JSON.stringify(list));
}
function toggleBookmark(dataInfo) {
    var btn  = document.getElementById('bm-' + dataInfo.classId);
    var icon = document.getElementById('bm-icon-' + dataInfo.classId);
    if (btn && btn.classList.contains('bookmarked')) {
        removeVideoBookmark(dataInfo.classId);
        btn.classList.remove('bookmarked');
        if (icon) { icon.classList.remove('fa-solid'); icon.classList.add('fa-regular'); }
    } else {
        addVideoBookmark(dataInfo);
        if (btn)  btn.classList.add('bookmarked');
        if (icon) { icon.classList.remove('fa-regular'); icon.classList.add('fa-solid'); }
    }
}
function watchHistory(dataInfo) {
    var list = JSON.parse(localStorage.getItem('watchHistory') || '[]');
    var exists = list.some(function (b) { return b.classId == dataInfo.classId; });
    if (!exists) { list.unshift(dataInfo); localStorage.setItem('watchHistory', JSON.stringify(list)); }
}
</script>
@endsection

@endsection

@extends('layouts.register')
@section('content')

@php
    $batchTitle = \App\Batchpackage::where('batch_id', $batch_id)->value('title') ?? 'Course';

    $iconMap = [
        'anatomy'        => 'fa-bone',
        'physiology'     => 'fa-heart-pulse',
        'biochemistry'   => 'fa-flask-vial',
        'pathology'      => 'fa-microscope',
        'pharmacology'   => 'fa-capsules',
        'microbiology'   => 'fa-bacterium',
        'surgery'        => 'fa-scalpel',
        'medicine'       => 'fa-stethoscope',
        'paediatrics'    => 'fa-baby',
        'pediatrics'     => 'fa-baby',
        'gynaecology'    => 'fa-person-pregnant',
        'obstetrics'     => 'fa-person-pregnant',
        'ent'            => 'fa-ear',
        'ophthalmology'  => 'fa-eye',
        'psychiatry'     => 'fa-brain',
        'radiology'      => 'fa-x-ray',
        'dermatology'    => 'fa-hand',
        'forensic'       => 'fa-gavel',
        'community'      => 'fa-people-group',
        'bcs'            => 'fa-landmark',
        'english'        => 'fa-language',
        'math'           => 'fa-calculator',
        'general'        => 'fa-globe',
    ];

    $palettes = [
        ['bg' => '#e8f7fd', 'accent' => '#02b3e4', 'badge' => '#02b3e4'],
        ['bg' => '#e8f7f1', 'accent' => '#1aab61', 'badge' => '#1aab61'],
        ['bg' => '#fff4e5', 'accent' => '#d97706', 'badge' => '#d97706'],
        ['bg' => '#f0edfe', 'accent' => '#7c3aed', 'badge' => '#7c3aed'],
        ['bg' => '#fde8f0', 'accent' => '#db2777', 'badge' => '#db2777'],
        ['bg' => '#e8f0fe', 'accent' => '#2563eb', 'badge' => '#2563eb'],
    ];

    $allSubjects = collect();
    foreach ($categories as $chunk) {
        foreach ($chunk as $s) { $allSubjects->push($s); }
    }
    $totalSubjects = $allSubjects->count();
@endphp

<style>
.portal-page { background: #f4f6f9; min-height: 100vh; padding-bottom: 60px; font-family: "Poppins", sans-serif; }

/* Breadcrumb bar */
.portal-breadcrumb {
    background: #fff;
    border-bottom: 1px solid #e8edf3;
    padding: 12px 0;
    position: sticky;
    top: 0;
    z-index: 50;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.portal-breadcrumb nav { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
.portal-breadcrumb nav a { font-size: 13px; color: #6c757d; text-decoration: none; transition: color 0.2s; }
.portal-breadcrumb nav a:hover { color: #02b3e4; }
.portal-breadcrumb nav .bc-sep { color: #c4cbd6; font-size: 11px; }
.portal-breadcrumb nav .bc-current { font-size: 13px; color: #011c1a; font-weight: 600; }

/* Hero */
.portal-hero {
    background: linear-gradient(135deg, #02b3e4 0%, #011c1a 100%);
    padding: 40px 0 32px;
    position: relative;
    overflow: hidden;
}
.portal-hero::before {
    content: ''; position: absolute;
    top: -50px; right: -60px; width: 260px; height: 260px;
    background: rgba(255,255,255,0.05); border-radius: 50%;
}
.portal-hero-inner { position: relative; z-index: 1; }
.portal-hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25);
    border-radius: 20px; color: #fff; font-size: 11px; font-weight: 600;
    letter-spacing: 0.5px; text-transform: uppercase; padding: 4px 12px; margin-bottom: 12px;
}
.portal-hero-title {
    font-family: "Montserrat", sans-serif; font-size: 28px; font-weight: 800;
    color: #fff; margin: 0 0 6px; line-height: 1.25;
}
.portal-hero-sub { color: rgba(255,255,255,0.72); font-size: 13px; margin: 0 0 18px; }
.portal-hero-count {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.15); border-radius: 20px;
    color: #fff; font-size: 12px; font-weight: 600; padding: 5px 14px;
}

/* Section */
.portal-section { padding: 36px 0 0; }
.portal-section-title {
    font-family: "Montserrat", sans-serif; font-size: 17px; font-weight: 700;
    color: #011c1a; margin: 0 0 20px;
    display: flex; align-items: center; gap: 10px;
}
.portal-section-title::after {
    content: ''; flex: 1; height: 1px; background: #e8edf3; margin-left: 8px;
}

/* Subject grid */
.subject-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 18px;
}
.subject-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #edf1f7;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    padding: 24px 20px 20px;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 14px;
    transition: box-shadow 0.22s, transform 0.22s;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
.subject-card:hover {
    box-shadow: 0 8px 28px rgba(2,179,228,0.16);
    transform: translateY(-3px);
    text-decoration: none;
}
.subject-card-icon {
    width: 48px; height: 48px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; flex-shrink: 0;
}
.subject-card-name {
    font-family: "Montserrat", sans-serif;
    font-size: 14px; font-weight: 700; color: #011c1a;
    line-height: 1.35; margin: 0;
}
.subject-card-arrow {
    position: absolute; bottom: 16px; right: 16px;
    width: 28px; height: 28px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; opacity: 0;
    transition: opacity 0.2s, transform 0.2s;
}
.subject-card:hover .subject-card-arrow {
    opacity: 1; transform: translateX(3px);
}

@media (max-width: 576px) {
    .subject-grid { grid-template-columns: repeat(2, 1fr); }
    .portal-hero-title { font-size: 22px; }
}
@media (max-width: 360px) {
    .subject-grid { grid-template-columns: 1fr; }
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
                <span class="bc-current">{{ $batchTitle }}</span>
            </nav>
        </div>
    </div>

    {{-- Hero --}}
    <div class="portal-hero">
        <div class="container">
            <div class="portal-hero-inner">
                <div class="portal-hero-eyebrow">
                    <i class="fa-regular fa-layer-group"></i> Subjects
                </div>
                <h1 class="portal-hero-title">{{ $batchTitle }}</h1>
                <p class="portal-hero-sub">Choose a subject to explore its chapters and lectures.</p>
                <span class="portal-hero-count">
                    <i class="fa-regular fa-books"></i>
                    {{ $totalSubjects }} Subject{{ $totalSubjects != 1 ? 's' : '' }}
                </span>
            </div>
        </div>
    </div>

    {{-- Subjects grid --}}
    <div class="portal-section">
        <div class="container">
            <div class="portal-section-title">
                <i class="fa-regular fa-layer-group" style="color:#02b3e4"></i> All Subjects
            </div>

            <div class="subject-grid">
                @php $pIdx = 0; @endphp
                @foreach($categories as $subjects)
                    @foreach($subjects as $subject)
                        @php
                            $pal = $palettes[$pIdx % count($palettes)];
                            $key = strtolower(strtok($subject->name, ' '));
                            $icon = $iconMap[$key] ?? 'fa-book-open';
                            $pIdx++;
                        @endphp
                        <a href="{{ route('subject_chapters', ['batch_id' => $batch_id, 'subject_id' => $subject->id]) }}"
                           class="subject-card">
                            <div class="subject-card-icon"
                                 style="background: {{ $pal['bg'] }}; color: {{ $pal['accent'] }}">
                                <i class="fa-regular {{ $icon }}"></i>
                            </div>
                            <p class="subject-card-name">{{ $subject->name }}</p>
                            <div class="subject-card-arrow"
                                 style="background: {{ $pal['bg'] }}; color: {{ $pal['accent'] }}">
                                <i class="fa-regular fa-arrow-right"></i>
                            </div>
                        </a>
                    @endforeach
                @endforeach
            </div>

        </div>
    </div>

</div>

@endsection

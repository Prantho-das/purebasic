@extends('layouts.user')
@push('css')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
@endpush


@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Lecture Video</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->

                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">

            <div class="card card-custom card-stretch gutter-b">
                <div class="card-body pt-50">
                    <div class="plyr__video-embed" id="player">
                        {!! $solveClass !!}
                    </div>
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection
@section('script')
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script>
        const player = new Plyr('#player');
    </script>
@endsection

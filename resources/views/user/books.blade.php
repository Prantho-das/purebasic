@extends('layouts.user')
@section('content')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Books Download</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('profile',session()->get('id'))}}" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <span  class="text-muted text-hover-info">Books Download</span>
                        </li>

                    </ul>
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
        @foreach($books as $books_raw)
            <!--begin::Row-->
                <div class="row">
                    @foreach($books_raw as $data)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b card-stretch">
                                <!--begin::Body-->
                                <div class="card-body pt-4 text-center">
                                    <img src="{{asset('uploads/user/'.$data->image)}}" style="width:250px">
                                    <h6 style="margin-top:10px">{{$data->name}}</h6>
                                    <a href="{{$data->url}}" style="background: #2B96CC; color: #fff; padding: 5px 11px; border-radius: 13px;">Downloads</a>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end:: Card-->
                        </div>
{{--                        <div class="col-md-3">--}}
{{--                            <div class="my_cl text-center" style="background: #fff; box-shadow: 0px 0px 5px 0px #ccc;    padding-bottom: 15px;">--}}
{{--                                <img src="{{asset('uploads/user/'.$data->image)}}" style="width:250px">--}}
{{--                                <h6 style="margin-top:10px">{{$data->name}}</h6>--}}
{{--                                <a href="{{$data->url}}" style="background: #2B96CC; color: #fff; padding: 5px 11px; border-radius: 13px;">Downloads</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                   @endforeach
                </div>
            @endforeach
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection
@push('script')
    <script>
        $(document).ready(function(){
            $('#dashboard_tab').removeClass('active');
            $('#books_tab').addClass('active');

            $('#mb_dashboard_tab').removeClass('active');
            $('#mb_remove_tab').attr("aria-selected","true");
        });
    </script>
@endpush


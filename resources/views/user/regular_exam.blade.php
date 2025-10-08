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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Regular Exam</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('profile',session()->get('id'))}}" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <span  class="text-muted text-hover-info">{{$type}}</span>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
        {{--            <div class="d-flex align-items-center">--}}
        {{--                <!--begin::Actions-->--}}
        {{--                <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm">Actions</a>--}}
        {{--                <!--end::Actions-->--}}
        {{--                <!--begin::Dropdown-->--}}
        {{--                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">--}}
        {{--                    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
        {{--											<span class="svg-icon svg-icon-success svg-icon-2x">--}}
        {{--												<!--begin::Svg Icon | path:/metronic/theme/html/demo7/dist/assets/media/svg/icons/Files/File-plus.svg-->--}}
        {{--												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
        {{--													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
        {{--														<polygon points="0 0 24 0 24 24 0 24"></polygon>--}}
        {{--														<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>--}}
        {{--														<path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"></path>--}}
        {{--													</g>--}}
        {{--												</svg>--}}
        {{--                                                <!--end::Svg Icon-->--}}
        {{--											</span>--}}
        {{--                    </a>--}}
        {{--                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">--}}
        {{--                        <!--begin::Navigation-->--}}
        {{--                        <ul class="navi navi-hover">--}}
        {{--                            <li class="navi-header font-weight-bold py-4">--}}
        {{--                                <span class="font-size-lg">Choose Label:</span>--}}
        {{--                                <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>--}}
        {{--                            </li>--}}
        {{--                            <li class="navi-separator mb-3 opacity-70"></li>--}}
        {{--                            <li class="navi-item">--}}
        {{--                                <a href="#" class="navi-link">--}}
        {{--														<span class="navi-text">--}}
        {{--															<span class="label label-xl label-inline label-light-success">Customer</span>--}}
        {{--														</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}
        {{--                            <li class="navi-item">--}}
        {{--                                <a href="#" class="navi-link">--}}
        {{--														<span class="navi-text">--}}
        {{--															<span class="label label-xl label-inline label-light-danger">Partner</span>--}}
        {{--														</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}
        {{--                            <li class="navi-item">--}}
        {{--                                <a href="#" class="navi-link">--}}
        {{--														<span class="navi-text">--}}
        {{--															<span class="label label-xl label-inline label-light-warning">Suplier</span>--}}
        {{--														</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}
        {{--                            <li class="navi-item">--}}
        {{--                                <a href="#" class="navi-link">--}}
        {{--														<span class="navi-text">--}}
        {{--															<span class="label label-xl label-inline label-light-primary">Member</span>--}}
        {{--														</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}
        {{--                            <li class="navi-item">--}}
        {{--                                <a href="#" class="navi-link">--}}
        {{--														<span class="navi-text">--}}
        {{--															<span class="label label-xl label-inline label-light-dark">Staff</span>--}}
        {{--														</span>--}}
        {{--                                </a>--}}
        {{--                            </li>--}}
        {{--                            <li class="navi-separator mt-3 opacity-70"></li>--}}
        {{--                            <li class="navi-footer py-4">--}}
        {{--                                <a class="btn btn-clean font-weight-bold btn-sm" href="#">--}}
        {{--                                    <i class="ki ki-plus icon-sm"></i>Add new</a>--}}
        {{--                            </li>--}}
        {{--                        </ul>--}}
        {{--                        <!--end::Navigation-->--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <!--end::Dropdown-->--}}
        {{--            </div>--}}
        <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label"> {{$type}}
                            <span class="d-block text-muted pt-2 font-size-sm">{{$type}} list</span></h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                        <thead>
                        <tr>
                            <th title="Field #1">Exam Name</th>
                            <th title="Field #2">Batch</th>
                            <th title="Field #3">Total Mark</th>
                            <th title="Field #4">Total Time</th>
                            <th title="Field #5">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @php $key=($exams_raw->perPage() * ($exams_raw->currentPage()-1))+1; @endphp
                        @foreach($exams as $exam)
                            <tr>
{{--                                <td>{{$key++}}</td>--}}
                                <td>{{$exam->name}}</td>
                                <td style="width: 25%">{{$exam->batch_name}}</td>
                                <td>{{$exam->exam_in_minutes}}</td>
                                <td>{{$exam->ex_time.' minutes'}}</td>
                                <td><a href="{{url('/spacialmodeltest-examm/'.$exam->id)}}">Start Exam</a></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                {{ $exams_raw->links() }}
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection
@push('script')
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{asset('mt7/assets/js/pages/crud/ktdatatable/base/regular_exam-table.js')}}"></script>
    <!--end::Page Scripts-->
<script>
    $(document).ready(function(){
        $('#dashboard_tab').removeClass('active');
      $('#kt_header_tab_1').addClass('show active');
      $('#exam_tab').addClass('active');

    });
</script>
    @endpush

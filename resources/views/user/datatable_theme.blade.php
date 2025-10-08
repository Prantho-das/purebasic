@extends('layouts.user')
@push('css')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('mt7/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Modal Examples</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">KTDatatable</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Advanced</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Modal Examples</a>
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

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">My Courses</h5>
                <!--end::Title-->

                <!--begin::Search Form-->
                <!--end::Search Form-->
                <!--begin::Group Actions-->
            {{--                            <div class="d-flex- align-items-center flex-wrap mr-2 d-none" id="kt_subheader_group_actions">--}}
            {{--                                <div class="text-dark-50 font-weight-bold">--}}
            {{--                                    <span id="kt_subheader_group_selected_rows">23</span>Selected:</div>--}}
            {{--                                <div class="d-flex ml-6">--}}
            {{--                                    <div class="dropdown mr-2" id="kt_subheader_group_actions_status_change">--}}
            {{--                                        <button type="button" class="btn btn-light-primary font-weight-bolder btn-sm dropdown-toggle" data-toggle="dropdown">Update Status</button>--}}
            {{--                                        <div class="dropdown-menu p-0 m-0 dropdown-menu-sm">--}}
            {{--                                            <ul class="navi navi-hover pt-3 pb-4">--}}
            {{--                                                <li class="navi-header font-weight-bolder text-uppercase text-primary font-size-lg pb-0">Change status to:</li>--}}
            {{--                                                <li class="navi-item">--}}
            {{--                                                    <a href="#" class="navi-link" data-toggle="status-change" data-status="1">--}}
            {{--																<span class="navi-text">--}}
            {{--																	<span class="label label-light-success label-inline font-weight-bold">Approved</span>--}}
            {{--																</span>--}}
            {{--                                                    </a>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="navi-item">--}}
            {{--                                                    <a href="#" class="navi-link" data-toggle="status-change" data-status="2">--}}
            {{--																<span class="navi-text">--}}
            {{--																	<span class="label label-light-danger label-inline font-weight-bold">Rejected</span>--}}
            {{--																</span>--}}
            {{--                                                    </a>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="navi-item">--}}
            {{--                                                    <a href="#" class="navi-link" data-toggle="status-change" data-status="3">--}}
            {{--																<span class="navi-text">--}}
            {{--																	<span class="label label-light-warning label-inline font-weight-bold">Pending</span>--}}
            {{--																</span>--}}
            {{--                                                    </a>--}}
            {{--                                                </li>--}}
            {{--                                                <li class="navi-item">--}}
            {{--                                                    <a href="#" class="navi-link" data-toggle="status-change" data-status="4">--}}
            {{--																<span class="navi-text">--}}
            {{--																	<span class="label label-light-info label-inline font-weight-bold">On Hold</span>--}}
            {{--																</span>--}}
            {{--                                                    </a>--}}
            {{--                                                </li>--}}
            {{--                                            </ul>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                    <button class="btn btn-light-success font-weight-bolder btn-sm mr-2" id="kt_subheader_group_actions_fetch" data-toggle="modal" data-target="#kt_datatable_records_fetch_modal">Fetch Selected</button>--}}
            {{--                                    <button class="btn btn-light-danger font-weight-bolder btn-sm mr-2" id="kt_subheader_group_actions_delete_all">Delete All</button>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            <!--end::Group Actions-->
            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                <a href="#" class=""></a>
                <!--end::Button-->
                <!--begin::Button-->
                <a href="{{route('batches')}}" class="btn btn-light-primary font-weight-bold ml-2">Add Course</a>
                <!--end::Button-->
                <!--begin::Dropdown-->
            {{--                            <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="left">--}}
            {{--                                <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
            {{--											<span class="svg-icon svg-icon-success svg-icon-2x">--}}
            {{--												<!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->--}}
            {{--												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
            {{--													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
            {{--														<polygon points="0 0 24 0 24 24 0 24" />--}}
            {{--														<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />--}}
            {{--														<path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />--}}
            {{--													</g>--}}
            {{--												</svg>--}}
            {{--                                                <!--end::Svg Icon-->--}}
            {{--											</span>--}}
            {{--                                </a>--}}
            {{--                                <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">--}}
            {{--                                    <!--begin::Naviigation-->--}}
            {{--                                    <ul class="navi">--}}
            {{--                                        <li class="navi-header font-weight-bold py-5">--}}
            {{--                                            <span class="font-size-lg">Add New:</span>--}}
            {{--                                            <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="navi-separator mb-3 opacity-70"></li>--}}
            {{--                                        <li class="navi-item">--}}
            {{--                                            <a href="#" class="navi-link">--}}
            {{--														<span class="navi-icon">--}}
            {{--															<i class="flaticon2-shopping-cart-1"></i>--}}
            {{--														</span>--}}
            {{--                                                <span class="navi-text">Order</span>--}}
            {{--                                            </a>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="navi-item">--}}
            {{--                                            <a href="#" class="navi-link">--}}
            {{--														<span class="navi-icon">--}}
            {{--															<i class="navi-icon flaticon2-calendar-8"></i>--}}
            {{--														</span>--}}
            {{--                                                <span class="navi-text">Members</span>--}}
            {{--                                                <span class="navi-label">--}}
            {{--															<span class="label label-light-danger label-rounded font-weight-bold">3</span>--}}
            {{--														</span>--}}
            {{--                                            </a>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="navi-item">--}}
            {{--                                            <a href="#" class="navi-link">--}}
            {{--														<span class="navi-icon">--}}
            {{--															<i class="navi-icon flaticon2-telegram-logo"></i>--}}
            {{--														</span>--}}
            {{--                                                <span class="navi-text">Project</span>--}}
            {{--                                            </a>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="navi-item">--}}
            {{--                                            <a href="#" class="navi-link">--}}
            {{--														<span class="navi-icon">--}}
            {{--															<i class="navi-icon flaticon2-new-email"></i>--}}
            {{--														</span>--}}
            {{--                                                <span class="navi-text">Record</span>--}}
            {{--                                                <span class="navi-label">--}}
            {{--															<span class="label label-light-success label-rounded font-weight-bold">5</span>--}}
            {{--														</span>--}}
            {{--                                            </a>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="navi-separator mt-3 opacity-70"></li>--}}
            {{--                                        <li class="navi-footer pt-5 pb-4">--}}
            {{--                                            <a class="btn btn-light-primary font-weight-bolder btn-sm" href="#">More options</a>--}}
            {{--                                            <a class="btn btn-clean font-weight-bold btn-sm d-none" href="#" data-toggle="tooltip" data-placement="right" title="Click to learn more...">Learn more</a>--}}
            {{--                                        </li>--}}
            {{--                                    </ul>--}}
            {{--                                    <!--end::Naviigation-->--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            <!--end::Dropdown-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Notice-->
            <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
                <div class="alert-icon">
										<span class="svg-icon svg-icon-primary svg-icon-xl">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
													<path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>
                </div>
                <div class="alert-text">
                    <p>The Metronic Datatable component supports initialization from HTML table. It also defines the schema model of the data source. In addition to the visualization, the Datatable provides built-in support for operations over data such as sorting, filtering and paging performed in user browser (frontend).</p>For more information visit
                    <a class="font-weight-bold" href="https://keenthemes.com/metronic/?page=docs&amp;section=datatable" target="_blank">Metronic KTDatatable Documentation</a>.</div>
            </div>
            <!--end::Notice-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">HTML Table
                            <span class="d-block text-muted pt-2 font-size-sm">Datatable initialized from HTML table</span></h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="svg-icon svg-icon-md">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
															<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>Export</button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi flex-column navi-hover py-2">
                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-print"></i>
																</span>
                                            <span class="navi-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-copy"></i>
																</span>
                                            <span class="navi-text">Copy</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-excel-o"></i>
																</span>
                                            <span class="navi-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-text-o"></i>
																</span>
                                            <span class="navi-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-pdf-o"></i>
																</span>
                                            <span class="navi-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->
                        <!--begin::Button-->
                        <a href="#" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>New Record</a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom collapsed" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Ship Country</th>
                            <th>Ship City</th>
                            <th>Ship Name</th>
                            <th>Ship Address</th>
                            <th>Company Email</th>
                            <th>Company Agent</th>
                            <th>Company Name</th>
                            <th>Currency</th>
                            <th>Department</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Ship Date</th>
                            <th>Payment Date</th>
                            <th>Time Zone</th>
                            <th>Total Payment</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>64616-103</td>
                            <td>BR</td>
                            <td>São Félix do Xingu</td>
                            <td>Gerhold Inc</td>
                            <td>698 Oriole Pass</td>
                            <td>hboule0@hp.com</td>
                            <td>Hayes Boule</td>
                            <td>Casper-Kerluke</td>
                            <td>BRL</td>
                            <td>Shoes</td>
                            <td>-7.0179497</td>
                            <td>-52.3613378</td>
                            <td>10/15/2017</td>
                            <td>2016-07-28 03:44:46</td>
                            <td>America/Santarem</td>
                            <td>$563997.38</td>
                            <td>5</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>54868-3377</td>
                            <td>VN</td>
                            <td>Bình Minh</td>
                            <td>Schimmel, Raynor and Bechtelar</td>
                            <td>8998 Delaware Court</td>
                            <td>hbresnen1@theguardian.com</td>
                            <td>Humbert Bresnen</td>
                            <td>Hodkiewicz and Sons</td>
                            <td>VND</td>
                            <td>Kids</td>
                            <td>10.029192</td>
                            <td>105.8525154</td>
                            <td>4/24/2016</td>
                            <td>2016-08-07 16:14:58</td>
                            <td>Asia/Ho_Chi_Minh</td>
                            <td>$582935.03</td>
                            <td>2</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>0998-0355</td>
                            <td>PH</td>
                            <td>Palagao Norte</td>
                            <td>Rau, Rice and Mayert</td>
                            <td>91796 Sutteridge Road</td>
                            <td>jlabro2@kickstarter.com</td>
                            <td>Jareb Labro</td>
                            <td>Kuhlman Inc</td>
                            <td>PHP</td>
                            <td>Health</td>
                            <td>18.04406</td>
                            <td>121.71871</td>
                            <td>7/11/2017</td>
                            <td>2016-07-04 08:13:30</td>
                            <td>Asia/Manila</td>
                            <td>$925080.02</td>
                            <td>6</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>55154-6876</td>
                            <td>CN</td>
                            <td>Jiannan</td>
                            <td>Rogahn, Dibbert and Considine</td>
                            <td>8 Muir Drive</td>
                            <td>ktosspell3@flickr.com</td>
                            <td>Krishnah Tosspell</td>
                            <td>Prosacco-Kessler</td>
                            <td>CNY</td>
                            <td>Clothing</td>
                            <td>22.781631</td>
                            <td>108.273158</td>
                            <td>2/5/2016</td>
                            <td>2017-09-13 06:01:26</td>
                            <td>Asia/Chongqing</td>
                            <td>$144042.68</td>
                            <td>1</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>49349-069</td>
                            <td>US</td>
                            <td>Shawnee Mission</td>
                            <td>Aufderhar LLC</td>
                            <td>782 Mallory Lane</td>
                            <td>dkernan4@mapquest.com</td>
                            <td>Dale Kernan</td>
                            <td>Bernier and Sons</td>
                            <td>USD</td>
                            <td>Sports</td>
                            <td>39.02</td>
                            <td>-94.72</td>
                            <td>7/23/2017</td>
                            <td>2016-06-01 04:16:44</td>
                            <td>America/Chicago</td>
                            <td>$504245.54</td>
                            <td>5</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>53499-0393</td>
                            <td>UA</td>
                            <td>Kozel’shchyna</td>
                            <td>Steuber-Leffler</td>
                            <td>02 Briar Crest Parkway</td>
                            <td>hbentham5@nih.gov</td>
                            <td>Halley Bentham</td>
                            <td>Schoen-Metz</td>
                            <td>UAH</td>
                            <td>Garden</td>
                            <td>49.4424226</td>
                            <td>34.6731345</td>
                            <td>2/21/2016</td>
                            <td>2016-08-28 03:37:57</td>
                            <td>Europe/Zaporozhye</td>
                            <td>$431379.80</td>
                            <td>1</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>43074-105</td>
                            <td>PH</td>
                            <td>De la Paz</td>
                            <td>Bosco LLC</td>
                            <td>643 Mayer Road</td>
                            <td>bpenddreth6@example.com</td>
                            <td>Burgess Penddreth</td>
                            <td>DuBuque, Stanton and Stanton</td>
                            <td>PHP</td>
                            <td>Garden</td>
                            <td>14.6135888</td>
                            <td>121.0957927</td>
                            <td>10/25/2016</td>
                            <td>2016-06-02 23:17:08</td>
                            <td>Asia/Manila</td>
                            <td>$254072.66</td>
                            <td>5</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>76328-333</td>
                            <td>PT</td>
                            <td>Sobreira</td>
                            <td>Kuhlman and Sons</td>
                            <td>6715 Dakota Parkway</td>
                            <td>csedwick7@wikispaces.com</td>
                            <td>Cob Sedwick</td>
                            <td>Homenick-Nolan</td>
                            <td>EUR</td>
                            <td>Sports</td>
                            <td>41.343685</td>
                            <td>-7.3436907</td>
                            <td>2/18/2016</td>
                            <td>2017-06-21 00:04:09</td>
                            <td>Europe/Lisbon</td>
                            <td>$1070878.82</td>
                            <td>3</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>21130-054</td>
                            <td>FR</td>
                            <td>Roissy Charles-de-Gaulle</td>
                            <td>Ortiz and Sons</td>
                            <td>4942 Darwin Hill</td>
                            <td>tcallaghan8@squidoo.com</td>
                            <td>Tabby Callaghan</td>
                            <td>Daugherty-Considine</td>
                            <td>EUR</td>
                            <td>Industrial</td>
                            <td>48.989038</td>
                            <td>2.513543</td>
                            <td>3/26/2016</td>
                            <td>2017-08-28 14:29:39</td>
                            <td>Europe/Paris</td>
                            <td>$234343.18</td>
                            <td>2</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>68788-9890</td>
                            <td>DO</td>
                            <td>Cristóbal</td>
                            <td>Ernser Group</td>
                            <td>854 Dapin Terrace</td>
                            <td>bjarry9@craigslist.org</td>
                            <td>Broddy Jarry</td>
                            <td>Walter Group</td>
                            <td>DOP</td>
                            <td>Garden</td>
                            <td>18.5086907</td>
                            <td>-69.8497207</td>
                            <td>8/10/2016</td>
                            <td>2016-03-12 04:10:52</td>
                            <td>America/Santo_Domingo</td>
                            <td>$101388.34</td>
                            <td>1</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>68428-740</td>
                            <td>MA</td>
                            <td>Tidili Mesfioua</td>
                            <td>Doyle, Grady and Zboncak</td>
                            <td>67 Talisman Drive</td>
                            <td>mmcgougana@dion.ne.jp</td>
                            <td>Marjorie McGougan</td>
                            <td>Littel and Sons</td>
                            <td>MAD</td>
                            <td>Toys</td>
                            <td>31.4627186</td>
                            <td>-7.6080892</td>
                            <td>2/8/2016</td>
                            <td>2017-04-28 23:54:44</td>
                            <td>Africa/Casablanca</td>
                            <td>$1107527.60</td>
                            <td>6</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>43269-779</td>
                            <td>YE</td>
                            <td>Az Zāhir</td>
                            <td>Bailey-Sawayn</td>
                            <td>5583 Walton Hill</td>
                            <td>espriggingb@china.com.cn</td>
                            <td>Edsel Sprigging</td>
                            <td>Kulas, Huels and Strosin</td>
                            <td>YER</td>
                            <td>Jewelery</td>
                            <td>13.9625642</td>
                            <td>45.4674656</td>
                            <td>11/13/2017</td>
                            <td>2017-06-18 10:52:54</td>
                            <td>Asia/Aden</td>
                            <td>$467654.78</td>
                            <td>6</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>0573-0174</td>
                            <td>AM</td>
                            <td>Doghs</td>
                            <td>Bergstrom Inc</td>
                            <td>7024 Eagan Court</td>
                            <td>jgouldebyc@cocolog-nifty.com</td>
                            <td>Jess Gouldeby</td>
                            <td>Moen Group</td>
                            <td>AMD</td>
                            <td>Health</td>
                            <td>40.2213038</td>
                            <td>44.271441</td>
                            <td>9/10/2017</td>
                            <td>2016-12-16 12:23:06</td>
                            <td>Asia/Yerevan</td>
                            <td>$309518.30</td>
                            <td>5</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>67868-117</td>
                            <td>ID</td>
                            <td>Pakemitan</td>
                            <td>Cassin-Lebsack</td>
                            <td>141 Spaight Avenue</td>
                            <td>mmatzld@msn.com</td>
                            <td>Marys Matzl</td>
                            <td>Emard-Gerhold</td>
                            <td>IDR</td>
                            <td>Health</td>
                            <td>-6.9211461</td>
                            <td>107.6940475</td>
                            <td>3/5/2016</td>
                            <td>2016-05-28 05:25:30</td>
                            <td>Asia/Jakarta</td>
                            <td>$878639.99</td>
                            <td>2</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>0641-6114</td>
                            <td>KZ</td>
                            <td>Shu</td>
                            <td>Jerde-Mueller</td>
                            <td>601 Chinook Street</td>
                            <td>gfranscionie@craigslist.org</td>
                            <td>Gabrila Franscioni</td>
                            <td>Gusikowski LLC</td>
                            <td>KZT</td>
                            <td>Kids</td>
                            <td>43.6051078</td>
                            <td>73.7631135</td>
                            <td>6/21/2016</td>
                            <td>2016-12-20 14:15:17</td>
                            <td>Asia/Almaty</td>
                            <td>$200145.16</td>
                            <td>4</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>63629-4970</td>
                            <td>TH</td>
                            <td>Chang Klang</td>
                            <td>Schulist, Marks and Bashirian</td>
                            <td>7109 Ilene Place</td>
                            <td>cbookerf@blogs.com</td>
                            <td>Cozmo Booker</td>
                            <td>Dickinson-Klein</td>
                            <td>THB</td>
                            <td>Games</td>
                            <td>18.7744983</td>
                            <td>98.9989307</td>
                            <td>2/29/2016</td>
                            <td>2017-12-17 15:19:33</td>
                            <td>Asia/Bangkok</td>
                            <td>$425460.86</td>
                            <td>1</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>59528-4456</td>
                            <td>CA</td>
                            <td>Melfort</td>
                            <td>Cartwright, Bernier and Ryan</td>
                            <td>141 Aberg Pass</td>
                            <td>alarkingg@elegantthemes.com</td>
                            <td>Arlie Larking</td>
                            <td>Rosenbaum Group</td>
                            <td>CAD</td>
                            <td>Electronics</td>
                            <td>52.86673</td>
                            <td>-104.61768</td>
                            <td>7/7/2017</td>
                            <td>2017-05-05 02:23:44</td>
                            <td>America/Regina</td>
                            <td>$1163008.07</td>
                            <td>4</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>0054-0080</td>
                            <td>IS</td>
                            <td>Sandgerði</td>
                            <td>Reichert-Kirlin</td>
                            <td>4 Derek Alley</td>
                            <td>yscogingsh@liveinternet.ru</td>
                            <td>Yorker Scogings</td>
                            <td>Gorczany LLC</td>
                            <td>ISK</td>
                            <td>Tools</td>
                            <td>63.8351385</td>
                            <td>-21.0606971</td>
                            <td>7/6/2017</td>
                            <td>2016-10-11 07:59:03</td>
                            <td>Atlantic/Reykjavik</td>
                            <td>$656684.18</td>
                            <td>2</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>28475-810</td>
                            <td>ID</td>
                            <td>Keleng</td>
                            <td>Hodkiewicz, MacGyver and Gislason</td>
                            <td>49 Swallow Court</td>
                            <td>dmuscotti@bloomberg.com</td>
                            <td>Dominick Muscott</td>
                            <td>Swaniawski-Sipes</td>
                            <td>IDR</td>
                            <td>Clothing</td>
                            <td>-7.590458</td>
                            <td>109.1077389</td>
                            <td>5/15/2016</td>
                            <td>2016-04-25 19:47:02</td>
                            <td>Asia/Jakarta</td>
                            <td>$1194485.27</td>
                            <td>2</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>53645-1070</td>
                            <td>RU</td>
                            <td>Tugulym</td>
                            <td>Jaskolski Inc</td>
                            <td>611 Hintze Place</td>
                            <td>lkynforthj@meetup.com</td>
                            <td>Laurette Kynforth</td>
                            <td>Torp-Satterfield</td>
                            <td>RUB</td>
                            <td>Games</td>
                            <td>57.056336</td>
                            <td>64.6282995</td>
                            <td>10/18/2017</td>
                            <td>2017-07-11 15:39:14</td>
                            <td>Asia/Yekaterinburg</td>
                            <td>$486108.46</td>
                            <td>1</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>66869-137</td>
                            <td>ID</td>
                            <td>Binangun</td>
                            <td>Reichel-Howe</td>
                            <td>535 Delladonna Trail</td>
                            <td>blycettk@t.co</td>
                            <td>Beryl Lycett</td>
                            <td>Schoen Inc</td>
                            <td>IDR</td>
                            <td>Games</td>
                            <td>-8.2127777</td>
                            <td>112.3456985</td>
                            <td>6/28/2017</td>
                            <td>2016-10-02 17:59:36</td>
                            <td>Asia/Jakarta</td>
                            <td>$1050360.63</td>
                            <td>3</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>0069-0181</td>
                            <td>CZ</td>
                            <td>Tlumačov</td>
                            <td>Goldner, Kuhlman and Shanahan</td>
                            <td>8 Hauk Street</td>
                            <td>cboggasl@quantcast.com</td>
                            <td>Carny Boggas</td>
                            <td>Kuphal LLC</td>
                            <td>CZK</td>
                            <td>Movies</td>
                            <td>49.2515468</td>
                            <td>17.514286</td>
                            <td>6/24/2016</td>
                            <td>2016-03-06 06:50:25</td>
                            <td>Europe/Prague</td>
                            <td>$1029047.97</td>
                            <td>2</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>50580-449</td>
                            <td>US</td>
                            <td>Saint Augustine</td>
                            <td>Sporer, Hilpert and Greenholt</td>
                            <td>9050 High Crossing Pass</td>
                            <td>daxelbym@about.me</td>
                            <td>Dyana Axelby</td>
                            <td>Runolfsdottir-Hayes</td>
                            <td>USD</td>
                            <td>Clothing</td>
                            <td>29.910184</td>
                            <td>-81.5377013</td>
                            <td>3/16/2017</td>
                            <td>2017-07-24 13:19:46</td>
                            <td>America/Kentucky/Monticello</td>
                            <td>$249203.38</td>
                            <td>2</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>55714-2247</td>
                            <td>NL</td>
                            <td>Nijmegen</td>
                            <td>Schultz-Bahringer</td>
                            <td>2 Laurel Avenue</td>
                            <td>oduffyn@de.vu</td>
                            <td>Orelle Duffy</td>
                            <td>Roberts and Sons</td>
                            <td>EUR</td>
                            <td>Music</td>
                            <td>51.8417492</td>
                            <td>5.8715134</td>
                            <td>4/5/2016</td>
                            <td>2016-02-02 17:02:09</td>
                            <td>Europe/Amsterdam</td>
                            <td>$474214.97</td>
                            <td>5</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>48951-1208</td>
                            <td>RU</td>
                            <td>Ryazhsk</td>
                            <td>Romaguera, Bergstrom and Jast</td>
                            <td>131 Lerdahl Park</td>
                            <td>tkindero@hud.gov</td>
                            <td>Taylor Kinder</td>
                            <td>Terry-Howell</td>
                            <td>RUB</td>
                            <td>Outdoors</td>
                            <td>53.7217952</td>
                            <td>40.0305734</td>
                            <td>4/19/2017</td>
                            <td>2017-12-15 04:35:20</td>
                            <td>Europe/Moscow</td>
                            <td>$616175.56</td>
                            <td>3</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>30142-179</td>
                            <td>RU</td>
                            <td>Kazan</td>
                            <td>Flatley-Satterfield</td>
                            <td>7 Erie Pass</td>
                            <td>eaylesburyp@va.gov</td>
                            <td>Emanuele Aylesbury</td>
                            <td>Torp LLC</td>
                            <td>RUB</td>
                            <td>Shoes</td>
                            <td>59.9335031</td>
                            <td>30.3251493</td>
                            <td>7/6/2017</td>
                            <td>2017-02-06 18:37:33</td>
                            <td>Europe/Moscow</td>
                            <td>$560451.17</td>
                            <td>3</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>49349-025</td>
                            <td>TH</td>
                            <td>Bang Racham</td>
                            <td>Lowe Inc</td>
                            <td>98943 Schiller Pass</td>
                            <td>dgibkeq@multiply.com</td>
                            <td>Dorie Gibke</td>
                            <td>Tremblay and Sons</td>
                            <td>THB</td>
                            <td>Industrial</td>
                            <td>14.9192781</td>
                            <td>100.2905604</td>
                            <td>7/17/2017</td>
                            <td>2016-04-18 10:48:47</td>
                            <td>Asia/Bangkok</td>
                            <td>$295251.05</td>
                            <td>1</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>55154-4989</td>
                            <td>RU</td>
                            <td>Solnechnyy</td>
                            <td>Koch, Metz and Russel</td>
                            <td>485 Mockingbird Road</td>
                            <td>mharraginr@arstechnica.com</td>
                            <td>Melisandra Harragin</td>
                            <td>Turner-Cartwright</td>
                            <td>RUB</td>
                            <td>Grocery</td>
                            <td>51.3842543</td>
                            <td>58.9999439</td>
                            <td>12/3/2016</td>
                            <td>2016-10-01 05:28:41</td>
                            <td>Asia/Krasnoyarsk</td>
                            <td>$21451.37</td>
                            <td>5</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>13537-426</td>
                            <td>LB</td>
                            <td>Marjayoûn</td>
                            <td>Abshire-Lueilwitz</td>
                            <td>9141 Cascade Street</td>
                            <td>blampetts@behance.net</td>
                            <td>Berenice Lampett</td>
                            <td>Johnston-Fritsch</td>
                            <td>LBP</td>
                            <td>Beauty</td>
                            <td>33.3594755</td>
                            <td>35.5889282</td>
                            <td>12/27/2017</td>
                            <td>2016-04-22 01:03:17</td>
                            <td>Asia/Beirut</td>
                            <td>$324311.99</td>
                            <td>2</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>52565-009</td>
                            <td>JM</td>
                            <td>Manchioneal</td>
                            <td>Gaylord-Kulas</td>
                            <td>88503 Shopko Center</td>
                            <td>tmcmurthyt@psu.edu</td>
                            <td>Tammie McMurthy</td>
                            <td>Sipes, Conn and Stiedemann</td>
                            <td>JMD</td>
                            <td>Industrial</td>
                            <td>18.0443274</td>
                            <td>-76.2754275</td>
                            <td>10/11/2017</td>
                            <td>2017-05-31 13:49:32</td>
                            <td>America/Jamaica</td>
                            <td>$121710.22</td>
                            <td>2</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>0264-5535</td>
                            <td>GB</td>
                            <td>Glasgow</td>
                            <td>Larkin, Macejkovic and Bradtke</td>
                            <td>6 Lakeland Center</td>
                            <td>djoyesu@microsoft.com</td>
                            <td>Dinnie Joyes</td>
                            <td>Keebler Group</td>
                            <td>GBP</td>
                            <td>Sports</td>
                            <td>55.8709949</td>
                            <td>-4.2494388</td>
                            <td>6/5/2016</td>
                            <td>2016-10-10 05:31:49</td>
                            <td>Europe/London</td>
                            <td>$52827.56</td>
                            <td>5</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>15370-110</td>
                            <td>CN</td>
                            <td>Caijiang</td>
                            <td>Legros Inc</td>
                            <td>2 Mariners Cove Way</td>
                            <td>kaxelbeyv@macromedia.com</td>
                            <td>Kerianne Axelbey</td>
                            <td>Wolff, Sporer and Bechtelar</td>
                            <td>CNY</td>
                            <td>Clothing</td>
                            <td>26.610707</td>
                            <td>115.81778</td>
                            <td>2/20/2016</td>
                            <td>2017-07-22 20:37:10</td>
                            <td>Asia/Shanghai</td>
                            <td>$977590.14</td>
                            <td>6</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>67046-271</td>
                            <td>CN</td>
                            <td>Sanhe</td>
                            <td>Rodriguez, Schmitt and Maggio</td>
                            <td>537 Graceland Park</td>
                            <td>kmacterlaghw@dailymotion.com</td>
                            <td>Kiley MacTerlagh</td>
                            <td>Hauck Inc</td>
                            <td>CNY</td>
                            <td>Baby</td>
                            <td>39.982718</td>
                            <td>117.078294</td>
                            <td>6/9/2017</td>
                            <td>2016-05-08 12:34:58</td>
                            <td>Asia/Chongqing</td>
                            <td>$280193.57</td>
                            <td>2</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>49288-0356</td>
                            <td>ID</td>
                            <td>Rupe</td>
                            <td>Runolfsson, Reilly and Smitham</td>
                            <td>88 Blackbird Alley</td>
                            <td>tshuttlex@washingtonpost.com</td>
                            <td>Trula Shuttle</td>
                            <td>Will-Morissette</td>
                            <td>IDR</td>
                            <td>Baby</td>
                            <td>-8.6965738</td>
                            <td>118.865506</td>
                            <td>2/28/2016</td>
                            <td>2017-12-17 18:03:41</td>
                            <td>Asia/Makassar</td>
                            <td>$190771.08</td>
                            <td>5</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>41163-332</td>
                            <td>PL</td>
                            <td>Borowno</td>
                            <td>Cruickshank-Greenfelder</td>
                            <td>72 Iowa Drive</td>
                            <td>hbrisleny@4shared.com</td>
                            <td>Hollis Brislen</td>
                            <td>Lowe, Jaskolski and Gulgowski</td>
                            <td>PLN</td>
                            <td>Electronics</td>
                            <td>50.7784708</td>
                            <td>16.0928295</td>
                            <td>7/7/2016</td>
                            <td>2017-02-18 09:46:24</td>
                            <td>Europe/Warsaw</td>
                            <td>$318153.26</td>
                            <td>4</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>68428-088</td>
                            <td>GR</td>
                            <td>Néa Péramos</td>
                            <td>Feil, O'Reilly and Gerhold</td>
                            <td>76 Haas Alley</td>
                            <td>mbattinz@gov.uk</td>
                            <td>Marsh Battin</td>
                            <td>Fay LLC</td>
                            <td>EUR</td>
                            <td>Shoes</td>
                            <td>40.8385582</td>
                            <td>24.3031958</td>
                            <td>6/3/2017</td>
                            <td>2017-11-17 02:29:23</td>
                            <td>Europe/Athens</td>
                            <td>$618512.08</td>
                            <td>6</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>52686-288</td>
                            <td>CL</td>
                            <td>San Carlos</td>
                            <td>Nicolas Inc</td>
                            <td>6915 Mifflin Terrace</td>
                            <td>ppinnion10@state.tx.us</td>
                            <td>Patrizio Pinnion</td>
                            <td>Haag-Stokes</td>
                            <td>CLP</td>
                            <td>Games</td>
                            <td>-36.42615</td>
                            <td>-71.9708343</td>
                            <td>10/7/2016</td>
                            <td>2017-02-17 04:01:13</td>
                            <td>America/Santiago</td>
                            <td>$1147575.75</td>
                            <td>2</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>68084-534</td>
                            <td>UA</td>
                            <td>Ukrainka</td>
                            <td>Jenkins Group</td>
                            <td>77 Charing Cross Trail</td>
                            <td>idaouse11@yolasite.com</td>
                            <td>Ilario Daouse</td>
                            <td>Nitzsche, Davis and Romaguera</td>
                            <td>UAH</td>
                            <td>Beauty</td>
                            <td>50.1381207</td>
                            <td>30.7373521</td>
                            <td>4/10/2016</td>
                            <td>2016-07-08 21:09:25</td>
                            <td>Europe/Kiev</td>
                            <td>$702560.10</td>
                            <td>3</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>60681-2104</td>
                            <td>CN</td>
                            <td>Shangdu</td>
                            <td>Harvey LLC</td>
                            <td>61653 Welch Trail</td>
                            <td>bcoleborn12@upenn.edu</td>
                            <td>Blisse Coleborn</td>
                            <td>Bailey, Windler and Marquardt</td>
                            <td>CNY</td>
                            <td>Computers</td>
                            <td>30.572815</td>
                            <td>104.066801</td>
                            <td>5/15/2017</td>
                            <td>2017-05-11 02:44:29</td>
                            <td>Asia/Harbin</td>
                            <td>$374171.91</td>
                            <td>6</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>63402-193</td>
                            <td>CN</td>
                            <td>Xibin</td>
                            <td>Lakin and Sons</td>
                            <td>9 Duke Point</td>
                            <td>ajouannisson13@issuu.com</td>
                            <td>Augustin Jouannisson</td>
                            <td>Witting, Reilly and Morar</td>
                            <td>CNY</td>
                            <td>Beauty</td>
                            <td>24.804061</td>
                            <td>118.609289</td>
                            <td>7/3/2016</td>
                            <td>2017-09-13 11:49:22</td>
                            <td>Asia/Shanghai</td>
                            <td>$757700.73</td>
                            <td>3</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>0078-0614</td>
                            <td>RU</td>
                            <td>Skolkovo</td>
                            <td>Connelly, Beahan and Schmidt</td>
                            <td>5 Bay Center</td>
                            <td>kjennison14@slashdot.org</td>
                            <td>Kaleena Jennison</td>
                            <td>Johnston Inc</td>
                            <td>RUB</td>
                            <td>Outdoors</td>
                            <td>55.6830117</td>
                            <td>37.3439888</td>
                            <td>11/26/2016</td>
                            <td>2017-03-19 20:07:46</td>
                            <td>Europe/Moscow</td>
                            <td>$394364.64</td>
                            <td>5</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>60660-7787</td>
                            <td>DO</td>
                            <td>Pimentel</td>
                            <td>Collins-Considine</td>
                            <td>5 Northwestern Drive</td>
                            <td>mpetronis15@bandcamp.com</td>
                            <td>Mariel Petronis</td>
                            <td>Mitchell, Bashirian and Schroeder</td>
                            <td>DOP</td>
                            <td>Beauty</td>
                            <td>18.9237513</td>
                            <td>-70.4144776</td>
                            <td>1/28/2016</td>
                            <td>2016-10-10 16:43:13</td>
                            <td>America/Santo_Domingo</td>
                            <td>$850885.78</td>
                            <td>5</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>51079-345</td>
                            <td>MY</td>
                            <td>Kuala Lumpur</td>
                            <td>Fadel-Franecki</td>
                            <td>11 Melvin Hill</td>
                            <td>ascroggie16@youku.com</td>
                            <td>Adamo Scroggie</td>
                            <td>Cartwright Group</td>
                            <td>MYR</td>
                            <td>Tools</td>
                            <td>3.1523104</td>
                            <td>101.7178316</td>
                            <td>6/9/2016</td>
                            <td>2016-04-08 03:19:15</td>
                            <td>Asia/Kuala_Lumpur</td>
                            <td>$681054.04</td>
                            <td>4</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>29033-021</td>
                            <td>PT</td>
                            <td>Serzedelo</td>
                            <td>Reinger Group</td>
                            <td>380 Wayridge Street</td>
                            <td>lkilmartin17@bigcartel.com</td>
                            <td>Lewiss Kilmartin</td>
                            <td>Stroman-Orn</td>
                            <td>EUR</td>
                            <td>Books</td>
                            <td>41.4023768</td>
                            <td>-8.3684974</td>
                            <td>5/9/2017</td>
                            <td>2016-03-13 21:18:26</td>
                            <td>Europe/Lisbon</td>
                            <td>$456081.41</td>
                            <td>3</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>12830-816</td>
                            <td>FR</td>
                            <td>Fos-sur-Mer</td>
                            <td>Lockman and Sons</td>
                            <td>9924 Mariners Cove Circle</td>
                            <td>csachno18@blogs.com</td>
                            <td>Claretta Sachno</td>
                            <td>Zemlak-Cruickshank</td>
                            <td>EUR</td>
                            <td>Music</td>
                            <td>43.454956</td>
                            <td>4.946467</td>
                            <td>9/4/2016</td>
                            <td>2017-03-18 14:03:21</td>
                            <td>Europe/Paris</td>
                            <td>$773141.92</td>
                            <td>4</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>0781-5555</td>
                            <td>ID</td>
                            <td>Kotaagung</td>
                            <td>Schumm-Rempel</td>
                            <td>9 Calypso Road</td>
                            <td>bvan19@ebay.co.uk</td>
                            <td>Bryn Van Castele</td>
                            <td>Beier-Mante</td>
                            <td>IDR</td>
                            <td>Garden</td>
                            <td>-5.4736254</td>
                            <td>104.6471221</td>
                            <td>3/17/2017</td>
                            <td>2017-01-31 04:31:59</td>
                            <td>Asia/Jakarta</td>
                            <td>$491027.73</td>
                            <td>5</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>0378-7004</td>
                            <td>SE</td>
                            <td>Karlstad</td>
                            <td>Farrell-Emmerich</td>
                            <td>12000 Burrows Street</td>
                            <td>tgatch1a@4shared.com</td>
                            <td>Tades Gatch</td>
                            <td>Klocko, Koelpin and Nikolaus</td>
                            <td>SEK</td>
                            <td>Computers</td>
                            <td>59.454973</td>
                            <td>13.7250925</td>
                            <td>7/10/2016</td>
                            <td>2017-12-18 00:04:35</td>
                            <td>Europe/Stockholm</td>
                            <td>$641229.92</td>
                            <td>5</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>49483-052</td>
                            <td>ID</td>
                            <td>Kebonjaya</td>
                            <td>Cremin-Conn</td>
                            <td>2 Oakridge Crossing</td>
                            <td>rjolland1b@artisteer.com</td>
                            <td>Reinold Jolland</td>
                            <td>Zieme-Funk</td>
                            <td>IDR</td>
                            <td>Toys</td>
                            <td>-7.6609976</td>
                            <td>112.8968078</td>
                            <td>5/24/2016</td>
                            <td>2016-10-20 05:26:56</td>
                            <td>Asia/Jakarta</td>
                            <td>$180360.95</td>
                            <td>4</td>
                            <td>2</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>10812-357</td>
                            <td>RS</td>
                            <td>Ruma</td>
                            <td>Dach and Sons</td>
                            <td>7 Wayridge Plaza</td>
                            <td>kbrainsby1c@hibu.com</td>
                            <td>Ky Brainsby</td>
                            <td>Towne Inc</td>
                            <td>RSD</td>
                            <td>Games</td>
                            <td>45.0075322</td>
                            <td>19.8227166</td>
                            <td>11/1/2016</td>
                            <td>2017-12-07 00:32:03</td>
                            <td>Europe/Belgrade</td>
                            <td>$218087.73</td>
                            <td>2</td>
                            <td>3</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        <tr>
                            <td>49349-222</td>
                            <td>CN</td>
                            <td>Zhulan</td>
                            <td>Robel Inc</td>
                            <td>55385 Stoughton Trail</td>
                            <td>sgiddings1d@samsung.com</td>
                            <td>Sheryl Giddings</td>
                            <td>Grimes, Ryan and Larkin</td>
                            <td>CNY</td>
                            <td>Electronics</td>
                            <td>25.627549</td>
                            <td>115.717179</td>
                            <td>9/15/2017</td>
                            <td>2017-03-03 10:52:49</td>
                            <td>Asia/Shanghai</td>
                            <td>$308853.72</td>
                            <td>3</td>
                            <td>1</td>
                            <td nowrap="nowrap"></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Order ID</th>
                            <th>Ship Country</th>
                            <th>Ship City</th>
                            <th>Ship Name</th>
                            <th>Ship Address</th>
                            <th>Company Email</th>
                            <th>Company Agent</th>
                            <th>Company Name</th>
                            <th>Currency</th>
                            <th>Department</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Ship Date</th>
                            <th>Payment Date</th>
                            <th>Time Zone</th>
                            <th>Total Payment</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                    </table>
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
{{--    <script src="{{asset('mt7/assets/js/pages/crud/ktdatatable/base/html-table.js')}}"></script>--}}
    <!--end::Page Scripts-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('mt7/assets/js/pages/crud/datatables/extensions/responsive.js')}}"></script>
    <!--end::Page Scripts-->
    @endpush

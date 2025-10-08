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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Make Payment</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('profile',session()->get('id'))}}" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('batches')}}" class="text-muted">Ongoing Courses</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <span  class="text-muted text-hover-info">Make Payment</span>
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
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">

                    <div class="payment_batch" style="background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 11px;">
                        <h3>{{$batch_info->plan}}
                            <span style="font-weight: 700; color: red;"> Actual Payable amount</span>
                            {{$batch_info->payable_amount}}
                            @if($batch_info->payable_amount == 0)
                                Please Input Amount 0 Transaction ID demo
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="form-group" style="width: 79%;">
                        <label style="font-size: 25px;">Select Payment Procedure</label>
                        <div>
                            <input type="radio" name="payment_type" class="bkash"/> Bkash<br />
                            <input type="radio" name="payment_type" class="rocket"/> Rocket<br />
                            <input type="radio" name="payment_type" class="nagad"/> Nagad<br />
                            <input type="radio" name="payment_type" class="bank"/> Bank<br />
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <section id="bkash">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <div class="payment">
                            <img src="{{asset('contents/website')}}/img/bkash_bill.jpg" style="width: 750px; margin-bottom: 21px; border-radius: 16px; border: 1px solid #ccc;" />
                        </div>
                    </div>
                </div>

                {{--            <div class="container">--}}
                {{--                <div class="row">--}}
                {{--                    <div class="col-md-12">--}}
                {{--                        <div class="payment_batch" style="background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 11px;margin-left: 178px; margin-right: 208px;margin-top: -82px;">--}}
                {{--                            <h3>{{$batch_info->plan}}--}}
                {{--								<span style="font-weight: 700; color: red;"> Actual Payable amount</span>--}}
                {{--								{{$batch_info->payable_amount}}--}}
                {{--									@if($batch_info->payable_amount == 0)--}}
                {{--										Please Input Amount 0 Transaction ID demo--}}
                {{--									@endif--}}
                {{--							</h3>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--            </div>--}}

                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-2"></div>

                    <div id="form-wrap" class="col-md-8">
                        <div class="register_form" style="margin-top: -61px;">
                            <form action="{{url('/student/paidmember')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                    <label>Enter Amount</label>
                                    <div>
                                        <input type="text" class="form-control" name="taka" placeholder="Taka" />
                                        <input type="hidden" class="form-control" name="mar" placeholder="Taka" value="Bkash" />
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                    <label>Transaction ID</label>
                                    <div>
                                        <input type="hidden" class="form-control" name="batch_id" value="{{$batch_info->id}}" />
                                        <input type="hidden" class="form-control" name="id" value="{{$student->id}}" />
                                        <input type="text" class="form-control" name="transaction" value="{{old('transaction')}}" placeholder="Transaction ID" />
                                        @if ($errors->has('transaction'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('transaction') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Payment Now
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </section>

            <section id="rocket">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <div class="payment">
                            <img src="{{asset('contents/website')}}/img/roket.jpg" style="width: 750px; margin-bottom: 21px; border-radius: 16px; border: 1px solid #ccc;" />
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-2"></div>

                    <div id="form-wrap" class="col-md-8">
                        <div class="register_form" style="margin-top: -61px;">
                            <form action="{{url('/student/paidmember')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group{{ $errors->has('id') ? ' is-invalid' : '' }}">
                                    <label>Enter Amount</label>
                                    <div>
                                        <input type="hidden" class="form-control" name="mar" placeholder="Taka" value="rocket" />
                                        <input type="text" class="form-control" name="taka" placeholder="Taka" />
                                        <input type="hidden" class="form-control" name="batch_id" value="{{$batch_info->id}}" />
                                        <input type="hidden" class="form-control" name="id" value="{{$student->id}}" />
                                        @if ($errors->has('id'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                    <label>Transaction ID</label>
                                    <div>

                                        <input type="text" class="form-control" name="transaction" value="{{old('transaction')}}" placeholder="Transaction ID" />
                                        @if ($errors->has('transaction'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('transaction') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Payment Now
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </section>

            <section id="nagad">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <div class="payment">
                            <img src="{{asset('contents/website')}}/img/nagad.jpg" style="width: 750px; margin-bottom: 21px; border-radius: 16px; border: 1px solid #ccc;" />
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-2"></div>

                    <div id="form-wrap" class="col-md-8">
                        <div class="register_form" style="margin-top: -61px;">
                            <form action="{{url('/student/paidmember')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group{{ $errors->has('id') ? ' is-invalid' : '' }}">
                                    <label>Enter Amount</label>
                                    <div>
                                        <input type="text" class="form-control" name="taka" placeholder="Taka" />
                                        <input type="hidden" class="form-control" name="mar" placeholder="Taka" value="Nagad" />
                                        <input type="hidden" class="form-control" name="batch_id" value="{{$batch_info->id}}" />
                                        <input type="hidden" class="form-control" name="id" value="{{$student->id}}" />
                                        @if ($errors->has('id'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                    <label>Transaction ID</label>
                                    <div>

                                        <input type="text" class="form-control" name="transaction" value="{{old('transaction')}}" placeholder="Transaction ID" />
                                        @if ($errors->has('transaction'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('transaction') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Payment Now
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </section>

            <section id="bank">

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="payment">
                            <img src="{{asset('contents/website')}}/img/WhatsApp .jpeg" style="width: 100%;border: 1px solid #ccc; border-radius: 11px;" />
                        </div>
                    </div>
                </div>

                {{--            <div class="container">--}}
                {{--            <div class="row">--}}
                {{--                <div class="col-md-12">--}}
                {{--                    <div class="payment_batch" style="background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 11px; margin-left: 178px; margin-right: 208px;margin-top: 0px;">--}}
                {{--                        <h3>{{$batch_info->plan}}--}}
                {{--                            <span style="font-weight: 700; color: red;"> Your actual payable amount</span>--}}
                {{--                            {{$batch_info->payable_amount}}--}}
                {{--                            @if($batch_info->payable_amount == 0)--}}
                {{--                                Please Input Amount 0 Transaction ID demo--}}
                {{--                            @endif--}}
                {{--                        </h3>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--            </div>--}}
                {{--            </div>--}}


                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-2"></div>

                    <div id="form-wrap" class="col-md-8">
                        <div class="register_form" style="margin-top: -61px;">
                            <form action="{{url('/student/paidmember')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group{{ $errors->has('id') ? ' is-invalid' : '' }}" style="margin-right: 0px; margin-left: 0px;">
                                    <label>Enter Amount</label>
                                    <div>
                                        <input type="text" class="form-control" name="taka" placeholder="Taka" />
                                        <input type="hidden" class="form-control" name="mar" placeholder="Taka" value="Bank" />
                                        <input type="hidden" class="form-control" name="batch_id" value="{{$batch_info->id}}" />
                                        <input type="hidden" class="form-control" name="id" value="{{$student->id}}" />
                                        @if ($errors->has('id'))
                                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('id') }}</strong>
                            </span>
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light" style="margin-left: 46px;">
                                    Payment Now
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </section>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

@endsection
@push('script')
    <script>
        $(document).ready(function(){ /*code here*/
            $("#bkash").hide();
            $("#rocket").hide();
            $("#nagad").hide();
            $("#bank").hide();
        });

        $(".bkash").on("click", function () {
            console.log('bkash_selected');
            $("#bkash").show();
            $("#rocket").hide();
            $("#nagad").hide();
            $("#bank").hide();
        });

        $(".rocket").on("click", function () {
            console.log('Rocket selected');
            $("#bkash").hide();
            $("#rocket").show();
            $("#nagad").hide();
            $("#bank").hide();
        });

        $(".nagad").on("click", function () {
            console.log('Nagad selected');
            $("#bkash").hide();
            $("#rocket").hide();
            $("#nagad").show();
            $("#bank").hide();
        });

        $(".bank").on("click", function () {
            console.log('Bank selected');
            $("#bkash").hide();
            $("#rocket").hide();
            $("#nagad").hide();
            $("#bank").show();
        });


    </script>
@endpush

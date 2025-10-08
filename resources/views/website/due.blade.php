@extends('layouts.register') @section('content')
<section id="payment">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="form-group" style="width: 79%;">
                    <label style="font-size: 25px;">Select Payment Merchant</label>
                    <div>
                        <input type="radio" class="bkash"/> Bkash<br />
                        <input type="radio" class="rocket"/> Rocket<br />
                        <input type="radio" class="nagad"/> Nogad<br />
                        <input type="radio" class="bank"/> Bank<br />
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
            @php $id=Session:: get('id'); $profile=App\Student:: where('id',$id)->first(); @endphp
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="payment_batch" style="background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 11px;margin-left: 178px; margin-right: 208px;margin-top: -82px;">
                            <h3>{{$profile->membership->plan}} <span style="font-weight: 700; color: red;">Price</span> {{$profile->membership->ammount}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-2"></div>

                <div id="form-wrap" class="col-md-8">
                    <div class="register_form" style="margin-top: -61px;">
                        <form action="{{url('student/duePay')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                <label>Enter Amount (Due Taka: {{$profile->membership->ammount - $profile->taka}})</label>
                                <div>
                                    <input type="text" class="form-control" name="taka" placeholder="Taka" />
                                    <input type="hidden" class="form-control" name="mar" placeholder="Taka" value="Bkash" />
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                <label>Transaction ID</label>
                                <div>
                                    <input type="hidden" class="form-control" name="batch_id" value="{{$student->batch_id}}" />
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
            @php $id=Session:: get('id'); $profile=App\Student:: where('id',$id)->first(); @endphp
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="payment_batch" style="background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 11px; margin-left: 178px; margin-right: 208px;margin-top: -82px;">
                            <h3>{{$profile->membership->plan}} <span style="font-weight: 700; color: red;">Price</span> {{$profile->membership->ammount}}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>

                <div id="form-wrap" class="col-md-8">
                    <div class="register_form" style="margin-top: -61px;">
                        <form action="{{url('student/duePay')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                <label>Enter Amount (Due Taka: {{$profile->membership->ammount - $profile->taka}})</label>
                                <div>
                                    <input type="text" class="form-control" name="taka" placeholder="Taka" />
                                    <input type="hidden" class="form-control" name="mar" placeholder="Taka" value="Rocket" />
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                <label>Transaction ID</label>
                                <div>
                                    <input type="hidden" class="form-control" name="batch_id" value="{{$student->batch_id}}" />
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
         <section id="nagad">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="payment">
                        <img src="{{asset('contents/website')}}/img/nagad.jpg" style="width: 750px; margin-bottom: 21px; border-radius: 16px; border: 1px solid #ccc;" />
                    </div>
                </div>
            </div>
            @php $id=Session:: get('id'); $profile=App\Student:: where('id',$id)->first(); @endphp
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="payment_batch" style="background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 11px; margin-left: 178px; margin-right: 208px;margin-top: -82px;">
                            <h3>{{$profile->membership->plan}} <span style="font-weight: 700; color: red;">Price</span> {{$profile->membership->ammount}}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>

                <div id="form-wrap" class="col-md-8">
                    <div class="register_form" style="margin-top: -61px;">
                        <form action="{{url('student/duePay')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                <label>Enter Amount (Due Taka: {{$profile->membership->ammount - $profile->taka}})</label>
                                <div>
                                    <input type="text" class="form-control" name="taka" placeholder="Taka" />
                                    <input type="hidden" class="form-control" name="mar" placeholder="Taka" value="nagad" />
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                <label>Transaction ID</label>
                                <div>
                                    <input type="hidden" class="form-control" name="batch_id" value="{{$student->batch_id}}" />
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

        <section id="bank">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="payment">
                        <img src="{{asset('contents/website')}}/img/WhatsApp .jpeg" style="width: 750px; margin-bottom: 21px; border-radius: 16px; border: 1px solid #ccc;" />
                    </div>
                </div>
            </div>
            @php $id=Session:: get('id'); $profile=App\Student:: where('id',$id)->first(); @endphp
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="payment_batch" style="background: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 11px; margin-left: 178px; margin-right: 208px;margin-top: -82px;">
                            <h3>{{$profile->membership->plan}} <span style="font-weight: 700; color: red;">Price</span> {{$profile->membership->ammount}}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>

                <div id="form-wrap" class="col-md-8">
                    <div class="register_form" style="margin-top: -61px;">
                        <form action="{{url('student/duePay')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group{{ $errors->has('transaction') ? ' is-invalid' : '' }}">
                                <label>Enter Amount</label>
                                <div>
                                    <input type="text" class="form-control" name="taka" placeholder="Taka" />
                                    <input type="hidden" class="form-control" name="id" value="{{$student->id}}" />
                                    <input type="hidden" class="form-control" name="mar" placeholder="Taka" value="Bank" />
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
    </div>
</section>
<script>
    $(function () {
        $("#bkash").hide();

        $(".bkash").on("click", function () {
            $("#bkash").toggle();
        });
    });

    $(function () {
        $("#rocket").hide();

        $(".rocket").on("click", function () {
            $("#rocket").toggle();
        });
    });

    $(function () {
        $("#nagad").hide();

        $(".nagad").on("click", function () {
            $("#nagad").toggle();
        });
    });

    $(function () {
        $("#bank").hide();

        $(".bank").on("click", function () {
            $("#bank").toggle();
        });
    });
</script>
@endsection

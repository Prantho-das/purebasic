@extends('layouts.website')
@section('content')
    <style>
        .green_text {
            color: green;
        }

        .red_text {
            color: red;
        }

        .bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .result_text {
            line-height: 25px;
            font-size: 16px;
            margin: 0px;
        }

        .result_column {
            padding: 8px 0px;
            border-bottom: 3px solid #cfcfcf;
        }

        .answer_details {
            margin: 15px 0px 0px 0px;
        }

        .alert {
            position: relative;
            padding: 0.05rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

        .alert-danger {
            background-color: #fef4f4 !important;
            border-color: #f3817f !important;
            color: #ef5350;
            margin-top: 0px;
        }

    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{url('/answerQuestionModeltest')}}">
                    @csrf
                    <div id="accordion" role="tablist" aria-multiselectable="true" class="m-b-20">
                        <div class="card-box">
                            <div class="takkkk text-center" style="margin-top:80px">

                                <h2>Total Marks:
                                    <button type="button" class="btn btn-primary">{{$modelTest->exam_in_minutes}}</button>
                                </h2>
                                <h2>Obtained Marks:
                                    <button type="button" class="btn btn-danger">{{$modelTestAnswer->point}}</button>
                                </h2>
                                <hr>
                            </div>
                            <div class="row">
                                {{--@if($modelTest->questions->count() > 0) --}}

                                @foreach($modelTest->questions as $key=> $data)
                                    <input type="text" hidden="" value="{{$data->id}}"
                                           name="questions[{{$key}}][questionId]">
                                    <div class="col-md-6" style="margin-bottom: 25px;">
                                        <label><h5><b style="font-family: SutonnyMJ">{{$key+1}}. </b>{{$data->question}}
                                            </h5></label>
                                        @php
                                            $options = App\Option::where('question_id',$data->id)->get();
                                        @endphp

                                        @foreach ($options as $keyOpt => $option)
                                            @php
                                                $check_right_ans = App\Modeltest_answer_detail::where('modeltest_id',$modelTest->id)->where('modeltest_answer_id',$modelTestAnswer->id)->where('question_id',$data->id)->where('answered_option_id',$option->id)->first();
                                            @endphp

                                            <div class="row">
                                                <div class="col-md-12" style=" margin-bottom: -16px;">
                                                    <div
                                                        class="radio radio-primary alert   {{$check_right_ans['answered_option_id'] == $option->id ?  $option->correct_or_not == 1 ? 'alert-success' : 'alert-danger' :'' }}">
                                                        <input type='{{$data->is_multi == 1 ? "checkbox" : 'radio'}}'
                                                               {{$check_right_ans['answered_option_id'] == $option->id ? 'checked disabled':'disabled' }}  class="option_radio"
                                                               name="questions[{{$key}}][option][{{$data->is_multi == 1 ? $keyOpt : $key }}]"
                                                               value="{{$option->id}}" id="option1">
                                                        <label
                                                            style="margin: 0px;">{{$option->option}} {{$check_right_ans['answered_option_id'] == $option->id ? '*':'' }}</label>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                        @php
                                            $options_right_ans = App\Option::where('question_id',$data->id)->where('correct_or_not',1)->get();
                                        @endphp
                                        <p>Details- {{$data->detailss}}</p>
                                        <h5 style="font-size: 14px; font-weight: 800;margin-top: 21px;">Correct Ans</h5>
                                        @foreach ($options_right_ans as $rightKey => $right_ans)
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="radio radio-primary"
                                                         style="margin-left: 14px; font-size: 16px;">
                                                        {{$rightKey+1}}. {{$right_ans->option}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            {{--@endif--}}
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('down_jquery')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.option_radio').on('change', function () {
                var question_serial_id = $(this).attr('id').substr(8);
                var question_id = $('#question_' + question_serial_id).html();
                var selected_option_id = $(this).val();
                $('#question_and_answer_' + question_serial_id).val(question_id + '|' + selected_option_id);
            });
        });
    </script>
@endsection

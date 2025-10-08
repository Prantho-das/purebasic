@extends('layouts.website')
@section('content')
    <style type="text/css">
        .countdown {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: white;
            line-height: 44px;
            padding-left: 20px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row"
                     style="background: #01AAEB; margin-left: 2px; position: fixed; width: 73%; margin-top: 83px;z-index:900">
                    <div class="col-md-4"></div>
                    <div class="col-md-3 text-right" style="margin-left: -100px">
                        <p style="margin-top: 10px; margin-left: -114px; font-weight: 600; color: #008000; margin-right: -34px;">
                            Time Left</p>
                    </div>
                    <div class="col-md-1">
                        <div class="countdown"></div>
                    </div>
                    <div class="col-md-4"></div>
                </div>

                <form method="post" action="{{url('/answerQuestionModeltest')}}" id="question_paper"
                      class="question_paper" style="    margin-top: 181px;">
                    @csrf
                    <input type="hidden" value="{{$modelTest->id}}" name="modeltest_id">
                    <input type="hidden" value="{{$modelTest->exam_type}}" name="modeltest_exam_type">
                    <div id="accordion" role="tablist" aria-multiselectable="true" class="m-b-20">
                        <div class="card-box">
                            <div class="row">
                                {{-- @if($modelTest->questions->count() > 0) --}}

                                @foreach($modelTest->questions as $key=> $data)
                                    <input type="text" hidden="" value="{{$data->id}}"
                                           name="questions[{{$key}}][questionId]">
                                    <div class="col-md-6">
                                        @if($data->is_multi==1)
                                        <label style="font-family: SutonnyMJ; background-color: yellow"><h5><b style="font-family: SutonnyMJ;">{{$key+1}}. </b>{{$data->question}}
                                            </h5></label>
                                        @else
                                            <label style="font-family: SutonnyMJ; background-color: greenyellow"><h5><b style="font-family: SutonnyMJ;">{{$key+1}}. </b>{{$data->question}}
                                                </h5></label>
                                            @endif

                                        @php
                                            $options = App\Option::where('question_id',$data->id)->get();
                                        @endphp
                                        @foreach ($options as $keyOpt => $option)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="radio radio-primary">
                                                        <input type='{{$data->is_multi == 1 ? "checkbox" : 'radio'}}'
                                                               class="option_radio"
                                                               name="questions[{{$key}}][option][{{$data->is_multi == 1 ? $keyOpt : $key }}]"
                                                               value="{{$option->id}}" id="option1">
                                                        <label>{{$option->option}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-10">
                            <p>Total Questions : <b id="gtotal">{{$modelTest->questions->count()}}</b></p>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Finish
                            </button>
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
            // $('#question_paper').delay(310).submit();
            var exam_length = {{$modelTest->ex_time}};
            var exam_length_in_micro = exam_length * 60 * 1000;
            setTimeout(function () {
                // $('.option_radio').attr('disabled',true);

                $('#question_paper').submit();
            }, exam_length_in_micro);

            // $('.option_radio').on('change',function(){
            //     var question_serial_id = $(this).attr('id').substr(8);
            //     var question_id = $('#question_'+question_serial_id).html();
            //     var selected_option_id = $(this).val();
            //     $('#question_and_answer_'+question_serial_id).val(question_id+'|'+selected_option_id);
            // });

            var timer2 = "{{$modelTest->ex_time}}:00";
            // var timer2 = "{{$modelTest->exam_in_minutes}}:01";
            var interval = setInterval(function () {
                var timer = timer2.split(':');
                console.log(timer);
                if (timer[0] == '0' && timer[1] == '01') {
                    clearInterval(interval);
                }
                //by parsing integer, I avoid all extra string processing
                var minutes = parseInt(timer[0], 10);
                var seconds = parseInt(timer[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) clearInterval(interval);
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                //minutes = (minutes < 10) ?  minutes : minutes;
                $('.countdown').html(minutes + ':' + seconds);
                timer2 = minutes + ':' + seconds;
            }, 1000);
        });
    </script>
@endsection

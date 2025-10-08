@extends('layouts.website')
@section('content')
<style>
    .tab {
        width: 150px;
        height: 100%;
        color: white;
        float: left;
        z-index: 2;
        position: relative;
    }

    .tab ul {
        margin: 0;
        padding: 0;
    }

    .tab li {
        list-style: none;
        font-size: 15px;
        padding: 15px 20px;
        cursor: pointer;
    }

    .tab li:hover {
        background-color: #90CAF9;
    }


    .tab ul li ul {
        display: none;
    }

    .tab ul li.submenu {
        position: relative
    }

    .tab ul li.submenu ul {
        position: absolute;
        left: 5em;
        width: 12em;
        top: 0;
        background: #333
    }

    .tab ul li.submenu:hover ul {
        display: inline-block;
        top: 55px;left: 0px;

    }
</style>
    <section style="background: #fff;margin-top:80px">
        <div class="container">
            @if(session()->has('profile'))
                <script>
                    swal({
                        title: "Good job!",
                        text: "Your profile update success........",
                        icon: "success",
                        button: "Aww yiss!",
                    });
                </script>
            @endif

            <div class="container">
                <div class="row" style="margin-top: 10px">
                    <div class="col-md-2">
                        <img src="{{$profile->photo}}"
                             style="width: 100%; box-shadow: 0px 0px 5px 0px #ccc; border: 1px solid #ccc; height: 150px; margin-top: 11px; margin-bottom: 38px;"/>
                    </div>

                    <div class="col-md-10">
                        <div>
                            <h3 style="font-size: 21px; font-weight: 700;">{{$profile->name}} / <span style="font-size: 16px;">{{$profile->student_id}}</span></h3>
                            <h5 style="font-size: 14px; color: #01aaeb;">Mobile: {{$profile->mobile}}</h5>
                            <h5 style="font-size: 14px; color: #01aaeb;">Email: {{$profile->email}}</h5>
                        </div>
{{--                        <a href="{{url('student/due/'.$profile->id)}}" class="btn btn-primary">Pay Now</a>--}}
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="col-md-12 tab">
                        <ul class="nav nav-tabs cls_info"
                            style="padding: 10px;border: none;margin-left: -14px; margin-right: 15px;padding-left: 0px">
                            <li class="active"><a data-toggle="tab" href="#home" style="color:#fff">Profile Information</a></li>
                            <li class="active"><a data-toggle="tab" href="#course" style="color:#fff">Enroll Courses</a></li>
{{--							<li><a href="{{url('spacialmodeltest-exam/regular-exam')}}" style="color:#fff">Live Exam</a></li>--}}
{{--							<li><a href="{{url('spacialmodeltest-exam/bcs-exam')}}" style="color:#fff">BCS Exam</a></li>--}}
{{--							<li><a href="{{url('exam-point')}}" style="color:#fff">Exam Wise Result</a></li>--}}
{{--							<li><a data-toggle="tab" href="#menu1" style="color:#fff">Exam history</a></li>--}}
                            <li class="submenu">Exams
                                <ul>
                                    <li><a href="{{url('spacialmodeltest-exam/regular-exam')}}" style="color:#fff">Live Exam</a></li>
                                    <li><a href="{{url('spacialmodeltest-exam/bcs-exam')}}" style="color:#fff">BCS Exam</a></li>
                                    <li><a href="{{url('exam-point')}}" style="color:#fff">Exam Wise Result</a></li>
                                    <li><a data-toggle="tab" href="#menu1" style="color:#fff">Exam history</a></li>
                                </ul>
                            </li>
                            <li class="active"><a target="_blank" href="{{url('books')}}" style="color:#fff">Book Download</a></li>
                            <li class="active"><a data-toggle="tab" href="#notice" style="color:#fff">Notice</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="container tab-pane fade in active" id="home">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <h2 class="h2_ex" style="margin-bottom: -17px;">My Information</h2>
                            <div class="all_info">

                                <div class="formm" style="margin-top:50px">
                                    <form method="post" action="{{url('/student/profile/update')}}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" class="form-control" name="id" value="{{$profile->id}}"/>
                                        <div class="form-group">
                                            <label for="fastname">Full Name<span class="text-danger">*</span></label>
                                            <input type="text" required="" class="form-control" name="name"
                                                   id="fastname" value="{{$profile->name}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="input2">Email<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email"
                                                   value="{{$profile->email}}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Phone Number(Without Country Code)<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" required="" class="form-control" name="mobile"
                                                   value="{{$profile->mobile}}"/>
                                        </div>

                                        <div class="form-group{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                            <label for="phone">Gender<span class="text-danger">*</span></label>
                                            <div class="radio-inline" >
                                                <input  type="radio" name="gender" value="male" <?php echo $profile->gender=='male'?'checked':''; ?> > Male
                                                <input style="padding-left: 30px" type="radio" name="gender" value="female" <?php echo $profile->gender=='female'?'checked':''; ?>>  Female<br>

                                                @if ($errors->has('gender'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Date of Birth<span class="text-danger">*</span></label>
                                            <input type="text" required="" class="form-control" name="birth"
                                                   value="{{$profile->birth}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Position<span class="text-danger">*</span></label>
                                            <input type="text" required="" class="form-control" name="position"
                                                   value="{{$profile->position}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Medical / Dental college<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" required="" class="form-control" name="medical"
                                                   value="{{$profile->medical}}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Medical / Dental College Batch<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" required="" class="form-control" name="batch"
                                                   value="{{$profile->batch}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Session<span class="text-danger">*</span></label>
                                            <input type="text" required="" class="form-control" name="sessionn"
                                                   value="{{$profile->sessionn}}"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Level<span class="text-danger">*</span></label>
                                            <input type="text" required="" class="form-control" name="batch"
                                                   value="{{$profile->batch}}"/>
                                        </div>


                                        <div class="form-group">
                                            <label for="phone">Facebook Id<span class="text-danger">*</span></label>
                                            <input type="text" required="" class="form-control" name="fb"
                                                   value="{{$profile->fb}}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Address<span class="text-danger">*</span></label>
                                            <input type="text" required="" class="form-control" name="address"
                                                   value="{{$profile->address}}"/>
                                        </div>


                                        <div class="form-group">
                                            <label for="input2">Batch Name<span class="text-danger">*</span></label>
                                            <select class="form-control" name="group" value="{{$profile->group}}">
                                                <option>
{{--                                                    value="{{$profile->membership->id}}">{{$profile->membership->plan}}--}}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="fastname">Profile Picture<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="photo"/>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="container tab-pane fade in" id="course" style="padding-bottom: 50px">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <h2 class="h2_ex" style="margin-right: 0;">Enroll Courses</h2>
                                    </div>
                                </div>
                                <div class="portlet-body" style="margin-left: -15px;">
                                    <div class="table-scrollable">
                                        <table class="table table-hover">
                                            @php $point=App\Modeltest_answer:: where('student_id',Session::get('id'))->orderBy('id','desc')->paginate(15); @endphp
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Course Title</th>
                                                <th>Subscription Date</th>
                                                <th>Remaining Day</th>
                                                <th>Enroll Status</th>
                                                <th>Payable</th>
                                                <th>Due</th>
                                                <th>Details</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($courses))
                                                <?php $key=1; ?>
                                                @foreach($courses as $value)
                                                    <tr>
                                                        <td>{{$key++}}</td>
                                                        <td>{{$value->course->plan}}</td>
                                                        <td>{{empty($value->subscription_start)?'-':date('d-m-Y',strtotime($value->subscription_start))}}</td>
                                                        <td>
                                                            @if(!empty($value->subscription_end))
                                                                <?php
                                                                $startDate = date_create(date('Y-m-d'));
                                                                $endDate = date_create(date('Y-m-d',strtotime($value->subscription_end)));
                                                                $interval = date_diff($startDate, $endDate);
                                                                $days = $interval->format('%a');
                                                                ?>
                                                                {{ $days.' Days' }}
                                                            @else
                                                                {{ '-' }}
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <?php
                                                            if($value->enroll_status==0)
                                                            {
                                                                $status_string = 'Pending';
                                                            }elseif($value->enroll_status==1)
                                                            {
                                                                $status_string = 'Approved';
                                                            }else{
                                                                $status_string = 'Block/Rejected';
                                                            }
                                                            ?>
                                                            {{ $status_string }}
                                                        </td>
                                                        <td>{{$value->payable}}</td>
                                                        <td style="padding-top: 0.6rem;">{{ $value->payable - $value->paid}}
                                                            @if(($value->payable - $value->paid)>0)
                                                                <a href="{{url('/payment/'.$value->batch_id)}}" class="btn btn-primary btn-sm">Pay Now</a>
                                                            @endif
                                                        </td>
                                                        <td style="padding-top: 0.6rem;"><a href="{{url('batch/'.$value->batch_id.'/subjects')}}" class="btn btn-primary btn-sm">Details</a></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                </div>

                <div class="container tab-pane fade in" id="notice" style="padding-bottom: 50px">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <h2 class="h2_ex" style="margin-right: 0;">Notice Board</h2>
                                    </div>
                                </div>
                                <div class="portlet-body" style="margin-left: -15px;">
                                    <div class="table-scrollable">
                                        <table class="table table-hover">
                                            @php $point=App\Modeltest_answer:: where('student_id',Session::get('id'))->orderBy('id','desc')->paginate(15); @endphp
                                            <tbody>
                                                    <tr>
                                                        <td>
                                                            No notice found
                                                        </td>
{{--                                                        <td style="padding-top: 0.6rem;"><a href="{{url('batch/'.$value->batch_id.'/subjects')}}" class="btn btn-primary btn-sm">Details</a></td>--}}
                                                    </tr>
{{--                                                @endforeach--}}
{{--                                            @endif--}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                </div>

                <div class="container tab-pane fade in" id="menu1">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <h2 class="h2_ex" style="margin-right: 0;">My Exam History</h2>
                                    </div>
                                </div>
                                <div class="portlet-body" style="margin-left: -15px;">
                                    <div class="table-scrollable">
                                        <table class="table table-hover">
                                        @php $point=App\Modeltest_answer:: where('student_id',Session::get('id'))->orderBy('id','desc')->paginate(15); @endphp

                                        <tr>
                                            <th>SL</th>
                                            <th>Exam name</th>
                                            <th>Date</th>
                                            <th>Total marks</th>
                                            <th>Obtained marks</th>
                                            <th>Solve Sheet</th>
                                        </tr>

                                        @foreach($point as $key=>$data) @php $modeltest = App\Modeltest:: where('id',$data->modeltest_id)->first(); @endphp @if($modeltest)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$modeltest->name}}</td>
                                            <td>{{$data->created_at}}</td>
                                            <td>{{$modeltest->exam_in_minutes}}</td>
                                            <td>{{$data->point}}</td>
                                            <td><a href="{{$modeltest->solve_shet}}" class="btn btn-primary">Solve
                                                    Sheeet</a></td>
                                        </tr>
                                         @endif @endforeach
                                    </table>
                                </div>
                                <div>{{ $point->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection

@extends('layouts.website')
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="lecture_sheet">
                        <h1>=== মডেল টেষ্ট ===</h1>
                        @foreach($subject as $data)

                        <div class="subject">
                            <p>
                              <a  data-toggle="collapse" href="#{{$data->id}}" role="button" aria-expanded="false" aria-controls="collapseExample">{{$data->name}}</a>
                            </p>
                            <div class="collapse" id="{{$data->id}}">
                              <div class="card card-body">
                                <table class="table">
                                  <tbody>
                                    @foreach($data->modeltest as $test)
                                    <tr>
                                      <th>{{$test->name}}</th>
                                      <td style="text-align: right;"><a href="{{url('/spacialmodeltest-examm/'.$test->id)}}">Click to view</a></td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@endsection

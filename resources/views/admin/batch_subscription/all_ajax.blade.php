@extends('layouts.admin')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Payment History
                        </div>

                        <form action="{{route('data-payment')}}" method="post" enctype="multipart/form-data"
                              class="col-md-12">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="batch_id">Filter by Batch:</label>
                                    <select name="batch_id" class="col-md-3 form-control-sm">
                                        <option value="">{{ 'Select' }}</option>
                                        @foreach($batchData as $aBatchData)
                                        <option value="{{$aBatchData->id}}">{{$aBatchData->plan}}</option>
                                        @endforeach
                                    </select>


                                    <div>
                                        <label for="day">Filter by Day:</label>
                                        <select id="daySelector" name="day" class="col-md-3 form-control-sm">
                                            <option value="">{{ 'select' }}</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
    
                                        </select>
                                        
                                    </div>
                                    
                                    <div>
                                        <label for="month">Filter by Month:</label>
                                        <select id="monthSelector" name="month" class="col-md-3 form-control-sm">
                                            <option value="">{{ 'select' }}</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                     </div>
                                     
                                     <div>
                                        
                                        <label for="year">Filter by Year:</label>
                                        <select id="yearSelector" name="year" class="col-md-3 form-control-sm" required>
                                            <option value="">{{ 'select' }}</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                        </select>
                                       
                                      </div>
                                      
                                    </div>





                                    <button type="submit" class="btn btn-primary btn-sm form-control col-md-2">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>


                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="card-body">
                    
                    <div>{{isset($dateInfo) ? $dateInfo : ''}}</div>
                    <div>{{isset($totalEnrolled) ? 'Enrolled : ' . $totalEnrolled : ''}}</div>
                    <div>{{isset($totalPayment) ? 'Payment Received : ' . $totalPayment . ' taka' : ''}}</div>

                    <div class="table-responsive">
                        <table class="table table-bordered yajra-datatable" width="100%">
                            <thead>
                            <tr role="row">
                                <th>Pure Basic ID</th>
                                <th>Name</th>
                                <th>Batch</th>
                                <th>Paid</th>
                                <th>Reference</th>
                                <th>Enrolled At</th>

                            </tr>
                            </thead>

                                              <tbody>
                                                  
                                              @if(isset($items))
                                                  @foreach($items as $value)
                                                  
                                                      @php
                                                        $due = $value->payable - $value->paid;
                                                      @endphp
                                                      <tr>
                                                        <td><a href="{{'/admin/student_info/' . $value->student->id . ''}}">{{$value->student->id}}</a></td>
                                                        <td>{{$value->student->name}}</td>
                                                        <td>{{isset($value->course) ? $value->course->plan : 'Clinical Case ' . $value->case_id}}</td>
                                                        <td>{{$value->paid}}</td>
                                                        <td>{{$value->reference_id}}</td>
                                                        <td>{{$value->created_at ? date('d F, Y h:i A', strtotime($value->created_at)) : ''}}</td>


                                                      </tr>
                                                  @endforeach
                                                  
                                            @endif
                                              </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

@endsection
@section('admin_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.yajra-datatable').dataTable(
                {
                    ordering: false,
                    pageLength: 100,
                    buttons: ['csv'],
                    serverSide: false,
                }
            );
            
            const today = new Date();

            document.getElementById("monthSelector").selectedIndex = today.getMonth() + 1;
            document.getElementById("yearSelector").selectedIndex = today.getFullYear() - 2022;

        });


    </script>
@endsection

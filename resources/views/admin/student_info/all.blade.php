@extends('layouts.admin')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Student List
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered yajra-datatable" style="text-transform: capitalize;" width="100%">
                                        <thead>
                                        <tr role="row">
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>otp</th>
                                            <th>Country</th>
                                            <th>status</th>
{{--                                            <th style="width:138px;">Manage</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($items))
                                            @foreach($items as $data)
                                                <tr class="takbir">
                                                    <td><a href="/admin/student_info/{{$data->id}}"><h3>{{$data->id}}</h3></a></td>
                                                    <td>{{$data->name}}</td>
{{--                                                    <td>{{$data->student_id}}</td>--}}
                                                    <td style="text-transform: lowercase;">{{$data->email}}</td>
                                                    <td> {{$data->mobile}}</td>
                                                    <td>{{$data->otp}}</td>
                                                    <td>{{$data->country}}</td>
                                                    <td>
                                                        @if($data->status==1)
                                                            {{ 'Active' }}
                                                        @else
                                                            {{'Inactive'}}
                                                       @endif
{{--                                                    <td>--}}
{{--                                                        <a href="{{url('/admin/student_info/'.$data->id)}}"--}}
{{--                                                           class="btn btn-info" title="view"><i class="fas fa-plus"></i></a>--}}
{{--                                                        <form method="post" action="{{route('student_info.destroy',$data->id)}}">--}}
{{--                                                            @csrf--}}
{{--                                                            @method('delete')--}}
{{--                                                            <button--}}
{{--                                                                type="submit" onclick="return confirm('Are you sure?')"--}}
{{--                                                                class="btn btn-dange" title="Delete" ><i--}}
{{--                                                                    class="fas fa-trash"></i></button>--}}
{{--                                                        </form>--}}
{{--                                                    </td>--}}
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">
                        {{ $items->links() }}
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
                }
            );
        });
    </script>

@endsection

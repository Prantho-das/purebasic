@extends('layouts.admin')
@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">All Subscriber</strong>
                </div>
                @if(session()->has('success'))
                <script>
                    swal({
                      title: "Good job!",
                      text: "Category insert success!",
                      icon: "success",
                      });
                </script>
                @endif

                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                
                                <th>Email</th>
                                <th>Phone</th>

                                <th>Status</th>
                                <th>Time</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscribers as $data)
                            <tr>
                                
                                <td>{{$data->email ?? "N/A"}}</td>
                                <td>{{$data->phone ?? "N/A"}}</td>

                                <td>
                                    @if($data->is_active != 0)
                                    <span class="badge btn-primary">Active</span>
                                    @else
                                    <span class="badge btn-danger">Divisible</span>
                                    @endif
                                </td>
                                <td>{{$data->created_at}}</td>
                                <td>
                                    <form action="{{route('admin.subscribers.destroy',$data->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $subscribers->links() }}
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
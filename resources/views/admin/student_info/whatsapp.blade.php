@extends('layouts.admin')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="text-transform: capitalize;" width="100%">
                                        <thead>
                                        <tr role="row">

                                            <th>WhatsApp Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $data)
                                            
                                                <tr>

                                                    <td> {{$data}}</td>
                                                   
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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


@endsection

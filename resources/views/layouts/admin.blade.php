<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pure Basic Admin</title>

    <!-- Favicon and Touch Icons -->
    <link href="{{asset('contents/website')}}/tak/images/favicon.png" rel="shortcut icon" type="image/png">
    <link href="{{asset('contents/admin')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{asset('contents/admin')}}/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/summernote/dist/summernote.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{asset('contents/admin')}}/vendor/jquery/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,slnt,wght@0,0,100..900;1,-15,100..900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    @livewireStyles
</head>

<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="{{url('admin')}}">Purebasic.com</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        </button>

        <!-- Navbar Search -->
        <form class="d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" method="get"
            action="{{url('admin/search')}}">
            <div class="input-group">
                {{-- <input type="text" name="search" class="form-control" placeholder="Search for..."
                    aria-label="Search" aria-describedby="basic-addon2" />--}}
                {{-- <div class="input-group-append">--}}
                    {{-- <button class="btn btn-primary" type="submit">--}}
                        {{-- --}}
                        {{-- </button>--}}
                    {{-- </div>--}}
            </div>
        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item"
                        href="{{url('admin/view/user/'.Auth::user()->id)}}">{{Auth::user()->name}}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                        data-toggle="modal" data-target="#logoutModal">
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <!-- Sidebar -->
        @include('admin.inc.sidebar')

        @yield('content')
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Purebasic.com.bd
                        <?php echo date('Y') ?>
                    </span>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.content-wrapper -->

    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('contents/admin')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('contents/admin')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{asset('contents/admin')}}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{asset('contents/admin')}}/vendor/datatables/jquery.dataTables.js"></script>
    <script src="{{asset('contents/admin')}}/js/sb-admin.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('contents/admin')}}/js/demo/chart-area-demo.js"></script>
    <script src="{{asset('contents/admin')}}/summernote/dist/summernote.min.js"></script>
    @yield('admin_js')
    <script>
        jQuery(document).ready(function () {

        $('.summernote').summernote({
            height: 250, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });

        $('.inline-editor').summernote({
            airMode: true
        });

    });

    window.edit = function () {
        $(".click2edit").summernote()
    },
        window.save = function () {
            $(".click2edit").summernote('destroy');
        }
    </script>

    <script type="text/javascript">
        // Material Select Initialization
    $(document).ready(function () {
// $('.mdb-select').materialSelect();
    });
    </script>

    <script>
        $(document).ready(function () {
        $('#myTable').DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    });

    </script>

    {{--BT Modification - Js code start--}}
    <script>
        $(document).ready(function(){
        $('.durationTable').DataTable();
    });

    </script>
    {{--BT - Js code end--}}
    @livewireScripts
</body>

</html>
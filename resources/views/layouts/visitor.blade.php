<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Visitor-Dashboard</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/plugin/summernote/dist/summernote.css">
    <link rel="stylesheet" href="{{asset('contents/admin')}}/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="{{asset('contents/admin')}}/js/sweetalert.min.js"></script>

    <style media="screen">
    /* text editor */
    .modal-backdrop.show {
          opacity: .5;
          z-index: -1;
          }
    .note-editor.note-frame .note-editing-area .note-editable {
            padding: 40px;
            overflow: auto;
            color: #000;
            background-color: #fff;
        }
    </style>
</head>

<body>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{url('/admin')}}"><img src="http://localhost:8000/uploads/setting/site_logo11579519492.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="http://localhost:8000/uploads/setting/site_logo11579519492.png" alt="Logo"></a>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
              @php
                $id = Session:: get('id');
                $visitor = App\Visitor:: where('id',$id)->first();
              @endphp
                <ul class="nav navbar-nav">
                    <li class="{{ Request::is('author.dashboard') ? 'active' : '' }}">
                      <a href="{{url('/user/dashboard/'.$id)}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
<!--                     <li class="menu-item-has-children dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Post</a>
                        <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-book"></i><a href="{{url('/user/all-post/'.$id)}}"> All Post </a></li>
                        <li><i class="menu-icon fa fa-plus"></i><a href="{{url('user/add-post/'.$id)}}"> Add Post </a></li>
                        </ul>
                      </li> -->

                    <li>
                        <a href="{{url('/user-allads/'.$id)}}"> <i class="menu-icon fa fa-globe"></i>My ads</a>
                    </li>
                    <li>
                        <a href="{{url('/user/logout')}}"> <i class="menu-icon fa fa-power-off"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
    <div id="right-panel" class="right-panel">
  <header id="header" class="header">
          <div class="header-menu">
              <div class="col-sm-7">
                  <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                  <div class="header-left">
                      <div class="dropdown for-message"> </div>
                  </div>
              </div>
              @php
                $id = Session:: get('id');
                $visitor = App\Visitor:: where('id',$id)->first();
              @endphp
              <div class="col-sm-5">
                  <div class="user-area dropdown float-right">
                <a href="{{url('/')}}" target="_blank" class=""> <i class="menu-icon fa fa-globe tak" title="Visit Site"></i></a>
                    
                      <a href="{{url('/user/profile-view/'.$id)}}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img class="user-avatar rounded-circle" src="{{asset('uploads/user/' .$visitor->image)}}">
                      </a>
                      <div class="user-menu dropdown-menu">
                          <a class="nav-link" href="{{url('/user/profile-view/'.$id)}}"><i class="fa fa-user"></i>  {{$visitor->name}}</a>
                          <a class="nav-link" href="{{url('/user/profile-edit/'.$id)}}"><i class="fa fa-pencil"></i>  Edit Profile</a>
                          <a class="nav-link" href="{{url('/user/logout')}}"><i class="fa fa-power-off"></i> Logout</a>
                      </div>
                  </div>
              </div>
          </div>
      </header>

      @yield('content')

    <script src="{{asset('contents/admin')}}/vendors/jquery/dist/jquery.min.js"></script>
    <script src="{{asset('contents/admin')}}/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{asset('contents/admin')}}/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{asset('contents/admin')}}/js/dashboard.js"></script>
    <script src="{{asset('contents/admin')}}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('contents/admin')}}/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('contents/admin')}}/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('contents/admin')}}/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('contents/admin')}}/vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{asset('contents/admin')}}/js/init-scripts/data-table/datatables-init.js"></script>
    <script src="{{asset('contents/admin')}}/plugin/summernote/dist/summernote.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
    @yield('multicat')
    <script>
   jQuery(document).ready(function() {
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

   window.edit = function() {
           $(".click2edit").summernote()
       },
       window.save = function() {
           $(".click2edit").summernote('destroy');
       }
   </script>

   <script type="text/javascript">
       // Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
   </script>
</body>
</html>

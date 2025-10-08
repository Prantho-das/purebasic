<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        
        
        <title>Pure Basic</title>
        
        <!-- font awesome --> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css"/>
        <link rel="stylesheet" href="{{asset('css')}}/purebasic.css">
        
        <style>
            
            .sidenav {
              height: 100%;
              width: 230px;
              position: fixed;
              z-index: 1;
              top: 0;
              left: 0;
              background-color: #111;
              overflow-x: hidden;
              padding-top: 20px;
              display: none;
            }
            
            /* Style the sidenav links and the dropdown button */
            .sidenav a, .dropdown-btn {
              padding: 6px 8px 6px 16px;
              text-decoration: none;
              font-size: 20px;
              color: #818181;
              display: block;
              border: none;
              background: none;
              width: 100%;
              text-align: left;
              cursor: pointer;
              outline: none;
            }
            
            /* On mouse-over */
            .sidenav a:hover, .dropdown-btn:hover {
              color: #f1f1f1;
            }
            
            .sidenav .closebtn {
                background: red;
                color: white;
                margin: 0.5rem;
                
            }

            /* Main content */
            .main {
              margin-left: 200px; /* Same as the width of the sidenav */
              font-size: 20px; /* Increased text to enable scrolling */
              padding: 0px 10px;
            }
            
            /* Add an active class to the active dropdown button */
            .active {
              background-color: green;
              color: white;
            }
            
            /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
            .dropdown-container {
              display: none;
              background-color: #262626;
              padding-left: 8px;
            }
            
            /* Optional: Style the caret down icon */
            .fa-caret-down {
              float: right;
              padding-right: 8px;
            }
            
            /* Some media queries for responsiveness */
            @media screen and (max-height: 450px) {
              .sidenav {padding-top: 15px;}
              .sidenav a {font-size: 18px;}
            }
        </style>
        


    </head>
    
    <body>

    @php
        $id=Session:: get('id');
    @endphp


        <header id="header" class="header">
        

                @if ($id)
                <ul>
                    
                    <li style="float: left;"><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Open Index</span>

                      </li>

                    <li style="float:right; margin-top: 1rem; color: #03136f;"><b> Pure Basic Id : {{$id}}</b></li>
                </ul>
                
                @else
                <ul>
                    <li style="float: left; color: #03136f;"><a href="/student/login"><h3>Login</h3></a></li>
                    <li style="float: right; color: #03136f;"><a href="/main_page"><h3>PURE BASIC</h3></a></li>
                </ul>
                
                @endif
                

                </div>

                 
                <div id="mySidenav" class="sidenav">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">Close Index</a>
                  
                    @php
                       $subjects=App\Category::where('qb_serial', '!=', 'null')->orderBy('qb_serial','asc')->get();
                    @endphp
            
                              @foreach($subjects as $subject)
                              
                                  <button class="dropdown-btn">{{$subject->name}} 
                                    <i class="fa fa-caret-down"></i>
                                  </button>

                                    @php
                                       $chapters=App\Chapter::where('cat_id', $subject->id)->where('qb_serial', '!=', 'null')->orderBy('qb_serial','asc')->get();
                                    @endphp
                                        
                                    <div class="dropdown-container"> 
                                        
                                        @foreach($chapters as $chapter)

                              
                                          <button class="dropdown-btn">{{$chapter->name}} 
                                            <i class="fa fa-caret-down"></i>
                                          </button>

                                                
                                            @php
                                               $topics=App\QuestionBank::where('subject_id', $subject->id)->where('chapter_id', $chapter->id)->orderBy('serial','asc')->get();
                                               
                                            @endphp
 
                                            <div class="dropdown-container"> 
                                                
                                            @foreach($topics as $topic)
                                            

                                                <a href="/question_bank_topic/{{$topic->id}}">{{$topic->name}}</a>
                                            
                                            @endforeach
                                        
                                            </div>
                                        
                                        @endforeach
                                        
                                    </div>
                                    
                                @endforeach
                        </div>
                
                </div>


        </header>
        
        <a target="_blank" href="https://api.whatsapp.com/send?phone=%2B8801673652555" id="whatsapp-button" style="position: fixed; right: 3px; width: 55px; z-index: 999; bottom: 9px;"><img style="width:100%;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6I0VERURFRDsiIGQ9Ik0wLDUxMmwzNS4zMS0xMjhDMTIuMzU5LDM0NC4yNzYsMCwzMDAuMTM4LDAsMjU0LjIzNEMwLDExNC43NTksMTE0Ljc1OSwwLDI1NS4xMTcsMCAgUzUxMiwxMTQuNzU5LDUxMiwyNTQuMjM0UzM5NS40NzYsNTEyLDI1NS4xMTcsNTEyYy00NC4xMzgsMC04Ni41MS0xNC4xMjQtMTI0LjQ2OS0zNS4zMUwwLDUxMnoiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzU1Q0Q2QzsiIGQ9Ik0xMzcuNzEsNDMwLjc4Nmw3Ljk0NSw0LjQxNGMzMi42NjIsMjAuMzAzLDcwLjYyMSwzMi42NjIsMTEwLjM0NSwzMi42NjIgIGMxMTUuNjQxLDAsMjExLjg2Mi05Ni4yMjEsMjExLjg2Mi0yMTMuNjI4UzM3MS42NDEsNDQuMTM4LDI1NS4xMTcsNDQuMTM4UzQ0LjEzOCwxMzcuNzEsNDQuMTM4LDI1NC4yMzQgIGMwLDQwLjYwNywxMS40NzYsODAuMzMxLDMyLjY2MiwxMTMuODc2bDUuMjk3LDcuOTQ1bC0yMC4zMDMsNzQuMTUyTDEzNy43MSw0MzAuNzg2eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRkVGRUZFOyIgZD0iTTE4Ny4xNDUsMTM1Ljk0NWwtMTYuNzcyLTAuODgzYy01LjI5NywwLTEwLjU5MywxLjc2Ni0xNC4xMjQsNS4yOTcgIGMtNy45NDUsNy4wNjItMjEuMTg2LDIwLjMwMy0yNC43MTcsMzcuOTU5Yy02LjE3OSwyNi40ODMsMy41MzEsNTguMjYyLDI2LjQ4Myw5MC4wNDFzNjcuMDksODIuOTc5LDE0NC43NzIsMTA1LjA0OCAgYzI0LjcxNyw3LjA2Miw0NC4xMzgsMi42NDgsNjAuMDI4LTcuMDYyYzEyLjM1OS03Ljk0NSwyMC4zMDMtMjAuMzAzLDIyLjk1Mi0zMy41NDVsMi42NDgtMTIuMzU5ICBjMC44ODMtMy41MzEtMC44ODMtNy45NDUtNC40MTQtOS43MWwtNTUuNjE0LTI1LjZjLTMuNTMxLTEuNzY2LTcuOTQ1LTAuODgzLTEwLjU5MywyLjY0OGwtMjIuMDY5LDI4LjI0OCAgYy0xLjc2NiwxLjc2Ni00LjQxNCwyLjY0OC03LjA2MiwxLjc2NmMtMTUuMDA3LTUuMjk3LTY1LjMyNC0yNi40ODMtOTIuNjktNzkuNDQ4Yy0wLjg4My0yLjY0OC0wLjg4My01LjI5NywwLjg4My03LjA2MiAgbDIxLjE4Ni0yMy44MzRjMS43NjYtMi42NDgsMi42NDgtNi4xNzksMS43NjYtOC44MjhsLTI1LjYtNTcuMzc5QzE5My4zMjQsMTM4LjU5MywxOTAuNjc2LDEzNS45NDUsMTg3LjE0NSwxMzUuOTQ1Ii8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo="></a>
        
@include('website.success_error')
@yield('content')

    <footer id="footer" class="footer">

        <ul>

            <li style="float: center">
                <a href="/main_page"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg><br><b>Home</b></a>
            </li>        


    

        </ul>        
        
    </footer>




@yield('js')


  <script>
    
    if (window.location.pathname == "/") {
        document.getElementById("footer").style.display = "none";
    }
    
    function openNav() {
      document.getElementById("mySidenav").style.display = "block";
    }
    
    function closeNav() {
      document.getElementById("mySidenav").style.display = "none";
    }
    
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    
    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        //this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
  
  </script>

  </body>
  </html>

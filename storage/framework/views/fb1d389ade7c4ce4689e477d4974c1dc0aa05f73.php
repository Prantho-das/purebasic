<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        
        
        <title>Pure Basic</title>
        
        <!-- font awesome --> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css"/>
        <link rel="stylesheet" href="<?php echo e(asset('css')); ?>/purebasic.css">
        
        


    </head>
    
    <body>

    <?php
        $id=Session:: get('id');
    ?>


        <header id="header" class="header">
        

                <?php if($id): ?>
                <ul>
                    
                    <li style="float: left;">
                        <a href="/profile/<?php echo e($id); ?>"><svg style="margin-top: 0.3rem; fill: #03136f;" xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 512 512"><path d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0H133.9c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0H487.4C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z"/></svg><b>Profile</b></b></a>
                      </li>

                    <li style="float:right; margin-top: 1rem; color: #03136f;"><b> Pure Basic Id : <?php echo e($id); ?></b></li>
                </ul>
                
                <?php else: ?>
                <ul>
                    <li style="float: left; color: #03136f;"><a href="/student/login"><h3>Login</h3></a></li>
                    <li style="float: right; color: #03136f;"><a href="/main_page"><h3>PURE BASIC</h3></a></li>
                </ul>
                
                <?php endif; ?>
                

                </div>

                 
              
        </header>
        
        <a target="_blank" href="https://api.whatsapp.com/send?phone=%2B8801673652555" id="whatsapp-button" style="position: fixed; right: 3px; width: 55px; z-index: 999; bottom: 9px;"><img style="width:100%;" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij4KPHBhdGggc3R5bGU9ImZpbGw6I0VERURFRDsiIGQ9Ik0wLDUxMmwzNS4zMS0xMjhDMTIuMzU5LDM0NC4yNzYsMCwzMDAuMTM4LDAsMjU0LjIzNEMwLDExNC43NTksMTE0Ljc1OSwwLDI1NS4xMTcsMCAgUzUxMiwxMTQuNzU5LDUxMiwyNTQuMjM0UzM5NS40NzYsNTEyLDI1NS4xMTcsNTEyYy00NC4xMzgsMC04Ni41MS0xNC4xMjQtMTI0LjQ2OS0zNS4zMUwwLDUxMnoiLz4KPHBhdGggc3R5bGU9ImZpbGw6IzU1Q0Q2QzsiIGQ9Ik0xMzcuNzEsNDMwLjc4Nmw3Ljk0NSw0LjQxNGMzMi42NjIsMjAuMzAzLDcwLjYyMSwzMi42NjIsMTEwLjM0NSwzMi42NjIgIGMxMTUuNjQxLDAsMjExLjg2Mi05Ni4yMjEsMjExLjg2Mi0yMTMuNjI4UzM3MS42NDEsNDQuMTM4LDI1NS4xMTcsNDQuMTM4UzQ0LjEzOCwxMzcuNzEsNDQuMTM4LDI1NC4yMzQgIGMwLDQwLjYwNywxMS40NzYsODAuMzMxLDMyLjY2MiwxMTMuODc2bDUuMjk3LDcuOTQ1bC0yMC4zMDMsNzQuMTUyTDEzNy43MSw0MzAuNzg2eiIvPgo8cGF0aCBzdHlsZT0iZmlsbDojRkVGRUZFOyIgZD0iTTE4Ny4xNDUsMTM1Ljk0NWwtMTYuNzcyLTAuODgzYy01LjI5NywwLTEwLjU5MywxLjc2Ni0xNC4xMjQsNS4yOTcgIGMtNy45NDUsNy4wNjItMjEuMTg2LDIwLjMwMy0yNC43MTcsMzcuOTU5Yy02LjE3OSwyNi40ODMsMy41MzEsNTguMjYyLDI2LjQ4Myw5MC4wNDFzNjcuMDksODIuOTc5LDE0NC43NzIsMTA1LjA0OCAgYzI0LjcxNyw3LjA2Miw0NC4xMzgsMi42NDgsNjAuMDI4LTcuMDYyYzEyLjM1OS03Ljk0NSwyMC4zMDMtMjAuMzAzLDIyLjk1Mi0zMy41NDVsMi42NDgtMTIuMzU5ICBjMC44ODMtMy41MzEtMC44ODMtNy45NDUtNC40MTQtOS43MWwtNTUuNjE0LTI1LjZjLTMuNTMxLTEuNzY2LTcuOTQ1LTAuODgzLTEwLjU5MywyLjY0OGwtMjIuMDY5LDI4LjI0OCAgYy0xLjc2NiwxLjc2Ni00LjQxNCwyLjY0OC03LjA2MiwxLjc2NmMtMTUuMDA3LTUuMjk3LTY1LjMyNC0yNi40ODMtOTIuNjktNzkuNDQ4Yy0wLjg4My0yLjY0OC0wLjg4My01LjI5NywwLjg4My03LjA2MiAgbDIxLjE4Ni0yMy44MzRjMS43NjYtMi42NDgsMi42NDgtNi4xNzksMS43NjYtOC44MjhsLTI1LjYtNTcuMzc5QzE5My4zMjQsMTM4LjU5MywxOTAuNjc2LDEzNS45NDUsMTg3LjE0NSwxMzUuOTQ1Ii8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo="></a>
        
<?php echo $__env->make('website.success_error', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>

    <footer id="footer" class="footer">

        <ul>

            <li style="float: center">
                <a href="/main_page"><svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg><br><b>Home</b></a>
            </li>        


    

        </ul>        
        
    </footer>




<?php echo $__env->yieldContent('js'); ?>


  <script>
    
    if (window.location.pathname == "/") {
        document.getElementById("footer").style.display = "none";
    }
  
  </script>

  </body>
  </html>

<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->
<head><base href="../../../">
    <meta charset="utf-8" />
    <title>Pure Basic </title>
    <meta name="description" content="List option - 1 example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('mt7/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('mt7/assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('mt7/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    {{--    <link rel="shortcut icon" href="{{asset('mt7/assets/media/logos/favicon.ico')}}" />--}}
    <link href="{{asset('contents/website')}}/tak/images/favicon.png" rel="shortcut icon" type="image/png">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="kt-app__aside--left header-fixed header-mobile-fixed subheader-enabled page-loading">
<!--begin::Main-->
<!--begin::Header Mobile-->
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <!--end::Header-->

            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                <!--begin::Sub Header-->
                <!--end::Subheader-->

                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container">
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-body pt-50">
                                <div class="plyr__video-embed" id="player">
                                    {!! $sheet->video !!}
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                <!--begin::Container-->
                <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <!--begin::Copyright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted font-weight-bold mr-2">{{date('Y')}}©</span>
                        <a href="https://www.purebasic.com.bd/" target="_blank" class="text-dark-75 text-hover-primary">Purebasic</a>
                    </div>
                    <!--end::Copyright-->
                {{--                    <!--begin::Nav-->--}}
                {{--                    <div class="nav nav-dark order-1 order-md-2">--}}
                {{--                        <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pr-3 pl-0">About</a>--}}
                {{--                        <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link px-3">Team</a>--}}
                {{--                        <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-3 pr-0">Contact</a>--}}
                {{--                    </div>--}}
                <!--end::Nav-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->
<!-- begin::User Panel-->
<!-- end::User Panel-->
<!--begin::Quick Panel-->
<!--end::Quick Panel-->
<!--begin::Chat Panel-->
<!--end::Chat Panel-->
<!--begin::Scrolltop-->
<!--end::Scrolltop-->
<!--begin::Sticky Toolbar-->
<!--end::Sticky Toolbar-->

<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{asset('mt7/assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('mt7/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
<script src="{{asset('mt7/assets/js/scripts.bundle.js')}}"></script>
<script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
<script>
    const player = new Plyr('#player');
</script>
<!--end::Global Theme Bundle-->
</body>
<!--end::Body-->
</html>

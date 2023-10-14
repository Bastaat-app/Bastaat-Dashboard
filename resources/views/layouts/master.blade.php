<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.includes.head')



<!-- body start -->
<body class="loading" data-layout='{"mode": "{{$color_scheme_mode}}", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "{{$color_scheme_mode}}", "size": "default", "showuser": false}, "topbar": {"color": "{{$color_scheme_mode == 'dark' ? 'light' : 'dark'}}"}, "showRightSidebarOnPageLoad": true}'>
<!-- Begin page -->
<div id="wrapper">

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <?php $segment=Request::segment(2); ?>
    @if(($segment != "login") && ($segment != "form_email"))

        @include('layouts.includes.side_menu')


    @endif
    <div class="content-page">
        <?php $segment=Request::segment(2); ?>
        @if(($segment != "login") && ($segment != "form_email"))

            @include('layouts.includes.nav')




        @endif
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->

            @yield('content')
                <!-- end page-->
            </div>
        </div>
                <!-- Start Footer here -->
            @include('layouts.includes.footer')
            <!-- End Footer -->


    </div>
</div>
    <!-- END wrapper -->

    <!-- Start Footer Script here -->
    @include('layouts.includes.scripts')
    <!-- End Footer Script -->

    @yield('script')
    @stack('script')



    @if(request()->filled("print"))
        <script>
            window.print();
            // self.focus();
            // window.onafterprint = function(){
            //     window.close();
            // }
        </script>
        <style>
            @media print {
                form, input, button, .btn, .hidden-print{
                    display: none !important;
                }
            }
        </style>
    @endif
</body>

</html>

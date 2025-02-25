<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control: no-cache, no-store, must-revalidate"/>
    <title>@yield('title', 'laravel role admin')</title>
    @include('backend.layouts.partials.css')
</head>

<body>

    <div id="preloader">
        <div class="loader"></div>
    </div>


    <div class="page-container">
        <!-- sidebar menu area start -->

        @include('backend.layouts.partials.sidebar')
        <!-- sidebar menu area end -->


        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            @include('backend.layouts.partials.header')
            @yield('admin-content')
            <!-- header area end -->
        </div>
        <!-- main content area end -->
        <!-- footer area start-->

        @include('backend.layouts.partials.footer')

        <!-- footer area end-->
    </div>
    <!-- page container area end -->

        @include('backend.layouts.partials.offset')

        @include('backend.layouts.partials.js')

</body>

</html>

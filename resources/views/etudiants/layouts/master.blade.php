<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control: no-cache, no-store, must-revalidate"/>
     <meta name="csrf-token" content="{{ csrf_token() }}">
 
    <title>@yield('title', 'laravel role admin')</title>
    @include('chercheur.layouts.partials.css')
</head>

<body>

    <div id="preloader">
        <div class="loader"></div>
    </div>


    <div class="page-container">
        <!-- sidebar menu area start -->

        @include('chercheur.layouts.partials.sidebar')
        <!-- sidebar menu area end -->


        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            @include('chercheur.layouts.partials.header')
            @yield('admin-content')
            <!-- header area end -->
        </div>
        <!-- main content area end -->
        <!-- footer area start-->

        @include('chercheur.layouts.partials.footer')

        <!-- footer area end-->
    </div>
    <!-- page container area end -->

        @include('chercheur.layouts.partials.offset')

        @include('chercheur.layouts.partials.js')

</body>

</html>

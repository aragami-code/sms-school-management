<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">


<head>
    <title>@yield('title', 'CYBER-CURE')</title>
    @include('site.layouts.partials.css')
</head>

<body>

    <div id="preloader">
        <div class="loader"></div>
    </div>


    <div class="page-container">
        <!-- sidebar menu area start -->

        @include('site.layouts.partials.css')
        <!-- sidebar menu area end -->


        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            @include('site.layouts.partials.header')
            @yield('acceuil-fr-content')
            <!-- header area end -->
        </div>
        <!-- main content area end -->
        <!-- footer area start-->

        @include('site.layouts.partials.footer')

        <!-- footer area end-->
    </div>

        @include('site.layouts.partials.js')

</body>

</html>

<!doctype html>
<html lang="en">
<head>
    <title>
        @yield('title')
        Elearning Aerofood
    </title>
    <!-- ********************************************** -->
    <!--                  HEAD IMPORT CSS DLL           -->
    <!-- ********************************************** -->
    @include('user.layouts.header')
        @yield('header')
</head>
<body class="page-header-fixed page-full-width" id="div1">

<!-- ********************************************** -->
<!--                  NAVBAR                        -->
<!-- ********************************************** -->

@include('user.layouts.navbar')

<!-- ********************************************** -->
<!--                  CONTENT                       -->
<!-- ********************************************** -->

<main role="main">
    @yield('content')


</main>

<!-- ********************************************** -->
<!--                  FOOTER                        -->
<!-- ********************************************** -->
@include('user.layouts.footer')


<!-- ********************************************** -->
<!--                  SCRIPT                        -->
<!-- ********************************************** -->

{{-- this include is required for all page--}}
@include('user.layouts.script')

{{-- if you need script only to a page, yield this --}}
    @yield('script')



</body>
</html>
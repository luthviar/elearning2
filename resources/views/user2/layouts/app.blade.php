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
    @include('user2.layouts.header')
        @yield('header')
</head>
<body class="page-header-fixed page-full-width">

<!-- ********************************************** -->
<!--                  NAVBAR                        -->
<!-- ********************************************** -->

@include('user2.layouts.navbar')

<!-- ********************************************** -->
<!--                  CONTENT                       -->
<!-- ********************************************** -->

<main role="main">
    @yield('content')

        <!-- ********************************************** -->
        <!--                  FOOTER                        -->
        <!-- ********************************************** -->

        @include('user2.layouts.footer')
</main>



<!-- ********************************************** -->
<!--                  SCRIPT                        -->
<!-- ********************************************** -->

{{-- this include is required for all page--}}
@include('user2.layouts.script')

{{-- if you need script only to a page, yield this --}}
@yield('script')



</body>
</html>



{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
    {{--<title>--}}
        {{--@yield('title')--}}
        {{--Elearning Aerofood--}}
    {{--</title>--}}
    {{--<!-- ********************************************** -->--}}
    {{--<!--                  HEAD IMPORT CSS DLL           -->--}}
    {{--<!-- ********************************************** -->--}}
    {{--@include('user.layouts.header')--}}

{{--</head>--}}
{{--<body class="bs-docs-home">--}}

{{--<!-- ********************************************** -->--}}
{{--<!--                  NAVBAR                        -->--}}
{{--<!-- ********************************************** -->--}}

{{--@include('user.layouts.navbar')--}}

{{--<!-- ********************************************** -->--}}
{{--<!--                  CONTENT                       -->--}}
{{--<!-- ********************************************** -->--}}

{{--<main>--}}
    {{--@yield('content')--}}
{{--</main>--}}

{{--<!-- ********************************************** -->--}}
{{--<!--                  FOOTER                        -->--}}
{{--<!-- ********************************************** -->--}}

{{--@include('user.layouts.footer')--}}


{{--<!-- ********************************************** -->--}}
{{--<!--                  SCRIPT                        -->--}}
{{--<!-- ********************************************** -->--}}

{{-- this include is required for all page--}}
{{--@include('user.layouts.script')--}}

{{-- if you need script only to a page, yield this --}}
{{--@yield('script')--}}

{{--</body>--}}
{{--</html>--}}

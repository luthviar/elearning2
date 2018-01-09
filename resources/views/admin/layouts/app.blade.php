<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        @yield('title')
        Elearning Aerofood
    </title>
    <!-- ********************************************** -->
    <!--                  HEAD IMPORT CSS DLL           -->
    <!-- ********************************************** -->
    @include('admin.layouts.header')
    @yield('header')
</head>
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">

    <!-- ********************************************** -->
    <!--                  NAVBAR                        -->
    <!-- ********************************************** -->
    @include('admin.layouts.navbar')


    <!-- Left side column. contains the logo and sidebar -->
    <!-- ********************************************** -->
    <!--                  SIDEBAR                       -->
    <!-- ********************************************** -->
    @include('admin.layouts.sidebar')

    <!-- ********************************************** -->
    <!--                  SIDEBAR                       -->
    <!-- ********************************************** -->
    <!-- Content Header (Page header) -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        {{-- START BREADCRUMB --}}
        @php
            $link = url('/');
        @endphp
        <section class="content-header">
            <h1>
                @yield('page-name')
            </h1>
            <ol class="breadcrumb">
                <i class="fa fa-home"></i>
        @for($i = 1; $i <= count(\Illuminate\Support\Facades\Request::segments()); $i++)

            @if($i < count(\Illuminate\Support\Facades\Request::segments()) & $i > 0)
                <?php $link .= "/" . \Illuminate\Support\Facades\Request::segment($i); ?>

                <li>
                    <a href="<?= $link ?>">
                        {{ \Illuminate\Support\Facades\Request::segment($i) }}
                    </a>
                </li>
                    {!!' <i class="fa fa-angle-right"></i> '!!}
            @else
                <li class="active">
                {{\Illuminate\Support\Facades\Request::segment($i)}}
                </li>
            @endif
        @endfor
            </ol>
        </section>
        {{-- END BREADCRUMB --}}

        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- ********************************************** -->
    <!--                  FOOTER                        -->
    <!-- ********************************************** -->
    @include('admin.layouts.footer')

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

{{-- this include is required for all page--}}
@include('admin.layouts.script')

{{-- if you need script only to a page, yield this --}}
@yield('script')
</body>
</html>
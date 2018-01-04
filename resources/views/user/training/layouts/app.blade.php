@extends('user.layouts.app')

@section('content')

    <div class="container" style="padding-top: 100px; padding-bottom: 100px;">
        <div class="row">

            {{--INTRO TRAINING--}}
            <div class="text-center">
                <h1><strong>{{ Session::get('training')->modul_name}}</strong></h1>
                <h5>Contain {{count(Session::get('training')['chapter'])}} chapter . 1271 user finish this course</h5>
                <p>{{ Session::get('training')['description']}}</p>
            </div>


            <div class="col-lg-12" style="border-top: 1px solid #13B795;">
                <div class="tabs tabs-style-underline">
                    <nav>
                        @include('user.training.layouts.navbar')
                    </nav>
                    <div class="content-wrap">
                        @yield('content_training')


                    </div><!-- /content -->
                </div><!-- /tabs -->
            </div>

            <div class="text-center">
                <a href="#" class="btn btn-success">Finish Training</a>
            </div>
        </div>
    </div>

@endsection


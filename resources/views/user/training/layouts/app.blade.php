@extends('user.layouts.app')

@section('content')

    <div class="container" style="padding-top: 100px; padding-bottom: 100px;">
        <div class="row">

            {{--INTRO TRAINING--}}
            <div class="text-center">
                <h1><strong>{{ Session::get('training')->modul_name}}</strong></h1>
                <h5>Contain {{count(Session::get('training')['chapter'])}} chapter . 1271 user finish this course</h5>
                <p>{!! Session::get('training')['description'] !!} </p>
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

            {{--<div class="text-center">--}}
                {{--<a href="#" class="btn btn-success">Finish Training</a>--}}
            {{--</div>--}}
        </div>
    </div>
    <!-- Modal To Start Test-->
    {{--<div class="modal fade" id="TestStart" tabindex="-1" role="dialog" aria-labelledby="TestStartLabel">--}}
        {{--<div class="modal-dialog" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                    {{--<h1 class="modal-title text-center" id="TestStartLabel"><strong>Are you serious to submit ?</strong></h1>--}}
                {{--</div>--}}
                {{--<div class="modal-body text-center">--}}
                    {{--<h1>Anda akan memulai test. Persiapkan sebaik mungkin. Test bersifat close all.</h1>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                    {{--<a--}}
                            {{--id="submit_button"--}}
                            {{--onclick="window.open('{{ url('/test',$chapter->id) }}','_self')"--}}
                            {{--target="_self"--}}
                            {{--class="btn btn-primary">--}}
                        {{--Start Test--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection


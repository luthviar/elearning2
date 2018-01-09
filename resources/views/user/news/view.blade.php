@extends('user.layouts.app')

@section('content')

    <div class="page-container" id="wrapper">

        <div class="page-content-wrapper" style="padding:30px">
            <div class ="col-md-8">
                <div class ="col-md-8">
                    <div class="col-md-3">
                        <br>
                        @if(empty($news->image))
                            <img src="{{URL::asset('Elegantic/images/ALS.jpg')}}" alt="Card image cap" style="width:100%;height:60px;">
                        @else
                            <img src="{{URL::asset($news['image'])}}" alt="Card image cap" style="width:100%;height:60px;">
                        @endif
                    </div>
                    <div class ="col-md-9">
                        <h3>{{ $news['title'] }}</h3>
                        <h6>{{ \Carbon\Carbon::parse($news->create_at)->format('l jS \\of F Y')}}</h6>
                    </div>
                </div>
                <div class ="col-md-12">
                    <hr class="style14">
                    <p align="justify" class="big">
                        {!! html_entity_decode($news['content']) !!}

                    </p>
                    <hr class="style14">
                    <div class='pull-right'>
                        @if(!empty($news['file_pendukung'][0]))
                            Attachments : <br>
                            @foreach($news['file_pendukung'] as $file)
                                <a href="{{URL::asset($file->attachment_url)}}">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>{{$file->attachment_name}}
                                </a><br>
                            @endforeach
                        @endif
                    </div>
                    <hr class="style14">
                    <br><br><br>

                    @if($news->is_reply == 1)
                        <div class="block-advice">
                            <h3>Comments({{count($replies)}})</h3>
                            <br>
                            @foreach($replies as $reply)
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong>{{ $reply['title'] }}</strong><br>
                                        {{$reply['user']->name}} ,
                                        {{ \Carbon\Carbon::parse($reply->create_at)->format('d - m - Y , H:i:s')}}</div>
                                    <div class="panel-body">

                                        {!! html_entity_decode($reply['content']) !!}
                                        <br>
                                        <div class ="pull-right">

                                            @if(!empty($reply['file_pendukung'][0]))
                                                Attachments : <br>
                                                @foreach($reply['file_pendukung'] as $file)
                                                    <a href="{{URL::asset($file->attachment_url)}}">
                                                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                                                        {{$file->attachment_name}}
                                                    </a><br>
                                                @endforeach
                                            @endif

                                        </div>

                                    </div>
                                </div>
                                <br>
                            @endforeach

                            @if(Auth::user() == null)

                            @else
                                <form id="myform" class="form-horizontal" role="form" method="POST"
                                      action="{{ URL::action('NewsController@storeCommentByUser') }}"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="id_news" value="{{$news->id}}">
                                    <div class="form-group">
                                        <label for="title" class="col-md-2 control-label">Title</label>

                                        <div class="col-md-8">
                                            <input id="title" type="text" class="form-control"
                                                   name="title" required  value="[RE:] {{$news['title']}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="content" class="col-md-2 control-label">Content</label>

                                        <div class="col-md-8">
                                            <textarea id="summernote" name="content"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="col-md-2 control-label">Upload attachment</label>

                                        <div class="col-md-8">
                                            <div class="input-group">
													<span class="input-group-btn">
														<span class="btn btn-default btn-file">
															Browse..
															<input type="file"
                                                                   id="file"
                                                                   onchange="javascript:updateList()"
                                                                   name="file_pendukung[]"
                                                                   multiple/>
															</span>
													</span>
                                                <input type="text" class="form-control" value="select file(s)" readonly>
                                            </div></br>
                                            <div class='file-uploaded'>
                                                <p>
                                                <div id="fileList"></div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-info">
                                                Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4  col-md-4 col-sm-12 hidden-sm hidden-xs">
                <div id="navWrap">
                    <nav>
                        <div class ="fixedpositiion">
                            <div class="well">
                                <h4>Recent News</h4>
                                <hr class="style14">
                                @foreach($beritas as $brt)
                                    <a href="{{ url('news/'.$brt->id) }}">
                                        <p>{{$brt->title}}</p>
                                    </a>
                                @endforeach
                                <br>
                            </div>
                            <!--Links -->
                            <p class="border-panel-title-wrap">
                                <span class="panel-title-text">Links</span>
                            </p>
                            <div class="row">
                                <div class="col-md-12 clearfix">
                                    <a href="https://oms.aerofood.co.id"
                                       class="btn btn-lg default"
                                       style="margin:5px 1px"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Operation Monitoring System	(oms.aerofood.co.id)"
                                       target="_blank"
                                    >
                                        OMS
                                    </a>

                                    <a href="https://oms.aerofood.co.id"
                                       class="btn btn-lg red"
                                       style="margin:5px 1px"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Operation Monitoring System	(oms.aerofood.co.id)"
                                       target="_blank"
                                    >
                                        IMS
                                    </a>
                                    <a href="https://oms.aerofood.co.id"
                                       class="btn btn-lg blue"
                                       style="margin:5px 1px"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Operation Monitoring System	(oms.aerofood.co.id)"
                                       target="_blank"
                                    >
                                        GLP-ICGB
                                    </a>
                                    <a href="https://oms.aerofood.co.id"
                                       class="btn btn-lg green"
                                       style="margin:5px 1px"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Operation Monitoring System	(oms.aerofood.co.id)"
                                       target="_blank"
                                    >
                                        Proline
                                    </a>
                                    <a href="#" class="btn btn-lg yellow" style="margin:5px 1px">
                                        eProc
                                    </a>
                                    <a href="#" class="btn btn-lg purple" style="margin:5px 1px">
                                        eLearning
                                    </a>
                                    <a href="#" class="btn btn-lg green" style="margin:5px 1px">
                                        eRecruitment
                                    </a>
                                    <a href="#" class="btn btn-lg dark" style="margin:5px 1px">
                                        Simpreman
                                    </a>
                                    <a href="#" class="btn btn-lg purple" style="margin:5px 1px">
                                        ePireq
                                    </a>
                                    <a href="#" class="btn btn-lg green" style="margin:5px 1px">
                                        eBudgeting
                                    </a>
                                    <a href="#" class="btn btn-lg blue" style="margin:5px 1px">
                                        SOB
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

        </div>

        <div id="stopHere"></div>
    </div>

    {{--<div class="page-container" id="wrapper">--}}

        {{--<div class="page-content-wrapper" style="padding:30px">--}}
            {{--<div class ="col-md-8">--}}
                {{--<div class ="col-md-8">--}}
                    {{--<div class="col-md-3">--}}
                        {{--<br>--}}
                        {{--@if(empty($news->image))--}}
                            {{--<img src="{{URL::asset('Elegantic/images/ALS.jpg')}}" alt="Card image cap" style="width:100%;height:60px;">--}}
                        {{--@else--}}
                            {{--<img src="{{URL::asset($news['image'])}}" alt="Card image cap" style="width:100%;height:60px;">--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class ="col-md-9">--}}
                        {{--<h3>{{ $news['title'] }}</h3>--}}
                        {{--<h6>{{ \Carbon\Carbon::parse($news->create_at)->format('l jS \\of F Y')}}</h6>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class ="col-md-12">--}}
                    {{--<hr class="style14">--}}
                    {{--<p align="justify" class="big">--}}
                        {{--{!! html_entity_decode($news['content']) !!}--}}

                    {{--</p>--}}
                    {{--<hr class="style14">--}}
                    {{--<div class='pull-right'>--}}
                        {{--@if(!empty($news['file_pendukung'][0]))--}}
                            {{--Attachments : <br>--}}
                            {{--@foreach($news['file_pendukung'] as $file)--}}
                                {{--<a href="{{URL::asset($file->url)}}"><i class="fa fa-paperclip" aria-hidden="true"></i>{{$file->name}} </a><br>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<br><br><br><br>--}}

                    {{--@if($news->is_reply == 1)--}}
                        {{--<div class="block-advice">--}}
                            {{--<h3>Comments({{count($replies)}})</h3>--}}
                            {{--<br>--}}
                            {{--@foreach($replies as $reply)--}}
                                {{--<div class="panel panel-default">--}}
                                    {{--<div class="panel-heading"><strong>{{ $reply['title'] }}</strong><br>--}}
                                        {{--{{$reply['user']->fname}} {{$reply['user']->lname}}, {{ \Carbon\Carbon::parse($reply->create_at)->format('d - m - Y , H:i:s')}}</div>--}}
                                    {{--<div class="panel-body">--}}

                                        {{--{!! html_entity_decode($reply['content']) !!}--}}
                                        {{--<br>--}}
                                        {{--<div class ="pull-right">--}}

                                            {{--@if(!empty($reply['file_pendukung'][0]))--}}
                                                {{--Attachments : <br>--}}
                                                {{--@foreach($reply['file_pendukung'] as $file)--}}
                                                    {{--<a href="{{URL::asset($file->url)}}"><i class="fa fa-paperclip" aria-hidden="true"></i>{{$file->name}}</a><br>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}

                                        {{--</div>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<br>--}}
                            {{--@endforeach--}}

                            {{--@if(Auth::user() == null)--}}

                            {{--@else--}}
                                {{--<form id="myform" class="form-horizontal" role="form" method="POST" action="{{ URL::action('NewsReplieController@store') }}" enctype="multipart/form-data">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<input type="hidden" name="id_user" value="{{Auth::user()->id}}">--}}
                                    {{--<input type="hidden" name="id_news" value="{{$news->id}}">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="title" class="col-md-2 control-label">Title</label>--}}

                                        {{--<div class="col-md-8">--}}
                                            {{--<input id="title" type="text" class="form-control" name="title" required  value="[RE:] {{$news['title']}}">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="content" class="col-md-2 control-label">Content</label>--}}

                                        {{--<div class="col-md-8">--}}
                                            {{--<textarea id="summernote" name="content"></textarea>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="form-group">--}}
                                        {{--<label for="image" class="col-md-2 control-label">Upload attachment</label>--}}

                                        {{--<div class="col-md-8">--}}
                                            {{--<div class="input-group">--}}
													{{--<span class="input-group-btn">--}}
														{{--<span class="btn btn-default btn-file">--}}
															{{--Browse..--}}
															{{--<input type="file"--}}
                                                                   {{--id="file"--}}
                                                                   {{--onchange="javascript:updateList()"--}}
                                                                   {{--name="file_pendukung[]"--}}
                                                                   {{--multiple/>--}}
															{{--</span>--}}
													{{--</span>--}}
                                                {{--<input type="text" class="form-control" value="select file(s)" readonly>--}}
                                            {{--</div></br>--}}
                                            {{--<div class='file-uploaded'>--}}
                                                {{--<p>--}}
                                                {{--<div id="fileList"></div>--}}
                                                {{--</p>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}


                                    {{--<div class="form-group">--}}
                                        {{--<div class="col-md-6 col-md-offset-4">--}}
                                            {{--<button type="submit" class="btn btn-info">--}}
                                                {{--Comment--}}
                                            {{--</button>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-lg-4  col-md-4 col-sm-12 hidden-sm hidden-xs">--}}
                {{--<div id="navWrap">--}}
                    {{--<nav>--}}
                        {{--<div class ="fixedpositiion">--}}
                            {{--<div class="well">--}}
                                {{--<h4>Recent News</h4>--}}
                                {{--<hr class="style14">--}}
                                {{--@foreach($last_news as $brt)--}}
                                    {{--<a href="/news/{{$brt->id}}"><p>{{$brt->title}}</p></a>--}}
                                {{--@endforeach--}}
                                {{--<br>--}}
                            {{--</div>--}}
                            {{--<!--Links -->--}}
                            {{--<p class="border-panel-title-wrap">--}}
                                {{--<span class="panel-title-text">Links</span>--}}
                            {{--</p>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12 clearfix">--}}
                                    {{--<a href="https://oms.aerofood.co.id"--}}
                                       {{--class="btn btn-lg default"--}}
                                       {{--style="margin:5px 1px"--}}
                                       {{--data-toggle="tooltip"--}}
                                       {{--data-placement="top"--}}
                                       {{--title="Operation Monitoring System	(oms.aerofood.co.id)"--}}
                                       {{--target="_blank"--}}
                                    {{-->--}}
                                        {{--OMS--}}
                                    {{--</a>--}}

                                    {{--<a href="https://oms.aerofood.co.id"--}}
                                       {{--class="btn btn-lg red"--}}
                                       {{--style="margin:5px 1px"--}}
                                       {{--data-toggle="tooltip"--}}
                                       {{--data-placement="top"--}}
                                       {{--title="Operation Monitoring System	(oms.aerofood.co.id)"--}}
                                       {{--target="_blank"--}}
                                    {{-->--}}
                                        {{--IMS--}}
                                    {{--</a>--}}
                                    {{--<a href="https://oms.aerofood.co.id"--}}
                                       {{--class="btn btn-lg blue"--}}
                                       {{--style="margin:5px 1px"--}}
                                       {{--data-toggle="tooltip"--}}
                                       {{--data-placement="top"--}}
                                       {{--title="Operation Monitoring System	(oms.aerofood.co.id)"--}}
                                       {{--target="_blank"--}}
                                    {{-->--}}
                                        {{--GLP-ICGB--}}
                                    {{--</a>--}}
                                    {{--<a href="https://oms.aerofood.co.id"--}}
                                       {{--class="btn btn-lg green"--}}
                                       {{--style="margin:5px 1px"--}}
                                       {{--data-toggle="tooltip"--}}
                                       {{--data-placement="top"--}}
                                       {{--title="Operation Monitoring System	(oms.aerofood.co.id)"--}}
                                       {{--target="_blank"--}}
                                    {{-->--}}
                                        {{--Proline--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg yellow" style="margin:5px 1px">--}}
                                        {{--eProc--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg purple" style="margin:5px 1px">--}}
                                        {{--eLearning--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg green" style="margin:5px 1px">--}}
                                        {{--eRecruitment--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg dark" style="margin:5px 1px">--}}
                                        {{--Simpreman--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg purple" style="margin:5px 1px">--}}
                                        {{--ePireq--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg green" style="margin:5px 1px">--}}
                                        {{--eBudgeting--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg blue" style="margin:5px 1px">--}}
                                        {{--SOB--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}


        {{--<div id="stopHere"></div>--}}
    {{--</div>--}}

@endsection

@section('script')
    <script>
        updateList = function() {
            var input = document.getElementById('file');
            var output = document.getElementById('fileList');

            output.innerHTML = 'Selected file(s) <br><ul>';
            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML += '<li>' + input.files.item(i).name + '</li>';

            }
            output.innerHTML += '</ul>';
        }

        var navWrap = $('#navWrap'),
            nav = $('nav'),
            startPosition = navWrap.offset().top,
            stopPosition = $('#stopHere').offset().top - nav.outerHeight();

        $(document).scroll(function () {
            //stick nav to top of page
            var y = $(this).scrollTop()

            if (y > startPosition) {
                nav.addClass('sticky');
                if (y > stopPosition) {
                    nav.css('top', stopPosition - y);
                } else {
                    nav.css('top', 80);
                }
            } else {
                nav.removeClass('sticky');
            }
        });
    </script>

    <script>
        $(window).load(function(){

            setTimeout(function() {
                    $("#loading").fadeOut(function(){

                        $(this).remove();
                        $('body').removeAttr('style');
                    })
                }
                , 300);
        });


        jQuery(document).ready(function() {
            // initiate layout and plugins
            App.init();

        });
    </script>

    <style>
        .sticky {
            position: fixed;
            top:200px;
        }
        p.big {
            line-height: 300%;
            font-size : 15px;
        }
    </style>
@endsection
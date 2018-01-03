@extends('user2.layouts.app')

@section('content')


    <div class="clearfix"></div>
    <div class="page-container" id="wrapper">

        <div class="page-content-wrapper">
            <!-- Slider -->
            <!-- <hr class="style13"> -->
            <div class="promo" >
                <ul class="slider">
                    @foreach ($sliders as $slide)

                        <li style="background: url({{$slide->image or 'Elegantic/images/ALS.jpg'}}) no-repeat 100% 100%; width:100% !important;">

                            <div class="slide-holder">
                                <div class="slide-info">
                                    <h1>{{$slide->title}}</h1>
                                    <p>{!! html_entity_decode(str_limit($slide->content, $limit = 360, $end = '...')) !!} ajsdfkldasf klsadf lkas fklsad fklds akfldas klf asdklf akdslf adsklf adkslf klsaf klasdf klsda fkldakf</p>
                                    <div class="top-left">
                                        <a class="btn btn-ghost"  href="/slider/{{$slide->id}}">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="clearfix"></div>
            <!-- NEWS -->
            <div class="page-content" style="background-color: rgb(243, 247, 248);opacity: 1;">

                <div class="blog-page">
                    <div class="row">
                        <div class="col-md-7 col-sm-6 article-block">
                            <p class="border-panel-title-wrap">
                                <!-- <div class="panel-title-wrap"> -->
                                <span class="panel-title-text">News</span>
                                <!-- </div> -->

                            </p>

                            @foreach ($newses as $news)
                                <div class="row" >
                                    <div class="col-md-4 blog-img blog-tag-data">
                                        @if(empty($news->image))

                                            <img class="img-responsive" src="{{ url('/Elegantic/images/ALS.jpg') }}" alt="" style="width:100%;height:150px;">
                                        @else
                                            <img class="img-responsive" src="{{$news->image or 'Elegantic/images/ALS.jpg'}}" alt="" style="width:100%;height:150px;">
                                        @endif
                                        <ul class="list-inline">
                                            <li>
                                                <i class="fa fa-calendar"></i>
                                                <a href="#">
                                                    {{ $news->created_at }}
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="col-md-8 blog-article">
                                        <h3>
                                            <a href="/news/{{$news->id}}">
                                                {{ str_limit($news->title, $limit = 50, $end = '...') }}
                                            </a>
                                        </h3>
                                        <p>
                                            {{ strip_tags(str_limit($news->content, $limit = 360, $end = '...')) }}
                                        </p>
                                        <a href="{{ url('/news/'.$news->id) }}" class="btn hijau-muda">
                                            Read more <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <hr>
                            @endforeach

                            <ul class="pagination pull-right">
                                <a href="{{ url('/news-board') }}" class="btn hijau-muda">
                                    More News <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </ul>
                        </div>

                        <div class="col-md-4 col-sm-6 article-block">
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
                    </div>
                    <!-- end Div links-->

                </div>

            </div>
            <div class="clearfix"></div>
            <!-- Footer -->
        </div>

    </div>

{{--<div class="page-container" id="wrapper">--}}
        {{--<div class="page-content-wrapper">--}}
            {{--<div class="page-content" class="wrapper-holder" style="margin-bottom: -109px;">--}}
                {{--<!-- Slider -->--}}
                {{--<!-- <hr class="style13"> -->--}}
                {{--<div class="promo" >--}}
                    {{--<ul class="slider">--}}
                        {{--@foreach ($sliders as $slide)--}}

                            {{--<li style="background: url({{$slide->image ||'Elegantic/images/ALS.jpg'}}) no-repeat 100% 100%; width:100% !important;">--}}

                                {{--<div class="slide-holder">--}}
                                    {{--<div class="slide-info">--}}
                                        {{--<h1>{{$slide->title}}</h1>--}}
                                        {{--<p>{{strip_tags(str_limit($slide->content, $limit = 150, $end = '...')) }}</p>--}}
                                        {{--<a class="btn btn-ghost"  href="{{ url('slider/'.$slide->id) }}">Read More</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="clearfix"></div>--}}
            {{--<!-- NEWS -->--}}
            {{--<div class="page-content" style="background-color: rgb(243, 247, 248);opacity: 1;">--}}

                {{--<div class="blog-page">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-8 col-sm-6 article-block">--}}
                            {{--<p class="border-panel-title-wrap">--}}
                                {{--<!-- <div class="panel-title-wrap"> -->--}}
                                {{--<span class="panel-title-text">News</span>--}}
                                {{--<!-- </div> -->--}}

                            {{--</p>--}}

                            {{--@foreach ($newses as $news)--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-4 blog-img blog-tag-data">--}}
                                        {{--@if(empty($news->image))--}}
                                            {{--<img class="img-responsive" src="{{ url('/Elegantic/images/ALS.jpg') }}" alt="">--}}
                                        {{--@else--}}
                                            {{--<img class="img-responsive" src="{{$news->image || 'Elegantic/images/ALS.jpg'}}" alt="">--}}
                                        {{--@endif--}}
                                        {{--<ul class="list-inline">--}}
                                            {{--<li>--}}
                                                {{--<i class="fa fa-calendar"></i>--}}
                                                {{--<a href="#">--}}
                                                    {{--{{ $news->created_at }}--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                        {{--<ul class="list-inline blog-tags">--}}
                                            {{--<li>--}}
                                                {{--<i class="fa fa-tags"></i>--}}
                                                {{--<a href="#">--}}
                                                    {{--Technology--}}
                                                {{--</a>--}}
                                                {{--<a href="#">--}}
                                                    {{--Education--}}
                                                {{--</a>--}}
                                                {{--<a href="#">--}}
                                                    {{--Internet--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-8 blog-article">--}}
                                        {{--<h3>--}}
                                            {{--<a href="/berita/{{$news->id}}">--}}
                                                {{--{{ str_limit($news->title, $limit = 50, $end = '...') }}--}}
                                            {{--</a>--}}
                                        {{--</h3>--}}
                                        {{--<p>--}}
                                            {{--{{strip_tags(str_limit($news->content, $limit = 250, $end = '...')) }}--}}
                                        {{--</p>--}}
                                        {{--<a class="btn hijau-muda" href="page_blog_item.html">--}}
                                            {{--Read more <i class="m-icon-swapright m-icon-white"></i>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<hr>--}}
                            {{--@endforeach--}}

                            {{--<ul class="pagination pull-right">--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<i class="fa fa-angle-left"></i>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--1--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--2--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--3--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--4--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--5--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--6--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">--}}
                                        {{--<i class="fa fa-angle-right"></i>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 col-sm-6 article-block">--}}
                            {{--<p class="border-panel-title-wrap">--}}
                                {{--<span class="panel-title-text">Links</span>--}}
                            {{--</p>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-12 clearfix">--}}
                                    {{--<a href="#" class="btn btn-lg default" style="margin:5px 1px">--}}
                                        {{--IMS--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg red" style="margin:5px 1px">--}}
                                        {{--IMS--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg blue" style="margin:5px 1px">--}}
                                        {{--IMS--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg green" style="margin:5px 1px">--}}
                                        {{--IMS--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg yellow" style="margin:5px 1px">--}}
                                        {{--IMS--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg purple" style="margin:5px 1px">--}}
                                        {{--IMS--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg green" style="margin:5px 1px">--}}
                                        {{--IMS--}}
                                    {{--</a>--}}
                                    {{--<a href="#" class="btn btn-lg dark" style="margin:5px 1px">--}}
                                        {{--IMS--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}

            {{--</div>--}}
            {{--<div class="clearfix"></div>--}}
            {{--<!-- Footer -->--}}
        {{--</div>--}}

    {{--</div>--}}

    {{--<!-- ********************************************** -->--}}
    {{--<!--                  SLIDER                        -->--}}
    {{--<!-- ********************************************** -->--}}

    {{--<div id="myCarousel" class="carousel slide" data-ride="carousel">--}}

        {{--<div id="myCarousel" class="carousel slide" data-ride="carousel">--}}
            {{--<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">--}}
            {{--<ol class="carousel-indicators">--}}
                {{--@for ( $i = 0 ;  $i < count($sliders) ; $i++ )--}}
                    {{--@if ( $i == 0 )--}}
                        {{--<li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>--}}
                    {{--@else--}}
                        {{--<li data-target="#myCarousel" data-slide-to="{{$i}}"></li>--}}
                    {{--@endif--}}
                {{--@endfor--}}

            {{--</ol>--}}
            {{--<div class="carousel-inner">--}}
                {{--@for ( $i = 0 ;  $i < count($sliders) ; $i++ )--}}
                    {{--@if ( $i == 0 )--}}
                        {{--<div class="carousel-item active">--}}
                            {{--<img class="first-slide" data-src="holder.js/900x500/auto/#777:#555/text:First slide" width="100%" alt="First slide" >--}}
                            {{--<div class="container">--}}
                                {{--<div class="carousel-caption">--}}
                                    {{--<h2>{{ $sliders[$i]->title }}</h2>--}}
                                    {{--<p>{{ $sliders[$i]->second_title }}</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@else--}}
                        {{--<li data-target="#myCarousel" data-slide-to="{{$i}}"></li>--}}
                    {{--@endif--}}
                {{--@endfor--}}
                    {{--<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">--}}
                        {{--<span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
                        {{--<span class="sr-only">Previous</span>--}}
                    {{--</a>--}}
                    {{--<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">--}}
                        {{--<span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
                        {{--<span class="sr-only">Next</span>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<!-- ********************************************** -->--}}
    {{--<!--                  News                          -->--}}
    {{--<!-- ********************************************** -->--}}

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="container">--}}
                {{--<div class="content_head">--}}
                    {{--<h4> <strong>News</strong></h4>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@foreach ( $newses as $news )--}}

            {{--<div class="container">--}}


            {{--<div class="row col-lg-8">--}}


                {{--<div class="col">--}}
                    {{--<img src="{{ url('assets/img/sass-less.png') }}" class="img-thumbnail float-left" alt="news image">--}}
                {{--</div>--}}

                {{--<div class="col">--}}
                    {{--<div class="card mb-3">--}}
                        {{--<div class="card-body">--}}
                            {{--<h4 class="card-title">{{ $news->title }}</h4>--}}
                            {{--<p class="card-text">{{ $news->content }}</p>--}}
                            {{--<a href="{{ URL ('/get_news', $news->id)}}" class="btn btn-primary">Read More</a>--}}
                            {{--<p class="card-text">--}}
                                {{--<small class="text-muted">Created at {{ $news->created_at }}</small>--}}
                            {{--</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}


            {{--</div>--}}

            {{--</div>--}}

        {{--@endforeach--}}

    {{--</div>--}}
@endsection
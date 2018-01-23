@extends('user.layouts.app') @section('content')

<style>
.pagination > li > span {
    border-radius: 0% !important;
}
</style>

<div style="margin-top:60px; border:none;">
    <img src="{{url('Elegantic/images/head_banner_news.jpg')}}" width="100%" style="border:none; margin:0; padding:0;">
</div>
<div class="container" style="padding-top: 50px; width:70%; background:#f1f1f1;">
    <div class="row">

        <div class="page-content" style="background:#f1f1f1;">

            <div>
                <!--<div class="text-center">
                    <div class="block-title2" style="background-color:transparent !important; border-bottom:none !important; border-top:none !important; padding-top:0px !important;">
                        <div style="font-size:28px; font-weight:300; text-align:center;">NEWS ABOUT AEROFOOD ACS LEARNING CENTER</div>
                        <div class="title-icon2"><i class="fa fa-newspaper-o fa-2x" style="color:#415FC3; margin-top:10px;;"></i></div>
                    </div>
                </div>-->
                <!--<br>-->

                <div class="row">
                    @if(empty($newses[0]))
                    <div style="text-align: center;">
                        <h4>No news content</h4>
                    </div>
                    @else
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />
                    
                    <div id="content">

                        @foreach ($newses as $news)
                        <div class="col-md-12" style="margin-bottom:2em;">
                            <a href="/news/{{$news->id}}" style="text-decoration:none;">
                                <div class="va-table" style="width:100%;">
                                    <div class="va-middle" style="width:30%;">
                                        <!--<div style="border:1px solid #ccc; background-image: url('{{$news->image or 'Elegantic/images/ALS.jpg'}}'); background-position:center center; height:150px; position:relative; border-radius:5px 0px 0px 5px !important;"></div>-->
                                        <div style="height:150px; position:relative;">
                                            <a href="{{ url(action('NewsController@get_news',$news->id)) }}">
                                                <img class="card-img-top img-fluid" src="<?php if($news->url_image) echo $news->url_image; else echo url('Elegantic/images/ALS.jpg') ?> " alt="" style="border: 1px solid #ccc; border-radius:5%;" height="100%">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="va-middle" style="width:70%;">
                                        <div style="border-top:1px; border-right:1px; border-bottom:1px; border-left:0px; border-style:solid; border-color:#ccc; background-color:#fff; padding:1em 1.5em; position:relative; border-radius:0px 5px 5px 0px !important; height:150px; max-height:150px;">
                                            <div style="font-size:18px !important;"><a href="{{ url(action('NewsController@get_news',$news->id)) }}"><b>{{ str_limit($news->title, $limit = 50, $end = '...') }}</b></a></div>
                                            <div style="margin:5px 0;"><span style="color:#999 !IMPORTANT; font-size:12px;"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $news->created_at }}</span></div>
                                            <div style="font-size:13px; color:#666 !IMPORTANT;">{{ strip_tags(str_limit($news->content, $limit = 300, $end = '...')) }}</div>
                                            <div style="position:absolute; bottom:0; right:0;"><div class="btn btn-warning btn-sm"><a href="{{ url(action('NewsController@get_news',$news->id)) }}" style="color:#fff !important;">Read more</a></div></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!--<div class="col-md-12 col-sm-6 portfolio-item" style="height: 400px;">
    
                            <div class="h-100">
                                <a href="{{ url(action('NewsController@get_news',$news->id)) }}">
                                    <img class="card-img-top img-fluid" src="{{$news->url_image or url('Elegantic/images/ALS.jpg')}}" alt="" style="border: 1px solid green; border-radius:5%;">
                                </a>
                                <div class="card-block">
                                    <h4 class="card-title">
                                        <a href="{{ url(action('NewsController@get_news',$news->id)) }}">
                                                {{ str_limit($news->title, $limit = 20, $end = '...') }}
                                            </a>
                                    </h4>
                                    <p class="card-text" align="justify">
                                        {{ strip_tags(str_limit($news->content, $limit = 200, $end = '...')) }}
                                    </p>
                                    <p class="text-right">
                                        <a href="{{ url(action('NewsController@get_news',$news->id)) }}">
                                                Read more
                                            </a>
                                    </p>
                                    <br>
                                </div>
                            </div>
                        </div>-->
                        @endforeach
                    </div>
                    @endif
                    <br>
                </div>
                <div class="row" style="text-align: center; padding-top: 0px;">
                    {{ $newses->links() }}
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

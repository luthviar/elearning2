@extends('layouts.app') @section('content')

<style>
    .va-table {
        display: table;
    }

    .va-middle {
        display: table-cell;
        vertical-align: middle;
    }
</style>

<div class="clearfix"></div>

<div class="page-container" id="wrapper">
    <div class="page-content-wrapper">

        <div style="border:1px solid #ccc; background-image: url('{{URL::asset('Elegantic/images/news_banner.png')}}'); background-position:top center; height:300px; position:relative; border-radius:5px 5px 0px 0px !important;"></div>

        <div class="page-content" style="background-color:#f1f1f1;">

            <main role="main" class="container">
                <div class="block-advice" style="border:none; margin-bottom:0;">
                    <div class="text-center">
                        <div style="font-size:28px; font-weight:300; text-align:center;">NEWS ABOUT AEROFOOD ACS LEARNING CENTER</div>
                    </div><br><br><br>
                    <div class="row">
                        @if(empty($berita[0]))
                        <div style="text-align: center;">
                            <h4>No news content</h4>
                        </div>
                        @else
                        <input type='hidden' id='current_page' />
                        <input type='hidden' id='show_per_page' />
                        <div id="content">
                            @foreach ($berita as $news)

                            <div class="row">
                                <div class="col-md-12" style="margin-bottom:2em;">
                                    <a href="/news/{{$news->id}}" style="text-decoration:none;">
                                        <div class="va-table" style="width:100%;">
                                            <div class="va-middle" style="width:30%;">
                                                <div style="border:1px solid #ccc; background-image: url('{{$news->image or 'Elegantic/images/ALS.jpg'}}'); background-position:center center; height:150px; position:relative; border-radius:5px 0px 0px 5px !important;"></div>
                                            </div>
                                            <div class="va-middle" style="width:70%;">
                                                <div style="border-top:1px; border-right:1px; border-bottom:1px; border-left:0px; border-style:solid; border-color:#ccc; background-color:#fff; padding:1em 1.5em; position:relative; border-radius:0px 5px 5px 0px !important; height:150px; max-height:150px;">
                                                    <div><b>{{ str_limit($news->title, $limit = 50, $end = '...') }}</b></div>
                                                    <div style="margin:5px 0;">
                                                        <span style="color:#999 !IMPORTANT; font-size:12px;">
                                                            <i class="fa fa-clock-o"></i>&nbsp;&nbsp;
                                                            {{ $news->created_at }}
                                                        </span>
                                                    </div>
                                                    <div style="font-size:13px; color:#666 !IMPORTANT;">
                                                        {{ strip_tags(str_limit($news->content, $limit = 340, $end = '...')) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            @endforeach
                        </div>
                        @endif
                        <br>
                    </div>
                    <div style="text-align: center">

                        <ul class="pagination" id="page_navigation">

                        </ul>

                    </div>
                </div>

            </main>
        </div>

    </div>

</div>


@endsection

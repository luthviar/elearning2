@extends('user.layouts.app')
@section('content')

    <div class="container" style="padding-top: 100px;">
        <div class="row" style="background-color: rgb(243, 247, 248);opacity: 1;">

            <div class="page-content">

                <div class="block-advice">
                    <div class="text-center">
                        <h1 class="brand-name">News</h1>
                    </div>
                    <br>
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
                            <div
                                class="col-lg-4 col-sm-6 portfolio-item"
                                style="height: 400px;">

                                <div class="card h-100">
                                    <a href="{{ url('news/'.$news->id) }}">
                                        <img
                                            class="card-img-top img-fluid"
                                            src="{{$news->url_image or url('Elegantic/images/ALS.jpg')}}"
                                            alt="" style="border: 1px solid green; border-radius:5%; ">
                                    </a>
                                    <div class="card-block">
                                        <h4 class="card-title">
                                            <a href="{{ url('news/'.$news->id) }}">
                                                {{ str_limit($news->title, $limit = 20, $end = '...') }}
                                            </a>
                                        </h4>
                                        <p class="card-text" align="justify">
                                            {{ strip_tags(str_limit($news->content, $limit = 200, $end = '...')) }}
                                        </p>
                                        <p class="text-right">
                                            <a href="{{ url('news/'.$news->id) }}">
                                                Read more
                                            </a>
                                        </p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                            </div>
                        @endif
                        <br>
                    </div>
                    <div class="row" style="text-align: center; padding-top: 50px;">

                            {{--<ul class="pagination" id="page_navigation">--}}
                                {{ $newses->links() }}
                            {{--</ul>--}}

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
@extends('user.layouts.app')

@section('content')

    <div class="page-container" id="wrapper">

        <div class="page-content-wrapper" style="padding:30px">
            <div class ="col-md-8">
                <div class ="col-md-8">
                    <div class="col-md-3">
                        <br>
                        @if(empty($slider->url_image))
                            <img src="{{URL::asset('Elegantic/images/ALS.jpg')}}" alt="Card image cap" style="width:100%;height:60px;">
                        @else
                            <img src="{{URL::asset($slider['url_image'])}}" alt="Card image cap" style="width:100%;height:60px;">
                        @endif
                    </div>
                    <div class ="col-md-9">
                        <h3>{{ $slider['title'] }}</h3>
                        <h6>{{ \Carbon\Carbon::parse($slider->create_at)->format('l jS \\of F Y')}}</h6>
                    </div>
                </div>
                <div class ="col-md-12">
                    <hr class="style14">
                    <p align="justify" class="big">
                        {!! html_entity_decode($slider['second_title']) !!}

                    </p>
                   
                    <hr class="style14">
                    <br><br><br>

                </div>
            </div>

            <div class="col-lg-4  col-md-4 col-sm-12 hidden-sm hidden-xs">
                <div id="navWrap">
                    <nav>
                        <div class ="fixedpositiion">
                            <!--Recent Schedule -->
                            @include('user.layouts.schedule')
                            <!--Links -->
                            @include('user.layouts.aerofood_links')
                        </div>
                    </nav>
                </div>
            </div>

        </div>
    </div>

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
            var y = $(this).scrollTop();

            if (y > startPosition) {
                nav.addClass('sticky');
                if (y > stopPosition) {
					nav.css('top', stopPosition - y);
                } else {
                    nav.css('top', 0);
                }
            } else {
                nav.removeClass('sticky');
            }
        });
    </script>
    <style>
        .sticky {
            position: fixed;
        }
        p.big {
            line-height: 300%;
            font-size : 15px;
        }
    </style>
@endsection
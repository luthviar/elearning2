@include('layouts.head')

<style>
    p { text-align: justify;font-size:16px; }
</style>

<body class="page-header-fixed page-full-width" style="overflow:hidden">

    <!-- Header -->
    <div class="header navbar navbar-fixed-top mega-menu">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="header-inner">
            <!-- BEGIN LOGO -->
            <a class="navbar-brand" href="/">
                <img src="{{URL::asset('Elegantic/images/ALS-logo.jpg')}}"  class="img-responsive"/>
            </a>
            <!-- END LOGO -->
            <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <!-- <img src="assets/img/menu-toggler.png" alt=""/> -->
                <i class="fa fa-bars"></i>
            </a>
            <!-- END HORIZANTAL MENU -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav navbar-nav pull-right" style="cursor: pointer;">
                <!-- BEGIN USER LOGIN DROPDOWN -->
                @if (Auth::guest())
                <li><a style="margin-top:10px;" class="btn btn-small btn-sm pull-right hijau-muda" href="{{ route('login') }}">Login <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a></li>
                @else
                <li class="dropdown user">

                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" src="assets/img/avatar1_small.jpg"/>
                            <span class="username hidden-1024">{{Auth::user()->get_nama()}}</span>
                            <i class="fa fa-angle-down"></i>
                        </a>

                    <ul class="dropdown-menu" role="menu">
                        <li class="login">
                            @if(Auth::user()->is_admin == 1)
                            <a href="/personnel">
                                        Acting As Admin
                                    </a> @endif
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();" style="
                                    :hover{
                                        background-color: red;
                                    }">
                                    Logout
                                </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
            <!-- END TOP NAVIGATION MENU -->
            <!-- BEGIN HORIZANTAL MENU -->
            <div class="hor-menu hidden-sm hidden-xs navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="classic-menu-dropdown">
                        <a href="/">
                             Home
                        </a>
                    </li>
                    <li class="classic-menu-dropdown active"><a href="/news-board">News
                        <span class="selected">
                            </span>
                    </a></li>
                    @if(Auth::user())
                    <li class="classic-menu-dropdown "><a href="{{url('/forum')}}">Forum</a></li>
                    <li class="classic-menu-dropdown"><a data-toggle="dropdown" data-hover="dropdown" data-close-others="true" href="#">
                            My Modules <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($module as $modul)
                            <li>
                                <a href="/module/{{$modul->id}}">{{$modul->nama}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="classic-menu-dropdown "><a href="/raport/{{Auth::user()->id}}">My Profile</a></li>
                    @endif
                </ul>

            </div>
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <div class="clearfix"></div>
    <div class="page-container" id="wrapper" style="background-color:#f1f1f1;">
       <main role="main" class="container">
        <div class="page-sidebar navbar-collapse collapse">

            <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
                <li class="">
                    <a href="/">
						 Home
					</a>
                </li>
                <li class="active"><a href="/news-board">News</a><span class="selected">
						</span></li>
                @if(Auth::user())
                <li class=""><a href="{{url('/forum')}}">Forum</a></li>
                <li class="classic-menu-dropdown">
                    <a>
						My Modules <i class="arrow fa fa-angle-down"></i>
					</a>
                    <ul class="sub-menu">
                        @foreach ($module as $modul)
                        <li>
                            <a href="/module/{{$modul->id}}">{{$modul->nama}}</a>
                        </li>
                        @endforeach
                    </ul>

                </li>


                <li class=""><a href="/raport/{{Auth::user()->id}}">My Profile</a></li>
                @endif
            </ul>

        </div>
        <div class="page-content-wrapper" style="padding:30px">
            
                <div class="row">
                    <div class="col-md-8" style="background-color:#fff;">
                        <div class="col-md-12">
                            <!--<div class="col-md-3">
                                <br> @if(empty($news->image))
                                <img src="{{URL::asset('Elegantic/images/ALS.jpg')}}" alt="Card image cap" style="width:100%;"> @else
                                <img src="{{URL::asset($news['image'])}}" alt="Card image cap" style="width:100%;"> @endif
                            </div>-->
                                <div style="padding:1em 0 0 0; font-size:22px !important; color:#415FC3;">{{ $news['title'] }}</div>
                                <div style="padding:0 0 1em 0; font-size:12px; color:#ccc;">{{ \Carbon\Carbon::parse($news->create_at)->format('l jS \\of F Y')}}</div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <p align="justify">
                                    @if(empty($news->image))
                                    <img src="{{URL::asset('Elegantic/images/ALS.jpg')}}" alt="Card image cap" style="width:200px; margin-right:1.5em;" align="left"> @else
                                    <img src="{{URL::asset($news['image'])}}" alt="Card image cap" style="width:200px; margin-right:1.5em;" align="left"> @endif
                                    <span style="text-align:justify;">{!! html_entity_decode($news['content']) !!}</span>
                                </p>
                            </div>
                            <hr class="style14">
                            <div class='pull-right'>
                                @if(!empty($news['file_pendukung'][0])) Attachments : <br> @foreach($news['file_pendukung'] as $file)
                                <a href="{{URL::asset($file->url)}}"><i class="fa fa-paperclip" aria-hidden="true"></i>{{$file->name}} </a><br> @endforeach @endif
                            </div>
                            <br><br><br><br> @if($news->can_reply == 1)
                            <div class="block-advice">
                                <h3>Comments({{count($replies)}})</h3>
                                <br> @foreach($replies as $reply)
                                <div class="panel panel-default">
                                    <div class="panel-heading"><strong>{{ $reply['title'] }}</strong><br> {{$reply['user']->fname}} {{$reply['user']->lname}}, {{ \Carbon\Carbon::parse($reply->create_at)->format('d - m - Y , H:i:s')}}</div>
                                    <div class="panel-body">

                                        {!! html_entity_decode($reply['content']) !!}
                                        <br>
                                        <div class="pull-right">

                                            @if(!empty($reply['file_pendukung'][0])) Attachments : <br> @foreach($reply['file_pendukung'] as $file)
                                            <a href="{{URL::asset($file->url)}}"><i class="fa fa-paperclip" aria-hidden="true"></i>{{$file->name}}</a><br> @endforeach @endif

                                        </div>

                                    </div>
                                </div>
                                <br> @endforeach @if(Auth::user() == null) @else
                                <form id="myform" class="form-horizontal" role="form" method="POST" action="{{ URL::action('NewsReplieController@store') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="id_news" value="{{$news->id}}">
                                    <div class="form-group">
                                        <label for="title" class="col-md-2 control-label">Title</label>

                                        <div class="col-md-8">
                                            <input id="title" type="text" class="form-control" name="title" required value="[RE:] {{$news['title']}}">
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
                                            </div>
                                            </br>
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

            <div class="col-md-4 col-sm-12 hidden-sm hidden-xs">
                <div id="navWrap">
                    <nav>
                        <div class="fixedpositiion">
                            <div class="well">
                                <div style="margin:-19px;">
                                    <div style="padding:1em; background-color:#415FC3; display:table; width:100%;">
                                        <div style="display:table; width:100%;">
                                            <div style="display: table-cell; vertical-align:middle;">
                                                Recent News
                                            </div>
                                            <div style="display: table-cell; vertical-align:middle; float:right">
                                                MORE
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                @foreach($beritas as $brt)
                                <a href="/news/{{$brt->id}}">
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
                                    <a href="#" class="btn btn-lg default" style="margin:5px 1px">
                                         IMS 
                                    </a>
                                    <a href="#" class="btn btn-lg red" style="margin:5px 1px">
                                         IMS  
                                    </a>
                                    <a href="#" class="btn btn-lg blue" style="margin:5px 1px">
                                         IMS
                                    </a>
                                    <a href="#" class="btn btn-lg green" style="margin:5px 1px">
                                         IMS  
                                    </a>
                                    <a href="#" class="btn btn-lg yellow" style="margin:5px 1px">
                                         IMS  
                                    </a>
                                    <a href="#" class="btn btn-lg purple" style="margin:5px 1px">
                                        IMS
                                    </a>
                                    <a href="#" class="btn btn-lg green" style="margin:5px 1px">
                                         IMS  
                                    </a>
                                    <a href="#" class="btn btn-lg dark" style="margin:5px 1px">
                                         IMS  
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </div>
            </main>

        </div>

        <!-- Footer -->
        @include('layouts.footer')

        <div id="stopHere"></div>
    </div>

    @include('layouts.script')
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

        $(document).scroll(function() {
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
        $(window).load(function() {

            setTimeout(function() {
                $("#loading").fadeOut(function() {

                    $(this).remove();
                    $('body').removeAttr('style');
                })
            }, 300);
        });


        jQuery(document).ready(function() {
            // initiate layout and plugins
            App.init();

        });

    </script>

    <style>
        .sticky {
            position: fixed;
            top: 200px;
            width: 350px;
        }

        p.big {
            line-height: 300%;
            font-size: 15px;
        }

    </style>
</body>

</html>

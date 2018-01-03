<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Carousel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>

{{--<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">--}}
    {{--<div class="container">--}}
        {{--<div class="navbar-header">--}}
            {{--<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">--}}
                {{--<span class="sr-only">Toggle navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}
            {{--<a href="{{ url('/') }}" class="navbar-brand">Elearning</a>--}}
        {{--</div>--}}
        {{--<nav id="bs-navbar" class="collapse navbar-collapse">--}}
            {{--<ul class="nav navbar-nav">--}}
                {{--<li>--}}
                    {{--<a href="{{ url('/get_active_news') }}">News</a>--}}
                {{--</li>--}}
                {{--@guest--}}
                {{--@else--}}
                    {{--<li>--}}
                        {{--<a href="{{ url('/get_forum', 'public') }}">Forum</a>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}

                        {{--<a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Module Training <span class="caret"></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--@foreach ( $module as $modul)--}}
                                {{--<li><a href="{{ url('/get_training', $modul->id) }}">{{ $modul->modul_name }}</a></li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}

                        {{--<!-- <a href="components/">Components</a> -->--}}
                    {{--</li>--}}
                    {{--@endguest--}}
            {{--</ul>--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--@guest--}}
                {{--<li><a href="{{ route('login') }}">Login</a></li>--}}
                {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                {{--@else--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" > {{ Auth::user()->name }} </a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                        {{--<a href="{{ route('logout') }}"--}}
                           {{--onclick="event.preventDefault();--}}
                                 {{--document.getElementById('logout-form').submit();">--}}
                            {{--<span class="glyphicon glyphicon-off" aria-hidden="true"></span>--}}
                        {{--</a>--}}

                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                            {{--{{ csrf_field() }}--}}
                        {{--</form>--}}
                    {{--</li>--}}


                    {{--@endguest--}}

            {{--</ul>--}}
        {{--</nav>--}}
    {{--</div>--}}
{{--</header>--}}
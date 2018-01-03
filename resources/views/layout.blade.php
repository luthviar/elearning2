
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Bootstrap, a sleek, intuitive, and powerful mobile first front-end framework for faster and easier web development.">
<meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, bootstrap, front-end, frontend, web development">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">

<title>
  
    Elearning &middot; Aerofood ACS elearning system.
  
</title>

<!-- Bootstrap core CSS -->

<link href="{{ URL::asset('dist/css/bootstrap.css')}}" rel="stylesheet">



<!-- Documentation extras -->

<link href="{{ URL::asset('assets/css/src/pygments-manni.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/css/src/docs.css')}}" rel="stylesheet">

<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="{{ URL::asset('assets/js/ie-emulation-modes-warning.js')}}"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Favicons -->
<link rel="apple-touch-icon" href="{{ URL::asset('/apple-touch-icon.png')}}">
<link rel="icon" href="{{ URL::asset('/favicon.ico')}}">

<!-- My css -->
<link href="{{ URL::asset('css/style.css')}}" rel="stylesheet">

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-146052-10', 'getbootstrap.com');
  ga('send', 'pageview');
</script>

</head>
<body class="bs-docs-home">
    
  <!-- ********************************************** -->
  <!--                  NAVBAR                        -->
  <!-- ********************************************** -->

  <header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
      <div class="navbar-header">
        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="{{ url('/') }}" class="navbar-brand">Elearning</a>
      </div>
      <nav id="bs-navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li>
            <a href="{{ url('/get_active_news') }}">News</a>
          </li>
          @guest
          @else
          <li>
            <a href="{{ url('/get_forum', 'public') }}">Forum</a>
          </li>
          <li class="dropdown">
            
              <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Module Training <span class="caret"></span></a>
            <ul class="dropdown-menu">
              @foreach ( $module as $modul)
                <li><a href="{{ url('/get_training', $modul->id) }}">{{ $modul->modul_name }}</a></li>
              @endforeach
            </ul>
            
            <!-- <a href="components/">Components</a> -->
          </li>
          @endguest
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li class="dropdown">
                    <a href="{{ url('/profile') }}" > {{ Auth::user()->name }} </a>
                </li>
                    
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                       <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                    
                
            @endguest
          
        </ul>
      </nav>
    </div>
  </header>

<!-- ********************************************** -->
<!--                  CONTENT                       -->
<!-- ********************************************** -->

  <div>
    @yield('content')
  </div>

<!-- ********************************************** -->
<!--                  FOOTER                        -->
<!-- ********************************************** -->

    

    <!-- Footer
================================================== -->
<footer class="bs-docs-footer" role="contentinfo">
  <div class="container">
    <p>Bootstrap ships with vanilla CSS, but its source code utilizes<br> the two most popular CSS preprocessors, Less and Sass. Quickly get started with precompiled CSS or build on the source.</p>
    <ul class="bs-docs-footer-links text-muted">
      <li>Aerofood ACS</li>
      <li>&middot;</li>
      <li><a href="https://github.com/twbs/bootstrap">Facebook</a></li>
      <li>&middot;</li>
      <li><a href="getting-started/#examples">Twitter</a></li>
      <li>&middot;</li>
      <li><a href="2.3.2/">Instagram</a></li>
      <li>&middot;</li>
      <li><a href="about/">Google+</a></li>
      <li>&middot;</li>
      <li><a href="http://expo.getbootstrap.com">Expo</a></li>
      <li>&middot;</li>
      <li><a href="http://blog.getbootstrap.com">Blog</a></li>
      <li>&middot;</li>
      <li><a href="https://github.com/twbs/bootstrap/issues">Issues</a></li>
      <li>&middot;</li>
      <li><a href="https://github.com/twbs/bootstrap/releases">Releases</a></li>
    </ul>
  </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


  <script src="{{ URL::asset('dist/js/bootstrap.js')}}"></script>

  <script src="{{ URL::asset('assets/js/vendor/holder.min.js')}}"></script>
  
  <script src="{{ URL::asset('assets/js/vendor/ZeroClipboard.min.js')}}"></script>
  
  <script src="{{ URL::asset('assets/js/vendor/anchor.js')}}"></script>
  
  <script src="{{ URL::asset('assets/js/src/application.js')}}"></script>
  
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="{{ URL::asset('assets/js/ie10-viewport-bug-workaround.js')}}"></script>


<script>
  window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id; js.async=1;
    js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
  }(document, "script", "twitter-wjs"));
</script>

<!-- Analytics
================================================== -->
<script>
  var _gauges = _gauges || [];
  (function() {
    var t   = document.createElement('script');
    t.async = true;
    t.id    = 'gauges-tracker';
    t.setAttribute('data-site-id', '4f0dc9fef5a1f55508000013');
    t.src = '//secure.gaug.es/track.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(t, s);
  })();
</script>

@yield('script')

  </body>
</html>

<html>

<head>
    <title>e-Learning Aerofood</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{URL::asset('Elegantic/images/favicon.png')}}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}">
    <style>
        hr.style14 {
            border: 0;
            height: 1px;
            background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
        }

        @import url('font-awesome.css');

        /*  */

        html,
        body,
        .a {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
            font-weight: normal;
        }

        body {
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-image: url('{{ url('/Elegantic/images/login-bg.jpg') }}');
            overflow-y: auto;
        }

        .layer {
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* VERTICAL ALIGN MIDDLE */

        .a {
            display: table;
        }

        .b {
            display: table-cell;
            margin: 0;
            padding: 0;
            text-align: center;
            vertical-align: middle;
        }

        .content {
            border: 0px solid red;
            width: auto;
            height: auto;
            margin: auto;
        }


        /* END V A M */

        .form-1 .field {
            position: relative;
            /* For the icon positioning */
        }

        .form-1 .field i {
            /* Size and position */
            left: 0px;
            top: 0px;
            position: absolute;
            height: 36px;
            width: 36px;
            /* Line */
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            /*box-shadow: 1px 0 0 rgba(255, 255, 255, 0.7);*/
            /* Styles */
            color: #777777;
            text-align: center;
            line-height: 42px;
            -webkit-transition: all 0.3s ease-out;
            -moz-transition: all 0.3s ease-out;
            -ms-transition: all 0.3s ease-out;
            -o-transition: all 0.3s ease-out;
            transition: all 0.3s ease-out;
            pointer-events: none;
        }

        .form-1 input[type=text],
        .form-1 input[type=password] {
            font-size: 15px;
            font-weight: 400;
            /*text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);*/
            /* Size and position */
            width: 100%;
            padding: 10px 18px 10px 45px;
            /* Styles */
            border: 1px solid rgba(0, 0, 0, 0.1);
            /* Remove the default border */
            /*box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1), inset 0 3px 2px rgba(0, 0, 0, 0.1);*/
            border-radius: 3px;
            background: #f9f9f9;
            color: #777;
            -webkit-transition: color 0.3s ease-out;
            -moz-transition: color 0.3s ease-out;
            -ms-transition: color 0.3s ease-out;
            -o-transition: color 0.3s ease-out;
            transition: color 0.3s ease-out;
        }


        /* FORM-2 */

        .form-2 label {
            display: block;
            padding: 0 0 5px 2px;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: 400;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        .form-2 label i {
            margin-right: 5px;
            /* Gap between icon and text */
            display: inline-block;
            width: 10px;
        }

        .form-2 select {
            color: #999;
        }

        .form-2 input[type=text],
        .form-2 input[type=password],
        .form-2 select {
            font-size: 14px;
            font-weight: 400;
            display: block;
            width: 100%;
            padding: 10px;
            /*margin-bottom: 5px;*/
            border: 3px solid #f2f2f2 !important;
            border-radius: 5px;
            -webkit-transition: all 0.3s ease-out;
            -moz-transition: all 0.3s ease-out;
            -ms-transition: all 0.3s ease-out;
            -o-transition: all 0.3s ease-out;
            transition: all 0.3s ease-out;
            opacity: 0.7;
        }

        .add-on,
        .input-group-addon {
            /*padding: 2px !important;*/
            border: none !important;
            padding-bottom: 5px !important;
            margin: 0 !important;
        }

        .form-2 input[type=text]:hover,
        .form-2 input[type=password]:hover,
        .form-2 select:hover {
            border-color: #f2f2f2;
        }

        .form-2 label:hover~input {
            border-color: #f2f2f2;
        }

        .form-2 input[type=text]:focus,
        .form-2 input[type=password]:focus {
            border-color: #BBB;
            outline: none;
            opacity: 1;
            /* Remove Chrome's outline */
        }

        .form-2 input[type=submit]:active,
        .form-2 .log-twitter:active {
            top: 1px;
        }


        /* END FORM-2 */

        .login-box {
            -webkit-box-shadow: 0px 44px 10px -35px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 0px 44px 10px -35px rgba(0, 0, 0, 0.15);
            box-shadow: 0px 44px 10px -35px rgba(0, 0, 0, 0.15);
            /*background: #fefefe;*/
            border-radius: 0;
            /*overflow: hidden;*/
            width: 500px;
            margin: 0 auto;
            height: auto;
        }

        .login-box-dou {
            -webkit-box-shadow: 0px 44px 10px -35px rgba(0, 0, 0, 0.15);
            -moz-box-shadow: 0px 44px 10px -35px rgba(0, 0, 0, 0.15);
            box-shadow: 0px 44px 10px -35px rgba(0, 0, 0, 0.15);
            /*background: #fefefe;*/
            border-radius: 0;
            /*overflow: hidden;*/
            width: 90%;
            margin: 0 auto;
            height: auto;
        }

        .judul {
            font-size: 2em;
            color: #2E2D2E;
            line-height: 1.2em;
        }

        .judul-mobile {
            font-size: 1.3em;
            color: #2E2D2E;
            line-height: 1.2em;
        }

        .login-box .or,
        .login-box-dou .or {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            display: inline-block;
            min-width: 2.1em;
            padding: 0.3em;
            border-radius: 50%;
            font-size: 0.6rem;
            text-align: center;
            font-size: 1.275rem;
            background: #cacaca;
            box-shadow: 0 2px 4px rgba(10, 10, 10, 0.4);
        }

        .translucent-form-overlay {
            max-width: 500px;
            padding: 30px 50px;
            color: #7e7975;
            height: auto;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 4px;
        }

        .translucent-form-overlay .columns.row {
            display: block;
        }

        @media screen and (max-width: 39.9375em) {
            .login-box .or {
                top: 85%;
            }
        }

        .cmxform fieldset p.error label {
            color: #fff !important;
        }

        div.container {
            background-color: #eee;
            border: 1px solid red;
            margin: 5px;
            padding: 5px;
        }

        div.container ol li {
            list-style-type: disc;
            margin-left: 20px;
        }

        div.container {
            display: none
        }

        .container label.error {
            display: inline;
        }

        form.cmxform {
            /*width: 30em;*/
        }

        form.cmxform label.error,
        form.cmxform label.error-duo,
        .error-msg,
        .error-duo,
        .success-msg,
        .success-duo {
            display: block;
            margin: 0 auto;
            text-align: center;
            transition: 2s all;
        }

        form.cmxform label.error {
            max-width: 500px;
            border: 1px solid #EDC0B9;
            padding: 1em;
            background-color: #f7e4e1;
            color: red !important;
            font-size: 16px;
        }

        form.cmxform label.duo-err {
            max-width: 100%;
            border: 1px solid #EDC0B9;
            padding: 1em;
            background-color: #f7e4e1;
            color: red !important;
            font-size: 16px;
        }

        .error-msg {
            max-width: 500px;
            border: 1px solid #EDC0B9;
            padding: 1em;
            background-color: #f7e4e1;
            color: red !important;
            font-size: 16px;
            border-radius: 4px;
            margin-bottom: 1em;
        }

        .error-duo {
            max-width: 100%;
            border: 1px solid #EDC0B9;
            padding: 1em;
            background-color: #f7e4e1;
            color: red !important;
            font-size: 16px;
        }

        .success-msg {
            max-width: 500px;
            border: 1px solid #70C072;
            padding: 1em;
            background-color: #C5E5C5;
            color: #3F8F41 !important;
            font-size: 16px;
            border-radius: 4px;
            margin-bottom: 1em;
        }

        .success-duo {
            max-width: 100%;
            border: 1px solid #70C072;
            padding: 1em;
            background-color: #C5E5C5;
            color: #3F8F41 !important;
            font-size: 16px;
        }

        .copyright {
            color: #FFF;
            font-size: 13px;
            margin-top: 2em;
            position: relative;
            z-index: 99;
        }

        p.copyright {
            margin-bottom: 0px !important;
        }

        div.valign-center {
            display: table;
        }

        div.valign-center span,
        div.valign-center img {
            display: table-cell;
            vertical-align: middle;
        }

        .pro-det {
            margin: 1em 0;
        }

        a.bluebio {
            color: #2F297C;
        }

        a.bluedarkbio {
            color: #056F99;
        }

        .btn-bluebio {
            background-color: #00ADEF !important;
            color: #fff !important;
            transition: all 1s;
            font-weight: bold !important;
        }

        .btn-bluebio:hover {
            background-color: #056F99 !important;
            color: #fff !important;
        }

        .btn-greenbio {
            background-color: #70C072 !important;
            color: #fff !important;
            transition: all 1s;
            font-weight: bold !important;
        }

        .btn-greenbio:hover {
            background-color: #3F8F41 !important;
            color: #fff !important;
        }

        .btn-greybio {
            background-color: #B4B4B4 !important;
            color: #fff !important;
            transition: all 1s;
        }

        .btn-greybio:hover {
            background-color: #7B7B7B !important;
            color: #fff !important;
        }

        .sm-text-right {
            text-align: right !important;
        }

        .bg-white-op {
            background: rgba(255, 255, 255, 0.7);
            border-radius: .25rem;
            width: 100%;
        }

        .forgot a {
            font-weight: bold;
            text-decoration: none;
        }

        .forgot a:hover {
            color: #999;
            text-decoration: underline;
        }

        .fc-bio {
            color: #247032 !important;
        }

        .logo-bio {
            margin-bottom: 1em;
        }

        @media only screen and (max-width: 479px) {
            body {
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                background-image: url('{{ url('/Elegantic/images/login-bg.jpg') }}');
                background-position: center center;
            }
            .login-box,
            .login-box-dou {
                -webkit-box-shadow: 0px 44px 10px -35px rgba(0, 0, 0, 0.15);
                -moz-box-shadow: 0px 44px 10px -35px rgba(0, 0, 0, 0.15);
                box-shadow: 0px 44px 10px -35px rgba(0, 0, 0, 0.15);
                /*background: #fefefe;*/
                border-radius: 0;
                /*overflow: hidden;*/
                width: 100%;
                /*margin: 0 auto;
        height: auto;*/
                margin-top: 0em;
            }
            .login-box-dou {
                margin-top: 2em;
            }
            .translucent-form-overlay {
                /*max-width: 500px;*/
                width: 90%;
                /*background-color: rgba(214, 122, 23, 0.7);*/
                background: rgba(210, 217, 229, 0.8);
                padding: 20px;
                color: #666;
                height: auto;
            }
            .content {
                margin-bottom: 20px;
            }
            .footer-copy {
                margin-top: 20px;
                color: #fff;
                margin-bottom: 30px;
            }
            .bg-white-op {
                background: rgba(255, 255, 255, 0.7);
                border-radius: .25rem;
                width: 100%;
                margin-bottom: 10px;
            }
            .xs-text-center {
                text-align: center !important;
            }
            div.containerBio {
                background: rgba(255, 0, 0, 0.8);
                border: 1px solid red;
                width: 90%;
                margin: 0 auto;
                border-radius: 4px;
            }
            .mb-10px-m {
                margin-bottom: 5px !important;
            }
            .logo-bio {
                margin: 1em 0;
            }
            .error-msg {
                width: 90%;
                border: 1px solid #EDC0B9;
                padding: 1em;
                background-color: #f7e4e1;
                color: red !important;
                font-size: 16px;
                border-radius: 4px;
                margin-bottom: 1em;
            }
            .success-msg {
                width: 90%;
                border: 1px solid #70C072;
                padding: 1em;
                background-color: #C5E5C5;
                color: #3F8F41 !important;
                font-size: 16px;
                border-radius: 4px;
                margin-bottom: 1em;
            }
        }

    </style>
</head>

<body>

    <div class="layer"></div>
    <div class="a">
        <div class="b">
            <div class="content">

                <div class="login-box">
                    <div class="row" data-equalizer="foo" align="center">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="translucent-form-overlay" data-equalizer-watch="foo">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                    <div class="login-box-form-section">
                                        <div class="row" data-equalizer="foo">
                                            <div class="logo-bio"><a href="http://www.biogreenscience.com/" target="_blank" style="text-decoration:none;"><img src="{{ url('/Elegantic/images/ALS.png') }}" width="200px"></a></div>
                                        </div>
                                        <div class="form-group">
                                            <h4 class="text-center" style="text-align:center !important;">
                                                <span class="visible-lg hidden-md-down text-top fc-bio"><b>SIGN IN E-LEARNING AEROFOOD ACS</b></span>
                                            </h4>
                                            @if(Session::get('success') != null)
                                            <div class="alert alert-success" role="alert">
                                                {{ Session::get('success') }}
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group input-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus> @if ($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span> @endif
                                        </div>
                                        <div class="form-group input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                            <input id="password" type="password" class="form-control" name="password" required placeholder="Password"> @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span> @endif
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="sm-text-right xs-text-center"><a href="{{ url('/forgot_password') }}" class="bluebio"><b>Forgot Password</b></a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xs-6 mb-10px-m" style="padding-left:0px;">
                                                <p class="submit" style="margin-bottom:0;">
                                                    <button class="btn btn-danger" type="reset" style="margin-bottom:0px !important; width:100%;"><b>RESET</b></button>
                                                </p>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-6" style="padding-right:0px;">
                                                <p class="submit" style="margin-bottom:0;">
                                                    <button class="btn btn-success" type="submit" style="margin-bottom:0px !important; width:100%;"><b>LOG IN</b></button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" data-equalizer="foo">
                    <p class="copyright">Copyright &copy; Aerowisata 2018. All Rights Reserved</p>
                </div>

            </div>
        </div>
    </div>


    <!--<div class="container">
        <div class="card">
            <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" style="text-align:center;">
                <a href="{{ url(action('HomeController@index')) }}">
                <img class="card-img-top" style="margin-top:50px;" src="{{ url('/Elegantic/images/ALS.jpg') }}" alt="Card image cap" width="60%">
            </a>
            </div>
            <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <br>
                <hr class="style14">
                <br> @if(Session::get('success') != null)
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif

                <div class="panel panel-info">
                    <div class="panel-heading" style="background-color:green; color:white">
                        <div class="panel-title">Sign In</div>
                    </div>

                    <div style="padding-top:30px" class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div style="margin-bottom: 25px" class="input-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus> @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span> @endif
                            </div>

                            <div style="margin-bottom: 25px" class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Password"> @if ($errors->has('password'))
                                <span class="help-block">
												<strong>{{ $errors->first('password') }}</strong>
											</span> @endif
                            </div>

                            <div style="text-align: center">
                                <div style="margin-top:10px" class="form-group">
                                     Button 

                                    <div class="col-sm-12 controls">
                                        <button type="submit" class="btn btn-primary" style="background-color:green; color:white">
                                        Login
                                    </button>

                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                        <a class="btn btn-link" href="{{ url('/forgot_password') }}" style="color:green">
                                        Forgot Your Password?
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>-->
    
    
</body>

</html>

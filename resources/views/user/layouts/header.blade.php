<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'E-Learning Aerofood') }} - @yield('title')</title>
<link rel="icon" href="{{URL::asset('Elegantic/images/favicon.png')}}" type="image/png" sizes="16x16">
<link rel="stylesheet" href="{{ URL::asset('Elegantic/css/fancySelect.css')}}" />
<link rel="stylesheet" href="{{ URL::asset('Elegantic/css/uniform.css')}}" />
<link rel="stylesheet" href="{{ URL::asset('Elegantic/css/all.css')}}" />
<link media="screen" rel="stylesheet" type="text/css" href="{{ URL::asset('Elegantic/css/screen.css')}}" />
<link rel="stylesheet" href="{{ url('css/bootstrap3.min.css') }}">
<script type="text/javascript" src="{{ url('js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ url('js/bootstrap3.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('css/font-awesome.css') }}">

{{--<link href="{{ url('css/summernote.css') }}" rel="stylesheet">--}}
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
{{--<script src="{{ url('js/summernote.js') }}"></script>--}}
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<link rel="stylesheet" href="{{ URL::asset('css/Upload.css')}}" />
<script type="text/javascript" src="{{ URL::asset('js/UpoladImg.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/js-override.js')}}"></script>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
{{--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css"/>--}}
<link href="{{ url('css/fonts.css') }}" rel="stylesheet" type="text/css"/>
{{--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css"/>--}}
{{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>--}}
<link href="{{ URL::asset('Elegantic/css/uniform.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('Elegantic/css/style-override.css')}}" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="{{ URL::asset('metro/style-metronic.css')}}" 	rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('metro/style.css')}}" 			rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('metro/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('metro/plugins.css')}}" 			rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('metro/blog.css')}}" 			   rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('metro/themes/default.css')}}" 	rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{ URL::asset('metro/custom.css')}}" 			rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->



<!-- summernote script -->
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor

        });

    });

    $('#summernote_form').on('submit', function(e) {

        if($('#summernote').summernote('isEmpty')) {
            alert('Konten tidak boleh kosong');

            e.preventDefault();
        }
        else {
            $('#summernote_form').submit();
        }
    })
</script>

<!-- loading preloader -->
<div id="loading">
    <div id="loading-container" class="fullwidth">
        <div class="spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <p id='loading-text'>Loading...</p>
    </div>
</div>
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
    .card a img {
        border: 0;
        width: 100%;
    }
</style>
<!--[if lt IE 9]>
<script src="{{ url('js/html5shiv.js') }}"></script>

<![endif]-->



{{-- STYLE UNTUK TABS DI MODULE TRAINING --}}
<link rel="stylesheet" type="text/css" href="{{ url('css/tabs.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('css/tabstyles.css') }}" />
<script src="{{ url('js/tabs/modernizr.custom.js') }}"></script>
{{-- END OF STYLE UNTUK TABS DI MODULE TRAINING --}}

{{-- My Style --}}
<style>
    .color-std {
        background-color: #13B795 !important;
    }
</style>
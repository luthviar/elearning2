<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo e(config('app.name', 'E-Learning Aerofood')); ?> - <?php echo $__env->yieldContent('title'); ?></title>
<link rel="icon" href="<?php echo e(URL::asset('Elegantic/images/ALS.png')); ?>" type="image/jpg" sizes="16x16">
<link rel="stylesheet" href="<?php echo e(URL::asset('Elegantic/css/fancySelect.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(URL::asset('Elegantic/css/uniform.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(URL::asset('Elegantic/css/all.css')); ?>" />
<link media="screen" rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('Elegantic/css/screen.css')); ?>" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.6/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.6/summernote.js"></script>
<link rel="stylesheet" href="<?php echo e(URL::asset('css/Upload.css')); ?>" />
<script type="text/javascript" src="<?php echo e(URL::asset('js/UpoladImg.js')); ?>"></script>


<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css"/>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css"/>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(URL::asset('Elegantic/css/uniform.css')); ?>" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="<?php echo e(URL::asset('metro/style-metronic.css')); ?>" 	rel="stylesheet" type="text/css"/>
<link href="<?php echo e(URL::asset('metro/style.css')); ?>" 			rel="stylesheet" type="text/css"/>
<link href="<?php echo e(URL::asset('metro/style-responsive.css')); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(URL::asset('metro/plugins.css')); ?>" 			rel="stylesheet" type="text/css"/>
<link href="<?php echo e(URL::asset('metro/blog.css')); ?>" 			   rel="stylesheet" type="text/css"/>
<link href="<?php echo e(URL::asset('metro/themes/default.css')); ?>" 	rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo e(URL::asset('metro/custom.css')); ?>" 			rel="stylesheet" type="text/css"/>
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

<style>
    .card a img {
        border: 0;
        width: 100%;
    }
</style>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

<![endif]-->

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
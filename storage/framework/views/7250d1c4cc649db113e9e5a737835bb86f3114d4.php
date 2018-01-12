<html>
<head>
    <title>E-Learning Aerofood</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="icon" href="<?php echo e(URL::asset('Elegantic/images/ALS.png')); ?>" type="image/jpg" sizes="16x16">
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::asset('css/font-awesome.min.css')); ?>">
    <style>
        hr.style14 {
            border: 0;
            height: 1px;
            background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
            background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
        }

    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" style="text-align:center;">
            <img class="card-img-top" style="margin-top:50px;" src="<?php echo e(url('/Elegantic/images/ALS.jpg')); ?>" alt="Card image cap" width="60%"></div>
        <div id="loginbox"  class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <br>
            <hr class="style14">
            <br>

            <?php if(Session::get('success') != null): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo e(Session::get('success')); ?>

                </div>
            <?php endif; ?>

            <div class="panel panel-info" >
                <div class="panel-heading" style="background-color:green; color:white">
                    <div class="panel-title">Sign In</div>
                </div>

                <div style="padding-top:30px" class="panel-body" >
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div style="margin-bottom: 25px" class="input-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="username" type="text" class="form-control"
                                   name="username" value="<?php echo e(old('username')); ?>"
                                   placeholder="Username" required autofocus>
                            <?php if($errors->has('username')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('username')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div style="margin-bottom: 25px" class="input-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                            <?php if($errors->has('password')): ?>
                                <span class="help-block">
												<strong><?php echo e($errors->first('password')); ?></strong>
											</span>
                            <?php endif; ?>
                        </div>

                        <div style="text-align: center">
                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls">
                                    <button type="submit" class="btn btn-primary" style="background-color:green; color:white">
                                        Login
                                    </button>

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                    <a class="btn btn-link" href="<?php echo e(url('/forgot_password')); ?>" style="color:green">
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
</div>
</body>
</html>
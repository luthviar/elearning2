 <?php $__env->startSection('content'); ?>

<div class="clearfix"></div>

<div class="page-container" id="wrapper">
    <div class="page-content-wrapper" style="background-color:#f1f1f1;">
        <div class="promo">
            <ul class="slider">
                <?php $__currentLoopData = $sliders->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="background: url(<?php echo e((url($slide->url_image) or 'Elegantic/images/ALS.jpg') ?
                                                        url($slide->url_image) : 'Elegantic/images/ALS.jpg'); ?>)
                                no-repeat 100% 100%; width:100% !important;">
                    <div class="slide-holder">
                        <div class="slide-info">
                            <h1><?php echo e($slide->title); ?></h1>
                            <p><?php echo html_entity_decode(str_limit($slide->second_title, $limit = 360, $end = '...')); ?></p>
<!--
                            <div class="top-left">
                                <a class="btn btn-ghost" href="<?php echo e(url('slider/view-'.$slide->id)); ?>">Read More</a>
                            </div>
-->
                        </div>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div style="margin:100px 0 100px 0;">
            <main role="main" class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="block-title2" style="background-color:transparent !important; border-bottom:none !important; border-top:none !important; padding-top:0px !important;">
                            <div style="font-size:28px; font-weight:300; text-align:center;">NEWS ABOUT AEROFOOD ACS LEARNING CENTER</div>
                            <div class="title-icon2"><i class="fa fa-newspaper-o fa-2x" style="color:#415FC3; margin-top:10px;;"></i></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="carousel carousel-showfourmoveone slide" id="carou-news">
                            <div class="carousel-inner">
                                <?php $n = 0?> <?php $__currentLoopData = $newses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <div class="item <?php if($n == 0){echo 'active';} $n++;?>">
                                    <div class="col-md-3">
                                        <a href="<?php echo e(url('/news/'.$news->id)); ?>" style="text-decoration:none;">
                                            <?php if(empty($news->url_image)): ?>
                                            <div style="border:1px solid #ccc; height:135px; position:relative; border-radius:5px 5px 0px 0px !important;">
                                            <img src="<?php echo e(url('Elegantic/images/ALS.jpg')); ?>" width="100%"/>
                                            </div>
                                            <?php else: ?>
                                            <div style="border:1px solid #ccc; height:135px; position:relative; border-radius:5px 5px 0px 0px !important;">
                                            <img src="<?php echo e(url($news->url_image)); ?>" width="100%"/>
                                            </div>
                                            <?php endif; ?>
                                            <div style="border-top:1px; border-right:1px; border-bottom:1px; border-left:1px; border-style:solid; border-color:#ccc; background-color:#ffffff; padding:1em 1.5em; position:relative; border-radius:0px 0px 5px 5px !important; height:150px; max-height:150px;">
                                                <div style="height:40px;"><b><?php echo e(str_limit($news->title, $limit = 50, $end = '...')); ?></b></div>
                                                <div style="margin:5px 0;"><span style="color:#999 !IMPORTANT; font-size:12px;"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo e($news->created_at); ?></span></div>
                                                <div style="font-size:13px; color:#666 !IMPORTANT;height:40px;"><?php echo e(strip_tags(str_limit($news->content, $limit = 100, $end = '...'))); ?></div>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <a class="left carousel-control" href="#carou-news" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                            <a class="right carousel-control" href="#carou-news" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div><br><br><br>
                    <!--LINK-->
                    <div class="col-md-6 col-xs-12">
                        <?php echo $__env->make('user.layouts.aerofood_links', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                    <!--TRAINING-->
                    <div class="col-md-6 col-xs-12">
                        <?php echo $__env->make('user.layouts.schedule', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>

                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="block-title2" style="background-color:transparent !important; border-bottom:none !important; border-top:none !important; padding-top:0px !important;">
                            <div style="font-size:28px; font-weight:300; text-align:center;">ABOUT AEROFOOD ACS</div>
                            <div class="title-icon2"><i class="fa fa-newspaper-o fa-2x" style="color:#415FC3; margin-top:10px;;"></i></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="va-table" style="width:70%; margin:0 auto;">
                            <div class="va-middle"><img src="<?php echo e(url('/Elegantic/images/ALS.png')); ?>" alt="" style="width:200px;" /></div>
                            <div class="va-middle" style="color:#666; padding-left:1.5em;">PT Aerofood Indonesia, is the holding company of Aerowisata Group which is also a holding company of Garuda Indonesia Group. Aerofood is a company that serves the procurement of products and logistics needs in flight with domestic and international sizes.</div>
                        </div>
                    </div>
                </div>
            </main>
            
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
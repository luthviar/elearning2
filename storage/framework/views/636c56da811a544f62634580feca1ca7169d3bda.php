<?php $__env->startSection('content'); ?>


    <div class="clearfix"></div>
    <div class="page-container" id="wrapper">

        <div class="page-content-wrapper">
            <!-- Slider -->

            <!-- ********************************************** -->
            <!--                  SLIDER                        -->
            <!-- ********************************************** -->
            <div class="promo" >
                <ul class="slider">
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <li style="background: url(<?php echo e((url($slide->url_image) or 'Elegantic/images/ALS.jpg') ?
                                                        url($slide->url_image) : 'Elegantic/images/ALS.jpg'); ?>)
                                no-repeat 100% 100%; width:100% !important;">
                            <div class="slide-holder">
                                <div class="slide-info">
                                    <h1><?php echo e($slide->title); ?></h1>
                                    <p><?php echo html_entity_decode(str_limit($slide->second_title, $limit = 360, $end = '...')); ?></p>
                                    <div class="top-left">
                                        <a class="btn btn-ghost"  href="/slider/<?php echo e($slide->id); ?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

            </div>
            <div class="clearfix"></div>
            <!-- NEWS -->
            <div class="page-content" style="background-color: rgb(243, 247, 248);opacity: 1;">

                <div class="blog-page">
                    <div class="row">
                        <div class="col-md-7 col-sm-6 article-block">
                            <p class="border-panel-title-wrap">
                                <!-- <div class="panel-title-wrap"> -->
                                <span class="panel-title-text">News</span>
                                <!-- </div> -->

                            </p>

                            <?php $__currentLoopData = $newses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row" >
                                    <div class="col-md-4 blog-img blog-tag-data">
                                        <?php if(empty($news->image)): ?>
                                            <a href="<?php echo e(url('/news/'.$news->id)); ?>" >
                                                <img class="img-responsive" src="<?php echo e(url('/Elegantic/images/ALS.jpg')); ?>" alt="" style="width:100%;height:150px;">
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(url('/news/'.$news->id)); ?>" >
                                                <img class="img-responsive" src="<?php echo e(isset($news->image) ? $news->image : 'Elegantic/images/ALS.jpg'); ?>" alt="" style="width:100%;height:150px;">
                                            </a>
                                        <?php endif; ?>
                                        <ul class="list-inline">
                                            <li>
                                                <i class="fa fa-calendar"></i>
                                                <a href="#">
                                                    <?php echo e($news->created_at); ?>

                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="col-md-8 blog-article">
                                        <h3>
                                            <a href="<?php echo e(url('/news/'.$news->id)); ?>" >
                                                <?php echo e(str_limit($news->title, $limit = 50, $end = '...')); ?>

                                            </a>
                                        </h3>
                                        <p>
                                            <?php echo e(strip_tags(str_limit($news->content, $limit = 360, $end = '...'))); ?>

                                        </p>
                                        <a href="<?php echo e(url('/news/'.$news->id)); ?>" class="btn hijau-muda">
                                            Read more <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <ul class="pagination pull-right">
                                <a href="<?php echo e(url('/news-board')); ?>" class="btn hijau-muda">
                                    More News <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </ul>
                        </div>

                        <div class="col-md-4 col-sm-6 article-block">
                            <p class="border-panel-title-wrap">
                                <span class="panel-title-text">Links</span>
                            </p>
                            <div class="row">
                                <div class="col-md-12 clearfix">
                                    <a href="https://oms.aerofood.co.id"
                                       class="btn btn-lg default"
                                       style="margin:5px 1px"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Operation Monitoring System	(oms.aerofood.co.id)"
                                       target="_blank"
                                    >
                                        OMS
                                    </a>

                                    <a href="https://oms.aerofood.co.id"
                                       class="btn btn-lg red"
                                       style="margin:5px 1px"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Operation Monitoring System	(oms.aerofood.co.id)"
                                       target="_blank"
                                    >
                                        IMS
                                    </a>
                                    <a href="https://oms.aerofood.co.id"
                                       class="btn btn-lg blue"
                                       style="margin:5px 1px"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Operation Monitoring System	(oms.aerofood.co.id)"
                                       target="_blank"
                                    >
                                        GLP-ICGB
                                    </a>
                                    <a href="https://oms.aerofood.co.id"
                                       class="btn btn-lg green"
                                       style="margin:5px 1px"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Operation Monitoring System	(oms.aerofood.co.id)"
                                       target="_blank"
                                    >
                                        Proline
                                    </a>
                                    <a href="#" class="btn btn-lg yellow" style="margin:5px 1px">
                                        eProc
                                    </a>
                                    <a href="#" class="btn btn-lg purple" style="margin:5px 1px">
                                        eLearning
                                    </a>
                                    <a href="#" class="btn btn-lg green" style="margin:5px 1px">
                                        eRecruitment
                                    </a>
                                    <a href="#" class="btn btn-lg dark" style="margin:5px 1px">
                                        Simpreman
                                    </a>
                                    <a href="#" class="btn btn-lg purple" style="margin:5px 1px">
                                        ePireq
                                    </a>
                                    <a href="#" class="btn btn-lg green" style="margin:5px 1px">
                                        eBudgeting
                                    </a>
                                    <a href="#" class="btn btn-lg blue" style="margin:5px 1px">
                                        SOB
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Div links-->

                </div>

            </div>
            <div class="clearfix"></div>
            <!-- Footer -->
        </div>

    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
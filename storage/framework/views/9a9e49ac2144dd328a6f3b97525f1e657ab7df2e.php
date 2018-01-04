<?php $__env->startSection('content'); ?>

    <div class="container" style="padding-top: 100px;">
        <div class="row" style="background-color: rgb(243, 247, 248);opacity: 1;">

            <div class="page-content">

                <div class="block-advice">
                    <div class="text-center">
                        <h1 class="brand-name">News</h1>
                    </div>
                    <br>
                    <div class="row">
                        <?php if(empty($newses[0])): ?>
                            <div style="text-align: center;">
                                <h4>No news content</h4>
                            </div>
                        <?php else: ?>
                            <input type='hidden' id='current_page' />
                            <input type='hidden' id='show_per_page' />
                            <div id="content">

                        <?php $__currentLoopData = $newses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div
                                class="col-lg-4 col-sm-6 portfolio-item"
                                style="height: 400px;">

                                <div class="card h-100">
                                    <a href="#">
                                        <img
                                            class="card-img-top img-fluid"
                                            src="<?php echo e(isset($news->url_image) ? $news->url_image : url('Elegantic/images/ALS.jpg')); ?>"
                                            alt="" style="border: 1px solid green; border-radius:5%; ">
                                    </a>
                                    <div class="card-block">
                                        <h4 class="card-title">
                                            <a href="/news/<?php echo e($news->id); ?>">
                                                <?php echo e(str_limit($news->title, $limit = 20, $end = '...')); ?>

                                            </a>
                                        </h4>
                                        <p class="card-text" align="justify">
                                            <?php echo e(strip_tags(str_limit($news->content, $limit = 200, $end = '...'))); ?>

                                        </p>
                                        <p class="text-right">
                                            <a href="<?php echo e(url('news/'.$news->id)); ?>">
                                                Read more
                                            </a>
                                        </p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        <br>
                    </div>
                    <div class="row" style="text-align: center; padding-top: 50px;">

                            <ul class="pagination" id="page_navigation">

                            </ul>

                    </div>
                </div>
            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
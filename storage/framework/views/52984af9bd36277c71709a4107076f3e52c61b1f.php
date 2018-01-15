<?php $__env->startSection('content'); ?>

    <div class="page-container" id="wrapper">

        <div class="page-content-wrapper" style="padding:30px">
            <div class ="col-md-8">
                <div class ="col-md-8">
                    <div class="col-md-3">
                        <br>
                        <?php if(empty($slider->url_image)): ?>
                            <img src="<?php echo e(URL::asset('Elegantic/images/ALS.jpg')); ?>" alt="Card image cap" style="width:100%;height:60px;">
                        <?php else: ?>
                            <img src="<?php echo e(URL::asset($slider['url_image'])); ?>" alt="Card image cap" style="width:100%;height:60px;">
                        <?php endif; ?>
                    </div>
                    <div class ="col-md-9">
                        <h3><?php echo e($slider['title']); ?></h3>
                        <h6><?php echo e(\Carbon\Carbon::parse($slider->create_at)->format('l jS \\of F Y')); ?></h6>
                    </div>
                </div>
                <div class ="col-md-12">
                    <hr class="style14">
                    <p align="justify" class="big">
                        <?php echo html_entity_decode($slider['second_title']); ?>


                    </p>
                   
                    <hr class="style14">
                    <br><br><br>

                </div>
            </div>

            <div class="col-lg-4  col-md-4 col-sm-12 hidden-sm hidden-xs">
                <div id="navWrap">
                    <nav>
                        <div class ="fixedpositiion">
                            <!--Recent Schedule -->
                            <?php echo $__env->make('user.layouts.schedule', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <!--Links -->
                            <?php echo $__env->make('user.layouts.aerofood_links', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </nav>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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

        $(document).scroll(function () {
            //stick nav to top of page
            var y = $(this).scrollTop();

            if (y > startPosition) {
                nav.addClass('sticky');
                if (y > stopPosition) {
					nav.css('top', stopPosition - y);
                } else {
                    nav.css('top', 0);
                }
            } else {
                nav.removeClass('sticky');
            }
        });
    </script>
    <style>
        .sticky {
            position: fixed;
        }
        p.big {
            line-height: 300%;
            font-size : 15px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
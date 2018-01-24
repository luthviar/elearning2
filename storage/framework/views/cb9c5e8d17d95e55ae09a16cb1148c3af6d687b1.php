<!doctype html>
<html lang="en">
<head>
    <title>
        <?php echo $__env->yieldContent('title'); ?>
        e-Learning Aerofood ACS
    </title>
    <!-- ********************************************** -->
    <!--                  HEAD IMPORT CSS DLL           -->
    <!-- ********************************************** -->
    <?php echo $__env->make('user.layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('header'); ?>
</head>
<body class="page-header-fixed page-full-width" id="div1">

<!-- ********************************************** -->
<!--                  NAVBAR                        -->
<!-- ********************************************** -->

<?php echo $__env->make('user.layouts.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- ********************************************** -->
<!--                  CONTENT                       -->
<!-- ********************************************** -->

<main role="main" style="background-color:#f1f1f1;">
    <?php echo $__env->yieldContent('content'); ?>


</main>

<!-- ********************************************** -->
<!--                  FOOTER                        -->
<!-- ********************************************** -->
<?php echo $__env->make('user.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<!-- ********************************************** -->
<!--                  SCRIPT                        -->
<!-- ********************************************** -->


<?php echo $__env->make('user.layouts.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <?php echo $__env->yieldContent('script'); ?>



</body>
</html>
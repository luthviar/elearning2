<!doctype html>
<html lang="en">
<head>
    <title>
        <?php echo $__env->yieldContent('title'); ?>
        Elearning Aerofood
    </title>
    <!-- ********************************************** -->
    <!--                  HEAD IMPORT CSS DLL           -->
    <!-- ********************************************** -->
    <?php echo $__env->make('user2.layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('header'); ?>
</head>
<body class="page-header-fixed page-full-width">

<!-- ********************************************** -->
<!--                  NAVBAR                        -->
<!-- ********************************************** -->

<?php echo $__env->make('user2.layouts.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- ********************************************** -->
<!--                  CONTENT                       -->
<!-- ********************************************** -->

<main role="main">
    <?php echo $__env->yieldContent('content'); ?>

        <!-- ********************************************** -->
        <!--                  FOOTER                        -->
        <!-- ********************************************** -->

        <?php echo $__env->make('user2.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</main>



<!-- ********************************************** -->
<!--                  SCRIPT                        -->
<!-- ********************************************** -->


<?php echo $__env->make('user2.layouts.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->yieldContent('script'); ?>



</body>
</html>






    
        
        
    
    
    
    
    















    






















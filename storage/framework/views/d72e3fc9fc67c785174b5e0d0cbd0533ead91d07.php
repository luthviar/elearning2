<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php echo $__env->yieldContent('title'); ?>
        Elearning Aerofood
    </title>
    <!-- ********************************************** -->
    <!--                  HEAD IMPORT CSS DLL           -->
    <!-- ********************************************** -->
    <?php echo $__env->make('admin.layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('header'); ?>
</head>
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">

    <!-- ********************************************** -->
    <!--                  NAVBAR                        -->
    <!-- ********************************************** -->
    <?php echo $__env->make('admin.layouts.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <!-- Left side column. contains the logo and sidebar -->
    <!-- ********************************************** -->
    <!--                  SIDEBAR                       -->
    <!-- ********************************************** -->
    <?php echo $__env->make('admin.layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- ********************************************** -->
    <!--                  SIDEBAR                       -->
    <!-- ********************************************** -->
    <!-- Content Header (Page header) -->
    
        
            
        
        
            
            
            
        
    


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        
        <?php
            $link = url('/');
        ?>
        <section class="content-header">
            <h1>
                <?php echo $__env->yieldContent('page-name'); ?>
            </h1>
            <ol class="breadcrumb">
        <?php for($i = 1; $i <= count(\Illuminate\Support\Facades\Request::segments()); $i++): ?>


            <?php if($i < count(\Illuminate\Support\Facades\Request::segments()) & $i > 0): ?>
                <?php $link .= "/" . \Illuminate\Support\Facades\Request::segment($i); ?>

                <li>
                    <a href="<?= $link ?>">
                        <i class="fa fa-home"></i>
                        <?php echo e(\Illuminate\Support\Facades\Request::segment($i)); ?>

                    </a>
                </li>
                    <?php echo ' <i class="fa fa-angle-right"></i> '; ?>

            <?php else: ?>
                <li class="active">
                <?php echo e(\Illuminate\Support\Facades\Request::segment($i)); ?>

                </li>
            <?php endif; ?>
        <?php endfor; ?>
            </ol>
        </section>
        

        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- /.content-wrapper -->

    <!-- ********************************************** -->
    <!--                  FOOTER                        -->
    <!-- ********************************************** -->
    <?php echo $__env->make('admin.layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<?php echo $__env->make('admin.layouts.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
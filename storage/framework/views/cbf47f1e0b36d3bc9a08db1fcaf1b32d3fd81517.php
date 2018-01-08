<?php $__env->startSection('content'); ?>

<div class="container" style="padding-top: 100px;">
  <div class="row">

    
      <?php
        function prints($print_data , $indent) {
              if ( count ($print_data['children']) > 0) {
                echo "<div class='col-xs-". (12- $indent)." col-md-". (12- $indent)." col-md-offset-".$indent." col-xs-offset-".$indent." '>
                          <div class='panel panel-success'>
                            <div class='panel-body' style='background-color: #13B795 !important; color: white;'>
                              <span class='pull-left'>
                                <strong>Modul Training Parent</strong>
                              </span>
                              <span class='pull-right'>
                                <i class='glyphicon glyphicon-chevron-down'></i>
                              </span>
                            </div>
                          </div>
                        </div>";
                foreach ( $print_data['children'] as $children) {
                  prints($children, $indent+1);
                }
              } else {
                echo "<div class='col-xs-". (12- $indent)." col-md-". (12- $indent)." col-md-offset-".$indent." col-xs-offset-".$indent." '>
                          <div class='panel panel-default'>
                            <div class='panel-body'>
                              <span class='pull-left'>
                                <strong>Modul Training Parent</strong>
                              </span>
                              <span class='pull-right' style='color: red;'>
<!--                                <a href='".url('/get_training/'.$print_data->id)."' class='btn btn-danger' >Request Access</a> <i  class='glyphicon glyphicon-remove'></i>--!>
                                <a href='".url('/get_training/'.$print_data->id)."' class='btn btn-info' > Access</a>
                                ".Session::put('child_id', $print_data->id)."
                              </span>
                            </div>
                          </div>
                        </div>";

              }

          }
          prints( $trainings , 0);
      ?>

  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
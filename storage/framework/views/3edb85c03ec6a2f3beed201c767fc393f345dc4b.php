 <?php $__env->startSection('content'); ?>
  <div style="margin-top:60px; border:none;">
    <img src="<?php echo e(url('Elegantic/images/head_banner_profil.jpg')); ?>" width="100%" style="border:none; margin:0; padding:0;">
  </div>
  <div class="container" style="padding-top: 20px; padding-bottom: 20px;  margin-top:40px; margin-bottom:20px;">

    <div class="row">
      <!--PHOTO-->
      <div class="col-md-3">
        <div align="center" style="background-color:#fff; padding:30px 0;">
          <?php if($profile['personal_data']->photo != null): ?>
            <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#change_photo" style="padding:0 !important;"><img src="<?php echo e(URL::asset($profile['personal_data']->photo)); ?>" alt="..." class="img-circle" width="100"></a> <?php else: ?>
            <a class="btn btn-lg btn-default" data-toggle="modal" data-target="#change_photo" style="padding:0 !important;"><img src="<?php echo e(URL::asset('photo/user-default.png')); ?>" alt="..." class="img-circle" width="100"></a> <?php endif; ?>
          <div style="clear:both">&nbsp;</div>
          <h3 class="green_color" style="text-transform:uppercase; margin-top:0px;"><strong><?php echo e($profile['personal_data']->name); ?></strong></h3>
          <!--<div class="badge badge-default" style="border-radius:3px !important;">POSITION</div>-->
          <div class="badge badge-default" style="border-radius:3px !important; font-size:13px !important;"><?php echo e($profile['personal_data']->position_name); ?></div>
          <h4>Aerofood ACS</h4>
        </div>
      </div>
      <!--DETAIL-->
      <div class="col-md-9" style="background-color:#fff; padding:0px 0; border:1px solid #ddd;" id="profil-content">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active" style="width: 25%; cursor: pointer;"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="text-center green_color" style="border-left:none;border-top:none; cursor: pointer;"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
          <li role="presentation" style="width: 25%;cursor: pointer;"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="text-center green_color" style="cursor: pointer;"><i class="fa fa-lock"></i>&nbsp;Account</a></li>
          <li role="presentation" style="width: 25%;cursor: pointer;"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" class="text-center green_color" style="cursor: pointer;"><i class="fa fa-user"></i>&nbsp;Training Record</a></li>
          <li role="presentation" style="width: 25%;cursor: pointer;"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" class="text-center green_color" style="cursor: pointer;"><i class="fa fa-user"></i>&nbsp;Employee Score</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <h4><b>Personal Data</b></h4>
                <table class="table">
                  <tbody>
                  <tr>
                    <td width="50%" class="text-muted">Name</td>
                    <td><?php echo e($profile['personal_data']->name); ?></td>
                  </tr>
                  <tr>
                    <td width="50%" class="text-muted">Email</td>
                    <td><?php echo e($profile['personal_data']->email); ?></td>
                  </tr>
                  <tr>
                    <td class="text-muted">Birtdate</td>
                    <td><?php echo e($profile['personal_data']->birtdate); ?></td>
                  </tr>
                  <tr>
                    <td width="50%" class="text-muted">Gender</td>
                    <?php if($profile['personal_data']->gender == 1): ?>
                      <td>Male</td>
                    <?php else: ?>
                      <td>Female</td>
                    <?php endif; ?>
                  </tr>
                  <tr>
                    <td width="50%" class="text-muted">Education</td>
                    <td><?php echo e($profile['personal_data']->education); ?></td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-xs-12 col-md-6">
                <h4><b>Employee Data</b></h4>
                <table class="table">
                  <tbody>
                  <tr>
                    <td width="50%" class="text-muted">Employee Status</td>
                    <td><?php echo e($profile['employee_data']['employee_status']->name); ?></td>
                  </tr>
                  <tr>
                    <td width="50%" class="text-muted">Years of working</td>
                    <td><?php echo e($profile['personal_data']->years_of_working); ?> years</td>
                  </tr>
                  <tr>
                    <td width="50%" class="text-muted">Division</td>
                    <td><?php echo e(isset($profile['employee_data']['division']->division_name) ? $profile['employee_data']['division']->division_name : 'No Division'); ?></td>
                  </tr>
                  <tr>
                    <td class="text-muted">Unit</td>
                    <td><?php echo e(isset($profile['employee_data']['unit']->unit_name) ? $profile['employee_data']['unit']->unit_name : 'No Unit'); ?></td>
                  </tr>
                  <tr>
                    <td width="50%" class="text-muted">Department</td>
                    <td><?php echo e(isset($profile['employee_data']['department']->department_name) ? $profile['employee_data']['department']->department_name : 'No Department'); ?></td>
                  </tr>
                  <tr>
                    <td class="text-muted">Section</td>
                    <td><?php echo e(isset($profile['employee_data']['section']->section_name) ? $profile['employee_data']['section']->section_name : 'No Section'); ?></td>
                  </tr>
                  <tr>
                    <td class="text-muted">Job Family</td>
                    <td><?php echo e(isset($profile['employee_data']['job_family']->job_family_name) ? $profile['employee_data']['job_family']->job_family_name : 'No Job Family'); ?></td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div role="tabpanel" class="tab-pane" id="profile">
            <div class="row">
              <form action="<?php echo e(url('/change_password')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="col-xs-12 col-md-6 col-md-offset-3">
                  <table class="table">
                    <tbody>
                    <tr>
                      <td width="50%">Username</td>
                      <td><?php echo e($profile['personal_data']->username); ?></td>
                    </tr>

                    <tr>
                      <td>New Password</td>
                      <td>
                        <input id="change_password" type="password" class="form-control" name="change_password" placeholder="password" required="true"><span id="change_password_msg"></span></td>
                    </tr>
                    <tr>
                      <td>Confirm Password</td>
                      <td>
                        <input id="confirm_password" type="password" class="form-control" name="confirm_password" placeholder="confirm password" required="true">
                      </td>
                    </tr>
                    </tbody>
                  </table>
                  <button type="submit" class="btn btn-success" style="width: 100%;">Change Password</button>
                </div>
              </form>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="messages">
            <div class="col-xs-12 col-md-12 text-center">
              <div class="col-xs-12 col-md-6">
                <h4>Training Included</h4>
                <h1 style="font-size: 40px"><?php echo e(count($training_record['records'])); ?></h1>
              </div>
              <div class="col-xs-12 col-md-6 green_color">
                <h4>Training Finished</h4>
                <h1 style="font-size: 40px"><?php echo e($training_record['total_finish']); ?></h1>
              </div>

              <div class="col-xs-12 col-md-12 col-lg-offset-0 text-center">
                <br/>
                <hr/>
                <?php if(count($training_record['records']) == 0): ?>
                  <tr>
                    <th scope="row">no training record</th>
                  </tr>
                <?php else: ?>
                <table class="table table-hover" id="example2">
                  <thead>
                  <tr class="text-center">
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Start At</th>
                    <th scope="col" class="text-center">Module</th>
                    <th scope="col" class="text-center">Training Title</th>
                    <th scope="col" class="text-center">Post Test Score</th>
                    <th scope="col" class="text-center">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $__currentLoopData = $training_record['records']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row"><?php echo e(++$key); ?></th>
                      <th scope="row"><?php echo e($record['module']->date); ?></th>
                      <td>
                        <a href="<?php echo e(url('/get_training',  $record['module_parent']->id)); ?>">
                          <?php echo e($record['module_parent']->modul_name); ?>

                        </a>
                      </td>
                      <td>
                        <a href="<?php echo e(url('/get_training',  $record['module']->id)); ?>">
                          <?php echo e($record['module']->modul_name); ?>

                        </a>
                      </td>
                      <td>
                        <?php echo e($record['post_test']); ?>


                      </td>
                      <td><?php echo e($record['status']); ?></td>


                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>

                  </tbody>
                </table>

              </div>
            </div>

          </div>
          <div role="tabpanel" class="tab-pane" id="settings">
            <div class="row text-center">
              <div class="col-lg-8 col-lg-offset-2">
                <?php if($scores->count() > 0): ?> <?php $__currentLoopData = $scores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $score): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                <a
                        class="btn btn-block btn-default btn-lg"
                        onclick="window.open('<?php echo e(URL::asset($score->attachment_url)); ?>',width='+screen.availWidth+',
                                height='+screen.availHeight')"
                        style="cursor:pointer; text-decoration: none;"

                >
                  <?php echo e($score->attachment_name); ?> <br/>
                  <small><b>published: <?php echo e($score->created_at->diffForHumans()); ?></b></small>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <a
                          class="btn btn-block btn-default btn-lg"
                          style="cursor:pointer; text-decoration: none;"
                  >
                    No Score
                  </a>
                <?php endif; ?>
              </div>


            </div>
          </div>
        </div>

      </div>
      <!--END DETAIL-->


    </div>
  </div>
  <br>


  <!-- MODAL CHANGE PHOTO -->
  <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="change_photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="post" action="<?php echo e(url('/change_photo')); ?>" enctype="multipart/form-data">
          <?php echo e(csrf_field()); ?>

          <input type="hidden" name="id_user" value="<?php echo e($profile['personal_data']->id); ?>">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Change Photo</h4>
          </div>
          <div class="modal-body text-center">
            <div class="text-center">
              <?php if($profile['personal_data']->photo == null): ?>
                <img id="img_prev" src="<?php echo e(URL::asset('photo/user-default.png')); ?>" style="width: 35%; height: 200px;"> <?php else: ?>
                <img id="img_prev" src="<?php echo e(URL::asset($profile['personal_data']->photo)); ?>" style="width: 35%; height: 200px;"> <?php endif; ?>
            </div>
            <!-- Image -->
            <div class="form-group">
              <label for="exampleInputFile">Profile</label>
              <input type="file" id="img" name="image" accept="image/*">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?> <?php $__env->startSection('script'); ?>
  <script type="text/javascript">
      $(document).ready(function() {
          $('iframe').ready(function() {
              setTimeout(function() {
                  $('iframe').contents().find('#download').remove();
              }, 100);
          });
      });

  </script>
  <script type="text/javascript">
      function readURL(input) {


          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
                  $('#img_prev').attr('src', e.target.result);
              }

              reader.readAsDataURL(input.files[0]);
          }
      }

      $("#img").change(function() {
          readURL(this);
      });

  </script>

  <script type="text/javascript">
      $('#example2').DataTable({
          autoWidth: true,
          "processing": true,
          "serverSide": false,
          "deferRender": true,
          order: [[ 0, "asc" ]]
      });
      $(".select2").select2();

  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
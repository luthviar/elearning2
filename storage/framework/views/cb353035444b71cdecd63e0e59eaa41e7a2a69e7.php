<?php $__env->startSection('content'); ?>

  <div class="container" style="padding-top: 100px; padding-bottom: 100px;">
    <div class="col-xs-12 col-md-12 text center" style="height: 230px;text-align: center; border-bottom: 1px solid green;">
      <img src="<?php echo e(URL::asset('gambar.png')); ?>" alt="..." style="height: 58%; border: 1px solid green;" class="img-circle">
      <h3 class="green_color"><strong><?php echo e($profile['personal_data']->name); ?></strong></h3>
      <h4>Department Human Capital . Aerofood ACS Head Office</h4>
    </div>
    <div class="col-xs-12 col-md-12" style="padding-top: 10px;">

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active" style="width: 25%;"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="text-center green_color">Profile</a></li>
        <li role="presentation" style="width: 25%;"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="text-center green_color">Account</a></li>
        <li role="presentation" style="width: 25%;"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" class="text-center green_color">Training Record</a></li>
        <li role="presentation" style="width: 25%;"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" class="text-center green_color">Employee Score</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
          <div class="col-xs-12 col-md-6">
            <h4>Personal Data</h4>
            <table class="table">
              <tbody>
              <tr>
                <td width="50%">Name</td>
                <td><?php echo e($profile['personal_data']->name); ?></td>
              </tr>
              <tr>
                <td width="50%">Email</td>
                <td><?php echo e($profile['personal_data']->email); ?></td>
              </tr>
              <tr>
                <td>Birtdate</td>
                <td><?php echo e($profile['personal_data']->birtdate); ?></td>
              </tr>
              <tr>
                <td width="50%">Age</td>
                <td><?php echo e($profile['personal_data']->age); ?></td>
              </tr>
              <tr>
                <td width="50%">Education</td>
                <td><?php echo e($profile['personal_data']->education); ?></td>
              </tr>
              </tbody>
            </table>
          </div>
          <div class="col-xs-12 col-md-6">
            <h4>Employee Data</h4>
            <table class="table">
              <tbody>
              <tr>
                <td width="50%">Employee Status</td>
                <td><?php echo e($profile['employee_data']['employee_status']->name); ?></td>
              </tr>
              <tr>
                <td width="50%">Years of working</td>
                <td><?php echo e($profile['personal_data']->years_of_working); ?> years</td>
              </tr>
              <tr>
                <td width="50%">Division</td>
                <td><?php echo e(isset($profile['employee_data']['division']->division_name) ? $profile['employee_data']['division']->division_name : null); ?></td>
              </tr>
              <tr>
                <td>Unit</td>
                <td><?php echo e(isset($profile['employee_data']['unit']->unit_name) ? $profile['employee_data']['unit']->unit_name : null); ?></td>
              </tr>
              <tr>
                <td width="50%">Department</td>
                <td><?php echo e(isset($profile['employee_data']['department']->department_name) ? $profile['employee_data']['department']->department_name : null); ?></td>
              </tr>
              <tr>
                <td>Section</td>
                <td><?php echo e(isset($profile['employee_data']['section']->section_name) ? $profile['employee_data']['section']->section_name : null); ?></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="profile">
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
                    <input id="change_password" type="password" class="form-control" name="change_password" placeholder="password" required="true" ><span id="change_password_msg"></span></td>
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

            <div class="col-xs-6 col-md-6 col-lg-offset-3 text-center">

              <table class="table table-hover">
                <thead>
                <tr class="text-center">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Training Title</th>
                  <th scope="col" class="text-center">Status</th>

                </tr>
                </thead>
                <tbody>
                <?php if(count($training_record['records']) == 0): ?>
                  <tr>
                    <th scope="row">no training record</th>
                  </tr>
                <?php else: ?> <?php $__currentLoopData = $training_record['records']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <th scope="row"><?php echo e(++$key); ?></th>
                    <td><a href="<?php echo e(url('/get_training',  $record['module']->id)); ?>"><?php echo e($record['module']->modul_name); ?></a></td>
                    <td><?php echo e($record['status']); ?></td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>

                </tbody>
              </table>

            </div>
          </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="settings">
          <div class="container text-center">
            <iframe id="iframe" src="<?php echo e(URL::to('/ViewerJS/index.html#../files/situs.pdf')); ?>" width='100%' height='600' allowfullscreen webkitallowfullscreen>
            </iframe>
          </div>
        </div>
      </div>

    </div>
  </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
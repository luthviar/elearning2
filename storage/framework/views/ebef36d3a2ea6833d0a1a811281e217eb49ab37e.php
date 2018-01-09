<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('/personnel')); ?>">Personnel</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo e(URL::asset('AdminLTE/dist/img/user4-128x128.jpg')); ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo e($profile['personal_data']->name); ?></h3>

              <p class="text-muted text-center"><?php echo e($profile['personal_data']->position_name); ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                	<?php if($profile['personal_data']->role == 1): ?>
                  	<b>Role</b> <a class="pull-right">Administrator</a>
                  	<?php else: ?>
                  	<b>Role</b> <a class="pull-right">User</a>
                  	<?php endif; ?>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo e($profile['personal_data']->email); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Level</b> <a class="pull-right"><?php echo e($profile['level']->nama_level); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Employee Status</b> <a class="pull-right"><?php echo e($profile['employee_data']['employee_status']->name); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Birtdate</b> <a class="pull-right"><?php echo e($profile['personal_data']->birtdate); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Education</b> <a class="pull-right"><?php echo e($profile['personal_data']->education); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Date Join</b> <a class="pull-right"><?php echo e($profile['personal_data']->date_join_acs); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Division</b> <a class="pull-right"><?php echo e(isset($profile['employee_data']['division']->division_name) ? $profile['employee_data']['division']->division_name : null); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Unit</b> <a class="pull-right"><?php echo e(isset($profile['employee_data']['unit']->unit_name) ? $profile['employee_data']['unit']->unit_name : null); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Department</b> <a class="pull-right"><?php echo e(isset($profile['employee_data']['department']->department_name) ? $profile['employee_data']['department']->department_name : null); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Section</b> <a class="pull-right"><?php echo e(isset($profile['employee_data']['section']->section_name) ? $profile['employee_data']['section']->section_name : null); ?></a>
                </li>
                <li class="list-group-item">
                <?php if($profile['personal_data']->flag_active == 1): ?>
                  <b>Status</b> <a class="pull-right">Active</a>
                 <?php else: ?>
                  <b>Status</b> <a class="pull-right">Non-Active</a>
                 <?php endif; ?>
                </li>
              </ul>
              <?php if($profile['personal_data']->flag_active == 1): ?>
              <a href="#" class="btn btn-danger btn-block"><b>Non-Activate</b></a>
              <?php else: ?>
              <a href="#" class="btn btn-success btn-block"><b>Activate</b></a>
              <?php endif; ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Training Record</a></li>
              <li><a href="#timeline" data-toggle="tab">Employee Score</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
		          <div class="box">
		            <div class="box-header">
		              <h3 class="box-title">Training Record Data</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <table id="record" class="table table-bordered table-striped">
		                <thead>

		                <tr>
		                  <th>No</th>
		                  <th>Training</th>
		                  <th>Status</th>
		                  <th>See Record</th>
		                </tr>
		                </thead>
		                <tbody>
		                <?php $__currentLoopData = $training_record['records']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <tr>
		                	<td><?php echo e($key+1); ?></td>
		                	<td><?php echo e($record['module']->modul_name); ?></td>
		                	<td><?php echo e($record['status']); ?></td>
		                	<td>1</td>
		                </tr>
		                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
		                </tbody>
		              </table>
		            </div>
		            <!-- /.box-body -->
		          </div>
		          <!-- /.box -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <div class="box">
		            <div class="box-header">
		              <h3 class="box-title">Employee Score</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <table id="score" class="table table-bordered table-striped">
		                <thead>
		                <tr>
		                  <th>No</th>
		                  <th>Score file</th>
		                  <th>Date</th>
		                </tr>
		                </thead>
		                <tbody>
		                <?php $__currentLoopData = $employee_record; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <tr>
		                	<td><?php echo e($key+1); ?></td>
		                	<td><a href="<?php echo e($record->attachment_url); ?>"><?php echo e($record->attachment_name); ?></a></td>
		                	<td><?php echo e($record->created_at); ?></td>
		                </tr>	
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                </tbody>
		              </table>
		            </div>
		            <!-- /.box-body -->
		          </div>
		          <!-- /.box -->
              </div>
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
  $(function () {
    $("#record").DataTable();
    $('#score').DataTable();
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('page-name'); ?>
    <a href="<?php echo e(url(action('UserController@personnel_list'))); ?>">
        <i class="fa fa-arrow-left"></i>
    </a>
    Personnel View
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo e(URL::asset('photo/user-default.png')); ?>" alt="User profile picture">

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
              <a href="<?php echo e(url(action('UserController@edit_personnel',$profile['personal_data']->id))); ?>"
                 class="btn btn-info btn-block"><b>Edit Personnel</b></a>
              <?php if($profile['personal_data']->flag_active == 1): ?>
              <a href="<?php echo e(url('admin/personnel/nonactivate',$profile['personal_data']->id)); ?>" class="btn btn-danger btn-block"><b>Non-Activate</b></a>
              <?php else: ?>
              <a href="<?php echo e(url('admin/personnel/activate',$profile['personal_data']->id)); ?>" class="btn btn-success btn-block"><b>Activate</b></a>
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
		                	<td><span><a href="<?php echo e(url('admin/personnel/'.$profile['personal_data']->id.'/training/'.$record['module']->id)); ?>"><i class="fa fa-eye" style="color: blue;" aria-hidden="true">see_record</i></a></span></td>
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
		              <h3 class="box-title">Employee Score</h3> <span class="pull-right"><a href="#" data-toggle="modal" data-target="#add_score"><i style="color:green;" class="fa fa-plus" aria-hidden="true">add_score</i></a></span>
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
		                	<td><a href="<?php echo e(URL::asset($record->attachment_url)); ?>"><?php echo e($record->attachment_name); ?></a></td>
		                	<td><?php echo e(date('j M Y',strtotime($record->created_at))); ?></td>
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

<div class="modal fade" id="add_score" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?php echo e(url('admin/personnel/add_score')); ?>" method="post" enctype="multipart/form-data">
        

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add <strong><?php echo e($profile['personal_data']->name); ?></strong> Score</h4>
      </div>
      <div class="modal-body">
      <?php echo e(csrf_field()); ?>

          <input type="hidden" name="id_user" value="<?php echo e($profile['personal_data']->id); ?>">
          <!-- Name -->
          <div class="form-group col-md-12">
            <label>Attachment Name:</label>
            <div class="input-group col-md-12">
              <input type="text" style="width: 100%" class="form-control" name="attachment_name"  placeholder="attachment name">
            </div>
          </div>
          <!-- Score -->
          <div class="form-group">
              <label for="exampleInputFile">Score File</label>
              <input type="file" name="score" accept=".pdf">
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


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
  $(function () {
    $("#record").DataTable();
    $('#score').DataTable();
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('page-name'); ?>
    <a href="<?php echo e(url(action('UserController@personnel_list'))); ?>">
        <i class="fa fa-arrow-left"></i>
    </a>
    Personnel View
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <style>
        dt{
            width: 40% !important;
        }
        dd{
            margin-left: 50% !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <?php if(Session::get('success') != null): ?>
            <div class="row">
                <div class="col-lg-12">
                    <hr/>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                        <?php echo e(Session::get('success')); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>

            <?php if(Session::get('failed') != null): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <hr/>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Gagal!</h4>
                            <?php echo e(Session::get('failed')); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-solid">
              <div class="box-header with-border">
                  <?php if($profile['personal_data']->photo == null): ?>
                      <img class="profile-user-img img-responsive img-circle"
                           src="<?php echo e(URL::asset('photo/user-default.png')); ?>" alt="User profile picture">
                  <?php else: ?>
                      <img class="profile-user-img img-responsive img-circle"
                           src="<?php echo e(URL::asset($profile['personal_data']->photo)); ?>" alt="User profile picture">
                  <?php endif; ?>

                  <h3 class="profile-username text-center"><?php echo e($profile['personal_data']->name); ?></h3>

                  <p class="text-muted text-center"><?php echo e($profile['personal_data']->position_name); ?></p>
              </div>

              <div class="box-body">
                  <dl class="dl-horizontal">
                  <?php if($profile['personal_data']->role == 1): ?>
                      <dt>
                          <b>Role</b>
                      <dd>
                          <a>Administrator</a>
                      </dd>
                  <?php else: ?>
                      <dt>
                          <b>Role</b>
                      <dd>
                          <a>User</a>
                      </dd>
                  <?php endif; ?>
                      <dt>
                          <b>Email</b>
                      </dt>
                      <dd>
                          <a ><?php echo e($profile['personal_data']->email); ?></a>
                      </dd>
                      <dt>
                          <b>Level</b>
                      </dt>
                      <dd>
                          <a ><?php echo e($profile['level']->nama_level); ?></a>
                      </dd>
                      <dt>
                          <b>Employee Status</b>
                      </dt>
                      <dd>
                          <a ><?php echo e($profile['employee_data']['employee_status']->name); ?></a>
                      </dd>
                      <dt>
                          <b>Birtdate</b>
                      </dt>
                      <dd>
                          <a ><?php echo e($profile['personal_data']->birtdate); ?></a>
                      </dd>
                      <dt>
                          <b>Education</b>
                      </dt>
                      <dd>
                          <a ><?php echo e($profile['personal_data']->education); ?></a>
                      </dd>
                      <dt>
                          <b>Date Join</b>
                      </dt>
                      <dd>
                          <a ><?php echo e($profile['personal_data']->date_join_acs); ?></a>
                      </dd>
                      <dt>
                          <b>Division</b>
                      </dt>
                      <dd>
                          <a ><?php echo e(isset($profile['employee_data']['division']->division_name) ? $profile['employee_data']['division']->division_name : null); ?></a>
                      </dd>
                      <dt>
                          <b>Unit</b>
                      </dt>
                      <dd>
                          <a ><?php echo e(isset($profile['employee_data']['unit']->unit_name) ? $profile['employee_data']['unit']->unit_name : null); ?></a>
                      </dd>
                      <dt>
                          <b>Department</b>
                      </dt>
                      <dd>
                          <a ><?php echo e(isset($profile['employee_data']['department']->department_name) ? $profile['employee_data']['department']->department_name : null); ?></a>
                      </dd>
                      <dt>
                          <b>Section</b>
                      </dt>
                      <dd>
                          <a ><?php echo e(isset($profile['employee_data']['section']->section_name) ? $profile['employee_data']['section']->section_name : null); ?></a>
                      </dd>

                  <?php if($profile['personal_data']->flag_active == 1): ?>
                      <dt>
                          <b>Status</b>
                      </dt>
                      <dd>
                          <a >Active</a>
                      </dd>
                  <?php else: ?>
                      <dt>
                          <b>Status</b>
                      </dt>
                      <dd>
                          <a >Non-Active</a>
                      </dd>
                  <?php endif; ?>

                  </dl>
                  <a href="<?php echo e(url(action('UserController@edit_personnel',$profile['personal_data']->id))); ?>"
                     class="btn btn-info btn-block">
                      <b>Edit Personnel</b>
                  </a>
                  <?php if($profile['personal_data']->flag_active == 1): ?>

                      <a href="<?php echo e(url(action('UserController@nonactivate',$profile['personal_data']->id))); ?>"
                         class="btn btn-danger btn-block">
                          <b>Non-Activate</b>
                      </a>
                  <?php else: ?>

                      <a href="<?php echo e(url(action('UserController@activate',$profile['personal_data']->id))); ?>"
                         class="btn btn-success btn-block">
                          <b>Activate</b>
                      </a>
                  <?php endif; ?>

              </div>
            <!-- /.box-body -->
          <!-- /.box -->

          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-8">
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
		                  <th>See Records</th>
		                </tr>
		                </thead>
		                <tbody>
		                <?php $__currentLoopData = $training_record['records']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <tr>
		                	<td><?php echo e($key+1); ?></td>
		                	<td><?php echo e($record['module']->modul_name); ?></td>
		                	<td><?php echo e($record['status']); ?></td>
		                	<td>
                                <span>
                                    <a href="<?php echo e(url('admin/personnel/'.$profile['personal_data']->id.'/training/'.$record['module']->id)); ?>">
                                        <i class="fa fa-eye" style="color: blue;" aria-hidden="true"></i>
                                        see record
                                    </a>
                                </span>
                            </td>
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
		              <h3 class="box-title">Employee Score</h3> <span class="pull-right"><a href="#" data-toggle="modal" data-target="#add_score"><i style="color:green;" class="fa fa-plus" aria-hidden="true"></i>Add Score</a></span>
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
		                	<td>
                                <a
                                    onclick="window.open('<?php echo e(URL::asset($record->attachment_url)); ?>',width='+screen.availWidth+',
                                            height='+screen.availHeight')"
                                    style="cursor:pointer;"
                                >
                                    <?php echo e($record->attachment_name); ?>

                                </a>
                            </td>
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
      <form action="<?php echo e(url(action('UserController@add_score'))); ?>" method="post" enctype="multipart/form-data">


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
              
              <input type="file" name="score" id="my_file_score" value="" accept=".pdf">
              <textarea type="text" id="base64" name="encoded_file_score" cols="50" hidden></textarea>
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

<script>
    document.getElementById('my_file_score').addEventListener('change', function(event){

        var input = document.getElementById("my_file_score");

        var fReader = new FileReader();
        fReader.readAsDataURL(input.files[0]);
        fReader.onloadend = function(event){
            document.getElementById("base64").innerHTML = event.target.result;
            console.log(event.target.result);

        }
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
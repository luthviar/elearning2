<?php $__env->startSection('page-name'); ?>
    <a href="<?php echo e(url(action('UserController@profile_view',$user->id))); ?>">
        <i class="fa fa-arrow-left"></i>
    </a>
    Edit Personnel - <?php echo e($user->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



    <form action="<?php echo e(url('admin/personnel/edit')); ?>" method="post">
      
      <?php echo e(csrf_field()); ?>


      <input type="hidden" name="id_user" value="<?php echo e($user->id); ?>">
    

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-6">
      

      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Personal Information</h3>
            </div>
            <div class="box-body">

                <div class="row">
                    <!-- Username -->
                    <div class="form-group col-md-6">
                        <label>
                            Username*: (NIP)
                            <i class="fa fa-question-circle"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="username merupakan NIP karyawan."
                            ></i>
                        </label>
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" name="username" value="<?php echo e($user->username); ?>" placeholder="username" required>
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="form-group col-md-6">
                        <label>
                            Password:
                            <i class="fa fa-question-circle"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Isi untuk mengupdate password lama user"
                            ></i>
                        </label>
                        <div class="input-group">
                            <span class="input-group-addon">**</span>
                            <input type="password" name="password" class="form-control" placeholder="New Password"">
                        </div>
                        <p class="small" style="color:red;">Leave the password field empty will be used the old password</p>
                    </div>
                </div>

              <!-- name -->
              <div class="form-group">
                <label>Name*:</label>
                <div class="input-group">
                 <span class="input-group-addon">
                      <i class="fa fa-address-book"></i>
                  </span>
                  <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>" placeholder="name" required>
                </div>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label>Email*:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" value="<?php echo e($user->email); ?>" placeholder="email" required>
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group">
                <label>Gender*:</label>
                <select class="form-control" name="gender" style="width: 100%;">
                  <?php if($user->gender == 1): ?>
                  <option value="1" selected="true">male</option>
                  <option value="0">female</option>
                  <?php else: ?>
                  <option value="1">male</option>
                  <option value="0" selected="true">female</option>
                  <?php endif; ?>
                </select>
              </div>


              <!-- Date -->
              <div class="form-group">
                <label>Birth Date*:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="birtdate" value="<?php echo e($user->birtdate); ?>" placeholder="birtdate"
                         class="form-control pull-right datepicker"required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Education -->
              <div class="form-group">
                  <label>
                      Education*:
                      <i class="fa fa-question-circle"
                         data-toggle="tooltip"
                         data-placement="top"
                         title="Lulusan terakhir karyawan, contoh: S1, SMA, S2, dll"
                      ></i>
                  </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-institution"></i></span>
                  <input type="text" name="education" value="<?php echo e($user->education); ?>" class="form-control" placeholder="education"required>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
      

      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Employee Information</h3>
            </div>
            <div class="box-body">
              <!-- Date -->
              <div class="form-group">
                <label>Date Join ACS*:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="date_join_acs" value="<?php echo e($user->date_join_acs); ?>"
                         placeholder="date join acs" class="form-control pull-right datepicker" required>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Position name -->
              <div class="form-group">
                  <label>Position Name*:</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                  <input type="text" name="position" value="<?php echo e($user->position_name); ?>" class="form-control" placeholder="position" required>
                </div>
              </div>

              <!-- Employee Status -->
              <div class="form-group">
                <label>Employee Status*:</label>
                <select class="form-control select3" name="id_employee_status" style="width: 100%;">
                  <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp_stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($emp_stat->id == $user->id_employee_status): ?>
                  <option value="<?php echo e($emp_stat->id); ?>" selected="true"><?php echo e($emp_stat->name); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($emp_stat->id); ?>"><?php echo e($emp_stat->name); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>

              
              <!-- /.form-group -->
                <div class="row">
              <div class="form-group col-md-6 col-xs-6">
                <label>Level of Position*:</label>
                <select class="form-control select2" name="level_position" style="width: 100%;"  required>
                  <?php $__currentLoopData = $level_position; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($level->id == $user->position): ?>
                  <option value="<?php echo e($level->id); ?>" selected="true"><?php echo e($level->nama_level); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($level->id); ?>"><?php echo e($level->nama_level); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>

               <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Role*:</label>
                <select class="form-control select2" name="role" style="width: 100%;">
                  <?php if($user->role == 1): ?>
                  <option value="0">User</option>
                  <option value="1" selected="true">Administrator</option>
                  <?php else: ?>
                  <option value="0" selected="true">User</option>
                  <option value="1">Administrator</option>
                  <?php endif; ?>
                </select>
              </div>
              <!-- /.form-group -->



                <div class="form-group col-md-12">
                    <hr/>
                    <h5 style="color: orangered;" class="text-center">
                        Pilih Divisi, Unit dan Department dari Database.
                        Jika tidak ada, maka Anda dapat menginput sendiri pada input text.
                    </h5>
                </div>
                <!-- Division -->
              <div class="form-group col-md-6">
                <label>Division : </label>
                <select class="form-control select3" name="division" id="division" style="width: 100%;">
                  <option value="0" >-- Choose --</option>
                  <?php if($user['org_structure'] != null): ?>
                    <?php $__currentLoopData = $division; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $div): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($user['org_structure']->id_division == $div->id): ?>
                      <option value="<?php echo e($div->id); ?>" selected="true"><?php echo e($div->division_name); ?></option>
                      <?php else: ?>
                      <option value="<?php echo e($div->id); ?>"><?php echo e($div->division_name); ?></option>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <?php $__currentLoopData = $division; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $div): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($div->id); ?>"><?php echo e($div->division_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?> 
                  
                </select>
              </div>



              <div class="form-group col-md-6">
                <label>Division Input :</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                      <input type="text" name="division_input" class="form-control" placeholder="division">           
                  </div>
              </div>

              <div class="form-group col-md-6">
                <label>Unit : </label>
                <select class="form-control select3" name="unit" id="unit" style="width: 100%;">
                  <option value="0" >-- Choose --</option>
                  <?php if($user['org_structure'] != null): ?>
                    <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($user['org_structure']->id_unit == $unt->id): ?>
                     <option value="<?php echo e($unt->id); ?>" selected="true"><?php echo e($unt->unit_name); ?></option>
                      <?php else: ?>
                      <option value="<?php echo e($unt->id); ?>"><?php echo e($unt->unit_name); ?></option>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                  <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($unt->id); ?>"><?php echo e($unt->unit_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                  
                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Unit Input :</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                      <input type="text" name="unit_input" class="form-control" placeholder="unit">           
                  </div>
              </div>

              <!-- Department name -->

              <div class="form-group col-md-6">
                <label>Department : </label>
                <select class="form-control select3" name="department" id="department" style="width: 100%;">
                  <option value="0" >-- Choose --</option>
                  <?php if($user['org_structure'] != null): ?>
                    <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($user['org_structure']->id_department == $deps->id): ?>
                      <option value="<?php echo e($deps->id); ?>" selected="true"><?php echo e($deps->department_name); ?></option>
                      <?php else: ?>
                        <option value="<?php echo e($deps->id); ?>" selected="true"><?php echo e($deps->department_name); ?></option>
                      <?php endif; ?>  
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($deps->id); ?>" selected="true"><?php echo e($deps->department_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                  
                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Department Input :</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                      <input type="text" name="department_input" class="form-control" placeholder="division">           
                  </div>
              </div>

              <div class="form-group col-md-6">
                <label>Section: </label>
                <select class="form-control select3" name="section" id="section" style="width: 100%;">
                  <option value="0" >-- Choose --</option>
                  <?php if($user['org_structure'] != null): ?>
                    <?php $__currentLoopData = $section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($user['org_structure']->id_section == $sec->id): ?>
                    <option value="<?php echo e($sec->id); ?>" selected="true"><?php echo e($sec->section_name); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($sec->id); ?>" ><?php echo e($sec->section_name); ?></option>  
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                    <?php $__currentLoopData = $section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($sec->id); ?>" ><?php echo e($sec->section_name); ?></option>  
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                  
                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Section Input:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                      <input type="text" name="section_input" class="form-control" placeholder="section">           
                  </div>
              </div>


              <!-- /.form-group -->
              <div class="form-group col-md-12">
                <label>Job Family</label>
                <select class="form-control select3" name="job_family" id="division" style="width: 100%;">
                  <?php $__currentLoopData = $job_family; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $family): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(!empty($job_family_user) and $family->id == $job_family_user->id): ?>
                  <option value="<?php echo e($family->id); ?>" selected="true" ><?php echo e($family->job_family_name); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($family->id); ?>" ><?php echo e($family->job_family_name); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
             

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
    </div>


    </div>

        <div class="row text-center">
            <div class="col-lg-12">
                <button class="btn btn-block btn-info">Update Personnel</button>
            </div>
        </div>
    </section>
    <!-- /.content -->

    </form>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


<script>

  $(function () {
    //Initialize Select2 Elements
$(".select2").select2({
  tags: true,
  createTag: function (params) {
    return {
      id: params.term,
      text: params.term,
      newOption: true
    }
  },
   templateResult: function (data) {
    var $result = $("<span></span>");

    $result.text(data.text);

    if (data.newOption) {
      $result.append(" <em>(new)</em>");
    }

    return $result;
  }
});
      $(".select3").select2({
          tags: false,
          createTag: function (params) {
              return {
                  id: params.term,
                  text: params.term
              }
          }
      });

	
    //Date picker
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });

  });

</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
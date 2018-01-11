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

              <!-- Username -->
              <div class="form-group col-md-6">
                <label>Username:</label>
                <div class="input-group">
                  <span class="input-group-addon">@</span>
                  <input type="text" class="form-control" name="username" value="<?php echo e($user->username); ?>" placeholder="username">
                </div>
              </div>

              <!-- Password -->
              <div class="form-group col-md-6">
                <label>Password:</label>
                <div class="input-group">
                  <span class="input-group-addon">**</span>
                  <input type="password" name="password" class="form-control" placeholder="new_password">
                </div>
              </div>

              <!-- name -->
              <div class="form-group">
                <label>Name:</label>
                <div class="input-group">
                  <span class="input-group-addon">@</span>
                  <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>" placeholder="name">
                </div>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label>Email:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" value="<?php echo e($user->email); ?>" placeholder="email">
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group">
                <label>Gender:</label>
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
                <label>Birtdate:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="birtdate" value="<?php echo e($user->birtdate); ?>" placeholder="birtdate" class="form-control pull-right datepicker" >
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Email -->
              <div class="form-group">
                <label>Education:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" name="education" value="<?php echo e($user->education); ?>" class="form-control" placeholder="education">
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
                <label>Date Join ACS:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="date_join_acs" value="<?php echo e($user->date_join_acs); ?>" placeholder="date join acs" class="form-control pull-right datepicker" >
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Email -->
              <div class="form-group">
                <label>Position:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" name="position" value="<?php echo e($user->position_name); ?>" class="form-control" placeholder="position">
                </div>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label>Employee Status:</label>
                <select class="form-control select2" name="id_employee_status" style="width: 100%;">
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
              <div class="form-group col-md-6 col-xs-6">
                <label>Level Position</label>
                <select class="form-control select2" name="level_position" style="width: 100%;">
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
                <label>Role</label>
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

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Division</label>
                <select class="form-control" name="division" id="division" style="width: 100%;">
                  <?php $__currentLoopData = $division; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $div): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($user['org_structure']->id_division == $div->id): ?>
                  <option value="<?php echo e($div->id); ?>" selected="true" ><?php echo e($div->division_name); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($div->id); ?>" ><?php echo e($div->division_name); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Unit</label>
                <select class="form-control" name="unit" id="unit" style="width: 100%;">
                  <?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($user['org_structure']->id_unit == $unt->id): ?>
                  <option value="<?php echo e($unt->id); ?>" selected="true" ><?php echo e($unt->unit_name); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($unt->id); ?>" ><?php echo e($unt->unit_name); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </select>
              </div>

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Department</label>
                <select class="form-control" name="department" id="department" style="width: 100%;">
                  <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($user['org_structure']->id_department == $deps->id): ?>
                  <option value="<?php echo e($deps->id); ?>" selected="true" ><?php echo e($deps->department_name); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($deps->id); ?>" ><?php echo e($deps->department_name); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Section</label>
                <select class="form-control" name="section" id="section" style="width: 100%;">
                  <?php $__currentLoopData = $section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($user['org_structure']->id_section == $sec->id): ?>
                  <option value="<?php echo e($sec->id); ?>" selected="true" ><?php echo e($sec->section_name); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($sec->id); ?>" ><?php echo e($sec->section_name); ?></option>
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
    <div class="row text-center">
      <button class="btn btn-success">submit</button>
    </div>


    </section>
    <!-- /.content -->

    </form>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">

    $('#division').click(function() {
      var id_division = $('#division').val();
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('get_unit')); ?>",
        dataType: 'json',
        data:{id_division:id_division,_token: '<?php echo e(csrf_token()); ?>'},
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function(units) {
            var html = '';
            $.each(units.units, function(key, value){
                html += '<option value="'+value.id+'">'+value.unit_name+'</option>';               
                
            });
            $('#unit').html(html);        
            
            
        },
        error: function(data){
            console.log(data);
        },
      });
      
    });

</script>
<script type="text/javascript">

    $('#unit').click(function() {
      var id_division = $('#division').val();
      var id_unit = $('#unit').val();
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('get_department')); ?>",
        dataType: 'json',
        data:{id_division:id_division,id_unit:id_unit,_token: '<?php echo e(csrf_token()); ?>'},
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function(departments) {
            var html = '';
            $.each(departments.departments, function(key, value){
                html += '<option value="'+value.id+'">'+value.department_name+'</option>';               
                
            });
            $('#department').html(html);        
            
            
        },
        error: function(data){
            console.log(data);
        },
      });
      
    });

</script>
<script type="text/javascript">

    $('#department').click(function() {
      var id_division = $('#division').val();
      var id_unit = $('#unit').val();
      var id_department = $('#department').val();
      $.ajax({
        type:"POST",
        url:"<?php echo e(url('get_section')); ?>",
        dataType: 'json',
        data:{id_division:id_division,id_unit:id_unit,id_department:id_department,_token: '<?php echo e(csrf_token()); ?>'},
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function(sections) {
            var html = '';
            $.each(sections.sections, function(key, value){
                html += '<option value="'+value.id+'">'+value.section_name+'</option>';               
                
            });
            $('#section').html(html);        
            
            
        },
        error: function(data){
            console.log(data);
        },
      });
      
    });

</script>
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

	
    //Date picker
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });

  });

</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
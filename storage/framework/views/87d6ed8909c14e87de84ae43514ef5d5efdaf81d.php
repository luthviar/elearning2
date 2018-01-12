<?php $__env->startSection('page-name'); ?>
Add Personnel
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <form action="<?php echo e(url(action('UserController@user_add_submit'))); ?>" method="post">
      
      <?php echo e(csrf_field()); ?>

    

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
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Username:
                    </label>
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" class="form-control" name="username" placeholder="username">
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group col-md-6">
                    <label>Password:</label>
                    <div class="input-group">
                        <span class="input-group-addon">**</span>
                        <input type="password" name="password" class="form-control" placeholder="password">
                    </div>
                </div>
            </div>


              <!-- name -->
              <div class="form-group">
                <label>Name:</label>
                <div class="input-group">
                  <span class="input-group-addon">
                      <i class="fa fa-address-book"></i>
                  </span>
                  <input type="text" class="form-control" name="name" placeholder="name">
                </div>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label>Email:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" placeholder="email">
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group">
                <label>Gender:</label>
                <select class="form-control" name="gender" style="width: 100%;">
                  <option value="1">male</option>
                  <option value="0">female</option>
                </select>
              </div>


              <!-- Date -->
              <div class="form-group">
                <label>Birtdate:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="birtdate" placeholder="birtdate" class="form-control pull-right datepicker" >
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Education -->
              <div class="form-group">
                <label>
                    Education:
                    <i class="fa fa-question-circle"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="Lulusan terakhir karyawan, contoh: S1, SMA, S2, dll"
                    ></i>
                </label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-institution"></i></span>
                  <input type="text" name="education" class="form-control" placeholder="education">
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
                  <input type="text" name="date_join_acs" placeholder="date join acs" class="form-control pull-right datepicker" >
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Position name -->
              <div class="form-group">
                <label>Position Name:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                  <input type="text" name="position" class="form-control" placeholder="position">
                </div>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label>Employee Status:</label>
                  <div class="input-group col-lg-12">
                <select class="form-control select2" name="id_employee_status" style="width: 100%;">
                  <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp_stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($emp_stat->id); ?>"><?php echo e($emp_stat->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                  </div>
              </div>

              
              <!-- /.form-group -->
                <div class="row">
                  <div class="form-group col-md-6 col-xs-6">
                    <label>Level of Position</label>
                    <select class="form-control select2" name="level_position" style="width: 100%;">
                      <?php $__currentLoopData = $level_position; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($level->id); ?>"><?php echo e($level->nama_level); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>

                   <!-- /.form-group -->
                  <div class="form-group col-md-6 col-xs-6">
                    <label>Role</label>
                    <select class="form-control select2" name="role" style="width: 100%;">
                      <option value="0">User</option>
                      <option value="1">Administrator</option>
                    </select>
                  </div>
                  <!-- /.form-group -->


                <!-- hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh -->

                <!-- Position name -->
              <div class="form-group col-md-6">
                <label>Division:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                  <input type="text" name="division" class="form-control" placeholder="division">
                </div>
              </div>

              <!-- Position name -->
              <div class="form-group col-md-6">
                <label>Unit:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                  <input type="text" name="unit" class="form-control" placeholder="unit">
                </div>
              </div>

              <!-- Position name -->
              <div class="form-group col-md-6">
                <label>Department:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                  <input type="text" name="department" class="form-control" placeholder="department">
                </div>
              </div>

              <!-- Position name -->
              <div class="form-group col-md-6">
                <label>Section:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                  <input type="text" name="section" class="form-control" placeholder="section">
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group col-md-6">
                <label>Job Family</label>
                <select class="form-control" name="job_family" id="division" style="width: 100%;">
                  <?php $__currentLoopData = $job_family; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $family): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($family->id); ?>" ><?php echo e($family->job_family_name); ?></option>
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
        <div class="col-lg-12">
            <button class="btn btn-block btn-success">Submit New Personnel</button>
        </div>
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
@extends('admin.layouts.app')

@section('page-name')
    Add Personnel
@endsection

@section('content')

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
              <div class="form-group">
                <label>Username:</label>
                <div class="input-group">
                  <span class="input-group-addon">@</span>
                  <input type="text" class="form-control" name="username" placeholder="username">
                </div>
              </div>

              <!-- Password -->
              <div class="form-group">
                <label>Password:</label>
                <div class="input-group">
                  <span class="input-group-addon">**</span>
                  <input type="password" name="password" class="form-control" placeholder="password">
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
                  <option selected="selected">male</option>
                  <option>female</option>
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

              <!-- Email -->
              <div class="form-group">
                <label>Education:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
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

              <!-- Email -->
              <div class="form-group">
                <label>Position:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" name="position" class="form-control" placeholder="position">
                </div>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label>Employee Status:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" name="employee_status" class="form-control" placeholder="employee status">
                </div>
              </div>

              
              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Level Position</label>
                <select class="form-control select2" name="level_position" style="width: 100%;">
                  <option selected="selected">staff</option>
                  <option>Alaska</option>
                  <option disabled="disabled">California (disabled)</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>

               <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Role</label>
                <select class="form-control select2" name="role" style="width: 100%;">
                  <option selected="selected">user</option>
                  <option>Administrator</option>
                </select>
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Division</label>
                <select class="form-control select2" name="division" id="division" style="width: 100%;">
                  <option >staff</option>
                  <option value="1">Alaska</option>
                </select>
              </div>

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Unit</label>
                <select class="form-control select2" name="unit" id="unit" style="width: 100%;">
                  <option >staff</option>
                </select>
              </div>

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Department</label>
                <select class="form-control select2" name="department" id="department" style="width: 100%;">
                  <option selected="selected">staff</option>
                  <option>Alaska</option>
                  <option disabled="disabled">California (disabled)</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Section</label>
                <select class="form-control select2" name="section" id="section" style="width: 100%;">
                  <option selected="selected">staff</option>
                  <option>Alaska</option>
                  <option disabled="disabled">California (disabled)</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
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


@endsection

@section('script')
<script type="text/javascript">

    $('#division').click(function() {
      var id_division = $('#division').val();
      console.log($id_division);
      $.ajax({
        type:"POST",
        url:"/get_unit",
        dataType: 'json',
        data:{id_division:id_division,_token: '{{csrf_token()}}'},
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function(units) {
          console.log(value.units);
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
      autoclose: true
    });

  });

</script>


<script type="text/javascript">


    $('#MyUnit').click(function() {
      var id_divisi = $('#MyDivisi').val();
      var id_unit = $('#MyUnit').val();
      $.ajax({
        type:"POST",
        url:"/get-department",
        dataType: 'json',
        data:{id_unit:id_unit,id_divisi:id_divisi,_token: '{{csrf_token()}}'},
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function(departments) {
            var html = '';
            $.each(departments.departments, function(key, value){               
                html += '<option value="'+value.id_department+'">'+value.nama_departmen+'</option>';
                
            });
            $('#MyDepartment').html(html);  
                
            
            
        },
        error: function(data){
            console.log(data);
        },
      });
      
    });


</script>

<script type="text/javascript">


    $('#MyDepartment').click(function() {
      var id_divisi = $('#MyDivisi').val();
      var id_unit = $('#MyUnit').val();
      var id_department = $('#MyDepartment').val();
      $.ajax({
        type:"POST",
        url:"/get-section",
        dataType: 'json',
        data:{id_department:id_department,id_unit:id_unit,id_divisi:id_divisi,_token: '{{csrf_token()}}'},
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function(sections) {
            var html = '';
            $.each(sections.sections, function(key, value){             
                html += '<option value="'+value.id_section+'">'+value.nama_section+'</option>';
                
            });
            $('#MySection').html(html); 
                
            
            
        },
        error: function(data){
            console.log(data);
        },
      });
      
    });


</script>

@endsection
@extends('admin.layout_admin')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Personnel
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/personnel')}}">Personnel</a></li>
        <li class="active">Add Personnel</li>
      </ol>
    </section>



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
              <div class="form-group">
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
              <div class="form-group">
                <label>Division</label>
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
              <div class="form-group">
                <label>Unit</label>
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
              <div class="form-group">
                <label>Department</label>
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
              <div class="form-group">
                <label>Section</label>
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
              <div class="form-group">
                <label>Role</label>
                <select class="form-control select2" name="role" style="width: 100%;">
                  <option selected="selected">user</option>
                  <option>Administratoe</option>
                </select>
              </div>
              <!-- /.form-group -->

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
<script>

  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });

  });

</script>

@endsection
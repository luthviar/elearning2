@extends('admin.layouts.app')

@section('content')



    <form action="{{url('admin/personnel/edit')}}" method="post">
      
      {{csrf_field()}}

      <input type="hidden" name="id_user" value="{{$user->id}}">
    

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
                  <input type="text" class="form-control" name="username" value="{{$user->username}}" placeholder="username">
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
                  <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="name">
                </div>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label>Email:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="email">
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group">
                <label>Gender:</label>
                <select class="form-control" name="gender" style="width: 100%;">
                  @if ($user->gender == 1)
                  <option value="1" selected="true">male</option>
                  <option value="0">female</option>
                  @else
                  <option value="1">male</option>
                  <option value="0" selected="true">female</option>
                  @endif
                </select>
              </div>


              <!-- Date -->
              <div class="form-group">
                <label>Birtdate:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="birtdate" value="{{$user->birtdate}}" placeholder="birtdate" class="form-control pull-right datepicker" >
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Email -->
              <div class="form-group">
                <label>Education:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" name="education" value="{{$user->education}}" class="form-control" placeholder="education">
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
                  <input type="text" name="date_join_acs" value="{{ $user->date_join_acs}}" placeholder="date join acs" class="form-control pull-right datepicker" >
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Email -->
              <div class="form-group">
                <label>Position:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" name="position" value="{{$user->position_name}}" class="form-control" placeholder="position">
                </div>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label>Employee Status:</label>
                <select class="form-control select2" name="id_employee_status" style="width: 100%;">
                  @foreach($status as $emp_stat)
                  @if($emp_stat->id == $user->id_employee_status)
                  <option value="{{$emp_stat->id}}" selected="true">{{$emp_stat->name}}</option>
                  @else
                  <option value="{{$emp_stat->id}}">{{$emp_stat->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>

              
              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Level Position</label>
                <select class="form-control select2" name="level_position" style="width: 100%;">
                  @foreach($level_position as $level)
                  @if($level->id == $user->position)
                  <option value="{{$level->id}}" selected="true">{{$level->nama_level}}</option>
                  @else
                  <option value="{{$level->id}}">{{$level->nama_level}}</option>
                  @endif
                  @endforeach
                </select>
              </div>

               <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Role</label>
                <select class="form-control select2" name="role" style="width: 100%;">
                  @if($user->role == 1)
                  <option value="0">User</option>
                  <option value="1" selected="true">Administrator</option>
                  @else
                  <option value="0" selected="true">User</option>
                  <option value="1">Administrator</option>
                  @endif
                </select>
              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Division</label>
                <select class="form-control" name="division" id="division" style="width: 100%;">
                  @foreach($division as $div)
                  @if($user['org_structure']->id_division == $div->id)
                  <option value="{{$div->id}}" selected="true" >{{$div->division_name}}</option>
                  @else
                  <option value="{{$div->id}}" >{{$div->division_name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Unit</label>
                <select class="form-control" name="unit" id="unit" style="width: 100%;">
                  @foreach($unit as $unt)
                  @if($user['org_structure']->id_unit == $unt->id)
                  <option value="{{$unt->id}}" selected="true" >{{$unt->unit_name}}</option>
                  @else
                  <option value="{{$unt->id}}" >{{$unt->unit_name}}</option>
                  @endif
                  @endforeach
                </select>
                </select>
              </div>

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Department</label>
                <select class="form-control" name="department" id="department" style="width: 100%;">
                  @foreach($department as $deps)
                  @if($user['org_structure']->id_department == $deps->id)
                  <option value="{{$deps->id}}" selected="true" >{{$deps->department_name}}</option>
                  @else
                  <option value="{{$deps->id}}" >{{$deps->department_name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>

              <!-- /.form-group -->
              <div class="form-group col-md-6 col-xs-6">
                <label>Section</label>
                <select class="form-control" name="section" id="section" style="width: 100%;">
                  @foreach($section as $sec)
                  @if($user['org_structure']->id_section == $sec->id)
                  <option value="{{$sec->id}}" selected="true" >{{$sec->section_name}}</option>
                  @else
                  <option value="{{$sec->id}}" >{{$sec->section_name}}</option>
                  @endif
                  @endforeach
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


@endsection

@section('script')

<script type="text/javascript">

    $('#division').click(function() {
      var id_division = $('#division').val();
      $.ajax({
        type:"POST",
        url:"{{ url('get_unit') }}",
        dataType: 'json',
        data:{id_division:id_division,_token: '{{csrf_token()}}'},
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
        url:"{{ url('get_department') }}",
        dataType: 'json',
        data:{id_division:id_division,id_unit:id_unit,_token: '{{csrf_token()}}'},
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
        url:"{{ url('get_section') }}",
        dataType: 'json',
        data:{id_division:id_division,id_unit:id_unit,id_department:id_department,_token: '{{csrf_token()}}'},
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



@endsection
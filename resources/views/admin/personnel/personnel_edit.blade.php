@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url(action('UserController@profile_view',$user->id)) }}">
        <i class="fa fa-arrow-left"></i>
    </a>
    Edit Personnel - {{$user->name}}
@endsection

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
                            <input type="text" class="form-control" name="username" value="{{$user->username}}" placeholder="username" required>
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
                  <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="name" required>
                </div>
              </div>

              <!-- Email -->
              <div class="form-group">
                <label>Email*:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" value="{{$user->email}}" placeholder="email" required>
                </div>
              </div>

              <!-- /.form-group -->
              <div class="form-group">
                <label>Gender*:</label>
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
                <label>Birth Date*:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="birtdate" value="{{$user->birtdate}}" placeholder="birtdate"
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
                  <input type="text" name="education" value="{{$user->education}}" class="form-control" placeholder="education"required>
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
                  <input type="text" name="date_join_acs" value="{{ $user->date_join_acs}}"
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
                  <input type="text" name="position" value="{{$user->position_name}}" class="form-control" placeholder="position" required>
                </div>
              </div>

              <!-- Employee Status -->
              <div class="form-group">
                <label>Employee Status*:</label>
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
                <div class="row">
              <div class="form-group col-md-6 col-xs-6">
                <label>Level of Position*:</label>
                <select class="form-control select2" name="level_position" style="width: 100%;"  required>
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
                <label>Role*:</label>
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
                  @if($user['org_structure'] != null)
                    @foreach($division as $div)
                      @if($user['org_structure']->id_division == $div->id)
                      <option value="{{$div->id}}" selected="true">{{$div->division_name}}</option>
                      @else
                      <option value="{{$div->id}}">{{$div->division_name}}</option>
                      @endif
                    @endforeach
                  @else
                    @foreach($division as $div)
                      <option value="{{$div->id}}">{{$div->division_name}}</option>
                    @endforeach
                  @endif 
                  
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
                  @if($user['org_structure'] != null)
                    @foreach($unit as $unt)
                      @if($user['org_structure']->id_unit == $unt->id)
                     <option value="{{$unt->id}}" selected="true">{{$unt->unit_name}}</option>
                      @else
                      <option value="{{$unt->id}}">{{$unt->unit_name}}</option>
                      @endif
                    @endforeach
                  @else
                  @foreach($unit as $unt)
                    <option value="{{$unt->id}}">{{$unt->unit_name}}</option>
                  @endforeach
                  @endif
                  
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
                  @if($user['org_structure'] != null)
                    @foreach($department as $deps)
                      @if($user['org_structure']->id_department == $deps->id)
                      <option value="{{$deps->id}}" selected="true">{{$deps->department_name}}</option>
                      @else
                        <option value="{{$deps->id}}" selected="true">{{$deps->department_name}}</option>
                      @endif  
                    @endforeach
                  @else
                    @foreach($department as $deps)
                        <option value="{{$deps->id}}" selected="true">{{$deps->department_name}}</option>
                    @endforeach
                  @endif
                  
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
                  @if($user['org_structure'] != null)
                    @foreach($section as $sec)
                    @if($user['org_structure']->id_section == $sec->id)
                    <option value="{{$sec->id}}" selected="true">{{$sec->section_name}}</option>
                    @else
                    <option value="{{$sec->id}}" >{{$sec->section_name}}</option>  
                    @endif
                    @endforeach
                  @else
                    @foreach($section as $sec)
                    <option value="{{$sec->id}}" >{{$sec->section_name}}</option>  
                    @endforeach
                  @endif
                  
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
                  @foreach($job_family as $family)
                  @if(!empty($job_family_user) and $family->id == $job_family_user->id)
                  <option value="{{$family->id}}" selected="true" >{{$family->job_family_name}}</option>
                  @else
                  <option value="{{$family->id}}" >{{$family->job_family_name}}</option>
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


    </div>

        <div class="row text-center">
            <div class="col-lg-12">
                <button class="btn btn-block btn-info">Update Personnel</button>
            </div>
        </div>
    </section>
    <!-- /.content -->

    </form>


@endsection

@section('script')


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



@endsection
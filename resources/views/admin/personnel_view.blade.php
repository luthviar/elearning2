@extends('admin.layout_admin')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/personnel')}}">Personnel</a></li>
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
              <img class="profile-user-img img-responsive img-circle" src="{{URL::asset('AdminLTE/dist/img/user4-128x128.jpg')}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$profile['personal_data']->name}}</h3>

              <p class="text-muted text-center">{{$profile['personal_data']->position_name}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                	@if ($profile['personal_data']->role == 1)
                  	<b>Role</b> <a class="pull-right">Administrator</a>
                  	@else
                  	<b>Role</b> <a class="pull-right">User</a>
                  	@endif
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right">{{$profile['personal_data']->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Level</b> <a class="pull-right">{{$profile['level']->nama_level}}</a>
                </li>
                <li class="list-group-item">
                  <b>Employee Status</b> <a class="pull-right">{{$profile['employee_data']['employee_status']->name}}</a>
                </li>
                <li class="list-group-item">
                  <b>Birtdate</b> <a class="pull-right">{{$profile['personal_data']->birtdate}}</a>
                </li>
                <li class="list-group-item">
                  <b>Education</b> <a class="pull-right">{{ $profile['personal_data']->education}}</a>
                </li>
                <li class="list-group-item">
                  <b>Date Join</b> <a class="pull-right">{{$profile['personal_data']->date_join_acs}}</a>
                </li>
                <li class="list-group-item">
                  <b>Division</b> <a class="pull-right">{{$profile['employee_data']['division']->division_name or null}}</a>
                </li>
                <li class="list-group-item">
                  <b>Unit</b> <a class="pull-right">{{$profile['employee_data']['unit']->unit_name or null}}</a>
                </li>
                <li class="list-group-item">
                  <b>Department</b> <a class="pull-right">{{$profile['employee_data']['department']->department_name or null}}</a>
                </li>
                <li class="list-group-item">
                  <b>Section</b> <a class="pull-right">{{$profile['employee_data']['section']->section_name or null}}</a>
                </li>
                <li class="list-group-item">
                @if ($profile['personal_data']->flag_active == 1)
                  <b>Status</b> <a class="pull-right">Active</a>
                 @else
                  <b>Status</b> <a class="pull-right">Non-Active</a>
                 @endif
                </li>
              </ul>
              @if ($profile['personal_data']->flag_active == 1)
              <a href="#" class="btn btn-danger btn-block"><b>Non-Activate</b></a>
              @else
              <a href="#" class="btn btn-success btn-block"><b>Activate</b></a>
              @endif
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
		                @foreach ( $training_record['records']  as $key => $record)
		                <tr>
		                	<td>{{ $key+1}}</td>
		                	<td>{{ $record['module']->modul_name}}</td>
		                	<td>{{ $record['status']}}</td>
		                	<td>1</td>
		                </tr>
		                @endforeach	
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
		                @foreach($employee_record as $key => $record)
		                <tr>
		                	<td>{{$key+1}}</td>
		                	<td><a href="{{$record->attachment_url}}">{{$record->attachment_name}}</a></td>
		                	<td>{{$record->created_at}}</td>
		                </tr>	
                    @endforeach
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


@endsection

@section('script')
<script>
  $(function () {
    $("#record").DataTable();
    $('#score').DataTable();
  });
</script>

@endsection
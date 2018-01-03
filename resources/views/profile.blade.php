@extends('layout')

@section('content')

<div class="container" style="padding-top: 20px;">
  <div class="col-xs-12 col-md-12 text center" style="height: 230px;text-align: center; border-bottom: 1px solid green;">
    <img src="{{ URL::asset('gambar.png') }}" alt="..." style="height: 58%; border: 1px solid green;" class="img-circle">
    <h3 class="green_color"><strong>{{$profile['personal_data']->name}}</strong></h3>
    <h4>Department Human Capital . Aerofood ACS Head Office</h4>
  </div>
  <div class="col-xs-12 col-md-12" style="padding-top: 10px;">
    

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active" style="width: 25%;"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="text-center green_color">Profile</a></li>
        <li role="presentation" style="width: 25%;"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="text-center green_color">Account</a></li>
        <li role="presentation" style="width: 25%;"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" class="text-center green_color">Training Record</a></li>
        <li role="presentation" style="width: 25%;"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" class="text-center green_color">Employee Score</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
          <div class="col-xs-12 col-md-6">
            <h4>Personal Data</h4>
            <table class="table">
              <tbody>
                <tr>
                  <td width="50%">Name</td>
                  <td>{{ $profile['personal_data']->name}}</td>
                </tr>
                <tr>
                  <td width="50%">Email</td>
                  <td>{{ $profile['personal_data']->email}}</td>
                </tr>
                <tr>
                  <td>Birtdate</td>
                  <td>{{ $profile['personal_data']->birtdate}}</td>
                </tr>
                <tr>
                  <td width="50%">Age</td>
                  <td>{{ $profile['personal_data']->age}}</td>
                </tr>
                <tr>
                  <td width="50%">Education</td>
                  <td>{{ $profile['personal_data']->education}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-xs-12 col-md-6">
            <h4>Employee Data</h4>
            <table class="table">
              <tbody>
                <tr>
                  <td width="50%">Employee Status</td>
                  <td>{{$profile['employee_data']['employee_status']->name}}</td>
                </tr>
                <tr>
                  <td width="50%">Years of working</td>
                  <td>{{$profile['personal_data']->years_of_working}} years</td>
                </tr>
                <tr>
                  <td width="50%">Division</td>
                  <td>{{$profile['employee_data']['division']->division_name or null}}</td>
                </tr>
                <tr>
                  <td>Unit</td>
                  <td>{{$profile['employee_data']['unit']->unit_name or null}}</td>
                </tr>
                <tr>
                  <td width="50%">Department</td>
                  <td>{{$profile['employee_data']['department']->department_name or null}}</td>
                </tr>
                <tr>
                  <td>Section</td>
                  <td>{{$profile['employee_data']['section']->section_name or null}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>



        <div role="tabpanel" class="tab-pane" id="profile">
          <div class="col-xs-12 col-md-6 col-md-offset-3">
            <table class="table">
              <tbody>
                <tr>
                  <td width="50%">Username</td>
                  <td>{{ $profile['personal_data']->username }}</td>
                </tr>
                <tr>
                  <td>Change Password</td>
                  <td><input type="password" class="form-control" name="password" placeholder="password"></td>
                </tr>
                <tr>
                  <td>Confirm Password</td>
                  <td><input type="password" class="form-control" name="confirm_password" placeholder="confirm password"></td>
                </tr>
              </tbody>
            </table>
            <a href="#" class="btn btn-success" style="width: 100%;">change password</a>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
          <div class="col-xs-12 col-md-12 text-center">
            <div class="col-xs-12 col-md-6">
              <h4>Training Included</h4>
              <h1 style="font-size: 40px">10</h1>
            </div>
            <div class="col-xs-12 col-md-6 green_color">
              <h4>Training Finished</h4>
              <h1 style="font-size: 40px">10</h1>
            </div>
            <div class="col-xs-12 col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th>Training Title</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Training 1</td>
                    <td>Finished</td>
                  </tr>
                  <tr>
                    <td>Training 1</td>
                    <td>Finished</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="settings">
          <div class="container text-center">
            <iframe id="iframe"
                src = "{{URL::to('/ViewerJS/index.html#../files/situs.pdf')}}"
                width='100%'
                height='600'
                allowfullscreen webkitallowfullscreen>
            </iframe>
          </div>
        </div>
      </div>

    
  </div>
</div>

@endsection
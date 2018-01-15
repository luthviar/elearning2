@extends('admin.layouts.app')

@section('page-name')
    Add Personnel
@endsection

@section('content')


<form action="{{url(action('UserController@user_add_submit'))}}" method="post">

{{csrf_field()}}



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
                                <label>
                                    Username: (NIP)
                                    <i class="fa fa-question-circle"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="username merupakan NIP karyawan."
                                    ></i>
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
                                <input type="text" class="form-control" name="name" placeholder="Full Name of the Employee">
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label>Email:</label>
                            <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                <input type="email" name="email" class="form-control" placeholder="E-mail">
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
                            <label>Birth date:</label>
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
                                                <span class="input-group-addon">
                                                    <i class="fa fa-institution"></i>
                                                </span>
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
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-address-card"></i>
                                                        </span>
                                <input type="text" name="position" class="form-control" placeholder="position">
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label>Employee Status:</label>
                            <div class="input-group col-lg-12">
                                <select class="form-control select3" name="id_employee_status" style="width: 100%;">
                                    @foreach($status as $emp_stat)

                                        <option value="{{$emp_stat->id}}">{{$emp_stat->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="row">
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Level of Position</label>
                                <select class="form-control select3" name="level_position" style="width: 100%;">
                                    @foreach($level_position as $level)

                                        <option value="{{$level->id}}">{{$level->nama_level}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Role</label>
                                <select class="form-control select3" name="role" style="width: 100%;">
                                    <option value="0">User</option>
                                    <option value="1">Administrator</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <!-- /.form-group -->

                            <div class="form-group col-md-12">
                                <hr/>
                                <h5 style="color: orangered;" class="text-center">
                                    Pilih Divisi, Unit dan Department dari Database.
                                    Jika tidak ada, maka Anda dapat menginput sendiri pada input text.
                                </h5>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Division : </label>
                                <select class="form-control select3" name="division" id="division" style="width: 100%;">
                                    <option value="0" >-- Choose The Division --</option>
                                    @foreach($division as $div)

                                        <option value="{{$div->id}}" >{{$div->division_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- Position name -->
                            <div class="form-group col-md-6">
                                <label>Division Input:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-address-card"></i>
                                    </span>
                                    <input type="text" name="division_input" class="form-control" placeholder="division">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Unit : </label>
                                <select class="form-control select3" name="unit" id="unit" style="width: 100%;">
                                    <option value="0" >-- Choose The Unit --</option>
                                    @foreach($unit as $unt)

                                        <option value="{{$unt->id}}" >{{$unt->unit_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- Position name -->
                            <div class="form-group col-md-6">
                                <label>Unit Input:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-address-card"></i>
                                    </span>
                                    <input type="text" name="unit_input" class="form-control" placeholder="unit">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Department : </label>
                                <select class="form-control select3" name="department" id="department" style="width: 100%;">
                                    <option value="0" >-- Choose The Department --</option>
                                    @foreach($department as $dept)

                                        <option value="{{$dept->id}}" >{{$dept->department_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- Position name -->
                            <div class="form-group col-md-6">
                                <label>Department Input:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-address-card"></i>
                                    </span>
                                    <input type="text" name="department_input" class="form-control" placeholder="department">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Section : </label>
                                <select class="form-control select3" name="section" id="section" style="width: 100%;">
                                    <option value="0" >-- Choose The Section --</option>
                                    @foreach($section as $sect)

                                        <option value="{{$sect->id}}" >{{$sect->section_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!-- Position name -->
                            <div class="form-group col-md-6">
                                <label>Section Input:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-address-card"></i>
                                    </span>
                                    <input type="text" name="section_input" class="form-control" placeholder="section">
                                </div>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group col-md-12">
                                <label>Job Family</label>
                                <select class="form-control select3" name="job_family" id="job_family" style="width: 100%;">
                                    @foreach($job_family as $family)

                                        <option value="{{$family->id}}" >{{$family->job_family_name}}</option>
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
                <button class="btn btn-block btn-success">Submit New Personnel</button>
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
                    var $result = $(" <span></span>");

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
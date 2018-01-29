@extends('user.layouts.app')

@section('content')

<div style="margin-top:60px; border:none;">
    <img src="{{url('Elegantic/images/head_banner_forum.jpg')}}" width="100%" style="border:none; margin:0; padding:0;">
</div>

    <div class="page-container" id="wrapper">
        <div class="page-content-wrapper">

            <div class="page-content" style="padding:1em 2em 4em 2em;">
            <div class = "">
                        <div id="exTab1">
                            <ul  class="nav nav-tabs nav-justified" style="margin-bottom: 0px;">
                                <li class="active">
                                    <a  href="#umum" data-toggle="tab">
                                        <div><i class="fa fa-comments"></i>&nbsp;&nbsp;FORUM UMUM</div>
                                    </a>
                                </li>
                                @if(!empty($job_family))
                                    <li>
                                        <a href="#jobfamily" data-toggle="tab">
                                            <div><i class="fa fa-users"></i>&nbsp;&nbsp;FORUM JOB FAMILY</div>
                                        </a>
                                    </li>
                                @endif
                                @if(!empty($unit))
                                    <li>
                                        <a href="#unit" data-toggle="tab">
                                            <div><i class="fa fa-comments-o"></i>&nbsp;&nbsp;FORUM UNIT</div> 
                                        </a>
                                    </li>
                                @endif
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="umum">
                                    <div class="va-table" style="width:100%;">
                                        <div class="va-middle">
                                            <h1 style="margin:0px; padding:20px 0 0 0;">FORUM UMUM</h1>
                                            <p>Forum ini ditujukan untuk seluruh karyawan PT Aerofood Indonesia</p>
                                        </div>
                                        <div class="va-middle" style="text-align:right;">
                                            <button  class="btn btn-info" data-toggle="modal" data-target="#modal_umum">New Post</button>
                                        </div>
                                    </div>
                                    <hr/>
                                    {{--<h1>Forum Umum</h1>--}}
                                    {{--<p>Forum ini ditujukan untuk seluruh karyawan PT Aerofood Indonesia</p>--}}
                                    {{--<button  class="btn btn-info" data-toggle="modal" data-target="#modal_umum">--}}
                                        {{--New Post--}}
                                    {{--</button><br><br>--}}

                                    @if(empty(Session::get('failed_umum')) == false)
                                        <div class="alert alert-danger text-center" role="alert">
                                            <h3>Failed!</h3>
                                            <p>
                                                {{ Session::get('failed_umum') }}
                                            </p>
                                        </div>
                                    @endif
                                    @if(empty(Session::get('success_umum')) == false)
                                        <div class="alert alert-success text-center" role="alert">
                                            <h3>Berhasil!</h3>
                                            <p>
                                                {{ Session::get('success_umum') }}
                                            </p>
                                        </div>
                                    @endif

                                    <table  class="table table-striped detailTable text-left">
                                        <thead>
                                        <tr>
                                            <th>Topic Discussion</th>
                                            <th>Started By</th>
                                            <th>Replies</th>
                                            <th>Last Post</th>
                                            <th>Created At</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($forum_umum as $forum)

                                            <tr>
                                                <td>
                                                    <a href="{{ url('forum/'.$forum->id) }}">
                                                        {{$forum->title}}
                                                    </a>
                                                    @if($forum->created_by == Auth::user()->id)
                                                        <a
                                                                href="{{ url(action('ForumController@editByUser',$forum->id)) }}"
                                                                data-toggle="tooltip" data-placement="top" title="Edit Your Post"
                                                        >
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>{{$forum['personnel']['name']}} </td>
                                                <td>{{count($forum['replie'])}}</td>
                                                @if(count($forum['replie']) == 0)
                                                    <td>-</td>
                                                @else
                                                    <td>
                                                        {{$forum['last_reply_personnel']['name']}},
                                                        {{ \Carbon\Carbon::parse($forum['last_reply']->created_at)->format('l jS \\of F Y')}}
                                                    </td>
                                                @endif
                                                <td>{{ $forum->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>


                                </div>

                                @if($job_family->job_family_name != null)
                                    <div class="tab-pane" id="jobfamily">

                                        <div class="va-table" style="width:100%;">
                                            <div class="va-middle">
                                                <h1 style="margin:0px; padding:20px 0 0 0;">FORUM {{$job_family->job_family_name}}</h1>
                                                <p>Forum ini ditujukan untuk karyawan {{$job_family->name}} PT Aerofood Indonesia.</p>
                                            </div>
                                            <div class="va-middle" style="text-align:right;">
                                                <button  class="btn btn-info" data-toggle="modal" data-target="#modal_job_family">New Post</button>
                                            </div>
                                        </div>
                                        <hr/>
                                        @if(empty(Session::get('failed_jobfamily')) == false)
                                            <div class="alert alert-danger text-center" role="alert">
                                                <h3>Failed!</h3>
                                                <p>
                                                    {{ Session::get('failed_jobfamily') }}
                                                </p>
                                            </div>
                                        @endif
                                        @if(empty(Session::get('success_jobfamily')) == false)
                                            <div class="alert alert-success text-center" role="alert">
                                                <h3>Berhasil!</h3>
                                                <p>
                                                    {{ Session::get('success_jobfamily') }}
                                                </p>
                                            </div>
                                        @endif
                                        <table  class="table table-striped detailTable text-left">
                                            <thead>
                                            <tr>
                                                <th>Topic Discussion</th>
                                                <th>Started By</th>
                                                <th>Replies</th>
                                                <th>Last Post</th>
                                                <th>Created At</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($forum_job_family as $forum)
                                                <tr>
                                                    <td>
                                                        <a href="{{ url('forum/'.$forum->id) }}">
                                                            {{$forum->title}}
                                                        </a>
                                                        @if($forum->created_by === Auth::user()->id)
                                                            <a
                                                                    href="{{ url('forum/user/edit/'.$forum->id) }}"
                                                                    data-toggle="tooltip" data-placement="top" title="Edit Your Post"
                                                            >

                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>{{$forum['personnel']->name}}</td>
                                                    <td>{{count($forum['replie'])}}</td>
                                                @if(count($forum['replie']) == 0)
                                                    <td>-</td>
                                                @else
                                                    <td>
                                                        {{$forum['last_reply_personnel']['name']}} ,
                                                        {{ \Carbon\Carbon::parse($forum['last_reply']->created_at)->format('l jS \\of F Y')}}
                                                    </td>
                                                @endif
                                                    <td>{{ $forum->created_at->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>

                                    </div>
                                @else
                                    <div class="tab-pane text-center" id="jobfamily">
                                        <h1>You don't have Job Family</h1>
                                    </div>
                                @endif


                                @if($unit->unit_name != null)
                                    <div class="tab-pane" id="unit">
                                        <div class="va-table" style="width:100%;">
                                            <div class="va-middle">
                                                <h1 style="margin:0px; padding:20px 0 0 0;">Forum Unit {{$unit->unit_name}}</h1>
                                                <p>Forum ini ditujukan untuk karyawan Unit {{$unit->unit_name}}
                                                    PT Aerofood Indonesia</p>
                                            </div>
                                            <div class="va-middle" style="text-align:right;">
                                                <button  class="btn btn-info" data-toggle="modal" data-target="#modal_department">New Post</button>
                                            </div>
                                        </div>
                                        <hr/>


                                        @if(empty(Session::get('failed_unit')) == false)
                                            <div class="alert alert-danger text-center" role="alert">
                                                <h3>Failed!</h3>
                                                <p>
                                                    {{ Session::get('failed_unit') }}
                                                </p>
                                            </div>
                                        @endif
                                        @if(empty(Session::get('success_unit')) == false)
                                            <div class="alert alert-success text-center" role="alert">
                                                <h3>Berhasil!</h3>
                                                <p>
                                                    {{ Session::get('success_unit') }}
                                                </p>
                                            </div>
                                        @endif

                                        <table  class="table table-striped detailTable text-left">
                                            <thead>
                                            <tr>
                                                <th>Topic Discussion</th>
                                                <th>Started By</th>
                                                <th>Replies</th>
                                                <th>Last Post</th>
                                                <th>Created At</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($forum_unit as $forum)
                                                <tr>
                                                    <td>
                                                        <a href="{{ url('forum/'.$forum->id) }}">
                                                            {{$forum->title}}
                                                        </a>
                                                        @if($forum->created_by === Auth::user()->id)
                                                            <a
                                                                    href="{{ url('forum/user/edit/'.$forum->id) }}"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Edit Your Post">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                                            </a>
                                                        @endif

                                                    </td>
                                                    <td>{{$forum['personnel']->name}}</td>
                                                    <td>{{count($forum['replie'])}}</td>
                                                    @if(count($forum['replie']) == 0)
                                                        <td>-</td>
                                                    @else
                                                        <td>
                                                            {{$forum['last_reply_personnel']['name']}},
                                                            {{ \Carbon\Carbon::parse($forum['last_reply']->created_at)->format('l jS \\of F Y')}}
                                                        </td>
                                                    @endif
                                                    <td>{{ $forum->created_at->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="tab-pane text-center" id="unit">
                                        <h1>You don't have Unit</h1>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>



            </div>
        </div>


    </div>












    <!-- New Post Umum -->
    <div class="modal fade" id="modal_umum" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content" >
                <form id="summernote_form"class="form-horizontal" role="form" method="POST"
                      action="{{ URL::action('ForumController@storeByUser') }}"
                      enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="btn btn-danger btn-lg pull-right"
                                data-dismiss="modal">X</button>
                        <h1 class="modal-title text-center">New Post -  Forum Umum</h1>
                    </div>

                    <div class="modal-body">
                        {{ csrf_field() }}

                        <input type="hidden" name="id_department" value="">
                        <input type="hidden" name="id_unit" value="">
                        <input type="hidden" name="id_job_family" value="">


                        <div class="form-group">
                            <label for="title" class="col-md-3 control-label">Title</label>

                            <div class="col-md-6">
                                <input type="text" name="title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="can_reply" class="col-md-3 control-label">
                                Can Reply*:
                                <i class="fa fa-question-circle"
                                   data-toggle="tooltip"
                                   data-placement="bottom"
                                   title="Maksudnya adalah, apakah forum ini diizinkan untuk ada fitur memberi komentar dari user lain?"
                                   aria-hidden="true"></i>
                            </label>
                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input type="radio" name="can_reply" value="0">No
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="can_reply" value="1" checked="checked">Yes
                                </label>

                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="content" class="col-md-3 control-label">
                                Content*:
                                <i class="fa fa-question-circle"
                                   data-toggle="tooltip"
                                   data-placement="bottom"
                                   title="Jika tidak dapat dipakai, maka refresh page ini."
                                   aria-hidden="true"></i>
                            </label>
                            <div class="col-md-8" name="content">
                                <textarea class="summernote" name="content"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-md-3 control-label">Upload Attachment (Optional)</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse..
                                        <input type="file"
                                               id="file"
                                               onchange="javascript:updateList()"
                                               name="file_pendukung[]"
                                               multiple/>
                                    </span>
                                </span>
                                    <input type="text" class="form-control" value="select file(s)" readonly>
                                </div></br>
                                <div class='file-uploaded'>
                                    <p>
                                    <div id="fileList"></div>
                                    </p>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit New Post
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($department != null)
        <!-- New Post Department -->
        <div class="modal fade" id="modal_department" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content" >
                    <form id="summernote_form"class="form-horizontal" role="form" method="POST"
                          action="{{ URL::action('ForumController@storeByUser') }}" enctype="multipart/form-data">
                        <div class="modal-header">

                            <button type="button" class="btn btn-danger btn-lg pull-right"
                                    data-dismiss="modal">X</button>
                            <h1 class="modal-title text-center">New Post - Forum Unit</h1>
                        </div>

                        <div class="modal-body">
                            {{ csrf_field() }}

                            <input type="hidden" name="id_unit" value="{{$unit->id}}">
                            <input type="hidden" name="id_job_family" value="">
                            <input type="hidden" name="id_department" value="">


                            <div class="form-group">
                                <label for="title" class="col-md-3 control-label">Title*:</label>

                                <div class="col-md-6">
                                    <input required type="text" name="title"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="can_reply" class="col-md-3 control-label">
                                    Can Reply*:
                                    <i class="fa fa-question-circle"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       title="Maksudnya adalah, apakah
                                       forum ini diizinkan untuk ada fitur memberi komentar dari user lain?"
                                       aria-hidden="true"></i>
                                </label>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="can_reply" value="0">No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="can_reply" value="1" checked="checked">Yes
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-md-3 control-label">
                                    Content*:
                                    <i class="fa fa-question-circle"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       title="Jika tidak dapat dipakai, maka refresh page ini."
                                       aria-hidden="true"></i>
                                </label>

                                <div class="col-md-8" name="content3">
                                    <textarea class="summernote" name="content3"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-md-3 control-label">Upload Attachment (Optional)</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse..
                                        <input type="file"
                                               id="filedua"
                                               onchange="javascript:updateList2()"
                                               name="file_pendukung[]"
                                               multiple/>
                                    </span>
                                </span>
                                        <input type="text" class="form-control" value="select file(s)" readonly>
                                    </div></br>
                                    <div class='file-uploaded'>
                                        <p>
                                        <div id="fileListdua">

                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit New Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if($job_family != null)
        <!-- New Post Job Family -->
        <div class="modal fade" id="modal_job_family" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content" >
                    <form id="summernote_form"class="form-horizontal" role="form" method="POST" action="{{ URL::action('ForumController@storeByUser') }}" enctype="multipart/form-data">
                        <div class="modal-header">

                            <button type="button" class="btn btn-danger btn-lg pull-right"
                                    data-dismiss="modal">X</button>


                            <h1 class="modal-title text-center">New Post - Forum Job Family</h1>
                        </div>

                        <div class="modal-body">
                            {{ csrf_field() }}

                            <input type="hidden" name="id_department" value="">
                            <input type="hidden" name="id_unit" value="">
                            <input type="hidden" name="id_job_family" value="{{$job_family->id}}">


                            <div class="form-group">
                                <label for="title" class="col-md-3 control-label">Title*:</label>

                                <div class="col-md-6">
                                    <input required type="text" name="title"/>
                                </div>
                            </div>

                            <div class="form-group" >
                                <label for="can_reply" class="col-md-3 control-label">
                                    Can Reply*:
                                    <i class="fa fa-question-circle"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       title="Maksudnya adalah, apakah
                                       forum ini diizinkan untuk ada fitur memberi komentar dari user lain?"
                                       aria-hidden="true"></i>
                                </label>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio" name="can_reply" value="0">No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="can_reply" value="1" checked="checked">Yes
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-md-3 control-label">
                                    Content*:
                                    <i class="fa fa-question-circle"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       title="Jika tidak dapat dipakai, maka refresh page ini."
                                       aria-hidden="true"></i>
                                </label>
                                <div class="col-md-8" name="content">
                                    <textarea class="summernote" name="content2"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-md-3 control-label">Upload Attachment (Optional)</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse..
                                        <input type="file"
                                               id="filetiga"
                                               onchange="javascript:updateList3()"
                                               name="file_pendukung[]"
                                               multiple/>
                                    </span>
                                </span>
                                        <input type="text" class="form-control" value="select file(s)" readonly>
                                    </div></br>
                                    <div class='file-uploaded'>
                                        <p>
                                        <div id="fileListtiga">

                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit New Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else

    @endif




    <style>
        .modal_umum,modal_department,modal_job_family,{
            display: block !important;
        }
        .modal-dialog{
            overflow-y: initial !important
        }
        .modal-body{
            height: 400px;
            overflow-y: auto;
        }
    </style>

@endsection
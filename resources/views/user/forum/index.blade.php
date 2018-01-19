@extends('user.layouts.app')

@section('content')

    <div class="page-container" id="wrapper">
        <div class="page-content-wrapper">

            <div class="page-content" style="background-color: rgb(243, 247, 248);opacity: 1;">
                <div class="block-advice">
                    @if(empty(Session::get('failed')) == false)
                        <div class="alert alert-danger text-center" role="alert">
                            <h3>Failed!</h3>
                            <p>
                                {{ Session::get('failed') }}
                            </p>
                        </div>
                    @endif
                    <div class = "text-center">
                        <div id="exTab1">
                            <ul  class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a  href="#umum" data-toggle="tab">Forum Umum</a>
                                </li>
                                @if(!empty($job_family))
                                    <li>
                                        <a href="#jobfamily" data-toggle="tab">Forum Job Family</a>
                                    </li>
                                @endif
                                @if(!empty($unit))
                                    <li>
                                        <a href="#dept" data-toggle="tab">Forum Unit</a>
                                    </li>
                                @endif
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="umum">

                                    <h1>Forum Umum</h1>
                                    <p>Forum ini ditujukan untuk seluruh karyawan PT Aerofood Indonesia</p>
                                    <button  class="btn btn-info" data-toggle="modal" data-target="#modal_umum">New Thread</button><br><br>

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
                                                        href="{{ url('forum/user/edit/'.$forum->id) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit Your Thread"
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
                                                        {{ \Carbon\Carbon::parse($forum['last_reply'][0]
                                                        ->created_at)->format('l jS \\of F Y')}}
                                                    </td>
                                                @endif
                                                <td>{{ $forum->created_at }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>


                                </div>

                                @if($job_family != null)
                                    <div class="tab-pane" id="jobfamily">
                                        <h1>Forum {{$job_family->job_family_name}}</h1>
                                        <p>Forum ini ditujukan untuk karyawan {{$job_family->name}} PT Aerofood Indonesia.</p>
                                        <button  class="btn btn-info" data-toggle="modal"
                                                 data-target="#modal_job_family">New Thread</button><br><br>

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
                                                                    data-toggle="tooltip" data-placement="top" title="Edit Your Thread"
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
                                                            {{ \Carbon\Carbon::parse($forum['last_reply'][0]->created_at)->format('l jS \\of F Y')}}
                                                        </td>
                                                    @endif
                                                    <td>{{ $forum->created_at }}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>

                                    </div>
                                @endif


                                @if($unit != null)
                                    <div class="tab-pane" id="dept">
                                        <h1>Forum Unit {{$unit->unit_name}}</h1>
                                        <p>
                                            Forum ini ditujukan untuk karyawan Unit {{$unit->unit_name}}
                                            PT Aerofood Indonesia
                                        </p>
                                        <button  class="btn btn-info" data-toggle="modal"
                                                 data-target="#modal_department">New Thread</button><br><br>

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
                                                                title="Edit Your Thread">
                                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                                                </a>
                                                            @endif

                                                    </td>
                                                    <td>{{$forum['personnel']->name}}</td>
                                                    <td>{{count($forum['replie'])}}</td>
                                                    @if($forum['replie'] == null)
                                                        <td>-</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    <td>{{ $forum->created_at }}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>


    <!-- New Thread Umum -->
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
                        <h1 class="modal-title text-center">New Thread -  Forum Umum</h1>
                    </div>

                    <div class="modal-body">
                        {{ csrf_field() }}

                        <input type="hidden" name="id_department" value="">
                        <input type="hidden" name="id_unit" value="">
                        <input type="hidden" name="id_job_family" value="">


                        <div class="form-group">
                            <label for="title" class="col-md-3 control-label">Title*:</label>

                            <div class="col-md-6">
                                <input required type="text" name="title">
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
                                    <input required type="text" class="form-control" value="select file(s)" readonly>
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
                                    Submit New Thread
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($department != null)
        <!-- New Thread Department -->
        <div class="modal fade" id="modal_department" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content" >
                    <form id="summernote_form"class="form-horizontal" role="form" method="POST"
                          action="{{ URL::action('ForumController@storeByUser') }}" enctype="multipart/form-data">
                        <div class="modal-header">

                                <button type="button" class="btn btn-danger btn-lg pull-right"
                                        data-dismiss="modal">X</button>
                            <h1 class="modal-title text-center">New Thread - Forum Unit</h1>
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
                                        <input required type="text" class="form-control" value="select file(s)" readonly>
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
                                        Submit New Thread
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
        <!-- New Thread Job Family -->
        <div class="modal fade" id="modal_job_family" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content" >
                    <form id="summernote_form"class="form-horizontal" role="form" method="POST" action="{{ URL::action('ForumController@storeByUser') }}" enctype="multipart/form-data">
                        <div class="modal-header">

                                <button type="button" class="btn btn-danger btn-lg pull-right"
                                        data-dismiss="modal">X</button>


                            <h1 class="modal-title text-center">New Thread - Forum Job Family</h1>
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
                                        <input required type="text" class="form-control" value="select file(s)" readonly>
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
                                        Submit New Thread
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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


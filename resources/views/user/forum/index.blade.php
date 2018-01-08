@extends('user.layouts.app')

@section('content')

    <div class="page-container" id="wrapper">
        <div class="page-content-wrapper">

            <div class="page-content" style="background-color: rgb(243, 247, 248);opacity: 1;">
                <div class="block-advice">
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
                                @if(!empty($department))
                                    <li>
                                        <a href="#dept" data-toggle="tab">Forum Department</a>
                                    </li>
                                @endif
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="umum">

                                    <h1>Forum Umum</h1>
                                    <p>forum ini ditujukan untuk seluruh karyawan PT Aerofood Indonesia</p>
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

                                @if($forum_job_family != null)
                                    <div class="tab-pane" id="jobfamily">
                                        <h1>Forum {{$job_family->name}}</h1>
                                        <p>Forum ini ditujukan untuk karyawan {{$job_family->name}} PT Aerofood Indonesia.</p>
                                        <button  class="btn btn-info" data-toggle="modal" data-target="#modal_job_family">New Thread</button><br><br>

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
                                                        <td>{{$forum['last_reply_personnel']['name']}} , {{ \Carbon\Carbon::parse($forum['last_reply'][0]->created_at)->format('l jS \\of F Y')}}</td>
                                                    @endif
                                                    <td>{{ $forum->created_at }}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>

                                    </div>
                                @endif


                                @if($forum_department != null)
                                    <div class="tab-pane" id="dept">
                                        <h1>Forum {{$department->nama_departmen}}</h1>
                                        <p>forum ini ditujukan untuk karyawan {{$department->nama_departmen}} PT Aerofood Indonesia</p>
                                        <button  class="btn btn-info" data-toggle="modal" data-target="#modal_department">New Thread</button><br><br>

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

                                            @foreach($forum_department as $forum)
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


    {{-- modal edit forum --}}
    <div class="modal fade" id="modal_edit_forum" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content" >
                <form
                        class="form-horizontal"
                        role="form" method="POST"
                        action="/forum/user/update"
                        enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Your Thread</h4>
                    </div>

                    <div class="modal-body">
                        {{ csrf_field() }}

                        <input type="hidden" id="id_forum_edit" name="id_forum_edit">

                        <div class="form-group">
                            <label for="title" class="col-md-3 control-label">Title</label>

                            <div class="col-md-6">
                                <input type="text" id="title_edit" name="title"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="can_reply" id="can_reply_edit" class="col-md-3 control-label">Can Reply</label>
                            <div class="col-md-6">
                                <select name="can_reply" >
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-md-3 control-label">Content</label>

                            <div class="col-md-10">
                                <textarea class="summernote" id="summernote_edit" name="content_edit"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-md-3 control-label">Upload attachment</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse..
                                        <input type="file"
                                               id="filetiga"
                                               onchange="javascript:updateList4()"
                                               name="file_pendukung[]"
                                               multiple/>
                                    </span>
                                </span>
                                    <input type="text" class="form-control" value="select file(s)" readonly>
                                </div></br>
                                <div class='file-uploaded'>
                                    <p id="attachments_edit">

                                    </p>
                                    <p>
                                    <div id="fileListtiga">

                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- New Thread Umum -->
    <div class="modal fade" id="modal_umum" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content" >
                <form class="form-horizontal" role="form" method="POST"
                      action="{{ URL::action('ForumController@storeByUser') }}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Thread</h4>
                    </div>

                    <div class="modal-body">
                        {{ csrf_field() }}

                        <input type="hidden" name="id_department" value="">
                        <input type="hidden" name="id_job_family" value="">


                        <div class="form-group">
                            <label for="title" class="col-md-3 control-label">Title</label>

                            <div class="col-md-6">
                                <input type="text" name="title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="can_reply" class="col-md-3 control-label">Can Reply</label>
                            <div class="col-md-6">
                                <select name="can_reply" class="form-control pull-left">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select><br>

                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="content" class="col-md-3 control-label">Content</label>

                            <div class="col-md-8" name="content">
                                <textarea class="summernote" name="content"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-md-3 control-label">Upload attachment</label>

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
                                    Submit
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ForumController@storeByUser') }}" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">New Thread</h4>
                        </div>

                        <div class="modal-body">
                            {{ csrf_field() }}

                            <input type="hidden" name="id_department" value="{{$department->id_department}}">
                            <input type="hidden" name="id_job_family" value="">


                            <div class="form-group">
                                <label for="title" class="col-md-3 control-label">Title</label>

                                <div class="col-md-6">
                                    <input type="text" name="title"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="can_reply" class="col-md-3 control-label">Can Reply</label>
                                <div class="col-md-6">
                                    <select name="can_reply">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-md-3 control-label">Content</label>

                                <div class="col-md-8">
                                    <textarea class="summernote" name="content3"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-md-3 control-label">Upload attachment</label>

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
                                        Submit
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ForumController@storeByUser') }}" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">New Thread</h4>
                        </div>

                        <div class="modal-body">
                            {{ csrf_field() }}

                            <input type="hidden" name="id_department" value="">
                            <input type="hidden" name="id_job_family" value="{{$job_family->id}}">


                            <div class="form-group">
                                <label for="title" class="col-md-3 control-label">Title</label>

                                <div class="col-md-6">
                                    <input type="text" name="title"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="can_reply" class="col-md-3 control-label">Can Reply</label>
                                <div class="col-md-6">
                                    <select name="can_reply" >
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="content" class="col-md-3 control-label">Content</label>

                                <div class="col-md-8">
                                    <textarea class="summernote" name="content2"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-md-3 control-label">Upload attachment</label>

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
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif


    {{--<div class="page-container" id="wrapper">--}}
        {{--<div class="page-content-wrapper">--}}

            {{--<div class="page-content" style="background-color: rgb(243, 247, 248);opacity: 1;">--}}
                {{--<div class="block-advice">--}}
                    {{--<div class = "text-center">--}}
                        {{--<div id="exTab1">--}}
                            {{--<ul  class="nav nav-tabs nav-justified">--}}
                                {{--<li class="active">--}}
                                    {{--<a  href="#umum" data-toggle="tab">Forum Umum</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#jobfamily" data-toggle="tab">Forum Job Family</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#dept" data-toggle="tab">Forum Department</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}

                            {{--<div class="tab-content">--}}
                                {{--<div class="tab-pane active" id="umum">--}}

                                    {{--<h1>Forum Umum</h1>--}}
                                    {{--<p>forum ini ditujukan untuk seluruh karyawan PT Aerofood Indonesia</p>--}}
                                    {{--<button  class="btn btn-info" data-toggle="modal" data-target="#modal_umum">New Thread</button><br><br>--}}

                                    {{--<table  class="table table-striped detailTable text-left">--}}
                                        {{--<thead>--}}
                                        {{--<tr>--}}
                                            {{--<th>Topic Discussion</th>--}}
                                            {{--<th>Started By</th>--}}
                                            {{--<th>Replies</th>--}}
                                            {{--<th>Last Post</th>--}}
                                            {{--<th>Created At</th>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}

                                        {{--<tr>--}}

                                            {{--<td>--}}
                                                {{--<a href="/forum/1">new thread</a>--}}
                                                {{--<a--}}
                                                        {{--href="forum/1/user/edit"--}}
                                                        {{--data-toggle="tooltip" data-placement="top" title="Edit Your Thread"--}}
                                                {{-->--}}

                                                    {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}

                                                {{--</a>--}}
                                            {{--</td>--}}
                                            {{--<td>don din</td>--}}
                                            {{--<td>3</td>--}}
                                            {{--<td>don din, Thursday 4th of January 2018</td>--}}
                                            {{--<td>2017-08-10 01:38:34</td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}

                                            {{--<td>--}}
                                                {{--<a href="/forum/5">dua</a>--}}
                                                {{--<a--}}
                                                        {{--href="forum/5/user/edit"--}}
                                                        {{--data-toggle="tooltip" data-placement="top" title="Edit Your Thread"--}}
                                                {{-->--}}

                                                    {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}

                                                {{--</a>--}}
                                            {{--</td>--}}
                                            {{--<td>don din</td>--}}
                                            {{--<td>0</td>--}}
                                            {{--<td>-</td>--}}
                                            {{--<td>2017-08-10 04:53:31</td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}

                                            {{--<td>--}}
                                                {{--<a href="/forum/6">fafsd</a>--}}
                                                {{--<a--}}
                                                        {{--href="forum/6/user/edit"--}}
                                                        {{--data-toggle="tooltip" data-placement="top" title="Edit Your Thread"--}}
                                                {{-->--}}

                                                    {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}

                                                {{--</a>--}}
                                            {{--</td>--}}
                                            {{--<td>don din</td>--}}
                                            {{--<td>4</td>--}}
                                            {{--<td>don din, Thursday 4th of January 2018</td>--}}
                                            {{--<td></td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}

                                            {{--<td>--}}
                                                {{--<a href="/forum/7">dasdsad</a>--}}
                                                {{--<a--}}
                                                        {{--href="forum/7/user/edit"--}}
                                                        {{--data-toggle="tooltip" data-placement="top" title="Edit Your Thread"--}}
                                                {{-->--}}

                                                    {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}

                                                {{--</a>--}}
                                            {{--</td>--}}
                                            {{--<td>don din</td>--}}
                                            {{--<td>0</td>--}}
                                            {{--<td>-</td>--}}
                                            {{--<td></td>--}}
                                        {{--</tr>--}}

                                        {{--</tbody>--}}
                                    {{--</table>--}}


                                {{--</div>--}}

                                {{--<div class="tab-pane" id="jobfamily">--}}
                                    {{--<h1>Forum Sales and Marketing</h1>--}}
                                    {{--<p>forum ini ditujukan untuk karyawan Sales and Marketing PT Aerofood Indonesia</p>--}}
                                    {{--<button  class="btn btn-info" data-toggle="modal" data-target="#modal_job_family">New Thread</button><br><br>--}}

                                    {{--<table  class="table table-striped detailTable text-left">--}}
                                        {{--<thead>--}}
                                        {{--<tr>--}}
                                            {{--<th>Topic Discussion</th>--}}
                                            {{--<th>Started By</th>--}}
                                            {{--<th>Replies</th>--}}
                                            {{--<th>Last Post</th>--}}
                                            {{--<th>Created At</th>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}

                                        {{--<tr>--}}
                                            {{--<td>--}}
                                                {{--<a href="/forum/2">haha in ajah</a>--}}
                                                {{--<a--}}
                                                        {{--href="forum/2/user/edit"--}}
                                                        {{--data-toggle="tooltip" data-placement="top" title="Edit Your Thread"--}}
                                                {{-->--}}

                                                    {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i>--}}

                                                {{--</a>--}}
                                            {{--</td>--}}
                                            {{--<td>don din</td>--}}
                                            {{--<td>1</td>--}}
                                            {{--<td>don din, Thursday 10th of August 2017</td>--}}
                                            {{--<td>2017-08-10 01:45:59</td>--}}
                                        {{--</tr>--}}

                                        {{--</tbody>--}}
                                    {{--</table>--}}

                                {{--</div>--}}


                                {{--<div class="tab-pane" id="dept">--}}
                                    {{--<h1>Forum deps d</h1>--}}
                                    {{--<p>forum ini ditujukan untuk karyawan deps d PT Aerofood Indonesia</p>--}}
                                    {{--<button  class="btn btn-info" data-toggle="modal" data-target="#modal_department">New Thread</button><br><br>--}}

                                    {{--<table  class="table table-striped detailTable text-left">--}}
                                        {{--<thead>--}}
                                        {{--<tr>--}}
                                            {{--<th>Topic Discussion</th>--}}
                                            {{--<th>Started By</th>--}}
                                            {{--<th>Replies</th>--}}
                                            {{--<th>Last Post</th>--}}
                                            {{--<th>Created At</th>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}


                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}


    {{--</div>--}}



    {{--<div class="modal fade" id="modal_edit_forum" role="dialog">--}}
        {{--<div class="modal-dialog modal-lg">--}}
            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content" >--}}
                {{--<form--}}
                        {{--class="form-horizontal"--}}
                        {{--role="form" method="POST"--}}
                        {{--action="/forum/user/update"--}}
                        {{--enctype="multipart/form-data">--}}
                    {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                        {{--<h4 class="modal-title">Edit Your Thread</h4>--}}
                    {{--</div>--}}

                    {{--<div class="modal-body">--}}
                        {{--<input type="hidden" name="_token" value="ccCikyJ5lHKY7OM7JVFlFG8UqAh0vPuERy05Zu0w">--}}

                        {{--<input type="hidden" id="id_forum_edit" name="id_forum_edit">--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="title" class="col-md-3 control-label">Title</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="text" id="title_edit" name="title"/>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="can_reply" id="can_reply_edit" class="col-md-3 control-label">Can Reply</label>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<select name="can_reply" >--}}
                                    {{--<option value="1">Yes</option>--}}
                                    {{--<option value="0">No</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="content" class="col-md-3 control-label">Content</label>--}}

                            {{--<div class="col-md-10">--}}
                                {{--<textarea class="summernote" id="summernote_edit" name="content_edit"></textarea>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="image" class="col-md-3 control-label">Upload attachment</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<div class="input-group">--}}
                                {{--<span class="input-group-btn">--}}
                                    {{--<span class="btn btn-default btn-file">--}}
                                        {{--Browse..--}}
                                        {{--<input type="file"--}}
                                               {{--id="filetiga"--}}
                                               {{--onchange="javascript:updateList4()"--}}
                                               {{--name="file_pendukung[]"--}}
                                               {{--multiple/>--}}
                                    {{--</span>--}}
                                {{--</span>--}}
                                    {{--<input type="text" class="form-control" value="select file(s)" readonly>--}}
                                {{--</div></br>--}}
                                {{--<div class='file-uploaded'>--}}
                                    {{--<p id="attachments_edit">--}}

                                    {{--</p>--}}
                                    {{--<p>--}}
                                    {{--<div id="fileListtiga">--}}

                                    {{--</div>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<input type="submit" class="btn btn-primary" value="Update">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}

                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<!-- New Thread Umum -->--}}
    {{--<div class="modal fade" id="modal_umum" role="dialog">--}}
        {{--<div class="modal-dialog modal-lg">--}}
            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content" >--}}
                {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('forum/store') }}" enctype="multipart/form-data">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                        {{--<h4 class="modal-title">New Threada</h4>--}}
                    {{--</div>--}}

                    {{--<div class="modal-body">--}}
                        {{--<input type="hidden" name="_token" value="ccCikyJ5lHKY7OM7JVFlFG8UqAh0vPuERy05Zu0w">--}}

                        {{--<input type="hidden" name="id_department" value="">--}}
                        {{--<input type="hidden" name="id_job_family" value="">--}}


                        {{--<div class="form-group">--}}
                            {{--<label for="title" class="col-md-3 control-label">Title</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="text" name="title">--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="can_reply" class="col-md-3 control-label">Can Reply</label>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<select name="can_reply" class="form-control pull-left">--}}
                                    {{--<option value="1">Yes</option>--}}
                                    {{--<option value="0">No</option>--}}
                                {{--</select><br>--}}

                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group" >--}}
                            {{--<label for="content" class="col-md-3 control-label">Content</label>--}}

                            {{--<div class="col-md-8" name="content">--}}
                                {{--<textarea class="summernote" name="content"></textarea>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="image" class="col-md-3 control-label">Upload attachment</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<div class="input-group">--}}
                                {{--<span class="input-group-btn">--}}
                                    {{--<span class="btn btn-default btn-file">--}}
                                        {{--Browse..--}}
                                        {{--<input type="file"--}}
                                               {{--id="file"--}}
                                               {{--onchange="javascript:updateList()"--}}
                                               {{--name="file_pendukung[]"--}}
                                               {{--multiple/>--}}
                                    {{--</span>--}}
                                {{--</span>--}}
                                    {{--<input type="text" class="form-control" value="select file(s)" readonly>--}}
                                {{--</div></br>--}}
                                {{--<div class='file-uploaded'>--}}
                                    {{--<p>--}}
                                    {{--<div id="fileList"></div>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}


                        {{--</div>--}}
                        {{--{{ csrf_field() }}--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Submit--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<!-- New Thread Department -->--}}
    {{--<div class="modal fade" id="modal_department" role="dialog">--}}
        {{--<div class="modal-dialog modal-lg">--}}
            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content" >--}}
                {{--<form class="form-horizontal" role="form" method="POST" action="http://localhost/code_alc2/public/forum" enctype="multipart/form-data">--}}
                    {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                        {{--<h4 class="modal-title">New Thread</h4>--}}
                    {{--</div>--}}

                    {{--<div class="modal-body">--}}
                        {{--<input type="hidden" name="_token" value="ccCikyJ5lHKY7OM7JVFlFG8UqAh0vPuERy05Zu0w">--}}

                        {{--<input type="hidden" name="id_department" value="4">--}}
                        {{--<input type="hidden" name="id_job_family" value="">--}}


                        {{--<div class="form-group">--}}
                            {{--<label for="title" class="col-md-3 control-label">Title</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="text" name="title"/>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="can_reply" class="col-md-3 control-label">Can Reply</label>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<select name="can_reply">--}}
                                    {{--<option value="1">Yes</option>--}}
                                    {{--<option value="0">No</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="content" class="col-md-3 control-label">Content</label>--}}

                            {{--<div class="col-md-8">--}}
                                {{--<textarea class="summernote" name="content3"></textarea>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="image" class="col-md-3 control-label">Upload attachment</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<div class="input-group">--}}
                                {{--<span class="input-group-btn">--}}
                                    {{--<span class="btn btn-default btn-file">--}}
                                        {{--Browse..--}}
                                        {{--<input type="file"--}}
                                               {{--id="filedua"--}}
                                               {{--onchange="javascript:updateList2()"--}}
                                               {{--name="file_pendukung[]"--}}
                                               {{--multiple/>--}}
                                    {{--</span>--}}
                                {{--</span>--}}
                                    {{--<input type="text" class="form-control" value="select file(s)" readonly>--}}
                                {{--</div></br>--}}
                                {{--<div class='file-uploaded'>--}}
                                    {{--<p>--}}
                                    {{--<div id="fileListdua">--}}

                                    {{--</div>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Submit--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<!-- New Thread Job Family -->--}}
    {{--<div class="modal fade" id="modal_job_family" role="dialog">--}}
        {{--<div class="modal-dialog modal-lg">--}}
            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content" >--}}
                {{--<form class="form-horizontal" role="form" method="POST" action="http://localhost/code_alc2/public/forum" enctype="multipart/form-data">--}}
                    {{--<div class="modal-header">--}}
                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                        {{--<h4 class="modal-title">New Thread</h4>--}}
                    {{--</div>--}}

                    {{--<div class="modal-body">--}}
                        {{--<input type="hidden" name="_token" value="ccCikyJ5lHKY7OM7JVFlFG8UqAh0vPuERy05Zu0w">--}}

                        {{--<input type="hidden" name="id_department" value="">--}}
                        {{--<input type="hidden" name="id_job_family" value="2">--}}


                        {{--<div class="form-group">--}}
                            {{--<label for="title" class="col-md-3 control-label">Title</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input type="text" name="title"/>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="can_reply" class="col-md-3 control-label">Can Reply</label>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<select name="can_reply" >--}}
                                    {{--<option value="1">Yes</option>--}}
                                    {{--<option value="0">No</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="content" class="col-md-3 control-label">Content</label>--}}

                            {{--<div class="col-md-8">--}}
                                {{--<textarea class="summernote" name="content2"></textarea>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="image" class="col-md-3 control-label">Upload attachment</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<div class="input-group">--}}
                                {{--<span class="input-group-btn">--}}
                                    {{--<span class="btn btn-default btn-file">--}}
                                        {{--Browse..--}}
                                        {{--<input type="file"--}}
                                               {{--id="filetiga"--}}
                                               {{--onchange="javascript:updateList3()"--}}
                                               {{--name="file_pendukung[]"--}}
                                               {{--multiple/>--}}
                                    {{--</span>--}}
                                {{--</span>--}}
                                    {{--<input type="text" class="form-control" value="select file(s)" readonly>--}}
                                {{--</div></br>--}}
                                {{--<div class='file-uploaded'>--}}
                                    {{--<p>--}}
                                    {{--<div id="fileListtiga">--}}

                                    {{--</div>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Submit--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection
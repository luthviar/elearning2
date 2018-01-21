@extends('user.layouts.app')

@section('content')

<div class="page-container" id="wrapper">
    <div class="page-content-wrapper">

        <div class="page-content" style="background-color: rgb(243, 247, 248);opacity: 1;">
            <div class="block-advice">
                <div class="" id="modal_edit_forum" role="dialog">
                    <div class="">
                        <!-- Modal content-->
                        <div class="" >
                            <form
                                    class="form-horizontal"
                                    role="form" method="POST"
                                    action="{{ URL::action('ForumController@updateCommentByUser') }}"
                                    enctype="multipart/form-data">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">

                                        <a href="{{url()->previous()}}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                                        Edit Your Comment</h4>
                                    @if(empty(Session::get('success')) == false)
                                        <div class="alert alert-success text-center" role="alert">
                                            <h3>Success!</h3>
                                            <p>
                                                {{ Session::get('success') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <div class="modal-body">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="id_forum" value="{{ $forum->id  }}"/>

                                    <div class="form-group">
                                        <label for="title" class="col-md-3 control-label">Title</label>

                                        <div class="col-md-6">
                                            <input type="text" id="title_edit" name="title" value="{{ $forum->title  }}"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="content" class="col-md-3 control-label">Content</label>

                                        <div class="col-md-8">
                                            <textarea id ="" rows="5" cols="72" name="content" required>{{$forum->content}}</textarea>
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
                                                <hr>
                                                @foreach($forum['file_pendukung'] as $key=>$file)
                                                    <a href="{{URL::asset($file->attachment_url)}}">
                                                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                                                        {{$file->attachment_name}}
                                                    </a>
                                                    <span>
                                                        {{--<a--}}
                                                            {{--href="{{url(action('ForumController@deleteAttachmentCommentByUser',$file->id))}}"--}}
                                                           {{--style="color: red;">--}}
                                                            {{--<i class="fa fa-trash" aria-hidden="true"></i>--}}
                                                            {{--delete--}}
                                                        {{--</a>--}}



                        <a
                            data-toggle="modal" data-target="#myModal{{$key}}"
                            style="cursor: pointer; color: red;"
                        >
                            <i style="" class="fa fa-trash" aria-hidden="true"></i>
                            Delete
                        </a>


                        <script>
                            function submit_modal{{$key}}(){
                                window.open('{{url(action('ForumController@deleteAttachmentCommentByUser',$file->id))}}','_self')
                                //$('#form_delete').submit();
                            }
                        </script>

                        <!-- Modal Delete Chapter -->
                        <div class="modal fade" id="myModal{{$key}}"
                             tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h1 class="modal-title text-center" id="myModalLabel"><strong>
                                                Are you serious to delete this ATTACHMENT?</strong></h1>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>The deleted ATTACHMENT cannot be restored.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="button" id="submit_button" onclick="submit_modal{{$key}}()"
                                                class="btn btn-danger">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>






                                                    </span>
                                                    <br/>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <input type="submit" class="btn btn-block btn-primary" style="background-color: #13B795 !important;" value="Update">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">--}}
    {{--<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}
    {{--<script type="text/javascript">--}}
    {{--$(document).ready(function() {--}}
    {{--$('.detailTable').DataTable({--}}
    {{--"order": [[ 0, "desc" ]]--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
    {{--<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}

    {{-- modal edit forum --}}



    {{--modal edit forum--}}


    <script>
        updateList = function() {
            var input = document.getElementById('file');
            var output = document.getElementById('fileList');

            output.innerHTML = 'Selected file(s) <br><ul>';
            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML += '<li>' + input.files.item(i).name + '</li>';

            }
            output.innerHTML += '</ul>';
        }

        updateList2 = function() {
            var input = document.getElementById('filedua');
            var output = document.getElementById('fileListdua');

            output.innerHTML = 'Selected file(s) <br><ul>';
            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML += '<li>' + input.files.item(i).name + '</li>';

            }
            output.innerHTML += '</ul>';
        }

        updateList3 = function() {
            var input = document.getElementById('filetiga');
            var output = document.getElementById('fileListtiga');

            output.innerHTML = 'Selected file(s) <br><ul>';
            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML += '<li>' + input.files.item(i).name + '</li>';

            }
            output.innerHTML += '</ul>';
        }

        updateList4 = function() {
            var input = document.getElementById('filetiga');
            var output = document.getElementById('fileListtiga');

            output.innerHTML = 'Selected file(s) <br><ul>';
            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML += '<li>' + input.files.item(i).name + '</li>';

            }
            output.innerHTML += '</ul>';
        }
    </script>

    {{--edit forum script--}}
    <script>
        function editForum($id_edit,$title,$can_reply,$content,$attachments) {
            $("#id_forum_edit").val($id_edit);
            $("#title_edit").val($title);
            $("#can_reply_edit").val($can_reply);

            $("#summernote_edit").summernote("code", $content);
//                $("#content_edit").html($content);

            $("#attachments_edit").html($attachments);

            $('#modal_edit_forum').modal("show");
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor

            });

        });
    </script>

@endsection
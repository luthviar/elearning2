@extends('user.layouts.app')

@section('content')
<style>
    .required {
        color: #f00 !important;
    }
</style>

<div class="container">
    <div class="page-container" id="wrapper">
        <div class="page-content-wrapper" style="padding: 50px 0px 30px 0px">
            <div class ="col-md-8" style="background:#fff;">
                <div class="row" style="padding:0 2em 2em 2em;">
                    @if(empty(Session::get('success')) == false)
                        <div class="alert alert-success text-center" role="alert">
                            <h3>Success!</h3>
                            <p>
                                {{ Session::get('success') }}
                            </p>
                        </div>
                    @endif

                    <h3 style="color:#23527c; font-weight:700 !important;">
                        {{ $forum['title'] }}
                        @if($forum->created_by == Auth::user()->id)
                            <b><a href="{{ url(action('ForumController@editByUser',$forum->id)) }}">
                                <i class="fa fa-pencil-square-o"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Edit this Thread."
                                   aria-hidden="true"></i>
                            </a></b>
                        @endif

                    </h3>
                    <h6 class="text-muted">{{$forum['personnel']->name}},
                        {{ \Carbon\Carbon::parse($forum->create_at)->format('l jS \\of F Y')}}</h6>
                    <hr class="style14">
                    <p align="justify">
                        {!! html_entity_decode($forum['content']) !!}

                    </p>
                    <hr class="style14">
                    <div class=''>
                        @if(!empty($forum['file_pendukung'][0]))
                            Attachment(s) : <br>
                            @foreach($forum['file_pendukung'] as $file)
                                <a href="{{URL::asset($file->attachment_url)}}">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>{{$file->attachment_name}}
                                </a><br>
                            @endforeach
                        @endif

                    </div>
                </div>
                <br>

                @if($forum->is_reply == 1)
                    <div class="block-advice" style="padding:0em;">
                        <div style="width:100%; background-color:#ccc;">
                            <h4 style="margin-top:0px; padding:10px 15px; text-align:center;">COMMENTS&nbsp;({{count($forum['replie'])}})</h4>
                        </div>
                        @foreach($forum['replie'] as $key=>$reply)
                            <div class="panel panel-default" style="margin:1em;">
                                <div class="panel-heading">
                                    @if($reply->created_by == Auth::user()->id)
                                        <div class="pull-right">
                                            <a
                                                    data-toggle="modal" data-target="#myModal{{$key}}"
                                                    style="cursor: pointer; color: red;"
                                            >
                                                <i style="" class="fa fa-remove" aria-hidden="true"></i>

                                            </a>


                                            <script>
                                                function submit_modal{{$key}}(){
                                                    window.open('{{url(action('ForumController@comment_delete',$reply->id))}}','_self')
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
                                                                    Are you serious to delete this comment?</strong></h1>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <p>The deleted comment cannot be restored.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                            <button type="button" id="submit_button" onclick="submit_modal{{$key}}()"
                                                                    class="btn btn-danger">Yes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    @endif

                                    <strong>
                                        {{ $reply['title'] }}
                                        @if($reply->created_by == Auth::user()->id)
                                            <a href="{{ url(action('ForumController@editCommentByUser',$reply->id)) }}">
                                                <i class="fa fa-pencil-square-o"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="Edit this comment."
                                                   aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </strong>
                                    <br/>
                                    {{$reply['personnel']->name}} ,
                                    {{ \Carbon\Carbon::parse($reply->create_at)->format('l jS \\of F Y')}}



                                </div>

                                <div class="panel-body">
                                    {!! html_entity_decode($reply['content']) !!}

                                    @if(!empty($reply['file_pendukung'][0]))
                                    <hr class="style14">
                                    <div class=''>
                                        Attachments : <br>
                                        @foreach($reply['file_pendukung'] as $file)
                                            <a href="{{URL::asset($file->attachment_url)}}">
                                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                                {{$file->attachment_name}}
                                            </a><br>
                                        @endforeach
                                    </div>
                                    @endif

                                </div>

                            </div>
                            <br>
                        @endforeach

                        @if(Auth::user() == null)
                        @else
                            <form id="myform" class="form-horizontal" role="form" method="POST"
                                  action="{{ URL::action('ForumController@storeCommentByUser') }}" enctype="multipart/form-data" style="padding:0 2em;">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                                <input type="hidden" name="id_forum" value="{{$forum->id}}">
                                <div class="form-group">
                                    <label for="title" class="col-md-12 text-muted" style="text-align:left">Title <span class="required">*</span></label>

                                    <div class="col-md-12">
                                        <input id="title" type="text"
                                               class="form-control" name="title" required
                                               value="[RE:] {{$forum['title']}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="col-md-12 text-muted" style="text-align:left">Content <span class="required">*</span></label>

                                    <div class="col-md-12">
                                        {{--<textarea id="summernote" type="text" class="form-control" name="content" required  style="resize: none;"></textarea>--}}
                                        <textarea class="form-control" rows="5" id="comment" name="content" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-md-12 text-muted" style="text-align:left">Upload attachment (optional)</label>

                                    <div class="col-md-12">
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
                                        </div>
                                        <div class='file-uploaded'>
                                            <p>
                                            <div id="fileList"></div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" style="text-align:right;">
                                        <button type="submit" class="btn btn-info">
                                            Send Comment
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                @endif
                @endif

            </div>

            <div class="col-lg-4  col-md-4 col-sm-12 hidden-sm hidden-xs">
                <div>
                    <nav>
                        <div>
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action active">
                                    <div style="display: table; width:100%;">
                                    <div style="float:left;">RECENT FORUM</div>
                                    <div style="float:right;"><i class="fa fa-users"></i></div>
                                    </div>
                                </div>
                                @foreach($recent as $rct)
                                    <a href="{{ url(action('ForumController@get_forum',$rct->id)) }}" class="list-group-item">
                                        <div class="text-muted"style="font-size:11px;">{{ \Carbon\Carbon::parse($forum->create_at)->format('l jS \\of F Y')}}</div>
                                        <div>{{$rct->title}}</div>
                                    </a>
                                @endforeach
                            </div>
                            <!--Links -->
                            <div class="list-group" style="position:relative;">
                                <div class="list-group-item list-group-item-action active">
                                    <div style="display: table; width:100%;">
                                    <div style="float:left;">LINK OUR PROJECT</div>
                                    <div style="float:right;"><i class="fa fa-link"></i></div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="carousel carousel-showonemoveone slide" id="carou-one">
                                <div class="carousel-inner">
                                    <?php $n = 0?>
                                    @foreach(Session::get('link') as $aero_link)
                                        @IF($n == 0)
                                        <?php $n = 1 ?>
                                        <div class="item active">
                                        @ELSE
                                        <?php $n++; ?>
                                        <div class="item">
                                        @ENDIF
                                            <div class="col-md-12">
                                                <a href="http://{{ $aero_link->url}}" style="text-decoration:none;" target="_blank">
                                                    <div style="border-top:1px; border-right:1px; border-bottom:1px; border-left:1px; border-style:solid; border-color:#ccc; background-color:#ffffff; padding:1em 1.5em; position:relative; border-radius:5px !important; height:140px; max-height:140px; position: relative;">
                                                        <div class="va-table">
                                                            <div class="va-middle">
                                                                <h3 style="margin:0; color:#ccc; text-transform:uppercase;"><b>{{$aero_link->name}}</b></h3>
                                                            </div>
                                                        </div>
                                                        <div class="va-table">
                                                            <div class="va-middle" style="height:40px;">
                                                                <h5 style="margin:0; color:#000;">{{$aero_link->detail_url}}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="va-table">
                                                            <div class="va-middle"><i class="fa fa-link"></i>&nbsp;&nbsp;</div>
                                                            <div class="va-middle">{{$aero_link->url}}</div>
                                                        </div>
                                                        <div style="position: absolute; bottom:1em; left:1.5em;">
                                                            <h5 style="margin:0; color:#000;"><div class="badge badge-primary">&nbsp;&nbsp;{{$aero_link->status}}&nbsp;&nbsp;</div></h5>
                                                        </div>
                                                        <div style="position: absolute; top:-1px; right:-1px;">
                                                            <div style="margin:0; color:#FFF; padding:3px 7px; font-size:12px; background-color:#fcb322; font-weight:bold; border-radius:0px 5px 0px 0px !important;">{{$n}}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>

                                    <a class="left carousel-control" href="#carou-one" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                                    <a class="right carousel-control" href="#carou-one" data-slide="next"><i class="fa fa-chevron-right"></i></a>

                            </div>
                        </div>
                            
                            
                        </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
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

        var navWrap = $('#navWrap'),
            nav = $('nav'),
            startPosition = navWrap.offset().top,
            stopPosition = $('#stopHere').offset().top - nav.outerHeight();

        $(document).scroll(function () {
            //stick nav to top of page
            var y = $(this).scrollTop();

            if (y > startPosition) {
                nav.addClass('sticky');
                if (y > stopPosition) {
					nav.css('top', stopPosition - y );
                } else {
                    nav.css('top', 0);
                }
            } else {
                nav.removeClass('sticky');
            }
        });
    </script>
    <style>
        .sticky {
            position: fixed;
        }
        p.big {
            line-height: 300%;
            font-size : 15px;
        }
    </style>
@endsection
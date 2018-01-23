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
            <div class="row">
            <div class ="col-md-8" style="background:#fff;">
                @if(empty(Session::get('success')) == false)
                    <div class="alert alert-success text-center" role="alert">
                        <h3>Success!</h3>
                        <p>
                            {{ Session::get('success') }}
                        </p>
                    </div>
                @endif
                    
                <div class ="col-md-12">
                    <h3 style="color:#23527c;"><b>{{ $news['title'] }}</b></h3>
                    <h6 class="text-muted">{{ \Carbon\Carbon::parse($news->create_at)->format('l jS \\of F Y')}}</h6>
                </div>
                <div class ="col-md-12">
                    <hr class="style14">
                    <p align="justify" class="big">
                       @if(empty($news->url_image))
                            <img src="{{URL::asset('Elegantic/images/ALS.jpg')}}" alt="Card image cap" style="width:300px; margin-right:1em; margin-bottom:1em;" align="left">
                        @else
                            <img src="{{URL::asset($news['url_image'])}}" alt="Card image cap" style="width:300px; margin-right:1em; margin-bottom:1em;" align="left">
                        @endif
                        {!! html_entity_decode($news['content']) !!}

                    </p>
                    <hr class="style14">
                    <div class=''>
                        @if(!empty($news['file_pendukung'][0]))
                            Attachments : <br>
                            @foreach($news['file_pendukung'] as $file)
                                <a href="{{URL::asset($file->attachment_url)}}">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>{{$file->attachment_name}}
                                </a><br>
                            @endforeach
                        @endif
                    </div>
                    <hr class="style14">
                    <br>

                   
                    @if($news->is_reply == 1)
                        <div class="block-advice" style="padding:0em;">
                            <div style="width:100%; background-color:#ccc;">
                                <h4 style="margin-top:0px; padding:10px 15px; text-align:center;">COMMENTS&nbsp;({{count($replies)}})</h4>
                            </div>
                            @foreach($replies as $key=>$reply)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    @if(empty(Auth::user()) == false)
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
                                                    window.open('{{url(action('NewsController@comment_delete',$reply->id))}}','_self')
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
                                    @endif

                                    <strong>{{ $reply['title'] }}
                                        @if(empty(Auth::user()) == false)
                                        @if($reply->created_by == Auth::user()->id)
                                            <a href="{{ url(action('NewsController@editCommentByUser',$reply->id)) }}">
                                                <i class="fa fa-pencil-square-o"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="Edit this comment."
                                                   aria-hidden="true"></i>
                                            </a>
                                        @endif
                                        @endif
                                    </strong><br>
                                    {{$reply['user']->name}} ,
                                    {{ \Carbon\Carbon::parse($reply->create_at)->format('d - m - Y , H:i:s')}}

                                </div>
                                <div class="panel-body">

                                    {!! html_entity_decode($reply['content']) !!}
                                    <br>
                                        @if(!empty($reply['file_pendukung'][0]))
                                        <div class ="">
                                            <hr class="style14">
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

                            @endforeach

                            @if(Auth::user() == null)

                            @else
                                <form id="myform" class="form-horizontal" role="form" method="POST"
                                      action="{{ URL::action('NewsController@storeCommentByUser') }}"
                                      enctype="multipart/form-data" style="padding:0 2em;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="id_news" value="{{$news->id}}">
                                    <div class="form-group">
                                        <label for="title" class="col-md-12 text-muted" style="text-align:left">Title <span class="required">*</span></label>

                                        <div class="col-md-12">
                                            <input id="title" type="text" class="form-control"
                                                   name="title" required  value="[RE:] {{$news['title']}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="content" class="col-md-12 text-muted" style="text-align:left">Content*</label>
                                        <div class="col-md-12">
                                            {{--<textarea title="content" id="content" id="summernote" name="content" required></textarea>--}}
                                            <textarea class="form-control" rows="5" id="comment" name="content" required style="width:100%;"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="col-md-12 text-muted">Upload attachment (optional)</label>

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
                                                Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4  col-md-4 col-sm-12 hidden-sm hidden-xs">
                
                <!--<div id="navWrap">-->
                <div>   
                    <nav>
                        <!--<div class ="fixedpositiion">-->
                        <div>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action active">Recent News</a>
                                @foreach($beritas as $brt)
                                <a href="{{ url(action('NewsController@get_news',$brt->id)) }}" class="list-group-item list-group-item-action"><span class="text-muted" style="font-size:11px;">{{ \Carbon\Carbon::parse($news->create_at)->format('l jS \\of F Y')}}</span><br>{{$brt->title}}</a>
                                @endforeach
                            </div>
                            <!--<div class="well">
                                <h4>Recent News</h4>
                                <hr class="style14">
                                @foreach($beritas as $brt)
                                    <a href="{{ url(action('NewsController@get_news',$brt->id)) }}">
                                        <p>{{$brt->title}}</p>
                                    </a>
                                @endforeach
                                <br>
                            </div>-->
                            <!--Recent Schedule -->
                            @include('user.layouts.schedule')
                            <!--Links -->
                            @include('user.layouts.aerofood_links')
                        </div>
                    </nav>
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
					nav.css('top', stopPosition - y);
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
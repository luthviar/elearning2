@extends('admin.layouts.app')

@section('page-name')
  <a href="{{ url(action('TrainingController@admin_training')) }}">
    <i class="fa fa-arrow-left"></i>
  </a>
  Manage Training
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary text-center">
            <div class="box-header">
              <h1 class="box-title">
               Training name:
                <strong>{{$training->modul_name}}</strong>
              </h1>
              <span class="pull-right">
                @if($training->is_publish == 0)
                  <a href="{{url(action('TrainingController@publish_training',$training->id))}}"
                     class="btn btn-success">PUBLISH TRAINING</a>
                @else
                  <a href="{{url(action('TrainingController@unpublish_training',$training->id))}}"
                     class="btn btn-danger">UN-PUBLISH TRAINING</a>
                @endif
                <a href="{{url(action('TrainingController@see_participant',$training->id))}}"
                   class="btn btn-info">SEE PARTICIPANTS</a>

                  <a href="{{url(action('TrainingController@edit_training',$training->id))}}"
                   class="btn btn-warning" style="word-spacing: normal;">
                        <i style="" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        EDIT TRAINING
                   </a>
                   <a href="{{url('admin/training/add_participant',$training->id)}}" class="btn btn-success">ADD PARTICIPANT</a>

              </span>
            </div>
            <div class="box-body">

            
              <!-- select -->
                <div class="form-group col-md-4">
                  <label>Training Parent</label>
                  <select class="form-control" disabled="true">
                  @foreach($parent as $par)
                    @if($par->id == $training->id_parent)
                    <option selected="true" value="{{$par->id}}">{{$par->modul_name}}</option>
                    @else
                    <option>{{$par->modul_name}}</option>
                    @endif
                  @endforeach
                  </select>
                </div>

             <!-- Date -->
              <div class="form-group col-md-4">
                <label>Training Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" value="{{$training->date}}" id="datepicker" disabled="true">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- time Picker -->
              <div class="bootstrap-timepicker col-md-4">
                <div class="form-group">
                  <label>Training Start:</label>

                  <div class="input-group">
                    <input type="text" value="{{$training->time}}" class="form-control" disabled="true">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>

              <!-- Textarea -->
              <div class="form-group">
                  <label>Training Overview</label>
                  <p>{!! html_entity_decode($training->description)  !!}</p>
              </div>


            </div>
            <!-- /.box-body -->
          </div>

                 <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">

            <div class="container">
            <h4>Chapter Training</h4>  
          </div>

            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#chapter_list" data-toggle="tab">
                  Chapter List
                </a>
              </li>
              @if(count($training['chapter']) != 0)
              @foreach($training['chapter'] as $chapter)
                @if($chapter->category == 0)
                <li>
                  <a href="#material{{$chapter->id}}" data-toggle="tab">
                    {{$chapter->chapter_name}}
                  </a>
                </li>
                @else
                <li>
                  <a href="#test{{$chapter->id}}" data-toggle="tab">
                    {{$chapter->chapter_name}}
                  </a>
                </li>
                @endif
              @endforeach
              @endif
              <li>
                <a href="{{url(action('TrainingController@add_chapter',$training->id))}}">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
              </li>
            </ul>

            <div class="tab-content">
              <div class="active tab-pane" id="chapter_list">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Chapter List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="record" class="table table-bordered table-striped">
                    <thead>

                    <tr>
                      <th>No</th>
                      <th>Chapter</th>
                      <th>Type</th>
                      <th>Content Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($training['chapter']) != null)
                    @foreach ($training['chapter'] as $key => $chapter)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$chapter->chapter_name}}</td>
                      @if( $chapter->category ==0)
                      <td>Material</td>
                      <td>{{count($chapter['material']['files_material'])}} Attachments</td>
                      @else
                      <td>Test</td>
                      <td>{{count($chapter['test']['questions'])}} Question</td>
                      @endif
                      
              
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
              </div>

              @if(count($training['chapter']) > 0 )
              @foreach($training['chapter'] as $chapter)
              @if($chapter->category == 0)
              <div class="tab-pane" id="material{{$chapter->id}}">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">{{$chapter->chapter_name}}</h3>
                  <span class="pull-right">
                    <a class="btn btn-warning" href="{{url(action('TrainingController@manage_chapter',$chapter->id))}}">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      Manage Chapter
                    </a>
                  </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                  <h4>{{$chapter->chapter_name}}</h4>
                  <p>{!! $chapter['material']->description !!}</p>
                  <h5><strong>Attachments</strong></h5>
                  <div>
                    @foreach($chapter['material']->files_material as $material)
                      <button onclick="window.location.href='{{ URL::asset($material->url) }}'"
                              class="btn btn-block btn-flat"> {{ $material->name }}</button>
                    @endforeach
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
              </div>

              @else
              <div class="tab-pane" id="test{{$chapter->id}}">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">{{$chapter->chapter_name}}</h3>
                  <span class="pull-right">
                    <a class="btn btn-warning" href="{{url(action('TrainingController@manage_chapter',$chapter->id))}}">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      Manage Chapter
                    </a>
                  </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                  <h4>{{$chapter->chapter_name}}</h4>
                  <h5>Test Time : {{$chapter['test']->time}}minutes</h5>
                  <p>{!! $chapter['test']->description !!}</p>
                  
                    <div class="box box-success text-left">
                    <div class="box-header">
                      <h3 class="box-title">Test Question</h3>                     
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul style="list-style-type: none;">
                        @if(count($chapter['test']['questions']) >0)
                        @foreach ($chapter['test']['questions'] as $key => $question)
                        <li>{{$key+1}}. {{$question->question_text}} 
                          <ul style="list-style-type: none;">
                            @if(count($question['option']) >0)
                            @foreach($question['option'] as $option)
                            @if($option->is_true == 1)
                            <li><input type="radio" name="{{$option->id}}" checked>
                                {{$option->option_text}}
                                <span style="color: green"><i class="fa fa-check" aria-hidden="true"></i> true answer</span></li>
                            @else
                            <li><input type="radio" name="{{$option->id}}" >
                                {{$option->option_text}}</li>
                            @endif
                            @endforeach
                            @endif
                          </ul>
                        </li>
                        @endforeach
                        @endif
                      </ul>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
              </div>
              @endif
              @endforeach
              @endif

              <div class="tab-pane" id="add">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Add Chapter</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                  <!-- Title -->
                  <div class="form-group col-md-6">
                    <label for="title">Chapter Name</label>
                    <input type="text" class="form-control" id="title" name="title" id="title" placeholder="Training title">
                  </div>
                    <!-- select -->
                  <div class="form-group col-md-6">
                    <label>Chapter Type</label>
                    <select class="form-control" id="add_chapter_type">
                      <option value="0">Material</option>
                      <option value="1">Test</option>
                    </select>
                  </div>
                    <!-- Textarea -->
                  <div class="form-group">
                      <label>Chapter Description</label>
                      <textarea class="textarea" id="content" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                    
                  <!-- ADD MATERIAL  -->
                  <div class="box box-success text-left col-md-6" id="add_material_form">
                    <div class="box-header">
                      <h3 class="box-title">Add Material Attachments</h3>  
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- MATERIAL UPLOADED -->
                        <div class="box box-success col-md-6">
                          <div class="box-body">
                            <h5>Material Uploaded</h5>
                            <p>
                              <a href="" class="btn btn-default" style="width: 100%">attachment 1</a>
                              <a href="" class="btn btn-default" style="width: 100%">attachment 2</a>
                              <a href="" class="btn btn-default" style="width: 100%">attachment 3</a>
                            </p>
                          </div>
                          <!-- /.box-body -->
                        </div>

                        <!-- UPLOAD MATERIAL FORM -->
                        <div class="box box-warning col-md-6">
                          <!-- /.box-header -->
                          <div class="box-body">
                            <h5>Form Upload</h5>
                          </div>
                          <!-- /.box-body -->
                        </div>

                    </div>
                    <!-- /.box-body -->
                  </div>


                  <!-- ADD TEST QUESTION AND ANSWER -->
                    <div class="box box-success text-left hidden" id="add_test_form">
                    <div class="box-header">
                      <h3 class="box-title">Test Question</h3>  <span class="pull-right"><i style="color: green;" class="fa fa-plus" aria-hidden="true">add question</i></span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul style="list-style-type: none;">
                        <li>1. Siapakah presiden kita ? <span class="pull-right" style="color: red"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit</i> <i class="fa fa-times" aria-hidden="true">remove</i></span>
                          <ul style="list-style-type: none;">
                            <li><input type="radio" name="optionsRadios" value="option1" checked>
                                Option one is this and that&mdash;be sure to include why it's great
                                <span style="color: green"><i class="fa fa-check" aria-hidden="true"></i> true answer</span></li>
                            <li><input type="radio" name="optionsRadios" value="option1">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                            <li><input type="radio" name="optionsRadios" value="option1">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                          </ul>
                        </li>
                        <li>2. Berapa harga cabe sekarang ? <span class="pull-right" style="color: red"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit</i> <i class="fa fa-times" aria-hidden="true">remove</i></span>
                          <ul style="list-style-type: none;">
                            <li><input type="radio" name="optionsRadios2" value="option2" checked>
                                Option one is this and that&mdash;be sure to include why it's great
                                <span style="color: green"><i class="fa fa-check" aria-hidden="true"></i> true answer</span></li>
                            <li><input type="radio" name="optionsRadios2" value="option2">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                            <li><input type="radio" name="optionsRadios2" value="option2">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <!-- /.box-body -->
                  </div>


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
          <!-- /.box -->
        </div>
    </div>
    <div class="row text-center">
      {{--<button class="btn btn-success">Next Step</button>--}}
    </div>


    </section>
    <!-- /.content -->


@endsection

@section('script')


<script type="text/javascript">
  //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });


</script>

<script src="{{URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function(){
  $('#title').on('input', function(){ 
    var input = $('#title').val();
    $('#preview_news_title').html(input);

   });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#content').on('input', function(){ 
    var input = $('#content').val();
    $('#preview_news_content').html(input);

   });
});
</script>


@endsection
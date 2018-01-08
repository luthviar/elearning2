@extends('admin.layout_admin')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Chapter Training
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/training')}}">Training</a></li>
        <li class="active">Add Chapter Training</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add Chapter</h3>
            </div>
            <div class="box-body">

                 <form action="{{url('/edit_chapter_submit')}}" method="post">
                 {{csrf_field()}}
                  <input type="hidden" name="id_chapter" value="{{$chapter->id}}">
                  <!-- Title -->
                  <div class="form-group col-md-6">
                    <label for="title">Chapter Name</label>
                    <input type="text" class="form-control" name="chapter_name" value="{{$chapter->chapter_name}}" id="title" placeholder="Training title">
                  </div>
                    <!-- select -->
                  <div class="form-group col-md-6">
                    <label>Chapter Type</label>
                    <select class="form-control" id="add_chapter_type" name="category">
                      @if($chapter->category == 0)
                      <option value="0" selected="true">Material</option>
                      <option value="1">Test</option>
                      @else
                      <option value="0">Material</option>
                      <option value="1" selected="true">Test</option>
                      @endif
                    </select>
                  </div>
                    <!-- Textarea -->
                  <div class="form-group">
                      <label>Chapter Description</label>
                      
                      <textarea class="textarea" id="content" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        @if($chapter->category == 0)
                        {{$chapter['material']->description}}
                        @else
                        {{$chapter['test']->description}}
                        @endif
                        </textarea>
                  </div>
                    
                  <div class="col-md-12 text-center">
                   <input type="submit" name="submit" class="btn btn-default">
                  </div>
                  </form> 

                    </div>
                    <!-- /.box-body -->
                  </div>

            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->

        </div>

    </div>
    


    </section>
    <!-- /.content -->


@endsection

@section('script')
<script type="text/javascript">
  $('#add_chapter_type').on('input', function(){
      var chapter_type = $('#add_chapter_type').val();
    if (chapter_type == 0) {
      // material form load
      $('#add_test_form').addClass('hidden');
      $('#add_material_form').removeClass('hidden');
    } else {
      // test form load
      $('#add_test_form').removeClass('hidden');
      $('#add_material_form').addClass('hidden');
    }
  });
</script>
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
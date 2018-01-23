@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url(action('TrainingController@manage_training',$training->id)) }}">
        <i class="fa fa-arrow-left"></i>
    </a>
  Reorder Chapter
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
      <div class="box box-primary">
            <div class="box-header">
                @if(Session::get('failed') != null)
                    <div class="row">
                        <div class="col-lg-12">
                            <hr/>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Gagal!</h4>
                                {{ Session::get('failed') }}
                            </div>
                        </div>
                    </div>
                @endif
              <h3 class="box-title">
                  Training name:<br/> <b>{{$training->modul_name}}</b><br/> Reorder Chapter
              </h3>
            </div>
            <div class="box-body">

            <form action="{{url(action('TrainingController@change_order_submit'))}}" method="post">
              {{ csrf_field() }}

              <input type="hidden" name="id_training" value="{{$training->id}}">
              <table class="table">
              <thead>
                <tr>
                  <td width="20%" class="text-right">Chapter <br/> Sequence</td>
                  <td>Chapter Name</td>
                </tr>
              </thead>
              <tbody>
                @foreach($training['chapters'] as $key => $chapter)
                <tr>
                  <td width="20%" class="text-right">{{$key + 1}}</td>
                  <td>  
                    <select class="form-control" name="{{$key}}" style="width: 100%;" required>
                    @foreach($training['chapters'] as $value)
                        @if($key == $value->sequence)
                        <option value="{{$value->id}}" selected="true">{{$value->chapter_name}}</option>
                        @else
                        <option value="{{$value->id}}">{{$value->chapter_name}}</option>
                        @endif
                    @endforeach
                    </select>
                  </td>
                </tr>
                @endforeach
              </tbody>
              </table>


              <div class="row text-center">
                  <div class="col-lg-12">
                      <button class="btn btn-block btn-info">
                          Update Chapter Order
                          <i class="fa fa-save"></i>
                      </button>
                  </div>
              </div>

              </form>
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
  //Date picker
    $('#datepicker').datepicker({
      
      format: 'yyyy-mm-dd',
    });
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
      timeFormat: 'HH:i',
    });


</script>

<<!-- script src="{{URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>

  $(function () {
    
    //bootstrap WYSIHTML5 - text editor
  var editor =  $(".textarea").wysihtml5({
      toolbar: {
        "font-styles": true, // Font styling, e.g. h1, h2, etc.
        "emphasis": true, // Italics, bold, etc.
        "lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
        "html": false, // Button which allows you to edit the generated HTML.
        "link": true, // Button to insert a link.
        "image": false, // Button to insert an image.
        "color": true, // Button to change color of font
        "blockquote": false, // Blockquote
        
      }
    });

  
  
  
  
  });

</script> -->

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
<script type="text/javascript">
  $('#parent').on('input',function(){
    var $input = $('#parent').val();
    if ($input == 3) {
      $('#department').removeClass('hidden');
    }else{
      $('#department').addClass('hidden');
    }
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="col-md-12" style="padding-bottom: 5px;"><h6>Trainer Name</h6><input type="text" class="form-control" style="width: 50%;" placeholder="name.." name="trainer_name[]"><h6>Trainer Info</h6><input type="text" class="form-control" style="width: 50%;" placeholder="info.." name="trainer_info[]"><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

    @include('admin.layouts.summernote')

@endsection
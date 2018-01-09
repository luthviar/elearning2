<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Slider
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('/admin_slider')); ?>">Slider</a></li>
        <li class="active">Add Slider</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">

    <form method="post" action="<?php echo e(url('slider_add_submit')); ?>" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
      

      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add Slider</h3>
            </div>
            <div class="box-body">
              <?php echo e(csrf_field()); ?>


            
              <!-- Title -->
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Slider title">
              </div>


              <!-- Image -->
              <div class="form-group">
                  <label for="exampleInputFile">Image background</label>
                  <input type="file" id="img" name="image">
              </div>

              <!-- Textarea -->
              <div class="form-group">
                  <label>Textarea</label>
                  <textarea class="textarea" id="second_title" name="second_title" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
      

          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Preview Slider Image</h3>
             </div> 
            
            <div class="box-body">
                <div class="image">
                  <img src="<?php echo e(url('gambar.png')); ?>" id="image_preview" width="100%" height="250px">
                </div>  
                <h4 id="title_preview"></h4>
                <p id="second_title_preview"></p>
              
            </div>
          </div>
          <!-- /.box -->

        </div>
    </div>
    <div class="row text-center">
      <button class="btn btn-success">submit</button>
    </div>
    </form>


    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<script>

  // $(function () {
    
  //   //bootstrap WYSIHTML5 - text editor
  // var editor =  $(".textarea").wysihtml5({
  //     toolbar: {
  //       "font-styles": true, // Font styling, e.g. h1, h2, etc.
  //       "emphasis": true, // Italics, bold, etc.
  //       "lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
  //       "html": false, // Button which allows you to edit the generated HTML.
  //       "link": true, // Button to insert a link.
  //       "image": false, // Button to insert an image.
  //       "color": true, // Button to change color of font
  //       "blockquote": false, // Blockquote
        
  //     }
  //   });

  
  
  
  
  // });

</script>

<script type="text/javascript">
$(document).ready(function(){
  $('#title').on('input', function(){ 
    var input = $('#title').val();
    $('#title_preview').html(input);

   });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#second_title').on('input', function(){ 
    var input = $('#second_title').val();
    $('#second_title_preview').html(input);

   });
});
</script>

<script type="text/javascript">
  function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#image_preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#img").change(function() {
  readURL(this);
});
</script>
<script type="text/javascript">
  updateList = function() {
  var input = document.getElementById('file');
  var output = document.getElementById('file_list');

  output.innerHTML = '<ul>';
  for (var i = 0; i < input.files.length; ++i) {
    output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
  }
  output.innerHTML += '</ul>';
}
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
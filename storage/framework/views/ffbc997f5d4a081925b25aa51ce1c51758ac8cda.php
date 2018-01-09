<?php $__env->startSection('content'); ?>

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
                                    action="<?php echo e(URL::action('ForumController@updateByUser')); ?>"
                                    enctype="multipart/form-data">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">

                                        <a href="<?php echo e(url()->previous()); ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                                        Edit Your Thread</h4>
                                </div>

                                <div class="modal-body">
                                    <?php echo e(csrf_field()); ?>


                                    <input type="hidden" name="id_forum" value="<?php echo e($forum->id); ?>"/>

                                    <div class="form-group">
                                        <label for="title" class="col-md-3 control-label">Title</label>

                                        <div class="col-md-6">
                                            <input type="text" id="title_edit" name="title" value="<?php echo e($forum->title); ?>"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="can_reply" id="can_reply_edit" class="col-md-3 control-label">Can Reply</label>
                                        <div class="col-md-6">
                                            <?php if($forum->is_reply == 0): ?>
                                                   <label class="radio-inline">
													  <input type="radio" name="can_reply" value="0" checked="checked"No
													</label>
													<label class="radio-inline">
													  <input type="radio" name="can_reply" value="1">Yes
													</label>
                                                <?php else: ?>
                                                   <label class="radio-inline">
													  <input type="radio" name="can_reply" value="0">No
													</label>
													<label class="radio-inline">
													  <input type="radio" name="can_reply" value="1" checked="checked">Yes
													</label>
                                                <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="content" class="col-md-3 control-label">Content</label>

                                        <div class="col-md-8">
                                            <textarea id ="summernote" name="content"><?php echo e($forum->content); ?></textarea>
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
                                                <?php $__currentLoopData = $forum['file_pendukung']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(URL::asset($file->url)); ?>"><i class="fa fa-paperclip" aria-hidden="true"></i>  <?php echo e($file->name); ?></a>       <span><a href="/news_attachment_delete/<?php echo e($file->id); ?>" style="color: red;"><i class="fa fa-trash" aria-hidden="true"></i>delete</a></span><br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <input type="submit" class="btn btn-primary" style="background-color: #13B795 !important;" value="Update">
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
<script>

    $(window).load(function(){

        setTimeout(function() {
                $("#loading").fadeOut(function(){

                    $(this).remove();
                    $('body').removeAttr('style');
                })
            }
            , 300);
    });


    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.init();

    });
</script>

</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
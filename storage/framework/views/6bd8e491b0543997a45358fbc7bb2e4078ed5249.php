<!-- Scripts
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>-->


    

        
                

                    
                    
                
            
            
    


    
        
        

    

<script type="text/javascript" src="<?php echo e(URL::asset('Elegantic/js/jquery.bxslider.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('Elegantic/js/jquery.placeholder.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('Elegantic/js/jquery.uniform.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('Elegantic/js/fancySelect.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('Elegantic/js/main.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('Elegantic/js/app.js')); ?>"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<!-- END CORE PLUGINS -->
<style>
    .pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
</style>
<script type="text/javascript">
    $(document).ready(function(){
        //how much items per page to show
        var show_per_page = 6;
        //getting the amount of elements inside content div
        var number_of_items = $('#content').children().length;
        //calculate the number of pages we are going to have
        var number_of_pages = Math.ceil(number_of_items/show_per_page);
        //set the value of our hidden input fields
        $('#current_page').val(0);
        $('#show_per_page').val(show_per_page);
        //now when we got all we need for the navigation let's make it '
        /*
         what are we going to have in the navigation?
         - link to previous page
         - links to specific pages
         - link to next page
         */
        var navigation_html = '';
        var current_link = 0;
        while(number_of_pages > current_link){
            navigation_html += '<li><a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a></li>';
            current_link++;
        }
        navigation_html += '';

        $('#page_navigation').html(navigation_html);
        //add active_page class to the first page link
        $('#page_navigation .page_link:first').addClass('active_page');
        //hide all the elements inside content div
        $('#content').children().css('display', 'none');
        //and show the first n (show_per_page) elements
        $('#content').children().slice(0, show_per_page).css('display', 'block');
    });
    function previous(){
        new_page = parseInt($('#current_page').val()) - 1;
        //if there is an item before the current active link run the function
        if($('.active_page').prev('.page_link').length==true){
            go_to_page(new_page);
        }
    }
    function next(){
        new_page = parseInt($('#current_page').val()) + 1;
        //if there is an item after the current active link run the function
        if($('.active_page').next('.page_link').length==true){
            go_to_page(new_page);
        }
    }
    function go_to_page(page_num){
        //get the number of items shown per page
        var show_per_page = parseInt($('#show_per_page').val());
        //get the element number where to start the slice from
        start_from = page_num * show_per_page;
        //get the element number where to end the slice
        end_on = start_from + show_per_page;
        //hide all children elements of content div, get specific items and show them
        $('#content').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
        /*get the page link that has longdesc attribute of the current page and add active_page class to it
         and remove that class from previously active page link*/
        $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');
        //update the current page input field
        $('#current_page').val(page_num);
    }
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table_training').DataTable({
            "order": [[ 3, "desc" ]],
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table_raport').DataTable({
            "order": [[ 1, "desc" ]],
        });
    });

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
        window.location.href = '...';
        $("#id_forum_edit").val($id_edit);
        $("#title_edit").val($title);
        $("#can_reply_edit").val($can_reply);

        $("#summernote_edit").summernote("code", $content);
//                $("#content_edit").html($content);

        $("#attachments_edit").html($attachments);

        $('#modal_edit_forum').modal("show");
    }
</script>




<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.detailTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    });
</script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
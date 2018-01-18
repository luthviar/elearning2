<link rel="stylesheet" type="text/css" href="{{ url('css/loading.css') }}" />

<div id="loadingz" style="display: none;" class="loading">Loading&#8230;</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("button").click(function () {
            $("#loadingz").show();
        });
    });
//    $(document).ready(function(){
//        $("#loadingz").css("visibility", "hidden");
////            $("#loadingz").fadeIn();
//    });
//
//    $(document).ready(function(){
//        $("button").click(function(){
//            $("#loadingz").css("visibility", "visible").fadeIn();
////            $("#loadingz").fadeIn();
//        });
//    });
</script>



{{--<div class="load-container load5">--}}
    {{--<div class="loader">Loading...</div>--}}
{{--</div>--}}

@extends('layout')

@section('content')

<div class="container text-center">
	<iframe id="iframe"
			src = "{{URL::to('/ViewerJS/index.html#../files/situs.pdf')}}"
			width='100%'
			height='600'
			allowfullscreen webkitallowfullscreen>
	</iframe>

	<a href="{{ URL::previous() }}" class="btn btn-success">back</a>
</div>
<script type="text/javascript">
document.ready( function(){
	$('#iframe').ready(function() {
	   setTimeout(function() {
	      $('#iframe').contents().find('#download').remove();
	   }, 100);
	});
});

</script>

@endsection


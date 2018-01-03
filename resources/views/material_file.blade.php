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

@endsection


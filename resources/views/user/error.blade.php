@extends('user.layouts.app')

@section('content')

<div class="container text-center" style="padding-top: 100px; padding-bottom: 100px;">
	<h1>Error</h1>
	@if(empty($error) == false)
	<h3>{{ $error }}</h3>
	@elseif(isset($error->message))
		<h3>{{ $error->message }}</h3>
	@endif
	<a href="{{ URL::previous() }}" class="btn btn-success">Back</a>
	<hr/>
	<a href="{{ url('/') }}" class="btn btn-success">Home</a>
</div>


@endsection


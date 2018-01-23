@extends('user.layouts.app')

@section('content')

<div class="container text-center" style="padding-top: 100px; padding-bottom: 100px;">
	@if($error)
	<h3>{{ $error }}</h3>
	@elseif($error->message)
		<h3>{{ $error->message }}</h3>
	@endif
	<a href="{{ URL::previous() }}" class="btn btn-success">back</a>
</div>


@endsection


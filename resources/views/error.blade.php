@extends('layout')

@section('content')

<div class="container text-center" style="padding-top: 20px;">
	<h3>{{ $error['message']}}</h3>

	<a href="{{ URL::previous() }}" class="btn btn-success">back</a>
</div>


@endsection


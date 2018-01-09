@extends('user.layouts.app')

@section('content')

<div class="container text-center" style="padding-top: 100px; padding-bottom: 100px;">
	<h3>{{ $error}}</h3>

	<a href="{{ URL::previous() }}" class="btn btn-success">back</a>
</div>


@endsection


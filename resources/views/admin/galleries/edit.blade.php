@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Gallery</li>
		    <li class="active">Edit</li>
		</ul>

		<h1 class="h1">Edit Gallery</h1>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
	{!! Form::model( $gallery, ['route' => ['admin.galleries.update', $gallery->id], 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
			@include('admin.galleries._form', ['mediaItems' => $mediaItems])
	{!! Form::close() !!}
	</div>
</div>

@stop
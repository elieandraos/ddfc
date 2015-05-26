@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Users</li>
		    <li class="active">Edit</li>
		</ul>

		<h1 class="h1">Edit User</h1>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		{!! Form::model( $user, ['route' => ['admin.users.update', $user->id], 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
			@include('admin.users._form')
		{!! Form::close() !!}
	</div>
</div>

@stop
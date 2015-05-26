@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Users</li>
		    <li class="active">Permissions</li>
		</ul>

		{!! Form::open( [ 'route' => ['admin.users.update-permissions', $user->id], 'class' => 'form-horizontal', 'role' => 'form']) !!}

		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Choose Permissions</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<th>&nbsp;</th>
						<th>Permission</th>
						<th>Description</th>
					</tr>
					@foreach($permissions as $permission)
						<tr>
							<td>{!! Form::checkbox('permission[]', $permission->id, $user->can([$permission->name]), ['class' => 'field']) !!}</td>
							<td>{{ $permission->display_name }}</td>
							<td>{{ $permission->description }}</td>
						</tr>
					@endforeach
				<table>

				<div class="form-group">
					<div class="col-sm-2 col-sm-push-5">	
						{!! Form::submit('Save permissions', ['class' => 'btn btn-primary btn-trans form-control']) !!}
					</div>
				</div>
			</div>
		</div>
		<!-- Panel end -->
		{!! Form::close() !!}
	</div>
</div>

@stop
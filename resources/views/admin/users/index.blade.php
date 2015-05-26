@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Users</li>
		    <li class="active">List</li>
		</ul>


		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Users List</h3>
			</div>
			<div class="panel-body">
				<!-- Users List -->
				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th>Email</th>
				      <th>Name</th>
				      <th>Role</th>
				      <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>
				    @foreach($users as $u)
						<tr>
							<td>{{ $u->email }}</td>
							<td>{{ $u->name }}</td>
							<td>{{ $u->getRole()->display_name }}</td>
							<td>
								@include('admin.users._actions', ["user" => $u])
							</td>
						</tr>
					@endforeach
				  </tbody>
				</table>

			</div>
		</div>
		<!-- Panel end -->
	</div>
</div>

@stop
@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Subscribers</li>
		    <li class="active">List</li>
		</ul>


		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">subscribers List</h3>
			</div>
			<div class="panel-body">
				<!-- News List -->
				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th>Name</th>
				      <th>Email</th>
				      <th>Phone</th>
				      <th>Subscription Date</th>
				      <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>
				    @foreach($subscribers as $subscriber)
						<tr>
							<td>{{ $subscriber->first_name." ".$subscriber->last_name }}</td>
							<td>{{ $subscriber->email }}</td>
							<td>{{ $subscriber->phone }}</td>
							<td>{{ $subscriber->getHumanPublishedAt() }}</td>
							<td>
								@include('admin.subscribers._actions', ["subscriber" => $subscriber])
							</td>
						</tr>
					@endforeach
				  </tbody>
				</table>

				<div class="centered">
					{!! $subscribers->render() !!}
				</div>
			</div>
		</div>
		<!-- Panel end -->
	</div>
</div>

@stop
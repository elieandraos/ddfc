@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Galleries</li>
		    <li class="active">List</li>
		</ul>


		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
				Galleries List
				<a href="{{ route('admin.galleries.create') }}" class="pull-right">
					<button type="button" class="btn btn-primary btn-trans btn-xs " data-toggle="tooltip" data-placement="top" title="Add a new gallery">
						<i class="fa fa-plus-square-o"></i> &nbsp; Create New
					</button>
				</a>
				</h3>
			</div>
			<div class="panel-body">
				<!-- News List -->
				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th>Title</th>
				      <th>Type</th>
				      <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>
				    @foreach($galleries as $gallery)
						<tr>
							<td>{{ $gallery->name }}</td>
							<td>{{ $gallery->type }}</td>
							<td>
								@include('admin.galleries._actions', ["gallery" => $gallery])
							</td>
						</tr>
					@endforeach
				  </tbody>
				</table>

				<div class="centered">
					{!! $galleries->render() !!}
				</div>
			</div>
		</div>
		<!-- Panel end -->
	</div>
</div>

@stop
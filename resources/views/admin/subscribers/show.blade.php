@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Subscribers</li>
		    <li class="active">show</li>
		</ul>


		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Personal Information</h3>
			</div>
			<div class="panel-body">
				<!-- News List -->
				<table class="table table-hover">
				    <tr>
				      <td>Title</td>
				      <td>{{ $subscriber->title }}</td>
				    </tr>
				    <tr>
				      <td>Name</td>
				      <td>{{ $subscriber->first_name." ".$subscriber->last_name }}</td>
				    </tr>
				    <tr>
				      <td>Email</td>
				      <td>{{ $subscriber->email }}</td>
				    </tr>
				   <tr>
				      <td>Phone</td>
				      <td>{{ $subscriber->phone }}</td>
				    </tr>
				    <tr>
				      <td>Ticket ID</td>
				      <td>{{ $subscriber->verification_token }}</td>
				    </tr>
				    <tr>
				      <td>Subscription Date</td>
				      <td>{{ $subscriber->getHumanPublishedAt() }}</td>
				    </tr>
				</table>

			</div>
		</div>
		<!-- Panel end -->


		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Work Information</h3>
			</div>
			<div class="panel-body">
				<!-- News List -->
				<table class="table table-hover">
				    <tr>
				      <td>Job Title</td>
				      <td>{{ $subscriber->job_title }}</td>
				    </tr>
				    <tr>
				      <td>Company</td>
				      <td>{{ $subscriber->company }}</td>
				    </tr>
					{{--
				    <tr>
				      <td>Field</td>
				      <td>{{ $subscriber->field }}</td>
				    </tr>
				   <tr>
				      <td>Country</td>
				      <td>{{ $subscriber->country->full_name }}</td>
				    </tr>

				    <tr>
				      <td>Arabic Sign Language Interpreter</td>
				      <td>@if($subscriber->is_sign) <i class="fa fa-check-circle"></i> @endif </td>
				    </tr>
				    <tr>
				      <td>English Sign Language Interpreter</td>
				      <td>@if($subscriber->is_english_sign) <i class="fa fa-check-circle"></i> @endif </td>
				    </tr>
				    <tr>
				      <td>Braille</td>
				      <td>@if($subscriber->is_braille) <i class="fa fa-check-circle"></i> @endif</td>
				    </tr>
				   <tr>
				      <td>Large print</td>
				      <td>@if($subscriber->is_large) <i class="fa fa-check-circle"></i> @endif</td>
				    </tr>
				    <tr>
				      <td>Electronic Format</td>
				      <td>@if($subscriber->is_electronic) <i class="fa fa-check-circle"></i> @endif</td>
				    </tr>
				    --}}
				    <tr>
				      <td>Other</td>
				      <td>@if($subscriber->other) {{ $subscriber->other }} @endif</td>
				    </tr>
				    <tr>
				      <td>Additional Notes</td>
				      <td>{{ $subscriber->additional_notes }}</td>
				    </tr>
				</table>

			</div>
		</div>
		<!-- Panel end -->

	</div>
</div>

@stop
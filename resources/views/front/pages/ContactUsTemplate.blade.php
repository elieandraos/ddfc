@extends('front.layout')

@section('content')

	<div class="row ">
		<div class='col-sm-12'>
			<div class="title-container">
				<h1 class="heading1"> {!! $page->title !!}</h1>
			</div>
		</div>
	</div>

	<div class="row show-item">
		<div class="col-sm-6">

			<span>{!! $content['content_field']; !!}</span>

			{!! Form::open(['route' => 'pages.contact', 'class' => 'form-horizontal', 'role' => 'form']) !!}

			@include('admin.form-errors')

			<?php if(isset($_GET['success'])): ?>
				<ul class="alert alert-success">
					<li>Thank you for contacting us.</li>
				</ul> 
			<?php endif; ?>

			<div class="form-front @if($errors->has('subject')) has-error @endif">
				{!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
	            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
	        </div>

	        <div class="form-front @if($errors->has('email')) has-error @endif">
				{!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
	            {!! Form::text('email', null, ['class' => 'form-control']) !!}
	        </div>

	        <div class="form-front @if($errors->has('phone')) has-error @endif">
				{!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
	            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
	        </div>

	        <div class="form-front @if($errors->has('message')) has-error @endif">
				{!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
	            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
	        </div>

	        <div style="width:30%">
	        	{!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
	        </div>

	        {!! Form::close() !!}
		</div>
	</div>
	
@stop
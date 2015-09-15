@extends('front.standalone')

@section('content')

	<div class="row show-item">
		
		<div class='col-sm-6'>
			
			<div class="title-container-left">
				<h1 class="heading1"> {!! $page->title !!}</h1>
			</div>

			{!! $page->getMeta('description') !!}
			{!! Form::open(['route' => 'pages.forum', 'class' => 'form-horizontal', 'role' => 'form']) !!}

			@include('front.form-errors')

			<?php if(isset($_GET['success'])): ?>
				<ul class="alert alert-success">
					<li>{!! trans('messages.Forum Success') !!}</li>
				</ul> 
			<?php endif; ?>

			<h1 class="heading3" style="font-size: 17px;">{!! trans('messages.Personal Information') !!} *</h4>

			<div class="form-front @if($errors->has('title')) has-error @endif">
				{!! Form::label('title', trans('messages.Title'), ['class' => 'control-label']) !!}
	            {!! Form::select(
                    'title', 
                    $titles, 
                    null, 
                    ['class' => 'form-control', 'id' => 'title']
                ) !!}  
	        </div>

			<div class="form-front @if($errors->has('first_name')) has-error @endif">
				{!! Form::label('first_name', trans('messages.First Name'), ['class' => 'control-label']) !!}
	            {!! Form::text('first_name', old('first_name'), ['class' => 'form-control']) !!}
	        </div>

	        <div class="form-front @if($errors->has('last_name')) has-error @endif">
				{!! Form::label('last_name', trans('messages.Last Name'), ['class' => 'control-label']) !!}
	            {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
	        </div>

	        {{-- <div class="form-front @if($errors->has('address')) has-error @endif">
	         	{!! Form::label('address', trans('messages.Address'), ['class' => 'control-label']) !!}
	            {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 4]) !!}
	        </div> --}}

	        <div class="form-front @if($errors->has('phone')) has-error @endif">
				{!! Form::label('phone', trans('messages.Phone'), ['class' => 'control-label']) !!}
	            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
	        </div>

	        <div class="form-front @if($errors->has('email')) has-error @endif">
				{!! Form::label('email', trans('messages.Email'), ['class' => 'control-label']) !!}
	            {!! Form::text('email', null, ['class' => 'form-control']) !!}
	        </div>

	        <h1 class="heading3" style="font-size: 17px;">{!! trans('messages.Work Information') !!}</h4>

	        <div class="form-front @if($errors->has('job_title')) has-error @endif">
				{!! Form::label('job_title', trans('messages.Job Title'), ['class' => 'control-label']) !!}
	            {!! Form::text('job_title', null, ['class' => 'form-control']) !!}
	        </div>

	        <div class="form-front @if($errors->has('company')) has-error @endif">
				{!! Form::label('company', trans('messages.Company'), ['class' => 'control-label']) !!}
	            {!! Form::text('company', null, ['class' => 'form-control']) !!}
	        </div>

	       {{--  <div class="form-front @if($errors->has('field')) has-error @endif">
				{!! Form::label('field', trans('messages.Field'), ['class' => 'control-label']) !!}
				{!! Form::text('field', null, ['class' => 'form-control']) !!}
	        </div> --}}

	        {{-- <div class="form-front @if($errors->has('country')) has-error @endif">
				{!! Form::label('country', trans('messages.Country'), ['class' => 'control-label']) !!}
                {!! Form::select(
                    'country_id', 
                    $countries, 
                    null, 
                    ['class' => 'form-control', 'id' => 'country_id']
                ) !!}  
	        </div> --}}

	        <p>
	        	{!! trans('messages.RSVP Paragraph') !!}
	        </p>

	       {{--  <div class="form-front">
	            {!! Form::checkbox('is_sign', 1, false) !!} 
	            {!! Form::label('is_sign', trans('messages.Is Sign') , ['class' => 'control-label']) !!}
	        </div>

	        <div class="form-front">
	            {!! Form::checkbox('is_english_sign', 1, false) !!} 
	            {!! Form::label('is_english_sign', trans('messages.Is Eglish Sign') , ['class' => 'control-label']) !!}
	        </div>

	        <div class="form-front">
	            {!! Form::checkbox('is_braille', 1, false) !!} 
	            {!! Form::label('is_braille', trans('messages.is_braille') , ['class' => 'control-label']) !!}
	        </div>

	       	<div class="form-front">
	            {!! Form::checkbox('is_large', 1, false) !!} 
	            {!! Form::label('is_large', trans('messages.is_large') , ['class' => 'control-label']) !!}
	        </div>

	       	<div class="form-front">
	            {!! Form::checkbox('is_electronic', 1, false) !!} 
	            {!! Form::label('is_electronic', trans('messages.is_electronic') , ['class' => 'control-label']) !!}
	        </div> --}}

	        <div class="form-front">
	            {!! Form::textarea('other', null, ['class' => 'form-control', 'rows' => 4]) !!}
	        </div>	

	       	<h1 class="heading3" style="font-size: 17px;">{!! trans('messages.Additional Notes') !!}</h4>
	        <div class="form-front">
	        	<i>{!! trans('messages.Notes Info') !!}</i>
	            {!! Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 4]) !!}
	        </div>	

	         <div style="width:30%">
	        	{!! Form::submit( trans('messages.Submit'), ['class' => 'btn btn-primary form-control']) !!}
	        </div>

	        {!! Form::close() !!}
		</div>

		<div class='col-sm-5 col-sm-push-1' style="padding-top:35px">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3612.076671528596!2d55.18346599999999!3d25.13309860000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6a5521444459%3A0xaa1def0deb229c76!2sMadinat+Jumeirah!5e0!3m2!1sen!2slb!4v1442221528618" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
			<br/><br/>
			{!! trans('messages.Address Lines') !!}
		</div>
	</div>
	
@stop
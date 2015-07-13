@extends('front.layout')

@section('content')

	<div class="row">
		
		<div class='col-sm-6'>
			
			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['title_1'] !!}</h1>
			</div>
			{!! $content['paragraph_1'] !!}

			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['title_2'] !!}</h1>
			</div>
			{!! $content['paragraph_2'] !!}

			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['title_3'] !!}</h1>
			</div>
			{!! $content['paragraph_3'] !!}
		</div>

		<div class='col-sm-5 col-sm-push-1'>
			<div class="title-container-left">
				<h1 class="heading1"> the higher committee</h1>
			</div>
		</div>

	</div>
	
@stop
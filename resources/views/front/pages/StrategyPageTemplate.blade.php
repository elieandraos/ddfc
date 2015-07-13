@extends('front.layout')

@section('content')

	<div class="row">
		
		<div class='col-sm-6'>
			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['title_left'] !!}</h1>
			</div>
			{!! $content['paragraph_left'] !!}
		</div>

		
		<div class='col-sm-5 col-sm-push-1'>
			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['title_right'] !!}</h1>
			</div>
			<img src="{!! $content['infographic'] !!}" alt="{!! $content['title_right'] !!}" title="{!! $content['title_right'] !!}" />
		</div>
	</div>
	
@stop
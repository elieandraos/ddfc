@extends('front.layout')

@section('content')
	

	<div class="row breadcrumb-nav">
		<div class="col-sm-12">
			<a href="{!! url('/') !!}">{{trans('messages.Home')}}</a>
			<a href="/page/about">{{trans('messages.My Community')}}</a>
			<a href="/page/strategy">{{trans('messages.Strategy')}}</a>
		</div>
	</div>
	
	<div class="row show-item">
		
		<div class='col-sm-12'>
			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['title_left'] !!}</h1>
			</div>
			{!! $content['paragraph_left'] !!}
		</div>

		
		<div class='col-sm-12'>
			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['title_right'] !!}</h1>
			</div>
			<img src="{!! $content['infographic'] !!}" alt="{!! trans('messages.Strategy Roadmap Alt') !!}" />
			@include("front.common._social_buttons", ["link" => url('/page/strategy') ])

		</div>
	</div>
	
@stop
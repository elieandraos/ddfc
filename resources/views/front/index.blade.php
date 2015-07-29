@extends('front.layout')

@section('content')
	</div> <!-- close the layout master page container -->
	
	<div class="container-fluid">
		<div class="row">
			
				@include('front.homepage._slider')
			
		</div>
	</div>

	<div class="container-fluid homepage-block homepage-block-goals">
		<div class="container">
			@include('front.homepage._goals')
		</div>
	</div>

	<div class="container-fluid actnow-block">
		<div class="container text-center goal-act-now">
			<a href="/page/act-now" alt="ACT NOW">
                <img src="/images/ActNow.jpg" alt="ACT NOW">
                <div class="line">{{ trans('messages.Join us now and be part of the change')}}</div>
            </a>
		</div>
	</div>

	<div class="container">
		@include('front.homepage._voices')
	</div>

	<div class="container-fluid news-block">
		<div class="container">
			@include('front.homepage._news')
		</div>
	</div>

	<div class="container">
		@include('front.homepage._support')
	</div>
	
@stop
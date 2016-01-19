@extends('front.layout')

@section('content')
	</div> <!-- close the layout master page container -->
	
	<div class="container-fluid slider-wrapper">
		<div class="row">
			@include('front.homepage._slider')
		</div>
	</div>
	<div class="container homepage-block">
		<div class="container">
			@include('front.homepage._campaign')
		</div>
	</div>

	<div class="container-fluid homepage-block homepage-block-goals">
		<div class="container">
			@include('front.homepage._goals')
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
	
@stop
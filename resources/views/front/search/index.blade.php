@extends('front.layout')

@section('content')
	
	@if($newsTranslations->count() || $postsTranslations->count())

		<!-- Page Title -->
		<div class="row">
			<div class="col-sm-12 title-container">
				<h1 class="heading1">Search Results</h3>
			</div>
		</div>
		<!-- End Of Page Title -->

		<!-- posts -->
		@include('front.search._news')
		@include('front.search._posts')
		@include('front.search._galleries')
	@else
		<div class="row">
			<div class=" col-sm-12 text-center show-item top35">
				<p>Nothing found for your query.</p>
			</div>
		</div>
	@endif
	
@stop
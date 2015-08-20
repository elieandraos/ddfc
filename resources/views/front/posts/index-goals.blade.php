@extends('front.layout')

@section('content')
	
	@if($posts->count())

		<!-- Page Title -->
		@if(isset($pageTitle))
			<div class="row">
				<div class="col-sm-12 title-container">
					<h1 class="heading1">{!! $pageTitle !!}</h1>
				</div>
			</div>
		@endif
		<!-- End Of Page Title -->


		<!-- Page Desc -->
		@if(isset($pageDescription))
			<div class="row">
				<div class="col-sm-12">
					{!! $pageDescription !!}
				</div>
			</div>
		@endif
		<!-- End Of Page Desc -->


		<!-- posts listing -->
		<div class="row">
			@foreach($posts as $k => $post)
				@include('front.posts._listItem', ['post' => $post])
				@if($k%2 == 0 && $k != 0)
					<div style="height:1px;clear:both"></div>
				@endif
			@endforeach
		</div>


		<!-- posts pagination -->
		<div class="row">
			<div class=" col-sm-12 text-center">
				{!! $posts->render() !!}
			</div>
		</div>
	@else
		<div class="row">
			<div class=" col-sm-12 text-center show-item top35">
				<p>No posts available for this section.</p>
			</div>
		</div>
	@endif
	
@stop
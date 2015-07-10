@extends('front.layout')

@section('content')

	<div class="row">
		<!-- posts listing -->
		<div class='col-sm-6'>
			<img src="{!! $post->getFirstMediaURL( $post->getMediaCollectionName(), 'featured') !!}" alt="{!! $post->title !!}" title="{!! $post->title !!}" />
			<h2 class="heading3">{!! $post->title !!}</h2>
			<p>{!! $post->description !!}</p>	
		</div>

		<!-- others --> 
		<div class='col-sm-5 col-sm-push-1'>
			@if($related_posts->count())
				@include('front.posts._related_posts')
			@endif
		</div>
	</div>

@stop
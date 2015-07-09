@extends('front.layout')

@section('content')
	
	@if($posts->count())
		<!-- posts listing -->
		<div class="row">
			@foreach($posts as $post)
				@include('front.posts._listItem', ['post' => $post])
			@endforeach
		</div>
		<!-- posts pagination -->
		<div class="row">
			<div class=" col-sm-12 centered">
				{!! $posts->render() !!}
			</div>
		</div>
	@else
		No posts available for this section.
	@endif
	
@stop
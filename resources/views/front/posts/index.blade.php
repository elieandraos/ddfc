@extends('front.layout')

@section('content')
	<div class="row breadcrumb-nav">
			<div class="col-sm-12">
				<a href="{!! url('/') !!}">{{trans('messages.Home')}}</a>
				<a href="/posts/{{ $postType->title }}">{!! trans('messages.'.$pageTitle) !!}</a>
			</div>
	</div>

	@if($posts->count())

		<!-- Page Title -->
		@if(isset($pageTitle))
			<div class="row">
				<div class="col-sm-12 title-container">
					<h1 class="heading1">{!! trans('messages.'.$pageTitle) !!}</h3>
				</div>
			</div>
		@endif
		<!-- End Of Page Title -->


		<!-- Page Desc -->
		@if(isset($pageDescription))
			<div class="row">
				<div class="col-sm-12">
					<p class="heading4">{!! $pageDescription !!}</p>
				</div>
			</div>
		@endif
		<!-- End Of Page Desc -->


		<!-- posts listing -->
		<div class="row">
			
			@foreach($posts as $k => $post)
				@include('front.posts._listItem', ['post' => $post])
				@if( (($k+1)%3) == 0)
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
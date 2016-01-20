@extends('front.layout')

@section('content')
	<div class="row breadcrumb-nav">
			<div class="col-sm-12">
				<a href="{!! url('/') !!}">{{trans('messages.Home')}}</a>
				<a href="javascript::void(0)">{{trans('messages.Media')}}</a>
				<a href="/galleries">{!! trans('messages.'.$pageTitle) !!}</a>
			</div>
	</div>

	@if($galleries->count())

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
			@foreach($galleries as $k => $gallery)
				@include('front.news._galleryItem', ['gallery' => $gallery])
				@if( (($k+1)%3) == 0)
					<div style="height:1px;clear:both"></div>
				@endif
			@endforeach
		</div>


		<!-- posts pagination -->
		<div class="row">
			<div class=" col-sm-12 text-center">
				{!! $galleries->render() !!}
			</div>
		</div>
	@else
		<div class="row">
			<div class=" col-sm-12 text-center show-item top35">
				<p>No galleries available for this section.</p>
			</div>
		</div>
	@endif
	
@stop
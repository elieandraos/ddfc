@extends('front.layout')

@section('content')

	<div class="row show-item">

		<!-- posts listing -->
		<div class='col-sm-7 top35'>
		        <img src="{!! $news->getFirstMediaURL( $news->getMediaCollectionName(), 'featured') !!}" alt="{!! $news->title !!}" title="{!! $news->title !!}" />
			<h2 class="heading3">{!! $news->title !!}</h2>
			<p>{!! $news->description !!}</p>	
		</div>

		<!-- others --> 
		<div class='col-sm-5'>
			@if($related_news->count())
				@include('front.news._related')
			@endif
		</div>
	</div>

@stop
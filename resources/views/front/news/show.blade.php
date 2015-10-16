@extends('front.layout')

@section('content')
	
	<div class="row breadcrumb-nav">
        <div class="col-sm-12">
            <a href="{!! url('/') !!}">{{trans('messages.Home')}}</a>
            <a href="/news">{!! trans('messages.News') !!} </a>
            <a href="#">{!! $news->title !!}</a>
        </div>
    </div>

	<div class="row show-item">

		<!-- posts listing -->
		<div class='col-sm-7 top35'>
		       @if($news->getFirstMediaURL( $news->getMediaCollectionName(), 'featured'))
		        <img class='featured-img' src="{!! $news->getFirstMediaURL( $news->getMediaCollectionName(), 'featured') !!}" alt="{!! $news->title !!}" title="{!! $news->title !!}" />
		      @endif
			<h2 class="heading3">{!! $news->title !!}</h2>
			<p class="heading5">{!! $news->getReadablePublishedAt() !!}</p>
			<p>{!! $news->description !!}</p>	
			@include("front.common._social_buttons", ["link" => route('news.show', [$news->slug]) ])

		</div>

		<!-- others --> 
		<div class='col-sm-5'>
			@if($related_news->count())
				@include('front.news._related')
			@endif
		</div>
	</div>

@stop
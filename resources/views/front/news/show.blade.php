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
		        
                @if( Jenssegers\Date\Date::parse($news->published_at)->gt(Jenssegers\Date\Date::now()) )
                    <img src="/images/upcoming.png"  alt="Upcoming event" class="large-upcoming-badge" />
                @endif

                <img class='featured-img' src="{!! $news->getFirstMediaURL( $news->getMediaCollectionName(), 'featured') !!}" alt="{!! $news->title !!}" title="{!! $news->title !!}" />

		        @if(count($galleryItems))
		        	<div id="links">
		        		@foreach($galleryItems as $item)
						    <a href="{!! $item->getURL('featured')  !!}" title="{!! $news->gallery->getMediaCaption($item->id) !!}" data-gallery>
						        <img src="{!! $item->getURL('thumb')  !!}" alt="{!! $news->gallery->getMediaCaption($item->id) !!}" class='gallery-thumb'>
						    </a>
					    @endforeach
					</div>
		        @endif

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





<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev" style="border:none;left:30px;"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
    <a class="next" style="border:none;right:30px;"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


@stop
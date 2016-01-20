@extends('front.layout')

@section('content')
	
	 <div class="row breadcrumb-nav">
        <div class="col-sm-12">
				<a href="{!! url('/') !!}">{{trans('messages.Home')}}</a>
				<a href="javascript::void(0)">{{trans('messages.Media')}}</a>
				<a href="/galleries">{!! trans('messages.Galleries') !!}</a>
        </div>
    </div>


	<div class="row show-item">
		<!-- posts listing -->
		<div class='col-sm-7 top35'>
		   	
		   	<h2 class="heading3" style="margin-top:0px;">{!! $gallery->name !!}</h2>
			<img class='featured-img' src="{!! $gallery->getFirstMediaURL( $gallery->getMediaCollectionName(), 'featured') !!}" alt="{!! $gallery->name !!}" title="{!! $gallery->name !!}" />

		        @if(count($galleryItems))
                    <div id="gallery">
                        <div style="float:left;padding-top:40px"> <a id="gallery_left" href="#" class="glyphicon glyphicon-chevron-left" ></a> </div>
    		        	<div id="links" style="width:95%; float:left;overflow:hidden;height:60px;">
                            <div id="gallery_items">
                            <div id="lang_current" style="display:none;">{{Lang::getLocale()}}</div>
    		        		@foreach($galleryItems as $item)
    						    
                                @if(Lang::getLocale() == "ar")
                                    <a href="{!! $item->getURL('featured')  !!}" title="{!! $gallery->getMediaProperty($item->id, 'caption_ar') !!}" data-gallery>
        						        <img src="{!! $item->getURL('thumb')  !!}" alt="{!! $gallery->getMediaProperty($item->id, 'caption_ar') !!}" class='gallery-thumb'>
        						    </a>
                                @else
                                    <a href="{!! $item->getURL('featured')  !!}" title="{!! $gallery->getMediaProperty($item->id, 'caption') !!}" data-gallery>
                                        <img src="{!! $item->getURL('thumb')  !!}" alt="{!! $gallery->getMediaProperty($item->id, 'caption') !!}" class='gallery-thumb'>
                                    </a>
                                @endif
    					    @endforeach
                            </div>
    					</div>
                        <div style="float:right;padding-top:40px;"> <a id="gallery_right" href="#" class="glyphicon glyphicon-chevron-right"> </a></div>
                        <div style="clear:both;"></div>
                    </div>
		        @endif

		        <br/>
		        @include("front.common._social_buttons", ["link" => route('galleries.view', [$gallery->id]) ])
		</div>

		<!-- others --> 
		<div class='col-sm-5'>
			@if($related_galleries->count())
                @include('front.news._related_galleries')
            @endif
		</div>
	</div>

<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev" style="border:none;left:30px;font-size:30px;background: none;"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
    <a class="next" style="border:none;right:30px;font-size:30px;background: none;"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
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
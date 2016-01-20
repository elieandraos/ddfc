<div class="title-container-left">
	@if(Lang::getLocale() == "en")
		<h1 class="heading1"> {{trans('messages.other')}} {{trans('messages.Galleries')}} </h1>
	@else
		<h1 class="heading1">{{trans('messages.Galleries')}} {{trans('messages.other')}} </h1>
	@endif
</div>

@foreach($related_galleries as $related_gallery)
	<div class="row related-item">
		<div class='col-sm-5'>
			<a href="{!! route('galleries.view', [$related_gallery->id]) !!}" title="{!! $related_gallery->name !!}" >
				<div class="tint black">
					@if($related_gallery->getFirstMediaURL( $related_gallery->getMediaCollectionName(), 'thumb-small'))
						<img src="{!! $related_gallery->getFirstMediaURL( $related_gallery->getMediaCollectionName(), 'thumb-small') !!}" alt="{!! $related_gallery->name !!}" title="{!! $related_gallery->name !!}" />
					@else
						<img src="/images/noimage.jpg" class="related-news-thumb" />
					@endif
				</div>
			</a>
		</div>
		<div class='col-sm-7'>
			<a href="{!! route('galleries.view', [$related_gallery->id]) !!}" title="{!! $related_gallery->title !!}" >
				<h3 class="heading9">{!! str_limit($related_gallery->name,40,$end='...') !!}</h3>
			</a>
		</div>
	</div>
@endforeach
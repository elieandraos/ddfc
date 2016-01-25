<div class="title-container-left">
	<h1 class="heading1"> {{trans('messages.related')}}</h1>
</div>

@foreach($related_galleries as $related_gallery)
	<div class="row related-item">
		<div class='col-sm-5'>
			<a href="{!! route('galleries.view', [$related_gallery->id]) !!}" title="{!! $related_gallery->getName() !!}" >
				<div class="tint black">
					@if($related_gallery->getFirstMediaURL( $related_gallery->getMediaCollectionName(), 'thumb-small'))
						<img src="{!! $related_gallery->getFirstMediaURL( $related_gallery->getMediaCollectionName(), 'thumb-small') !!}" alt="{!! $related_gallery->getName() !!}" title="{!! $related_gallery->getName() !!}" />
					@else
						<img src="/images/noimage.jpg" class="related-news-thumb" />
					@endif
				</div>
			</a>
		</div>
		<div class='col-sm-7'>
			<a href="{!! route('galleries.view', [$related_gallery->id]) !!}" title="{!! $related_gallery->title !!}" >
				<h3 class="heading9">{!! str_limit($related_gallery->getName(),40,$end='...') !!}</h3>
			</a>
		</div>
	</div>
@endforeach
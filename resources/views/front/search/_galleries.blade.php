@foreach($galleries as $gallery)
	@if( (Lang::getLocale() == "en" && $gallery->is_en == 1) || (Lang::getLocale() == "ar" && $gallery->is_ar == 1))
	<div class="row show-item">
		<a href="{!! route('galleries.view', [$gallery->id]) !!}">
			<div class="col-sm-3">
				<div class="tint black">
					@if($gallery->getFirstMediaURL( $gallery->getMediaCollectionName(), 'thumb-small'))
						<img class="home-news-thumb" src="{!! $gallery->getFirstMediaURL( $gallery->getMediaCollectionName(), 'thumb-small') !!}" alt="{!! $gallery->name !!}"  />
					@else
						<img src="/images/noimage.jpg" class="home-news-thumb" alt="{!! $gallery->name !!}" />
					@endif
				</div>
			</div>
			<div class="col-sm-9">
				<h3 class="heading3">{!! $gallery->name !!}</h3>
			</div>
		</a>
	</div>
	@endif
@endforeach
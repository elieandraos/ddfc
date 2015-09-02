<div class="title-container-left">
	<h1 class="heading1"> {{trans('messages.other')}} {!! $news->category->title !!}</h1>
</div>

@foreach($related_news as $related_n)
	<div class="row related-item">
		<div class='col-sm-5'>
			<a href="{!! route('news.show', [$related_n->slug]) !!}" title="{!! $related_n->title !!}" >
				<div class="tint black">
					@if($related_n->getFirstMediaURL( $related_n->getMediaCollectionName(), 'thumb-small'))
						<img src="{!! $related_n->getFirstMediaURL( $related_n->getMediaCollectionName(), 'thumb-small') !!}" alt="{!! $related_n->title !!}" title="{!! $related_n->title !!}" />
					@else
						<img src="/images/noimage.jpg" class="related-news-thumb" />
					@endif
				</div>
			</a>
		</div>
		<div class='col-sm-7'>
			<a href="{!! route('news.show', [$related_n->slug]) !!}" title="{!! $related_n->title !!}" >
				<h3 class="heading9">{!! $related_n->title !!}</h3>
				<p class="heading7">{!! $related_n->excerpt !!}</p>
			</a>
		</div>
	</div>
@endforeach
<div class="col-sm-3"> 
	<a href="{!! route('news.show', [$single_news->slug]) !!}" title="{!! $single_news->title !!}" >
		<div class="tint black">
			@if($single_news->getFirstMediaURL( $single_news->getMediaCollectionName(), 'thumb-medium'))
				<img src="{!! $single_news->getFirstMediaURL( $single_news->getMediaCollectionName(), 'thumb-medium') !!}" alt="{!! $single_news->title !!}" title="{!! $single_news->title !!}" />
			@else
				<img src="/images/noimage.jpg" class="list-news" />
			@endif
		</div>
	</a>				
</div>

<div class="col-sm-9">
	<a href="{!! route('news.show', [$single_news->slug]) !!}" title="{!! $single_news->title !!}" >
		<h2 class="heading6" style="margin-bottom: 0px;">{!! $single_news->title !!}</h2>
		<p class="heading5">{!! $single_news->getReadablePublishedAt() !!}</p>
		<p class="heading5">{!! $single_news->excerpt !!}</p>	
	</a>
</div>
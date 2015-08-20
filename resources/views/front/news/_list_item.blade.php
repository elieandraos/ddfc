<div class="col-sm-3"> 
	<a href="{!! route('news.show', [$single_news->slug]) !!}" title="{!! $single_news->title !!}" >
		<div class="tint black">
			<img src="{!! $single_news->getFirstMediaURL( $single_news->getMediaCollectionName(), 'thumb-medium') !!}" alt="{!! $single_news->title !!}" title="{!! $single_news->title !!}" />
		</div>
	</a>				
</div>

<div class="col-sm-9">
	<a href="{!! route('news.show', [$single_news->slug]) !!}" title="{!! $single_news->title !!}" >
		<h2 class="heading6">{!! $single_news->title !!}</h2>
		<p class="heading5">{!! $single_news->excerpt !!}</p>	
	</a>
</div>
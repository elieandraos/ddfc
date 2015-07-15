
<div class="row">
	
	@if(isset($featured_news[0]))
		<div class="col-sm-5">
			<div class="title-container-left">
				<h1 class="heading1">Featured News</h1>
			</div>

			<img src="{!! $featured_news[0]->getFirstMediaURL( $featured_news[0]->getMediaCollectionName(), 'featured') !!}" alt="{!! $featured_news[0]->title !!}" title="{!! $featured_news[0]->title !!}" />
			<h2 class="heading6">{!! $featured_news[0]->title !!}</h2>
			<p class="heading7">{!! $featured_news[0]->excerpt !!}</p>	
		</div>
	@endif

	@if(isset($featured_news[1]))
		<div class="col-sm-5 col-sm-push-2">
			<div class="title-container-left">
				<h1 class="heading1">Featured News</h1>
			</div>

			<img src="{!! $featured_news[1]->getFirstMediaURL( $featured_news[1]->getMediaCollectionName(), 'featured') !!}" alt="{!! $featured_news[1]->title !!}" title="{!! $featured_news[1]->title !!}" />
			<h2 class="heading6">{!! $featured_news[1]->title !!}</h2>
			<p class="heading7">{!! $featured_news[1]->excerpt !!}</p>	
		</div>
	@endif

</div>
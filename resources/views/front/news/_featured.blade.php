
<div class="row">
	<div class="col-sm-12">
		<div class="title-container-left">
			<h1 class="heading1">{{ trans('messages.Featured News')}}</h1>
		</div>
	</div>
</div>

<div class="row">
	@if(isset($featured_news[0]))
		<div class="col-sm-5">
			<a href="{!! route('news.show', [$featured_news[0]->slug]) !!}" title="{!! $featured_news[0]->title !!}" >
				<img src="{!! $featured_news[0]->getFirstMediaURL( $featured_news[0]->getMediaCollectionName(), 'featured') !!}" alt="{!! $featured_news[0]->title !!}" title="{!! $featured_news[0]->title !!}" />
				<h2 class="heading6">{!! $featured_news[0]->title !!}</h2>
				<p class="heading7">{!! $featured_news[0]->excerpt !!}</p>	
			</a>
		</div>
	@endif

	@if(isset($featured_news[1]))
		<div class="col-sm-5 col-sm-push-2">
			<a href="{!! route('news.show', [$featured_news[1]->slug]) !!}" title="{!! $featured_news[1]->title !!}" >
				<img src="{!! $featured_news[1]->getFirstMediaURL( $featured_news[1]->getMediaCollectionName(), 'featured') !!}" alt="{!! $featured_news[1]->title !!}" title="{!! $featured_news[1]->title !!}" />
				<h2 class="heading6">{!! $featured_news[1]->title !!}</h2>
				<p class="heading7">{!! $featured_news[1]->excerpt !!}</p>	
			</a>
		</div>
	@endif

</div>
@foreach($newsTranslations as $newTranslations)

<div class="row show-item">
	<a href="{!! route('news.show', [$newTranslations->news->slug]) !!}">
		<div class="col-sm-3">
			<div class="tint black">
				@if($newTranslations->news->getFirstMediaURL( $newTranslations->news->getMediaCollectionName(), 'thumb-medium'))
					<img class="home-news-thumb" src="{!! $newTranslations->news->getFirstMediaURL( $newTranslations->news->getMediaCollectionName(), 'thumb-medium') !!}" alt="{!! $newTranslations->news->excerpt !!}"  />
				@else
					<img src="/images/noimage.jpg" class="home-news-thumb" alt="{!! $newTranslations->news->excerpt !!}" />
				@endif
			</div>
		</div>
		<div class="col-sm-9">
			<h3 class="heading3">{!! $newTranslations->title !!}</h3>
			<p  class="heading4">{!! $newTranslations->excerpt !!}</p>
		</div>
	</a>
</div>
@endforeach
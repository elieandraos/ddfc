@foreach($postsTranslations as $postTranslation)
<div class="row show-item">
	<a href="{!! route('posts.show', [$postTranslation->post->postType->slug, $postTranslation->post->slug]) !!}">
		<div class="col-sm-3">
			<div class="tint black">
				<img class="home-news-thumb" src="{!! $postTranslation->post->getFirstMediaURL( $postTranslation->post->getMediaCollectionName(), 'thumb-large') !!}" alt="{!! $postTranslation->post->excerpt !!}" />		
			</div>
		</div>
		<div class="col-sm-9">
			<h3 class="heading3">{!! $postTranslation->title !!}</h3>
			<p class="heading4">{!! $postTranslation->excerpt !!}</p>
		</div>
	</a>
</div>
@endforeach
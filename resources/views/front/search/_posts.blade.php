@foreach($postsTranslations as $postTranslation)
	@if( in_array($postTranslation->post->post_type_id, [4,5]))
		<?php continue; ?>
	@endif

	@if( (Lang::getLocale() == "en" && $postTranslation->post->is_en == 1) || (Lang::getLocale() == "ar" && $postTranslation->post->is_ar == 1))
		<div class="row show-item">
			<a href="{!! route('posts.show', [$postTranslation->post->postType->slug, $postTranslation->post->slug]) !!}">
				<div class="col-sm-3">
					<div class="tint black">

						@if($postTranslation->post->getFirstMediaURL( $postTranslation->post->getMediaCollectionName(), 'thumb-large'))
							<img class="home-news-thumb" src="{!! $postTranslation->post->getFirstMediaURL( $postTranslation->post->getMediaCollectionName(), 'thumb-large') !!}" alt="{!! $postTranslation->post->excerpt !!}" />
						@else 
							<img src="/images/noimage.jpg" class="home-news-thumb" alt="{!! $postTranslation->post->excerpt !!}" />
						@endif

					</div>
				</div>
				<div class="col-sm-9">
					<h3 class="heading3">{!! $postTranslation->title !!}</h3>
					<p class="heading4">{!! $postTranslation->excerpt !!}</p>
				</div>
			</a>
		</div>
	@endif
@endforeach
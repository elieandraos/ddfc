<div class="title-container-left">
	<h1 class="heading1"> {{trans('messages.other')}} {!! $post->category->title !!}</h1>
</div>

@foreach($related_posts as $related_post)
	<div class="row related-item">
		<div class='col-sm-5'>
			<a href="{!! route('posts.show', [$related_post->postType->slug, $related_post->slug]) !!}" title="{!! $related_post->title !!}" >
				<div class="tint black">
					<img class="related-thumb" src="{!! $related_post->getFirstMediaURL( $related_post->getMediaCollectionName(), 'thumb-small') !!}" alt="{!! $related_post->title !!}" title="{!! $related_post->title !!}" />
				</div>
			</a>
		</div>
		<div class='col-sm-7'>
			<a href="{!! route('posts.show', [$related_post->postType->slug, $related_post->slug]) !!}" title="{!! $related_post->title !!}" >
				<h3 class="heading9">{!! $related_post->title !!}</h3>
				<p class="heading7">{!! $related_post->excerpt !!}</p>
			</a>
		</div>
	</div>
@endforeach
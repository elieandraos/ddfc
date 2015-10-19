<div class="title-container-left">
	<h1 class="heading1"> {{trans('messages.related')}}</h1>
</div>

@foreach($related_posts as $related_post)
	<div class="row related-item">
		<div class='col-sm-5'>
			<a href="{!! route('posts.show', [$related_post->postType->slug, $related_post->slug]) !!}" title="{!! $related_post->title !!}" >
				<div class="tint black">
					@if($related_post->getFirstMediaURL( $related_post->getMediaCollectionName(), 'thumb-small'))
						<img class="related-thumb" src="{!! $related_post->getFirstMediaURL( $related_post->getMediaCollectionName(), 'thumb-small') !!}" alt="{!! $related_post->title !!}" title="{!! $related_post->title !!}" />
					@else
						<img src="/images/noimage.jpg" class="related-thumb" alt="{!! $related_post->excerpt !!}" />
					@endif
				</div>
			</a>
		</div>
		<div class='col-sm-7'>
			<a href="{!! route('posts.show', [$related_post->postType->slug, $related_post->slug]) !!}" title="{!! $related_post->title !!}" >
				<h3 class="heading9">{!! str_limit($related_post->title,40,$end='...') !!}</h3>
				<p  class="heading7">{!! str_limit($related_post->excerpt,65,$end='...') !!}</p>
			</a>
		</div>
	</div>
@endforeach
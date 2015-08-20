<div class="col-sm-4 post-item"> 
	<a href="{!! route('posts.show', [$post->postType->slug, $post->slug]) !!}" title="{!! $post->title !!}" >
		<div class="tint black">
			<img src="{!! $post->getFirstMediaURL( $post->getMediaCollectionName(), 'thumb-large') !!}" alt="{!! $post->title !!}" title="{!! $post->title !!}" />
		</div>
		<h2 class="heading3">{!! $post->title !!}</h2>
		<p class="heading4">{!! $post->excerpt !!}</p>	
	</a>				
</div>
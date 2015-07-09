<div class="col-sm-4"> 
	<img src="{!! $post->getFirstMediaURL( $post->getMediaCollectionName(), 'thumb-large') !!}" alt="{!! $post->title !!}" title="{!! $post->title !!}" />
	<h2>{!! $post->title !!}</h2>
	<p>{!! $post->excerpt !!}</p>					
</div>
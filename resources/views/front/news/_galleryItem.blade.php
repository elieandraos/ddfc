<div class="col-sm-4 post-item"> 
	<a href="{!! route('galleries.view', [$gallery->id]) !!}" title="{!! $gallery->title !!}" >
		<div class="tint black">
			<img class='grid-thumb' src="{!! $gallery->getFirstMediaURL( $gallery->getMediaCollectionName(), 'thumb-large') !!}" alt="{!! $gallery->title !!}" title="{!! $gallery->title !!}" />
		</div>
		<h2 class="heading3">{!! $gallery->name !!}</h2>
	</a>				
</div>
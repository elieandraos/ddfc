<div class="col-sm-4 post-item"> 
	
		<div class="">
			<img class='grid-thumb' src="{!! $post->getFirstMediaURL( $post->getMediaCollectionName(), 'thumb-large') !!}" alt="{!! $post->title !!}" title="{!! $post->title !!}" />
		</div>
		<h2 class="heading3">{!! $post->title !!}</h2>
			<hr/>
		{{trans('messages.Tel')}}: {!! $post->getMeta('contact_phone') !!}
		{{trans('messages.Web')}}: <a href="{!! $post->getMeta('contact_website') !!}" title="{!! $post->getMeta('contact_website') !!}" target="_blank"> {!! $post->getMeta('contact_website') !!} </a>	
</div>
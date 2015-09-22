<div class="col-sm-4 post-item"> 
	
		<div class="">
			<img class='grid-thumb' style="width:100%;height:auto;" src="{!! $post->getFirstMediaURL( $post->getMediaCollectionName(), 'thumb-large') !!}" alt="{!! $post->title !!}" title="{!! $post->title !!}" />
		</div>
		<h2 class="heading3" style="min-height:60px;">{!! $post->title !!}</h2>
			<hr/>
		{{trans('messages.Tel')}}: {!! $post->getMeta('contact_phone') !!}
		{{trans('messages.Web')}}: <a href="{!! $post->getMeta('contact_website') !!}" title="{!! $post->getMeta('contact_website') !!}" target="_blank"> {!! $post->getMeta('contact_website') !!} </a>	
</div>
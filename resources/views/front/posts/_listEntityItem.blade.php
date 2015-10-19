<div class="col-sm-4 entities-container post-item">
	
		<div class="">
			<img class='grid-thumb' style="width:100%;height:auto;" src="{!! $post->getFirstMediaURL( $post->getMediaCollectionName(), 'thumb-large') !!}" alt="{!! $post->title !!}" title="{!! $post->title !!}" />
		</div>
		<hr/>
		<p><b>{!! $post->title !!}</b></p>
		{{trans('messages.Tel')}}: <span class="tel">&#x200E;{!! $post->getMeta('contact_phone') !!}</span>
		<br/>
		{{trans('messages.Web')}}: <a href="{!! $post->getMeta('contact_website') !!}" title="{!! $post->getMeta('contact_website') !!}" target="_blank"> {!! $post->getMeta('contact_website') !!} </a>	
</div>
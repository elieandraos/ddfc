@foreach($posts as $post)
<div class="entity-row">
	<img src="{!! $post->getFirstMediaURL( $post->getMediaCollectionName()) !!}" alt="{!! $post->title !!}" title="{!! $post->title !!}" />
	<hr/>
	Tel: {!! $post->getMeta('contact_phone') !!}
	Web: <a href="{!! $post->getMeta('contact_website') !!}" title="{!! $post->getMeta('contact_website') !!}" target="_blank"> {!! $post->getMeta('contact_website') !!} </a>
</div>
@endforeach
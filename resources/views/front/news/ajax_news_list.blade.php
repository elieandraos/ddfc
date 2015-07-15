<!-- news listing -->
<div class="row">
	@foreach($news as $single_news)
		<div class="col-sm-10 col-push-1">
			<div class="row news-list-row">
				@include('front.news._list_item', ['single_news' => $single_news])
			</div>
		</div>
	@endforeach
</div>



<!-- posts pagination -->
<div class="row">
	<div class=" col-sm-12 text-center">
		{!! $news->render() !!}
	</div>
</div>
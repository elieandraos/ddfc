@if($news->count())
	<div class="homepage-block">
		
		<!-- Block Title -->
		<div class="row">
			<div class="col-sm-12 title-container">
				<h1 class="heading1">{{trans('messages.News')}}</h3>
				<h2 class="heading2">{{trans('messages.Read the latest news and learn about our activities')}}</h5>
			</div>
		</div>
		<!-- End Of Block Title -->

		<!-- Recent 2 News -->
		<div class="row">
			@foreach($news as $n)
				<div class="col-sm-6">
					<div class="row">
						<a href="{!! route('news.show', [$n->slug]) !!}">
							<div class="col-sm-6">
								<img src="{!! $n->getFirstMediaURL( $n->getMediaCollectionName(), 'thumb-medium') !!}" alt="{!! $n->excerpt !!}"  />
							</div>
							<div class="col-sm-6">
								<h1 class="heading5">{!! $n->getReadablePublishedAt() !!}</h4>
								<h2 class="heading6">{!! $n->title !!}</h2>
								<p  class="heading7">{!! $n->excerpt !!}</p>
							</div>
						</a>
					</div>
				</div>
			@endforeach
		</div>
		<!-- End Of Recent 2 News -->

	</div>
@endif


@if($news->count())
	<div class="homepage-block">
		
		<!-- Block Title -->
		<div class="row">
			<div class="col-sm-12 text-center">
				<h3>news</h3>
				<h5>Read the latest news and learn about our activities</h5>
			</div>
		</div>
		<!-- End Of Block Title -->

		<!-- Recent 2 News -->
		<div class="row">
			@foreach($news as $n)
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<img src="{!! $n->getFirstMediaURL( $n->getMediaCollectionName(), 'thumb-medium') !!}" alt="{!! $n->title !!}" title="{!! $n->title !!}" />
						</div>
						<div class="col-sm-6">
							<h2>{!! $n->title !!}</h2>
							<p>{!! $n->excerpt !!}</p>
						</div>
					</div>
				</div>
			@endforeach
		</div>
		<!-- End Of Recent 2 News -->

	</div>
@endif


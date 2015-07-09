@if($voices->count())
	<div class="homepage-block">
		
		<!-- Block Title -->
		<div class="row">
			<div class="col-sm-12 text-center">
				<h3>voices</h3>
				<h5>Inspirational success stories and best practices</h5>
			</div>
		</div>
		<!-- End Of Block Title -->

		<!-- Recent 2 Voices -->
		<div class="row">
		

			@foreach($voices as $voice)
				<div class="col-sm-6">
					<img src="{!! $voice->getFirstMediaURL( $voice->getMediaCollectionName(), 'thumb-large') !!}" alt="{!! $voice->title !!}" title="{!! $voice->title !!}" />
					<h2>{!! $voice->title !!}</h2>
					<p>{!! $voice->excerpt !!}</p>
				</div>
			@endforeach

			
		</div>
		<!-- End Of Recent 2 Voices -->

	</div>
@endif


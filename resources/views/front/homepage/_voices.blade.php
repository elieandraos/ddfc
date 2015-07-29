@if($voices->count())
	<div class="homepage-block">	
		<!-- Block Title -->
		<div class="row">
			<div class="col-sm-12 title-container">
				<h1 class="heading1">{{trans('messages.Voices')}}</h3>
				<h3 class="heading2">{{trans('messages.Inspirational success stories and best practices')}}</h5>
			</div>
		</div>
		<!-- End Of Block Title -->

		<!-- Recent 2 Voices -->
		<div class="row">
			@foreach($voices as $voice)
				<div class="col-sm-6">
					<a href="{!! route('posts.show', [$voice->postType->slug, $voice->slug]) !!}" title="{!! $voice->title !!}">
						<img src="{!! $voice->getFirstMediaURL( $voice->getMediaCollectionName(), 'thumb-large') !!}" alt="{!! $voice->title !!}" title="{!! $voice->title !!}" />
						<h1 class="heading3">{!! $voice->title !!}</h2>
						<h3 class="heading4">{!! $voice->excerpt !!}</p>
					</a>
				</div>
			@endforeach
		</div>
		<!-- End Of Recent 2 Voices -->

	</div>
@endif


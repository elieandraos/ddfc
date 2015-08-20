@extends('front.layout')

@section('content')

<div class="row">
	<div class="col-sm-12 title-container">
		<h1 class="heading1">{!! $page->title !!}</h1>
	</div>
</div>

<div class="row show-item">
	<div class="col-sm-3">
		 <img class="img-rounded" src="{!! $top_member->getFirstMediaURL( $top_member->getMediaCollectionName(), 'featured') !!}" alt="{!! $top_member->title !!}" title="{!! $top_member->title !!}" />
	</div>
	<div class="col-sm-9">
		<h2 class="heading3">{!! $top_member->title !!}</h2>
		<p class="heading4">{!! $top_member->getMeta('job_title') !!}</p>
		<hr/>
		<p>
			{!! $top_member->description !!}
		</p>
	</div>
</div>



<div class="row show-item">
	@foreach($members as $member)
		@if($member->id != $top_member->id)
			<div class="col-sm-6 post-item">
				<div class="row">
					<div class="col-sm-4">
						<img class="img-rounded" src="{!! $member->getFirstMediaURL( $member->getMediaCollectionName(), 'thumb-medium') !!}" alt="{!! $member->getMeta('job_title') !!}" />
					</div>
					<div class="col-sm-8">
						<h2 class="heading6">{!! $member->title !!}</h2>
						<p  class="heading7">{!! $member->getMeta('job_title') !!}</p>
					</div>
				</div>
			</div>
		@endif
	@endforeach
</div>

@stop
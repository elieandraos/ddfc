@extends('front.layout')

@section('content')
	
	@if($news->count())

		<div class="row">
			<div class="col-sm-12">
				<div class="title-container-left">
					<h1 class="heading1">{{ trans('messages.News')}}</h1>
				</div>
			</div>
		</div>

		{{-- @include('front.news._featured') --}}

		<!-- news filter -->
		@include('front.news._filters')
		
		<div class="news-listing">
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
		</div>
	@else
		<p>No posts available for this section.</p>
	@endif
	
@stop
@extends('front.layout')

@section('content')

	<div class="row show-item">
		
		<div class='col-sm-7'>
			
			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['title_1'] !!}</h1>
			</div>
			{!! $content['paragraph_1'] !!}

			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['title_2'] !!}</h1>
			</div>
			{!! $content['paragraph_2'] !!}

			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['title_3'] !!}</h1>
			</div>
			{!! $content['paragraph_3'] !!}
		</div>

		<div class='col-sm-5'>
			<div class="title-container-left">
				<h1 class="heading1"> {{trans('messages.the higher committee')}}</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
								<img src="{!! $top_member->getFirstMediaURL( $top_member->getMediaCollectionName(), 'thumb-medium') !!}" alt="{!! $top_member->getMeta('job_title') !!}" class="img-rounded" />
						</div>
						<div class="col-sm-8">
								<h2 class="heading6">{!! $top_member->title !!}</h2>
								<p  class="heading7">{!! $top_member->getMeta('job_title') !!}</p>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<a href="/page/the-higher-committee" class="btn btn-primary btn-custom">{{ trans('messages.View All Members')}}</a>
					<p class="aboutHint">
						{!! trans('messages.AboutText') !!}
					</p>
				</div>
			</div>

		</div>

	</div>
	
@stop
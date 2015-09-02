@extends('front.layout')

@section('content')
	
	@if($posts->count())

		<!-- Page Title -->
		@if(isset($pageTitle))
			<div class="row">
				<div class="col-sm-12 title-container">
					<h1 class="heading1">{!! $pageTitle !!}</h3>
				</div>
			</div>
		@endif
		<!-- End Of Page Title -->


		<!-- Page Desc -->
		@if(isset($pageDescription))
			<div class="row">
				<div class="col-sm-12">
					<p class="heading4">{!! $pageDescription !!}</p>
				</div>
			</div>
		@endif
		<!-- End Of Page Desc -->


		<!-- posts listing -->
		<div class="row">
			<div class="col-sm-7">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					{{--*/ $first = $posts->first()  /*--}}

					@foreach($posts as $key => $post)

						@if($key == 0)
							<div class="panel faq">
							    <div class="" role="tab" id="headingPost{!! $post->id!!}">
							      <h4 class="heading10">   
								        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePost{!! $post->id!!}" aria-expanded="true" aria-controls="collapsePost{!! $post->id!!}">
								          {!! $post->title!!} 
								        </a>
							      </h4>
							    </div>
							    <div id="collapsePost{!! $post->id!!}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingPost{!! $post->id!!}">
							      <div class="accordion-body">
							      		{!! $post->description !!}
							      </div>
							    </div>
							  </div> 
						@else
							  <div class="panel faq">
							    <div class="" role="tab" id="headingPost{!! $post->id!!}">
							      <h4 class="heading10">   
								        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePost{!! $post->id!!}" aria-expanded="false" aria-controls="collapsePost{!! $post->id!!}">
								          {!! $post->title!!} 
								        </a>
							      </h4>
							    </div>
							    <div id="collapsePost{!! $post->id!!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPost{!! $post->id!!}">
							      <div class="accordion-body">
							      		{!! $post->description !!}
							      </div>
							    </div>
							  </div>
						@endif
					@endforeach
				</div>
			</div>

			<div class="col-sm-5">
				<img src="/images/noimage.jpg">
			</div>
		</div>

	@else
		<p>No posts available for this section.</p>
	@endif
	
@stop
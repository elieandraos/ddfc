@extends('front.layout')

@section('content')

	<div class="row">
		
		<div class='col-sm-10'>
			<div class="title-container-left">
				<h1 class="heading1"> {!! $page->title !!}</h1>
			</div>
			<div class="default_content">
			    {!! $content['main_content'] !!}
			</div>


		</div>


	</div>
	
@stop
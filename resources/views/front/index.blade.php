@extends('front.layout')

@section('content')
	
	<div class="row">
		<div class="col-md-12"> 
			@include('front.homepage._slider')
		</div>
	</div>
	
	@include('front.homepage._voices')
	@include('front.homepage._news')
	
@stop
@extends('front.layout')

@section('content')
	
		<!--  Gov Entities Title -->
		<div class="row">
			<div class="col-sm-12">
				<div class="title-container">
					<h1 class="heading1"> {{trans('messages.government entities')}}</h1>
				</div>
			</div>
		</div>

		<!-- posts listing -->
		<div class="row">
			@foreach($posts['postsGov'] as $k => $post)
				@include('front.posts._listEntityItem', ['post' => $post])
				@if( ($k+1)%3  == 0)
					<div style="height:1px;clear:both"></div>
				@endif
			@endforeach
		</div>

		<!-- Org Entities Title -->
		<div class="row">
			<div class="col-sm-12">
				<div class="title-container">
					<h1 class="heading1"> {{trans('messages.organization')}}</h1>
				</div>
			</div>
		</div>

		
		<!-- posts listing -->
		<div class="row">
			@foreach($posts['postsOrg'] as $j => $post)
				@include('front.posts._listEntityItem', ['post' => $post])
				@if( ($j+1)%3  == 0)
					<div style="height:1px;clear:both"></div>
				@endif
			@endforeach
		</div>

@stop
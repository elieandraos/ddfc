@extends('front.layout')

@section('content')
		
		<div class="row breadcrumb-nav">
			<div class="col-sm-12">
				<a href="{!! url('/') !!}">{{trans('messages.Home')}}</a>
				<a href="javascript::void(0)">{{trans('messages.Support')}}</a>
				<a href="/posts/{{ $postType->title }}">{!! trans('messages.'.$pageTitle) !!}</a>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-12" style="margin-top: 35px;">
				<p class="heading4" style="margin-bottom: 0">{!! $pageDescription !!}</p>
			</div>
		</div>


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
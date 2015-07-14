@extends('front.layout')

@section('content')
	
		<!-- posts listing -->
		<div class="row">
			<div class="col-sm-5">
				<div class="title-container-left">
					<h1 class="heading1"> government entities</h1>
				</div>
				@include( "front.posts._entities_list", ['posts' => $posts['postsGov']])
			</div>
			<div class="col-sm-5 col-sm-push-2">
				<div class="title-container-left">
					<h1 class="heading1"> organization</h1>
				</div>
				@include( "front.posts._entities_list", ['posts' => $posts['postsOrg']])	
			</div>
		</div>

	
@stop
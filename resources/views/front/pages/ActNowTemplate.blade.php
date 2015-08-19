@extends('front.layout')

@section('content')

	<div class="row">

		<div class='col-sm-6 post_body_text'>
			<div class="title-container-left">
				<h1 class="heading1"> {!! $content['left_title'] !!}</h1>
			</div>
			<img style="" src="{!! $content['left_image'] !!}" alt="{!! $content['left_title'] !!}" title="{!! $content['left_title'] !!}" />

            <p>{!! $content['left_text'] !!}</p>

            <p class="moreinfo">{{trans('messages.For More Information')}}</p>
            <hr/>
            <p class="contact">{!! $content['left_contact'] !!}</p>
            <p>{{trans('messages.Tel')}}: {!! $content['left_phone'] !!}</p>
            <p>{{trans('messages.Web')}}: <a href="{!! $content['left_web'] !!}" target="_blank">{!! $content['left_web'] !!} </a></p>
		</div>

		<div class='col-sm-6 post_body_text'>
            <div class="title-container-left">
                <h1 class="heading1"> {!! $content['right_title'] !!}</h1>
            </div>
            <img src="{!! $content['right_image'] !!}" alt="{!! $content['right_title'] !!}" title="{!! $content['right_title'] !!}" />
            <p>{!! $content['right_text'] !!}</p>

             <p class="moreinfo">{{trans('messages.For More Information')}}</p>
             <hr/>
             <p class="contact">{!! $content['right_contact'] !!}</p>
             <p>{{trans('messages.Tel')}}: {!! $content['right_phone'] !!}</p>
             <p>{{trans('messages.Web')}}: <a href="{!! $content['right_web'] !!}" target="_blank">{!! $content['right_web'] !!} </a></p>
        </div>


	</div>

@stop
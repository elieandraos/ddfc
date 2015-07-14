@extends('front.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12 title-container">
            <h1 class="heading1">{!! $post->title !!}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <img src="{!! $post->getMeta('cover_image') !!}" />
        </div>
    </div>

	<div class="row">
        <div class="col-sm-6">
            <p class="heading4">{!! $post->description !!}</p>
        </div>
        <div class="col-sm-6 actnow_text">
            <p class="moreinfo">{{trans('For More Information')}}</p>
            <hr/>
            <p class="contact">{!! $post->getMeta('contact_person') !!}</p>
            <p>Tel: {!! $post->getMeta('contact_phone') !!}</p>
            <p>Web: <a href="{!! $post->getMeta('contact_web') !!}" target="_blank">{!! $post->getMeta('contact_web') !!} </a></p>
        </div>
    </div>

    <!-- others -->
    @if($related_posts->count())
    <div class="row">
            <div class="col-sm-12 title-container">
                <h1 class="heading1">Other {!! $post->category->title !!}</h1>
            </div>
    </div>



    <div class="row">
         @foreach($related_posts as $related_post)
            @include('front.posts._listItem', ['post' => $related_post])
        @endforeach
    </div>


    @endif



@stop
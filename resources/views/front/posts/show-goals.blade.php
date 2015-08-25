@extends('front.layout')

@section('content')
    

    <div class="row breadcrumb-nav">
        <div class="col-sm-12">
            <a href="{!! url('/') !!}">{{trans('messages.Home')}}</a>
            <a href="/posts/goals">{{trans('messages.Goals')}} </a>
            <a href="/posts/goals/category/{!! $post->category->slug!!}">{!! $post->category->title !!}</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 title-container">
            <h1 class="heading1">{!! $post->title !!}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <img class="goal-img" src="{!! $post->getMeta('cover_image') !!}" alt="{!! $post->title !!}" title="{!! $post->title !!}" />
        </div>
    </div>

	<div class="row post_body_text">
        <div class="col-sm-7">
            <p>{!! $post->description !!}</p>
        </div>
        <div class="col-sm-5">
            <p class="moreinfo">{{trans('messages.For More Information')}}</p>
            <hr/>
            <p class="contact">{!! $post->getMeta('contact_person') !!}</p>
            <p>{{trans('messages.Tel')}}: {!! $post->getMeta('contact_phone') !!}</p>
            <p>{{trans('messages.Web')}}: <a href="{!! $post->getMeta('contact_website') !!}" target="_blank" title="{!! $post->getMeta('contact_website') !!}">{!! $post->getMeta('contact_website') !!} </a></p>
            @include("front.common._social_buttons", ["link" => route('posts.show', [$post->postType->slug, $post->slug]) ])

        </div>
    </div>

    <!-- others -->
    @if($related_posts->count())
    <div class="row">
            <div class="col-sm-12 title-container">
                <h1 class="heading1">{{trans('messages.other')}} {!! $post->category->title !!}</h1>
            </div>
    </div>



    <div class="row">
         @foreach($related_posts as $k => $related_post)
            @include('front.posts._listItem', ['post' => $related_post])
        @endforeach
    </div>


    @endif



@stop
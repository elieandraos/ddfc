@if($slides->count())
 
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  

  <!-- Indicators -->
  <ol class="carousel-indicators">
    @foreach($slides as $key => $slide)
      <li data-target="#carousel-example-generic" data-slide-to="{!! $key !!}" class="@if($key == 0) active @endif"></li>
    @endforeach
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    @foreach($slides as $key => $slide)
      <div class="item @if($key == 0) active @endif">
        <a href="{!! $slide->getMeta('caption_link') !!}">
          <img src="{!! url($slide->getMeta('slider_image')) !!}" alt="{!! $slide->title !!}"  />
          <div class="caption-overlay">
              <div class="caption-content">
                <h1>{!! nl2br($slide->getMeta('caption_big')) !!}</h1>
                <h2>{!! $slide->getMeta('caption_small') !!}</h2>
                @if( Jenssegers\Date\Date::parse($slide->getMeta('event_date'))->gt(Jenssegers\Date\Date::now()) )
                  <img src="/images/upcoming.png" class="upcoming"  alt="Upcoming event" />
                @endif
              </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
@endif
@if($campaign)
	<div class="homepage-block">	
		<!-- Block Title -->
		<div class="row">
			<div class="col-sm-12 col-xs-12 title-container">
				<h1 class="heading1">{!! $campaign->title !!}</h3>
			</div>
		</div>
		<!-- End Of Block Title -->

		<div class="col-xs-6 col-xs-push-3 campaign-block">
			
			@if ($youtubeid != "")

		        <iframe  style="display:none;" id="ytplayer" type="text/html" width="100%" height="321"
	              src="//www.youtube.com/embed/{{$youtubeid}}?rel=0&showinfo=0&color=white&iv_load_policy=3"
	                                                                  frameborder="0" allowfullscreen></iframe>
	            <a href="#videoFrame" id="videoFrame" alt="{!! $campaign->title !!}" title="{!! $campaign->title !!}">
	                <div class="videoImageFrame" style="background-image: url('{!! $campaign->getFirstMediaURL( $campaign->getMediaCollectionName(), 'featured') !!}')">
	                    <div class="playButtonContainer">
	                        <img src="/images/playButton.png" />
	                    </div>
	                </div>
	            </a>

	        @else
	        	@if($campaign->getFirstMediaURL( $campaign->getMediaCollectionName(), 'featured'))
		        	<img class='featured-img' src="{!! $campaign->getFirstMediaURL( $campaign->getMediaCollectionName(), 'featured') !!}" alt="{!! $campaign->title !!}" title="{!! $campaign->title !!}" />
		        @else
		        	<img src="/images/noimage.jpg" class="featured-img" alt="{!! $campaign->title !!}" />
		        @endif
		    @endif
		</div>
	</div>
@endif

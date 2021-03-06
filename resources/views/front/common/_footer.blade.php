<!-- Bottom Bar -->
<div class="container-fluid" id="bottom-bar">
  <div class="container bottom_menu_holder" >
    <div class="row" style="">
        <div class="col-sm-2 col-xs-12">
            <h1 class="heading12">{{trans('messages.My Community')}}</h1>
            <p><a href="/page/about">{{trans('messages.About')}}</a></p>
            <p><a href="/page/the-higher-committee">{{trans('messages.the higher committee')}}</a></p>
            <p><a href="/page/strategy">{{trans('messages.Strategy')}}</a></p>
        </div>
        
        <div class="col-sm-2 col-xs-12">
            <h1 class="heading12">{{trans('messages.Goals')}}</h1>
            <p><a href="/posts/goals/category/quality-health-and-rehabilitation-services">{{trans('messages.Health')}}</a></p>
            <p><a href="/posts/goals/category/inclusive-education">{{trans('messages.Education')}}</a></p>
            <p><a href="/posts/goals/category/equal-employment-opportunities">{{trans('messages.Employment')}}</a></p>
            <p><a href="/posts/goals/category/universal-accessibility">{{trans('messages.Universal Accessibility')}}</a></p>
            <p><a href="/posts/goals/category/sustainable-social-protection-system">{{trans('messages.Social Protection')}}</a></p>
        </div>
        
         <div class="col-sm-2 col-xs-12">
            <h1 class="heading12">{{trans('messages.Support')}}</h1>
            <p><a href="/posts/entities">{{trans('messages.Entities')}}</a></p>
            <p><a href="/posts/support/category/faq">{{trans('messages.FAQ')}}</a></p>
            {{--<p><a href="/page/act-now">{{trans('messages.Act Now')}}</a></p>--}}
        </div>

        <div class="col-sm-2 col-xs-12">
            <h1 class="heading12">{{trans('messages.Other Sections')}}</h1>
            <p><a href="/news">{{trans('messages.News')}}</a></p>
            <p><a href="/posts/voices">{{trans('messages.Voices')}}</a></h4></p>
            <p><a href="/posts/knowledge">{{trans('messages.Knowledge')}}</a></p>
        </div>
        
        @if(!Request::is('page/act-now'))
             <div class="col-sm-3 col-sm-push-1 newsletter_bottom newsletter-{!! Lang::getLocale() !!}">
                <!--Newsletter --> 
                <p>{{ trans('messages.subscriberText')}}</p>
                {!! Form::open(['route' => 'search.newsletter', 'method' => 'POST', 'role' => 'form']) !!}
                    <label for="newsletter_email" style="display:none">subscribe</label>
                    <table style="width:100%">
                      <tr>
                        <td>
                          <input type="text" class="btn-newsletter" name="newsletter_email" id="newsletter_email" style="width:100%;height:38px" />
                        </td>
                        <td>
                          <input type="submit" class="submit-newsletter" value="{{ trans('messages.subscriberBtn')}}" style="height:38px"  />
                        </td>
                      </tr>
                    </table>
                {!! Form::close() !!}

                <!-- -->
                 <!-- Social Links --> 
                <div class="pull-right social_media_bottom" style="margin-top:20px;">
                 <a href="https://www.facebook.com/mycommunitydubai" target="_blank" title="Follow our page on Facebook">
                    <img src="/images/facebook-btn.png" class="social-icon" alt="Our page on facebook"/>
                  </a>
                  <a href="https://twitter.com/communitydubai" target="_blank" title="Follow our account on Twitter">
                    <img src="/images/twitter-btn.png" class="social-icon" alt="Our account on twitter"/>
                  </a>
                  <a href=" https://instagram.com/mycommunitydubai" target="_blank" title="Follow our account on Instagram">
                    <img src="/images/insta-btn.png" class="social-icon" alt="Our page on instagram"/>
                  </a>
                  <!-- End of Social Links -->
              </div>
            </div>
        @endif
    </div>
  </div>
</div>
<!-- End Of Bottom Bar -->


<!-- Logos -->
<div class="container" style="position:relative">


  <div class="row" id="logos" style="height:auto;padding-bottom: 35px;">
    <div class='col-sm-6 header-logo-left header-logo' style="float:left;">
      <a href="http://www.dubai.ae" target="_blank">
        <img src='/images/header-logo-left.png' alt='Government Of Dubai' />
      </a>
    </div>

    <div class='col-sm-6 header-logo-right header-logo pull-right' style="float:right !important;">
      <a href="http://tec.gov.ae/" target="_blank">
        <img src='/images/header-logo-right.png' alt='The Executive Council' />
      </a>

    </div>
  </div>
</div>
<!-- End Of Logos -->

<!-- Bottom Navigation -->
<div class="container-fluid navbar-bottom">
    <div class="container">
        <div class="row" id="logos-bottom">
            <div class='col-sm-4 header-logo-left header-logo'><img src='/images/small_logo.png' alt='Government Of Dubai' title='Government of Dubai'  /></div>
            <div class="col-sm-8 col-xs-12" id="copyright-text">
                <span>{{trans('messages.CopyrightText')}}</span>
                 <!-- <span> | </span><span class="white-link">&nbsp;<a href="/page/privacy-policy">{{trans('messages.Privacy Policy')}}</a></span> -->
                 <!-- <span> | </span><span class="white-link">&nbsp;<a href="/page/terms-and-conditions">{{trans('messages.Terms and Conditions')}}</a></span> -->
                 <span> | </span><span class="white-link">&nbsp;<a href="/page/contact-us">{{trans('messages.Contact Us')}}</a></span>
            </div>
        </div>
    </div>
</div>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-68834462-1', 'auto');
    ga('send', 'pageview');

</script>
<!-- End Of Bottom Navigation -->

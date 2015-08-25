<!-- Bottom Bar -->
<div class="container-fluid" id="bottom-bar">
  <div class="container" >
    <div class="row" style="padding-top:35px;">
        <div class="col-sm-2">
            <h1 class="heading12">{{trans('messages.My Community')}}</h1><br/>
            <p><a href="/page/about">{{trans('messages.About')}}</a></p>
            <p><a href="/page/the-higher-committee">{{trans('messages.the higher committee')}}</a></p>
            <p><a href="/page/strategy">{{trans('messages.Strategy')}}</a></p>
        </div>
        
        <div class="col-sm-2">
            <h1 class="heading12">{{trans('messages.Goals')}}</h1><br/>
            <p><a href="/posts/goals/category/quality-health-and-rehabilitation-services">{{trans('messages.Health')}}</a></p>
            <p><a href="/posts/goals/category/inclusive-education">{{trans('messages.Education')}}</a></p>
            <p><a href="/posts/goals/category/equal-employment-opportunities">{{trans('messages.Employment')}}</a></p>
            <p><a href="/posts/goals/category/universal-accessibility">{{trans('messages.Universal Accessibility')}}</a></p>
            <p><a href="/posts/goals/category/sustainable-social-protection-system">{{trans('messages.Social Protection')}}</a></p>
        </div>
        
         <div class="col-sm-2">
            <h1 class="heading12">{{trans('messages.Support')}}</h1><br/>
            <p><a href="/posts/entities">{{trans('messages.Entities')}}</a></p>
            <p><a href="/posts/support/category/faq">{{trans('messages.FAQ')}}</a></p>
            <p><a href="/page/act-now">{{trans('messages.Act Now')}}</a></p>
        </div>

        <div class="col-sm-2">
            <h1 class="heading12">{{trans('messages.Other Sections')}}</h1><br/>
            <p><a href="/news">{{trans('messages.News')}}</a></p>
            <p><a href="/posts/voices">{{trans('messages.Voices')}}</a></h4></p>
            <p><a href="/posts/knowledge">{{trans('messages.Knowledge')}}</a></p>
        </div>
        
        @if(!Request::is('page/act-now'))
             <div class="col-sm-3 col-sm-push-1">
                <a href="/page/act-now">
                    <img src="/images/ActNow.jpg" alt="ACT NOW"/>
                </a> 
                 <!-- Social Links --> 
                <div class="pull-right">
                <a href="https://www.facebook.com/mycommunitydubai" target="_blank"><img src="/images/facebook-btn.png" class="social-icon" alte="Our page on facebook"/></a>
                <a href="https://twitter.com/communitydubai" target="_blank"><img src="/images/twitter-btn.png" class="social-icon" alte="Our page on twotter"/></a>
                <a href=" https://instagram.com/communitydubai" target="_blank"><img src="/images/insta-btn.png" class="social-icon" alte="Our page on instagram"/></a>
                  <!-- End of Social Links -->
              </div>
            </div>
        @endif
    </div>
  </div>
</div>
<!-- End Of Bottom Bar -->

<!-- Bottom Navigation -->

<div class="container-fluid navbar-bottom">
    <div class="container">
        <div class="row" id="logos-bottom">
            <div class='col-sm-4 header-logo-left header-logo'><img src='/images/small_logo.png' alt='Government Of Dubai' title='Government of Dubai'  /></div>
            <div class="col-sm-8" id="copyright-text">
                <span>{{trans('messages.CopyrightText')}}</span>
                <span> | </span><span class="white-link">&nbsp;<a href="/page/privacy-policy">{{trans('messages.Privacy Policy')}}</a></span>
                 <span> | </span><span class="white-link">&nbsp;<a href="/page/terms-and-conditions">{{trans('messages.Terms and Conditions')}}</a></span>
                 <span> | </span><span class="white-link">&nbsp;<a href="/page/contact-us">{{trans('messages.Contact Us')}}</a></span>
            </div>
        </div>
    </div>
</div>

<!-- End Of Bottom Navigation -->

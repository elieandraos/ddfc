<!-- Bottom Bar -->
<div class="container-fluid" id="bottom-bar">
  <div class="container" >
    <div class="row" style="padding-top:35px;">
        <div class="col-sm-2">
            <h4>{{trans('messages.My Community')}}</h4><br/>
            <p><a href="/page/about" title="{{trans('messages.About')}}">{{trans('messages.About')}}</a></p>
            <p><a href="/page/the-higher-committee" title="{{trans('messages.the higher committee')}}">{{trans('messages.the higher committee')}}</a></p>
            <p><a href="/page/strategy" title="{{trans('messages.Strategy')}}">{{trans('messages.Strategy')}}</a></p>
        </div>
        <div class="col-sm-2">
            <h4>{{trans('messages.Goals')}}</h4><br/>
            <p><a href="/posts/goals/category/health" title="{{trans('messages.Health')}}" >{{trans('messages.Health')}}</a></p>
            <p><a href="/posts/goals/category/education" title="{{trans('messages.Education')}}" >{{trans('messages.Education')}}</a></p>
            <p><a href="/posts/goals/category/employment" title="{{trans('messages.Employment')}}" >{{trans('messages.Employment')}}</a></p>
            <p><a href="/posts/goals/category/universal-accessibility" title="{{trans('messages.Universal Accessibility')}}" >{{trans('messages.Universal Accessibility')}}</a></p>
            <p><a href="/posts/goals/category/social-protection" title="{{trans('messages.Social Protection')}}" >{{trans('messages.Social Protection')}}</a></p>
        </div>
        <div class="col-sm-2">
            <h4>{{trans('messages.Voices')}}</h4><br/>
            <p><a href="/posts/voices" title="{{trans('messages.All Voices')}}" >{{trans('messages.All Voices')}}</a></h4></p>
            {{--<p>{{trans('messages.Testimonials')}}</p>
            <p>{{trans('messages.Articles')}}</p> --}}
        </div>
        <div class="col-sm-2">
            <h4>{{trans('messages.Other Sections')}}</h4><br/>
            <p><a href="/news" title="{{trans('messages.News')}}">{{trans('messages.News')}}</a></p>
            <p><a href="/posts/entities" title="{{trans('messages.Support')}}">{{trans('messages.Support')}}</a></p>
            <p><a href="/posts/support/category/faq" title="{{trans('messages.FAQ')}}">{{trans('messages.FAQ')}}</a></p>
            <p><a href="/posts/knowledge" title="{{trans('messages.All Knowledge')}}">{{trans('messages.All Knowledge')}}</a></p>
        </div>
         <div class="col-sm-4">
            <a href="/page/act-now" alt="ACT NOW">
                <img src="/images/ActNow.jpg"  alt="ACT NOW"/>
            </a> <br/><br/>
            <!-- <p>{{trans('messages.Subscribe to our Newsletter')}}</p> -->
        </div>
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

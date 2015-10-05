<!-- Top Bar -->
<nav class="navbar navbar-top" role="navigation">
    <div class="container">
        <div class='col-sm-4 pull-left top-buffer'>
          <a href="#main-content" title="{!! trans('messages.Skip to Content Alt') !!}" id="skip-link" >{!! trans('messages.Skip to Content') !!}</a>
          &nbsp;&nbsp;
          <a href="/page/accessibility-options" title="Description of Accessibility Options">{!! trans('messages.AccessibilityOptions') !!}</a>
        </div>

        <div class='col-sm-4 pull-right text-right top-buffer'>
          

          <a class="decreaseFont fontResizer" href="javascript:void(0)" title="Increase Font Size">A</a> | 
          <a class="resetFont fontResizer" href="javascript:void(0)" title="Reset Font Size">A</a> |
          <a class="increaseFont fontResizer" href="javascript:void(0)" title="Decrease Font Size">A</a>  
          


          <div class="dropdown pull-right" style="margin-left: 20px;">
              <a class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                @if (Lang::getLocale() =="en")
                English
                @else
                Arabic
                @endif
                <span class="caret"></span>
              </a>

              <ul class="dropdown-menu pull-right text-right">
                  @if (Lang::getLocale() =="en")
                  <li><a href="?locale=ar">Arabic</a></li>
                  @else
                  <li><a href="?locale=en">English</a></li>
                  @endif
              </ul>
          </div>
        </div>

    </div>
</nav>
<!-- End Of Top Bar -->


<!-- Logos -->
<div class="container" style="position:relative">
  <div class="row" id="logos">
    <a href="/" class="header-logo-middle" style="width:158px !important; height:140px !important;">
      <img src='/images/header-logo-middle_new.png' alt='My Community Dubai Homepage' />
    </a>
    <div class='col-sm-6 pull-right social-top'>
        
      <span>{{trans('messages.Stay Connected')}}</span>
      <!-- Social Links --> 
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
</div>
<!-- End Of Logos -->


<!-- Menu Bar -->
@include('front.common._menu_navigation')
<!-- End Of Menu Bar -->  


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
    <div class='col-sm-6 header-logo-left header-logo'>
      <a href="http://www.dubai.ae" target="_blank">
        <img src='/images/header-logo-left.png' alt='Government Of Dubai' />
      </a>
    </div>
    <a href="/" class="header-logo-middle">
      <img src='/images/header-logo-middle.png' alt='My Community Dubai Homepage' />
    </a>
    <div class='col-sm-6 header-logo-right header-logo pull-right'>
      <a href="http://tec.gov.ae/" target="_blank">
        <img src='/images/header-logo-right.png' alt='The Executive Council' />
      </a>
    </div>
  </div>
</div>
<!-- End Of Logos -->


<!-- Menu Bar -->
@include('front.common._menu_navigation')
<!-- End Of Menu Bar -->  


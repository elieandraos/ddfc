<!-- Top Bar -->
<nav class="navbar navbar-top">
    <div class="container">
        <div class='col-sm-4 pull-left top-buffer'>Skip to Navigation</div>
        <div class='col-sm-4 pull-right text-right top-buffer'>
            <div class="dropdown">
              <a class="btn dropdown-toggle" type="button" data-toggle="dropdown">
              @if (Lang::getLocale() =="en")
              English
              @else
              Arabic
              @endif
              <span class="caret"></span></a>
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
<div class="container">
  <div class="row" id="logos">
    <div class='col-sm-4 header-logo-left header-logo'><img src='/images/header-logo-left.png' alt='Government Of Dubai' title='Government of Dubai'  /></div>
    <div class='col-sm-4 header-logo-middle header-logo'><img src='/images/header-logo-middle.png' alt='My Community' title='My Community'  /></div>
    <div class='col-sm-4 header-logo-right header-logo'><img src='/images/header-logo-right.png' alt='The Executive Council' title='The Executive Council'  /></div>
  </div>
</div>
<!-- End Of Logos -->


<!-- Menu Bar -->
@include('front.common._menu_navigation')
<!-- End Of Menu Bar -->  


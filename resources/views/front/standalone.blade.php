<html lang="{!! Lang::getLocale() !!}">
<head>
	<meta charset="utf-8"> 
 {!! MetaTag::generate() !!}
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta http-equiv="Content-Language" content="ar,en" />

    <!-- styles --> 
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" />
     @if (Lang::getLocale() =="ar")
        <link href="/css/ar.css" rel="stylesheet" />
     @endif
</head>
<body>
   <!-- Top Bar -->
    <nav class="navbar navbar-top" role="navigation">
        <div class="container">
            <div class='col-sm-4 pull-left top-buffer'></div>

            <div class='col-sm-4 pull-right text-right top-buffer'>
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
    <div class="row" id="logos" style="height:285px;">

      <div class="header-logo-middle-new" style="left:0px;margin-left:15px;">
          <div>
              <img src='/images/header-logo-middle_new.png' alt='My Community Dubai Homepage' />
          </div>
          <div style="padding-top:30px;">
              <img src='/images/forum_logo.png' alt='DUBAI INCLUSIVE DEVELOPMENT FORUM' />
          </div>
      </div>
    </div>
  </div>
  <!-- End Of Logos -->

    <div class="container body-content" id='main-content'>
      @yield('content')
    </div>

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

    <!-- Third Party Scripts -->
    <script type="text/javascript" src="/admin/js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="/admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>

      <script>
        $(document).ready(function(){
          $("#is_other").click(function(){
            $('#other').prop('disabled', function(i, v) { return !v; });
          })
        })
      </script>
</body>
</html>
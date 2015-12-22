<!DOCTYPE html>
<html lang="{!! Lang::getLocale() !!}">
<head>
	<meta charset="utf-8"> 
 {!! MetaTag::generate() !!}
 <link rel="shortcut icon" href="{{ asset('logo.ico') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
  <meta http-equiv="Content-Language" content="ar,en" />

    <!-- styles --> 
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" />
     @if (Lang::getLocale() =="ar")
        <link href="/css/ar.css" rel="stylesheet" />
     @endif
</head>
<body>
    @include('front.common._header')
    
  <div class="container body-content" id='main-content'>
      @yield('content')
  </div>

    @include('front.common._footer')

    <!-- Third Party Scripts -->
    <script type="text/javascript" src="/admin/js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="/admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/js/fontResize.js"></script>
    <script type="text/javascript">
        $('ul.nav li.dropdown').hover(function() {
          $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
        }, function() {
          $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
        });
    </script>
</body>
</html>
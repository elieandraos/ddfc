<html>
<head>
	<meta charset="utf-8">
    <title>Gaia Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    <!-- styles --> 
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/admin/css/animate.css" rel="stylesheet" />
    <link href="/admin/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/admin/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <link href="/admin/css/bootstrap-editable.css" rel="stylesheet" />
    <link href="/admin/css/sweet-alert.css" rel="stylesheet" />
    <link href="/admin/css/nestable.css" rel="stylesheet" />
    <link href="/admin/css/main.css" rel="stylesheet" />
    <link href="/admin/css/template-builder.css" rel="stylesheet" />

</head>
<body class="animated fadeIn">

    <section id="container">
        
        <!-- header -->
        <header id="header">
            <div class="brand"><a href="/admin/dashboard" class="logo"><span>GAIA</span>admin</a></div>
            <div class="toggle-navigation toggle-left">
                <button type="button" class="btn btn-default" id="toggle-left" data-toggle="tooltip" data-placement="right" title="Toggle Navigation">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
           
            <!-- user dropdown -->
            <div class="user-nav">
                <ul>
                    <li class="dropdown settings">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                          <i class="fa fa-cogs"></i> Manage <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu animated fadeInDown">  
                            <li><a href="/admin/pages/templates/">List Page Templates</a></li> 
                            <li><a href="/admin/pages/templates/create" id="add-template">Create Page Templates</a></li> 
                            <li class="seperator"></li> 
                            <li><a href="/admin/users/">List Users</a></li>    
                            <li><a href="/admin/users/create/">Create User</a></li>
                            <li class="seperator"></li>
                            <li><a href="/admin/post-types">Post Types</a></li> 
                        </ul>
                    </li>

                    <li class="settings">
                        <a href="/auth/logout"><i class="fa fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </header>

        @if (Session::has('flash_notification.message'))
            <script type="text/javascript">
                window.onload = function() {
                  
                        $.growl({
                            icon: "icon icon-comment-alt",
                            message: " {{ Session::get('flash_notification.message') }}"
                        }, {
                            delay: 3000,
                            type: "success"
                        });
                };
            </script>
        @endif

        <!--sidebar-->
        <aside class="sidebar">

            <div id="user-profile">
                <i class="fa fa-user"></i>
                {!! Auth::user()->name !!}
            </div>


            <div id="leftside-navigation" class="nano">
                <ul class="nano-content">
                    <li class="active">
                        <a href="/admin/dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:void(0);"><i class="fa fa-rss"></i><span>News</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>

                            <li><a href="/admin/news"><i class="arrow fa fa-angle-right"></i>List News</a></li>
                            <li><a href="/admin/news/create"><i class="arrow fa fa-angle-right"></i>Create News</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);"><i class="fa fa-file"></i><span>Pages</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                        <ul>
                            <li><a href="/admin/pages/"><i class="arrow fa fa-angle-right"></i>List Pages</a></li>
                            <li><a href="/admin/pages/create/"><i class="arrow fa fa-angle-right"></i>Create Page</a></li>
                        </ul>
                    </li>
                    {!! $postTypesSubmenu !!}

                    <li class="">
                        <a href="/admin/categories"><i class="fa fa-sitemap"></i><span>Categories</span></a>
                    </li> 
                </ul>
            </div>
        </aside>

        <!--main content -->
        <section class="main-content-wrapper">
            <section id="main-content">
                @yield('content')
            </section>
        </section>
        <!--main content end-->
        
    </section>

    <!-- Third Party Scripts -->
    <script type="text/javascript" src="/admin/js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="/admin/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="/admin/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/admin/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/admin/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript" src="/admin/js/bootstrap-growl.min.js"></script>
    <script type="text/javascript" src="/admin/js/jquery.slugify.js"></script>
    <script type="text/javascript" src="/admin/js/sweet-alert.min.js"></script>
    <script type="text/javascript" src="/admin/js/jquery.nestable.js"></script>
    <script type="text/javascript" src="/admin/js/nicEdit.js"></script>
    <!-- Custom Scripts -->
    <script type="text/javascript" src="/admin/js/application.js"></script>
    <script type="text/javascript" src="/admin/js/template.js"></script>

    <!-- setup ajax tokens -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
</html>
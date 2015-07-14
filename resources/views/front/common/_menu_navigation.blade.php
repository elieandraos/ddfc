<nav class="navbar navbar-main">
    <div class="container">

        <!-- Mobile Menu -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-navigation" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- End Of Mobile Menu -->


        <!-- Main Navigation -->
        <div class="collapse navbar-collapse" id="menu-navigation">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/*') ?  "active" : '' }}"><a href="/">Home <span class="sr-only">(current)</span></a></li>
                <!-- My Community -->
                <li class="dropdown">
                    <a style="{{ Request::is('page/about')|| Request::is('page/strategy') || Request::is('page/the-higher-committee') ?  'background-color:#23C4FD' : '' }}"href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Community <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li class="{{ Request::is('page/about') ?  "active" : '' }}"><a href="/page/about">About</a></li>
                    <li class="{{ Request::is('page/strategy') ?  "active" : '' }}"><a href="/page/strategy">Strategy</a></li>
                    <li class="{{ Request::is('page/the-higher-committee') ?  "active" : '' }}"><a href="/page/the-higher-committee">The Higher Committee</a></li>

                    </ul>
                 </li>


            <li><a href="javascript:void(0)">Goals</a></li>
            <!-- Voices -->

            @if($menuConfiguration['showVoicesCategories']==true)
            <li class="dropdown">
                <a style="{{ Request::is('*voices*') ?  'background-color:#23C4FD' : '' }}" href="/posts/voices/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Voices <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('*voices*success-stories*') ?  "active" : '' }}"><a href="/posts/voices/category/success-stories">Success Stories</a></li>
            <li class="{{ Request::is('*voices*testimonials*') ?  "active" : '' }}"><a href="/posts/voices/category/testimonials">Testimonials</a></li>
            <li class="{{ Request::is('*voices*articles*') ?  "active" : '' }}"><a href="/posts/voices/category/articles">Articles</a></li>
            <li class="{{ Request::is('posts/voices') ?  "active" : '' }}"><a href="/posts/voices">All Voices</a></li>
            </ul>
            </li>
            @else
            <li class="{{ Request::is('*voices*') ?  "active" : '' }}">
            <a href="/posts/voices">Voices</a>
            </li>
            @endif


            <!-- News -->
            <li class="{{ Request::is('*news*') ?  "active" : '' }}">
            <a href="/news">News</a>
            </li>


            <!-- Support -->
            @if ($menuConfiguration['showSupportCategories']==true)
            <li class="dropdown" >
                <a style="{{ Request::is('*support*') ?  'background-color:#23C4FD' : '' }}" href="/posts/support/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Support <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="{{ Request::is('*entities*') ?  "active" : '' }}"><a href="/posts/entities">Entities</a></li>
            <li class="{{ Request::is('*support*faq*') ?  "active" : '' }}"><a href="/posts/support/category/faq">FAQ</a></li>
            </ul>
            </li>
            @else
            <li class="{{ Request::is('*support*') ?  "active" : '' }}">
            <a href="/posts/support/">Support</a>
            </li>
            @endif

            <!-- Knowledge -->
            @if ($menuConfiguration['showKnowledgeCategories']==true)
            <li class="dropdown">
                <a style="{{ Request::is('*knowledge*') ?  'background-color:#23C4FD' : '' }}" href="/posts/knowledge/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Knowledge <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('*knowledge*useful-information*') ?  "active" : '' }}"><a href="/posts/knowledge/category/useful-information">Useful Information</a></li>
            <li class="{{ Request::is('*knowledge*testimonials*') ?  "active" : '' }}"><a href="/posts/knowledge/category/testimonials">Testimonials</a></li>
            <li class="{{ Request::is('*knowledge*facts*') ?  "active" : '' }}"><a href="/posts/knowledge/category/facts">Facts</a></li>
            <li class="{{ Request::is('posts/knowledge') ?  "active" : '' }}"><a href="/posts/knowledge">All Knowledge</a></li>
            </ul>
            </li>
            @else
            <li class="{{ Request::is('*knowledge*') ?  "active" : '' }}">
            <a href="/posts/knowledge">Knowledge</a>
            </li>
            @endif


            </ul>
        </div>
        <!-- End Of Main Navigation -->

    </div>
</nav>

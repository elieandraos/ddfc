<nav class="navbar navbar-main">
    <div class="container">


                <!-- search -->
            <div class="pull-right search-placeholder">
                <div class="search-icon"></div>
                {!! Form::open(['route' => 'search.index', 'method' => 'POST', 'role' => 'form']) !!}
                    <label for="search" style="display:none">Search</label><input type="text" name="search" id="search" />
                {!! Form::close() !!}
            </div>
            <!-- end of search -->



        <!-- Mobile Menu -->
        <div class="navbar-header">
            <button type="button"  class="navbar-toggle collapsed nav-float" data-toggle="collapse" data-target="#menu-navigation" aria-expanded="false">
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

            <li class="{{ Request::is('/*') ?  "active" : '' }}"><a href="{!! url('/') !!}">{{trans('messages.Home')}}</a></li>

            <!-- My Community -->
            <li class="dropdown">
                <a style="{{ Request::is('page/about')|| Request::is('page/strategy') || Request::is('page/the-higher-committee') ?  'background-color:#23C4FD' : '' }}"href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">{{trans('messages.My Community')}} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li class="{{ Request::is('page/about') ?  "active" : '' }}"><a href="/page/about">{{trans('messages.About')}}</a></li>
                <li class="{{ Request::is('page/strategy') ?  "active" : '' }}"><a href="/page/strategy">{{trans('messages.Strategy')}}</a></li>
                <li class="{{ Request::is('page/the-higher-committee') ?  "active" : '' }}"><a href="/page/the-higher-committee">{{trans('messages.the higher committee')}}</a></li>
                </ul>
             </li>


            <li class="dropdown">
                <a style="{{ Request::is('*goals*') ?  'background-color:#23C4FD' : '' }}" href="/posts/goals/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{trans('messages.Goals')}} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('*goals*quality-health-and-rehabilitation-services*') ?  "active" : '' }}">
                        <a href="/posts/goals/category/quality-health-and-rehabilitation-services">{{trans('messages.Health')}}</a>
                    </li>

                    <li class="{{ Request::is('*goals*inclusive-education*') ?  "active" : '' }}">
                        <a href="/posts/goals/category/inclusive-education">{{trans('messages.Education')}}</a>
                    </li>
                    
                    <li class="{{ Request::is('*goals*equal-employment-opportunities*') ?  "active" : '' }}">
                        <a href="/posts/goals/category/equal-employment-opportunities">{{trans('messages.Employment')}}</a>
                    </li>

                    <li class="{{ Request::is('*goals*universal-accessibility*') ?  "active" : '' }}">
                        <a href="/posts/goals/category/universal-accessibility">{{trans('messages.Universal Accessibility')}}</a>
                    </li>

                    <li class="{{ Request::is('*goals*sustainable-social-protection-system*') ?  "active" : '' }}">
                        <a href="/posts/goals/category/sustainable-social-protection-system">{{trans('messages.Social Protection')}}</a>
                    </li>
            </ul>
            </li>
            <!-- Voices -->

            @if($menuConfiguration['showVoicesCategories']==true)
            <li class="dropdown">
                <a style="{{ Request::is('*voices*') ?  'background-color:#23C4FD' : '' }}" href="/posts/voices/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{trans('messages.Voices')}} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('*voices*success-stories*') ?  "active" : '' }}"><a href="/posts/voices/category/success-stories">{{trans('messages.Success Stories')}}</a></li>
            <li class="{{ Request::is('*voices*testimonials*') ?  "active" : '' }}"><a href="/posts/voices/category/testimonials">{{trans('messages.Testimonials')}}</a></li>
            <li class="{{ Request::is('*voices*articles*') ?  "active" : '' }}"><a href="/posts/voices/category/articles">{{trans('messages.Articles')}}</a></li>
            <li class="{{ Request::is('posts/voices') ?  "active" : '' }}"><a href="/posts/voices">{{trans('messages.All Voices')}}</a></li>
            </ul>
            </li>
            @else
            <li class="{{ Request::is('*voices*') ?  "active" : '' }}">
            <a href="/posts/voices">{{trans('messages.Voices')}}</a>
            </li>
            @endif


            <!-- News -->
            <li class="{{ Request::is('*news*') ?  "active" : '' }}">
            <a href="/news">{{trans('messages.News')}}</a>
            </li>


            <!-- Support -->
            @if ($menuConfiguration['showSupportCategories']==true)
            <li class="dropdown" >
                <a style="{{ Request::is('*support*') ?  'background-color:#23C4FD' : '' }}" href="/posts/support/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{trans('messages.Support')}} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="{{ Request::is('*entities*') ?  "active" : '' }}"><a href="/posts/entities">{{trans('messages.Entities')}}</a></li>
                    <li class="{{ Request::is('*support*faq*') ?  "active" : '' }}"><a href="/posts/support/category/faq">{{trans('messages.FAQ')}}</a></li>
                    {{--<li class="{{ Request::is('*page*act-now*') ?  "active" : '' }}"><a href="/page/act-now">{{trans('messages.Act Now')}}</a></li>--}}
                </ul>
            </li>
            @else
            <li class="{{ Request::is('*support*') ?  "active" : '' }}">
            <a href="/posts/support/">{{trans('messages.Support')}}</a>
            </li>
            @endif

            <!-- Knowledge -->
            @if ($menuConfiguration['showKnowledgeCategories']==true)
            <li class="dropdown">
                <a style="{{ Request::is('*knowledge*') ?  'background-color:#23C4FD' : '' }}" href="/posts/knowledge/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Knowledge <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('*knowledge*useful-information*') ?  "active" : '' }}"><a href="/posts/knowledge/category/useful-information">{{trans('messages.Useful Information')}}</a></li>
            <li class="{{ Request::is('*knowledge*testimonials*') ?  "active" : '' }}"><a href="/posts/knowledge/category/testimonials">{{trans('messages.Testimonials')}}</a></li>
            <li class="{{ Request::is('*knowledge*facts*') ?  "active" : '' }}"><a href="/posts/knowledge/category/facts">{{trans('messages.Facts')}}</a></li>
            <li class="{{ Request::is('posts/knowledge') ?  "active" : '' }}"><a href="/posts/knowledge">{{trans('messages.All Knowledge')}}</a></li>
            </ul>
            </li>
            @else
            <li class="{{ Request::is('*knowledge*') ?  "active" : '' }}">
            <a href="/posts/knowledge">{{trans('messages.Knowledge')}}</a>
            </li>
            @endif

            </ul>
        </div>
        <!-- End Of Main Navigation -->
    </div>
</nav>

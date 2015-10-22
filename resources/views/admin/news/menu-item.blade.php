@if(Auth::user()->can('list-news') || Auth::user()->is('superadmin'))
<li class="sub-menu">
    <a href="javascript:void(0);"><i class="fa fa-rss"></i><span>News</span><i class="arrow fa fa-angle-right pull-right"></i></a>
    <ul>

        <li><a href="/admin/news"><i class="arrow fa fa-angle-right"></i>List News</a></li>
        <li><a href="/admin/news/create"><i class="arrow fa fa-angle-right"></i>Create News</a></li>
    </ul>
</li>
@endif
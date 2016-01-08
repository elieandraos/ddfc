@if(Auth::user()->can('list-news') || Auth::user()->is('superadmin'))
<li class="sub-menu">
    <a href="javascript:void(0);"><i class="fa fa-camera"></i><span>Galleries</span><i class="arrow fa fa-angle-right pull-right"></i></a>
    <ul>

        <li><a href="/admin/galleries"><i class="arrow fa fa-angle-right"></i>List Galleries</a></li>
        <li><a href="/admin/galleries/create"><i class="arrow fa fa-angle-right"></i>Create Gallery</a></li>
    </ul>
</li>
@endif
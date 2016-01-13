@if($authUser->can('manage-'.$postType->slug) || $authUser->is('superadmin') && $postType)
<li class="sub-menu">
    <a href="javascript:void(0);"><i class="fa fa-book"></i><span>
    	@if($postType->slug=="goals") Services @else {{ $postType->title }} @endif
    </span><i class="arrow fa fa-angle-right pull-right"></i>
	</a>
    <ul>
        <li>
        	<a href="{{ route('admin.posts.list', [$postType->id]) }}"><i class="arrow fa fa-angle-right"></i>
        		List @if($postType->slug=="goals") Services @else {{ $postType->title }} @endif
        	</a>
        </li>
        <li>
        	<a href="{{ route('admin.posts.create', [$postType->id]) }}"><i class="arrow fa fa-angle-right"></i>
        		Create @if($postType->slug=="goals") Service @else {{ $postType->title }} @endif
        	</a>
        </li>
    </ul>
</li>
@endif
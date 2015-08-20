<!-- news filter -->
<div class="row">
	<div class="col-sm-12 news-filters">
		{{ trans('messages.Filter By')}} &nbsp;
		<a class='btn btn-default btn-filter-news btn-custom' href="/news" title="Filter By All News">{{ trans('messages.All')}}</a>
		<a class='btn btn-default btn-filter-news btn-custom' href="/news/category/{!! $categories['feature']->id !!}" title="Filter By {!! $categories['feature']->title !!}">{!! $categories['feature']->title !!}</a>
		<a class='btn btn-default btn-filter-news btn-custom' href="/news/category/{!! $categories['event']->id !!}" title="Filter By {!! $categories['event']->title !!}">{!! $categories['event']->title !!}</a>
		<a class='btn btn-default btn-filter-news btn-custom' href="/news/category/{!! $categories['editorial']->id !!}" title="Filter By {!! $categories['editorial']->title !!}">{!! $categories['editorial']->title !!}</a>
		<a class='btn btn-default btn-filter-news btn-custom' href="/news/category/{!! $categories['press']->id !!}" title="Filter By {!! $categories['press']->title !!}">{!! $categories['press']->title !!}</a>
		<a class='btn btn-default btn-filter-news btn-custom' href="/news/category/{!! $categories['other']->id !!}" title="Filter By {!! $categories['other']->title !!}">{!! $categories['other']->title !!}</a>
	</div>
</div>
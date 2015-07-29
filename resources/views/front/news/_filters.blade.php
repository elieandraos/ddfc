<!-- news filter -->
<div class="row">
	<div class="col-sm-12 news-filters">
		Filter By &nbsp;
		<a class='btn btn-default btn-filter-news btn-custom' href="/news" title="Filter By All News">All</a>
		<a class='btn btn-default btn-filter-news btn-custom' href="/news/category/{!! $categories['feature']->id !!}" title="Filter By {!! $categories['feature']->title !!}">{!! $categories['feature']->title !!}</a>
		<a class='btn btn-default btn-filter-news btn-custom' href="/news/category/{!! $categories['event']->id !!}" title="Filter By {!! $categories['event']->title !!}">{!! $categories['event']->title !!}</a>
		<a class='btn btn-default btn-filter-news btn-custom' href="/news/category/{!! $categories['editorial']->id !!}" title="Filter By {!! $categories['editorial']->title !!}">{!! $categories['editorial']->title !!}</a>
		<a class='btn btn-default btn-filter-news btn-custom' href="/news/category/{!! $categories['press']->id !!}" title="Filter By {!! $categories['press']->title !!}">{!! $categories['press']->title !!}</a>
	</div>
</div>
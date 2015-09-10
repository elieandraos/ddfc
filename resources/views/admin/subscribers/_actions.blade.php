{!! Form::model($subscriber, ['data-remote' => true, 'data-callback' => 'removeTableRow', 'class' => 'remote-form', 'route' => ['admin.subscribers.delete', $subscriber->id]]) !!}
	<a href="#">
		<button type="button" class="btn btn-danger btn-trans btn-xs btn-action " data-toggle="tooltip" data-placement="top" title="Delete News" 
				onclick="customConfirm( this, 'Are you sure?', 'You will not be able to recover this subscriber.', 'Deleted!', 'The subscriber has been deleted.')" >
			<i class="fa fa-trash-o"></i>
		</button>
	</a>
{!! Form::close() !!}
<a href="{{ route('admin.galleries.edit', $gallery->id) }}">
	<button type="button" class="btn btn-info btn-trans btn-xs btn-action " data-toggle="tooltip" data-placement="top" title="Edit gallery">
		<i class="fa fa-pencil-square-o"></i>
	</button>
</a>



{!! Form::model($gallery, ['data-remote' => true, 'data-callback' => 'removeTableRow', 'class' => 'remote-form', 'route' => ['admin.galleries.delete', $gallery->id]]) !!}
	<a href="#">
		<button type="button" class="btn btn-danger btn-trans btn-xs btn-action " data-toggle="tooltip" data-placement="top" title="Delete Gallery" 
				onclick="customConfirm( this, 'Are you sure?', 'You will not be able to recover this gallery.', 'Deleted!', 'The gallery has been deleted.')" >
			<i class="fa fa-trash-o"></i>
		</button>
	</a>
{!! Form::close() !!}

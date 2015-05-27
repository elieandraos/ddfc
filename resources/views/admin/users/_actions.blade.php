<a href="{{ route('admin.users.edit', $user->id) }}">
	<button type="button" class="btn btn-info btn-trans btn-xs btn-action " data-toggle="tooltip" data-placement="top" title="Edit User">
		<i class="fa fa-pencil-square-o"></i>
	</button>
</a>

@if(!$user->is('superadmin'))
	<a href="{{ route('admin.users.permissions', $user->id) }}">
		<button type="button" class="btn btn-info btn-trans btn-xs btn-action " data-toggle="tooltip" data-placement="top" title="Manage Permissions">
			<i class="fa fa-wrench"></i>
		</button>
	</a>
@endif

{!! Form::model($user, ['data-remote' => true, 'data-callback' => 'removeTableRow', 'class' => 'remote-form', 'route' => ['admin.users.delete', $user->id]]) !!}
	<a href="#">
		<button type="button" class="btn btn-danger btn-trans btn-xs btn-action " data-toggle="tooltip" data-placement="top" title="Delete User" 
				onclick="customConfirm( this, 'Are you sure?', 'You will not be able to recover this user.', 'Deleted!', 'The user has been deleted.')" >
			<i class="fa fa-trash-o"></i>
		</button>
	</a>
{!! Form::close() !!}
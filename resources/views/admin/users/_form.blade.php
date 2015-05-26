<!-- Panel start -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Required Info</h3>
	</div>
	<div class="panel-body">

		@include('admin.form-errors')

        @if(!isset($user))
    		<div class="form-group @if($errors->has('email')) has-error @endif">
    			{!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control slug-target']) !!}
                </div>
            </div>
        @endif

        <div class="form-group @if($errors->has('name')) has-error @endif">
            {!! Form::label('name', 'Full name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group @if($errors->has('password')) has-error @endif">
            {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('password', "", ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group @if($errors->has('user_role')) has-error @endif">
            {!! Form::label('user_role', 'Role', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                  {!! Form::select('user_role', $roles, $user_role,[ 'class' => 'form-control']) !!}
            </div>
        </div> 
    
	</div>
</div>
<!-- Panel end -->


<div class="row">
    <div class="col-sm-1  col-sm-push-5">
        <a href="{{ route('admin.users.list') }}">
            <button type="button" class="btn btn-default btn-trans btn-full-width" data-toggle="tooltip" data-placement="top" title="Back to news list">
                <i class="fa fa-mail-reply"></i> &nbsp; Users List
            </button>
        </a>
    </div>
    <div class="col-sm-1 col-sm-push-5">
        {!! Form::submit('Save user', ['class' => 'btn btn-primary btn-trans form-control']) !!}
    </div>
</div>
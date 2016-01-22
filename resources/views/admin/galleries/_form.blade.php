<!-- Panel start -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">General Info</h3>
	</div>
	<div class="panel-body">
        @include('admin.form-errors')
		<div class="form-group @if($errors->has('name')) has-error @endif">
			{!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('name', (isset($gallery))?$gallery->name:null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group @if($errors->has('name_ar')) has-error @endif">
            {!! Form::label('name_ar', 'Name Ar', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('name_ar', (isset($gallery))?$gallery->name_ar:null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
               {!! Form::file('image','',array('id'=>'image','class'=>'form-control')) !!}
                @if($thumbUrl)
                    <div class="image-preview"><img src="{{ asset($thumbUrl) }}" /></div>
                    <div class="image-removal">{!! Form::checkbox('remove_image', $gallery->id, null) !!} remove existing image</div>
                @endif
            </div>
        </div>
	</div>
</div>
<!-- Panel end -->

<!-- Panel start -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Photos</h3>
    </div>
    <div class="panel-body"> 
        <p>Drag and drop photos, or click to upload.</p>   
        <div id="gallery-uploads" class="dropzone">
            @if(count($mediaItems))
                @foreach($mediaItems as $mediaItem)
                    <div class="dz-preview dz-file-preview">
                        <div class="dz-details">
                            <img src="{!!  $mediaItem->getURL('thumb-back') !!}" />
                            <br/>
                            <input type="text" name="dz_caption[]" placeholder="English caption..." class="dz-text" value="{!! $gallery->getMediaProperty($mediaItem->id)!!}" />
                            <input type="text" name="dz_caption_ar[]" placeholder="Arabic caption..." class="dz-text" value="{!! $gallery->getMediaProperty($mediaItem->id, 'caption_ar') !!}" />
                            <input type="hidden" name="dz_media[]" value="{!! $mediaItem->id !!}" class="dz-media" />
                            <input type="hidden" name="dz_file[]"  class="dz-file" />
                        </div>
                        <a class="media-remove" href="#">Delete</a>
                    </div>
                @endforeach
            @endif
        </div>
        <!-- dropzone pewview template: http://www.dropzonejs.com/#layout  -->
        <div id="preview-template" style="display: none;">
            <div class="dz-preview dz-file-preview">
                <div class="dz-details">
                    <img data-dz-thumbnail />
                   {{--  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div> --}}
                    <br/>
                    <input type="text" name="dz_caption[]" placeholder="English caption..." class="dz-text" /><Br/>
                    <input type="text" name="dz_caption_ar[]" placeholder="Arabic caption..." class="dz-text" />
                    <input type="hidden" name="dz_file[]"  class="dz-file" />
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
            </div>
        </div>

    </div>
</div>



<div class="row">
    <div class="col-sm-1  col-sm-push-5">
        <a href="{{ route('admin.galleries.list') }}">
            <button type="button" class="btn btn-default btn-trans btn-full-width" data-toggle="tooltip" data-placement="top" title="Back to galleries list">
                <i class="fa fa-mail-reply"></i> &nbsp; Back
            </button>
        </a>
    </div>
    <div class="col-sm-1 col-sm-push-5">
        {!! Form::submit('Save', ['class' => 'btn btn-primary btn-trans form-control', 'id' => 'gallery-save']) !!}
    </div>
</div>
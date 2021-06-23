<div class="form-group">
    {{ Form::label($name, trans('validation.attributes.'.$name), ['class' => 'control-label']) }}
    {{ Form::password($name, ['class' => 'form-control']) }}
    @error($name)
        <small class="text-danger">{{$message}}</small>
    @enderror
</div>
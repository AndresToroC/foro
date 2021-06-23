<div class="form-group">
    {{ Form::label($name, trans('validation.attributes.'.$name, ['class' => 'control-label'])) }}
    {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    @error($name)
        <small class="text-danger">{{$message}}</small>
    @enderror
</div>
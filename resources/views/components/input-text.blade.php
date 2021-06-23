<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" class="form-control" {{ $attributes }}>
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
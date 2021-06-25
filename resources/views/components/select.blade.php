<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <select name="{{ $name }}" id="{{ $name }}" class="form-control">
        @if ($placeholder)
            <option disabled selected>{{ $placeholder }}</option>
        @endif
        @foreach ($options as $key => $option )
            <option value="{{ $key }}"
                @if ($value == $key)
                    selected
                @endif
                >{{ $option }}</option>
        @endforeach
    </select>
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
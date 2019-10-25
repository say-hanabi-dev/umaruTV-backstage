<div class="form-group @error($name) has-error @enderror">
    @if(empty($show))
        <label>{{ ucfirst($name) }}</label>
    @else
        <label>{{ ucfirst($show) }}</label>
    @endif
    <select name="{{ $name }}" class="form-control">
        {{ $option }}
    </select>
    @error($name)
    <span class="help-block">{{ $message }}</span>
    @enderror
</div>
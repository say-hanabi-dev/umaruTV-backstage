@php $show = empty($show)?$name:$show @endphp
<div class="form-group @error($name) has-error @enderror">
    <label for="Input{{$name}}">{{ ucfirst($show) }}</label>
    <input type="text" name="{{$name}}" class="form-control" id="Input{{$name}}" placeholder="Enter {{$show}}" value="{{ $default }}">
    @error('resource')
    <span class="help-block">{{ $message }}</span>
    @enderror
</div>
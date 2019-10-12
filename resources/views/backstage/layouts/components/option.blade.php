@if(empty($show))
    <option value="{{$value}}" {{ $active==$value?'selected':'' }}>{{$value}}</option>
@else
    <option value="{{$value}}" {{ $active==$value?'selected':'' }}>{{$show}}</option>
@endif
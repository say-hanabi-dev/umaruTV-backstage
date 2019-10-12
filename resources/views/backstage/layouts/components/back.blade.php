@php
    $show = empty($show)?'Cancel':$show;
    $route = empty($route)?request()->header('referer'):$route
@endphp
<a href="{{ $route }}" type="submit" class="btn btn-default">{{$show}}</a>
@if(!empty($route))
    <a href="{{ $route }}" type="submit" class="btn btn-default">Cancel</a>
@else
    <a href="{{ request()->header('referer') }}" type="submit" class="btn btn-default">Cancel</a>
@endif
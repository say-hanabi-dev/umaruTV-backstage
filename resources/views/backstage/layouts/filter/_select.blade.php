<div class="form-group">
    <label>{{ $column['name'] }}</label>
    <select name="{{ $column['field'] }}" class="form-control">
        <option value="">All</option>
        @foreach($column['date'] as $date)
        <option {{ request($column['field']) == $date ? 'selected':'' }} value="{{ $date }}">{{ucfirst($date)}}</option>
        @endforeach
    </select>
</div>
@push('css')
    <link rel="stylesheet" href="{{ asset('/css/daterangepicker.css') }}">
@endpush
@push('js')
    <script src="{{ asset('/js/moment.min.js') }}"></script>
    <script src="{{ asset('/js/daterangepicker.js') }}"></script>
    <script>
        $('#clear-filter').click(function () {
            $(this).find('input').val("")
        })
    </script>
@endpush

<div class="box" id="filter">
    <form action="{{ route('backstage.anime.index') }}" class="asdkasd">
        <div class="box-header with-border">
            <h3 class="box-title">{{ ucfirst($table) }} filter</h3>
        </div>
    <!-- /.box-header -->
        <div class="box-body">
        @foreach($role as $column)
            @switch($column['type'])
                    @case('select')
                    @include('backstage.layouts.filter._select') @break
                    @case('int')
                    @include('backstage.layouts.filter._int') @break
                    @case('time')
{{--                TODO:: 修复在多个 time 组件时 重复 push js 的问题--}}
                    @include('backstage.layouts.filter._time') @break
                @endswitch
            @endforeach

        </div>
    <!-- /.box-body -->
        <div class="box-footer clearfix">
            <button class="btn btn-primary" id="clear-filter">Clear</button>
            <button class="btn btn-primary pull-right" id="submit-form" onclick="submiteOnHasValue(this)">Submit</button>
        </div>
    </form>
</div>


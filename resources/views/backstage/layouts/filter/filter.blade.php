@push('css')
    <link rel="stylesheet" href="{{ asset('/css/daterangepicker.css') }}">
@endpush
@push('js')
    <script src="{{ asset('/js/moment.min.js') }}"></script>
    <script src="{{ asset('/js/daterangepicker.js') }}"></script>
@endpush

<div class="box">
    <form action="{{ route('backstage.anime.index') }}">
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
                    @include('backstage.layouts.filter._time') @break
                @endswitch
            @endforeach

        </div>
    <!-- /.box-body -->
        <div class="box-footer clearfix">
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>


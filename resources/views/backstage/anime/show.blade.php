@extends("layouts.app")
@section('title','Animation view')
@section('header')
    <h1>
        Animation view
        {{--        <small>Version 2.0</small>--}}
    </h1>
@endsection
@section('content')
    <div class="col-md-9">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-warning" onclick="batch('setEnd')">Set end status</button>
                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" onclick="batch('delete')">Delete all</a></li>
                        <li><a href="#" onclick="batch('merge')">Merge</a></li>
                        {{--                            <li><a href="#">Something else here</a></li>--}}
                        {{--                            <li class="divider"></li>--}}
                        {{--                            <li><a href="#">Separated link</a></li>--}}
                    </ul>
                </div>
                <div class="box-tools">
                    <form action="">
                        <div class="input-group input-group-xs" style="width: 200px;">
                            <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="{{ request()->get('search') }}">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                {{--                <a class="btn btn-primary pull-right" href="{{ route('backstage.anime.create') }}">Add a new animation</a>--}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{ route('backstage.anime.batch') }}" method="post" id="batch">
                    <input type="hidden" name="operating">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 10px"><input type="checkbox"  onclick="checkall(this)"></th>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Episode</th>
                            <th style="width: 40px">Status</th>
                            <th>Operating</th>
                        </tr>
                        @foreach($animes as $anime)
                            <tr>
                                <td><input type="checkbox" name="ids[]" class="id-check" value="{{ $anime->id }}"></td>
                                <td>{{ $anime->id }}.</td>
                                <td>{{ $anime->name }}</td>
                                <td>
                                    <span class="badge bg-blue">{{ $anime->episodes }}</span>
                                </td>
                                <td><span class="badge bg-navy">{{ $anime->status() }}</span></td>
                                <td>
                                    <a href="{{ route('backstage.anime.edit',$anime->id) }}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('backstage.episode.index',$anime->id) }}" class="btn btn-primary">View episode</a>
                                    @can('delete-anime')
                                        <button class="btn btn-danger" onclick="$('#delete-{{ $anime->id }}').submit()"><i class="fa fa-trash-o"></i> Delete</button>
                                        <form id="delete-{{ $anime->id }}" method="post" action="{{ route('backstage.anime.destroy',$anime->id) }}" hidden>
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $animes->appends(request()->all())->links() }}
                {{--                <ul class="pagination pagination-sm no-margin pull-right">--}}
                {{--                    <li><a href="#">«</a></li>--}}
                {{--                    <li><a href="#">»</a></li>--}}
                {{--                </ul>--}}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        {!! \App\Models\Anime::filterView() !!}
    </div>
    @foreach($animes as $anime)
        @can('delete-anime')
            <form id="delete-{{ $anime->id }}" method="post" action="{{ route('backstage.anime.destroy',$anime->id) }}" hidden>
                {{ method_field('delete') }}
                {{ csrf_field() }}
            </form>
        @endcan
    @endforeach
@endsection
@push('js')
    <script>
        function checkall(obj) {
            if($(obj).prop('checked')){
                $(".id-check").prop('checked',true)
            }else{
                $('.id-check').prop('checked',false)
            }
        }
        function batch(operating) {
            const batch = $("#batch");
            batch.find("input[name='operating']").val(operating);
            batch.find("input[name='_method']").val('');
            batch.submit()
        }
    </script>
@endpush
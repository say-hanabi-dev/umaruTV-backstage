@extends("layouts.app")
@section('title','Animation view')
@section('content')
    <div class="col-md-9">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Animation view</h3>
                <div class="box-tools">
                    <form action="">
                        <div class="input-group input-group-sm hidden-xs" style="width: 200px;">
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
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Episode</th>
                        <th style="width: 40px">Status</th>
                        <th>Operating</th>
                    </tr>
                    @foreach($animes as $anime)
                        <tr>
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
                    </tbody></table>
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
@endsection
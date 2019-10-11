@extends("backstage.layouts.app")
@section('title','Animation view')
@section('content')
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Animation view</h3>
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
                            <td><span class="badge bg-red">{{ $anime->status }}</span></td>
                            <td>
                                <a href="{{ route('backstage.anime.edit',$anime->id) }}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{ route('backstage.episode.index',$anime->id) }}" class="btn btn-primary">View episode</a>
                                <button class="btn btn-danger" onclick="$('#delete-{{ $anime->id }}').submit()"><i class="fa fa-trash-o"></i> Delete</button>
                                <form id="delete-{{ $anime->id }}" method="post" action="{{ route('backstage.anime.destroy',$anime->id) }}" hidden>
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $animes->links() }}
                {{--                <ul class="pagination pagination-sm no-margin pull-right">--}}
                {{--                    <li><a href="#">«</a></li>--}}
                {{--                    <li><a href="#">1</a></li>--}}
                {{--                    <li><a href="#">2</a></li>--}}
                {{--                    <li><a href="#">3</a></li>--}}
                {{--                    <li><a href="#">»</a></li>--}}
                {{--                </ul>--}}
            </div>
        </div>
    </div>
@endsection
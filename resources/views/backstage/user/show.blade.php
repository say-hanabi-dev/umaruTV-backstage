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
                        <th>Email</th>
                        <th>Registration time</th>
                        <th>Operating</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}.</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="{{ route('backstage.user.edit', $user->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                <button class="btn btn-bitbucket"><i class="fa fa-ban"></i> Seal</button>
                                <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody></table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                {{ $users->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
    <div class="col-md-3">
{{--        {!! \App\Models\User::filterView() !!}--}}
    </div>
@endsection
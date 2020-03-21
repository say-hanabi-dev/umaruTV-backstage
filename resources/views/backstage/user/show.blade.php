@extends("layouts.app")
@section('title','Animation view')
@section('content')
    <div class="modal fade" id="banModal" tabindex="-1" role="dialog" aria-labelledby="banModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="banModalLabel">Block User: </h4>
                </div>
                <form action="{{ route('backstage.user.block') }}" method="post" class="form-horizontal" id="ban-form">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="id" value="" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ban time</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="time" required placeholder="How many days are banned?">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Reason</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reason" required placeholder="Why banned?">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Block</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                        <th>Status</th>
                        <th>Registration time</th>
                        <th>Operating</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}.</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{!! $user->statusLabel() !!}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="{{ route('backstage.user.edit', $user->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                @if(current_route_name_is('backstage.user.index'))
                                    <button class="btn btn-bitbucket" data-toggle="modal" data-target="#banModal"
                                            data-user-id="{{ $user->id }}" data-username="{{ $user->name }}"><i class="fa fa-ban"></i> Ban</button>
                                @else
                                    <button class="btn btn-bitbucket submit-form"><i class="fa fa-ban"></i> Unblock</button>
                                    <form action="{{ route('backstage.user.unblock', $user->id) }}" method="post" hidden>
                                        {{ csrf_field() }}
                                    </form>
                                @endif
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
@push('js')
    <script>
        $('#banModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let user_id = button.data('user-id');
            let username = button.data('username');

            let modal = $(this);
            modal.find('.modal-title').text('Block User: ' + username);
            modal.find('input[name="id"]').val(user_id);
        })
        $('.submit-form').click(function () {
            $(this).parent().find('form').submit();
        })

    </script>
@endpush
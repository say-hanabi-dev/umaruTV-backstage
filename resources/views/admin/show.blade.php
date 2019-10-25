@extends('layouts.app')
@section('title','Authority management')
@section('content')
    <div class="col-md-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Authority management</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 40px">Label</th>
                        <th>Operating</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}.</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td><span class="badge bg-red">55%</span></td>
                            <td>
                                <a href="{{ route('admin.user.show',$user->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
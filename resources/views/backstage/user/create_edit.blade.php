@extends("layouts.app")
@section('title','Edit: '.$user->name)
@section('content')
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('backstage.user.update',$user->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="box-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group @error('name') has-error @enderror">
                        <label for="InputName">Name</label>
                        <input type="text" class="form-control" id="InputName" name="name" placeholder="Enter name" value="{{ $user->name }}">
                        @error('name')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group @error('email') has-error @enderror">
                        <label for="InputEmail">Email</label>
                        <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter email" value="{{ $user->email }}">
                        @error('email')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group @error('password') has-error @enderror">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="InputPassword" data-name="password" placeholder="Enter password">
                        @error('password')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="InputPassword_con">Password confirmation</label>
                        <input type="password" class="form-control" id="InputPassword_con" data-name="password_confirmation" placeholder="Enter Password">
                        @error('password_confirmation')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right" onclick="submiteOnHasValue(this)">Sublime</button>
                </div>
            </form>
        </div>
    </div>
@endsection
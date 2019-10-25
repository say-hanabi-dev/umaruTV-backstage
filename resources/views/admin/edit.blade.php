`@extends("layouts.app")
@section('title','Edit profile: '.$user->name)
@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-edit"></i> Edit</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form role="form" action="{{ route('admin.user.update',$user->id) }}" method="post" enctype="multipart/form-data">
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
                        <input type="text" name="name" class="form-control" id="InputName" placeholder="Enter Name" value="{{ ee(old('name'),$user->name) }}">
                        @error('name')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @error('email') has-error @enderror">
                        <label for="InputEmail">Name</label>
                        <input type="text" name="email" class="form-control" id="InputEmail" placeholder="Enter Email" value="{{ ee(old('email'),$user->email) }}">
                        @error('email')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="InputFile">Upload Avatar</label>
                        <input type="file" name="avatar" id="InputFile">
                        <p class="help-block">上传头像.</p>
                    </div>
                    <hr style="border:0;background-color:#dadada;height:1px">
                    <div class="form-group @error('password') has-error @enderror">
                        <label for="InputPassword">Passwrd</label>
                        <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Enter Password">
                        @error('password')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @error('password_confirmation') has-error @enderror">
                        <label for="InputPassword_confirmation">Retype Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="InputPassword_confirmation" placeholder="Enter Password again" >
                        @error('password_confirmation')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    @back(['route'=>route('admin.user.index')]) @endback
                    <button type="submit" class="btn btn-primary pull-right">Sublime</button>
                </div>
            </form>
        </div>
    </div>
@endsection`
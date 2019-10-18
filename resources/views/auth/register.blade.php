@extends('auth.layouts.app')
@section('content')
    <div class="register-box-body">
        <p class="login-box-msg">Register a new account</p>

        <form action="{{ route('register') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback @error('name')has-error @enderror">
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                <span class="fa fa-user form-control-feedback"></span>
                @error('name')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group has-feedback @error('email')has-error @enderror">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                <span class="fa fa-envelope form-control-feedback"></span>
                @error('email')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group has-feedback @error('password')has-error @enderror">
                <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
                <span class="fa fa-lock form-control-feedback"></span>
                @error('password')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group has-feedback @error('password_confirmation')has-error @enderror">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" value="{{ old('password_confirmation') }}">
                <span class="fa fa-reply form-control-feedback"></span>
                @error('password_confirmation')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-xs-4 pull-right">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </div>
        </form>

        <a href="{{ route('login') }}" class="text-center">I already have a account</a>
    </div>
@endsection
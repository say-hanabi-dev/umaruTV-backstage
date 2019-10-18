@extends('auth.layouts.app')
@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{ route('login') }}" method="post">
        @csrf
        <!-- Username form start -->

            <div class="form-group has-feedback @error('email')has-error @enderror">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                <span class="fa fa-envelope form-control-feedback"></span>
                @error('email')
                <span class="help-block">{{ $message }}</span>
            @enderror
            <!-- Username form end -->
            </div>
            <!-- Password form start -->
            <div class="form-group has-feedback @error('password')has-error @enderror">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="fa fa-lock form-control-feedback"></span>
                @error('password')
                <span class="help-block">{{ $message }}</span>
            @enderror
            <!-- password form end -->
            </div>
            <div class="row">
                <!-- login btn -->
                <div class="col-xs-4 pull-right">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>

        <a href="/register" class="text-center">Register</a>
        <a href="#" class="pull-right">I forgot my password</a>

    </div>
@endsection
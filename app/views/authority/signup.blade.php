@extends('l.authority', array('active' => 'signup'))

@section('title') Đăng ký @parent @stop

@section('container')

    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Thêm Admin</h1>
            {{ HTML::image("public/assets/admin/images/login-logo.png") }}
        </div>
        <div class="login-wrap">
            <input name="email" value="{{ Input::old('email') }}" type="text" class="form-control" placeholder="E-mail" required autofocus>
            {{ $errors->first('email', '<strong class="error">:message</strong>') }}
            <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required>
            {{ $errors->first('password', '<strong class="error">:message</strong>') }}
            <input name="password_confirmation" type="password" class="form-control" placeholder="Xác nhận mật khẩu" required>
            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>
            </button>

        </div>
    {{ Form::close() }}

@stop


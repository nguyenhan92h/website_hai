@extends('l.authority', array('active' => 'signin'))

@section('title') Đặt lại mật khẩu @parent @stop

@section('container')

    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Đặt lại Mật Khẩu</h1>
            {{ HTML::image("public/assets/admin/images/login-logo.png") }}
        </div>
        <div class="login-wrap">
            <input name="email" value="{{ Input::old('email') }}" type="text" class="form-control" placeholder="E-mail" required autofocus>
            {{ $errors->first('email', '<strong class="error">:message</strong>') }}
            <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required>
            {{ $errors->first('password', '<strong class="error">:message</strong>') }}
            <input name="password_confirmation" type="password" class="form-control" placeholder="Xác nhận mật khẩu" required>
        <input type="hidden" name="token" value="{{ $token }}">
            @if( Session::get('error') )
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ Session::get('error') }}</strong>
            </div>
            @endif
            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>
            </button>

        </div>
    {{ Form::close() }}

@stop

@extends('l.authority', array('active' => 'signin'))

@section('title') Đăng nhập @parent @stop

@section('container')

    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Đăng nhập</h1>
            {{ HTML::image("public/assets/admin/images/login-logo.png") }}
        </div>
        <div class="login-wrap">
            <input type="text" name="email" class="form-control" placeholder="Địa chỉ E-mail" required value="{{ Input::old('email') }}" autofocus="">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="alert alert-warning alert-dismissable {{ $errors->first('attempt')?'':'hidden'; }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $errors->first('attempt') }}</strong>
            </div>
            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>
            </button>

            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="{{route('forgotPassword')}}"> Forgot Password?</a>
                </span>
            </label>

        </div>
    {{ Form::close() }}

@stop
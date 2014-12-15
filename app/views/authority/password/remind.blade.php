@extends('l.authority', array('active' => 'signin'))

@section('title') Quên mật khẩu @parent @stop

@section('container')

    {{ Form::open(array('class' => 'form-signin', 'role' => 'form')) }}
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Quên Mật Khẩu</h1>
            {{ HTML::image("public/assets/admin/images/login-logo.png") }}
        </div>
        <div class="login-wrap">
            <input type="email" class="form-control" name="email" id="email" placeholder="Địa chỉ E-mail" required >
             @if( Session::get('error') )
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span>{{ Session::get('error') }}</span>
            </div>
            @elseif( Session::get('status') )
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span>{{ Session::get('status') }}</span>
            </div>
            @endif
            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>
            </button>

        </div>
    {{ Form::close() }}

@stop

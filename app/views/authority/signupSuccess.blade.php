@extends('l.authority', array('active' => 'signin'))

@section('title') Đăng ký thành công @parent @stop

@section('style')
    @parent
    .center
    {
        text-align: center;
    }
@stop

@section('container')

    <h2 class="center">Vui lòng kích hoạt tài khoản của bạn</h2>
    <p class="center">Email kích hoạt đã được gửi đi, xin vui lòng đăng nhập vào e-mail của bạn（{{ $email }}）Kích hoạt tài khoản.</p>

@stop

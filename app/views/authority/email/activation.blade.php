@extends('l.mail')
@section('container')
    <p>Cảm ơn bạn đã đăng ký, xin vui lòng click vào link dưới đây để kích hoạt tài khoản của bạn:
        <br /><a href="{{ route('activate', $activationCode) }}" target="_blank">{{ route('activate', $activationCode) }}</a>
    </p>
@stop
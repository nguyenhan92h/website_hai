@extends('l.mail')
@section('container')
    <p>Bạn hãy nhấp vào liên kết dưới đây để hoàn thành việc thiết lập lại mật khẩu:
        <br /><a href="{{ route('reset', $token) }}" target="_blank">{{ route('reset', $token) }}</a>
    </p>
@stop
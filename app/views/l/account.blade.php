@extends('l.base')

@section('title') Trung tâm người dùng @parent @stop

@section('beforeStyle')
@parent @stop

@section('style')
body
{
    padding-bottom: 0;
    background-color: #f3f3ff;
}
@parent @stop

@section('body')

    @include('w.accountNavbar')

    <div class="container panel" style="margin-top:5em; padding-bottom:1em;">
        @yield('container')
    </div>

@stop

@section('end')
@parent @stop

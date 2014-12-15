@extends('l.base_auth')

@section('title') @parent @stop

@section('beforeStyle')
@parent @stop

@section('style')
	{{HTML::style("assets/admin/css/style.css")}}
	{{HTML::style("assets/admin/css/style-responsive.css")}}
@stop

@section('body')

	<div class="container">
		@yield('container')
	</div>

@stop

@section('end')
    {{ HTML::script('assets/admin/js/jquery-1.10.2.min.js') }}
    {{ HTML::script('assets/admin/js/bootstrap.min.js') }}
    {{ HTML::script('assets/admin/js/modernizr.min.js') }}
@parent @stop

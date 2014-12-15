@extends('l.base')

@section('title') {{$dataSetting->meta_desc}} @parent @stop
@section('description')
{{$dataSetting->meta_desc}}
@stop

@section('keywords')
{{$dataSetting->meta_key}}
@stop

@section('beforeStyle')
@parent @stop

@section('style')
{{HTML::style('public/assets/css/reset.css')}}
{{HTML::style('public/assets/css/superfish.css')}}
{{HTML::style('public/assets/css/prettyPhoto.css')}}
{{HTML::style('public/assets/css/jquery.qtip.css')}}
{{HTML::style('public/assets/css/style.css')}}
{{HTML::style('public/assets/css/menu_styles.css')}}
{{HTML::style('public/assets/css/animations.css')}}
{{HTML::style('public/assets/css/responsive.css')}}
{{HTML::style('public/assets/css/odometer-theme-default.css')}}
@parent @stop

@section('body')

    @include('w.blogNavbar')
		<!-- content slide big-->
		@yield('slideBig')

		<div class="page">
				<!-- content slide small-->
				@yield('slideSmall')
				<div class="page_layout page_margin_top clearfix">
					<div class="row">
						<!-- content website -->
		        		@yield('container')
		        		<!-- include content right -->
		        		<?if(!isset($hide_right)){?>
							@include('w.blogRight')
						<?}?>
		     		</div>
		  		</div>
		</div>
		<!-- include content footer -->
    @include('w.blogFooter')

@stop

@section('beforeScript')
	{{HTML::script('public/assets/js/jquery-1.11.1.min.js')}}
	<script>
	    jQuery(document).ready(function($){
	        // Get current url
	        // Select an a element that has the matching href and apply a class of 'active'. Also prepend a - to the content of the link
	        var url = window.location.href;
	        $('nav a[href="'+url+'"]').parent().addClass('selected');
	    });
	</script>
@stop

@section('end')
{{HTML::script('public/assets/js/jquery-migrate-1.2.1.min.js')}}
{{HTML::script('public/assets/js/jquery.ba-bbq.min.js')}}
{{HTML::script('public/assets/js/jquery-ui-1.11.1.custom.min.js')}}
{{HTML::script('public/assets/js/jquery.easing.1.3.js')}}
{{HTML::script('public/assets/js/jquery.carouFredSel-6.2.1-packed.js')}}
{{HTML::script('public/assets/js/jquery.touchSwipe.min.js')}}
{{HTML::script('public/assets/js/jquery.transit.min.js')}}
{{HTML::script('public/assets/js/jquery.sliderControl.js')}}
{{HTML::script('public/assets/js/jquery.timeago.js')}}
{{HTML::script('public/assets/js/jquery.hint.js')}}
{{HTML::script('public/assets/js/jquery.prettyPhoto.js')}}
{{HTML::script('public/assets/js/jquery.qtip.min.js')}}
{{HTML::script('public/assets/js/jquery.blockUI.js')}}
{{HTML::script('public/assets/js/main.js')}}
{{HTML::script('public/assets/js/odometer.min.js')}}
@parent @stop

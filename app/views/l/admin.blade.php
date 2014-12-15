@extends('l.base')

@section('title') @parent @stop

@section('style')

<!--common-->
{{HTML::style("public/assets/admin/css/style.css")}}
{{HTML::style("public/assets/admin/css/style-responsive.css")}}
@parent @stop

@section('body')

    @include('w.adminNavbar')

		<!-- main content start-->
        <div class="main-content" style="height: 1812px;">
            <!-- header section start-->
            <div class="header-section">
                <!--toggle button start-->
                <a class="toggle-btn"><i class="fa fa-bars"></i></a>

               <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        {{HTML::image("public/assets/admin/images/no_avatar.png")}}
                        {{Auth::user()->email}}
                        <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="{{URL::to('/admin/users/changeEmail/'.Auth::id())}}"><i class="fa fa-envelope"></i>Thay đổi E-mail</a></li>
                            <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--notification menu end -->
        </div>
        <!-- header section end-->
        <div class="wrapper">
	        @yield('container')
	        <!--footer section start-->
				   <footer>
				       2014 © AdminEx by ThemeBucket
				   </footer>
				<!--footer section end-->
        </div>
    </div>
@stop

@section('end')
<!-- Placed js at the end of the document so the pages load faster -->
	{{HTML::script("public/assets/admin/js/jquery-1.10.2.min.js")}}
	{{HTML::script("public/assets/admin/js/jquery-ui-1.9.2.custom.min.js")}}
	{{HTML::script("public/assets/admin/js/jquery-migrate-1.2.1.min.js")}}
	{{HTML::script("public/assets/admin/js/bootstrap.min.js")}}
	{{HTML::script("public/assets/admin/js/modernizr.min.js")}}
	{{HTML::script("public/assets/admin/js/jquery.nicescroll.js")}}

<!--common scripts for all pages-->
	{{HTML::script("public/assets/admin/js/scripts.js")}}
    <script>
        jQuery(document).ready(function($){
            // Get current url
            // Select an a element that has the matching href and apply a class of 'active'. Also prepend a - to the content of the link
            var url = window.location.href;
            $('.nav a[href="'+url+'"]').parents('.menu-list').addClass('nav-active');
            $('.nav a[href="'+url+'"]').parent().addClass('active');
            $('.nav li:first').click(function(){
                $(this).addClass('active');
            });
        });
    </script>
@parent @stop

 <!-- left side start-->
        <div class="left-side sticky-left-side">
            <!--logo and iconic logo start-->
            <div class="logo">
                <a href="index.html">{{HTML::image("public/assets/admin/images/logo.png")}}</a>
            </div>
            <div class="logo-icon text-center">
                <a href="index.html">{{HTML::image('public/assets/admin/images/logo_icon.png')}}</a>
            </div>
            <!--logo and iconic logo end-->
            <div class="left-side-inner">
                <!-- visible to small devices only -->
                <div class="visible-xs hidden-sm hidden-md hidden-lg">
                    <div class="media logged-user">
                    {{HTML::image('public/assets/admin/images/no_avatar.png', "", array('class' => 'media-object'))}}
                        <div class="media-body">
                            <h4><a href="#">{{Auth::user()->email}}</a></h4>
                        </div>
                    </div>
                    <h5 class="left-nav-title">Thông tin tài khoản</h5>
                    <ul class="nav nav-pills nav-stacked custom-nav">
                        <li><a href="{{URL::to('/admin/users/changeEmail/'.Auth::id())}}"><i class="fa fa-envelope"></i> <span>Thay đổi E-mail</span></a></li>
                        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> <span>Log Out</span></a></li>
                    </ul>
                </div>
                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li><a href="{{URL::to('/admin')}}"><i class="fa fa-home"></i> <span>Home</span></a>
                    </li>
                    <li class="menu-list"><a href=""><i class="fa fa-list"></i> <span>Danh mục Game</span></a>
                        <ul class="sub-menu-list" style="">
                            <li><a href="{{ route('category.create') }}"> Thêm danh mục</a></li>
                            <li><a href="{{ route('category.index') }}"> Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="menu-list"><a href=""><i class="fa fa-gamepad"></i> <span>Games</span></a>
                        <ul class="sub-menu-list" style="">
                            <li><a href="{{ route('games.create') }}"> Thêm Games</a></li>
                            <li><a href="{{ route('games.index') }}"> Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="menu-list"><a href=""><i class="fa fa-caret-square-o-right"></i> <span>Slider</span></a>
                        <ul class="sub-menu-list" style="">
                            <li><a href="{{ route('slider.create') }}"> Thêm Slider</a></li>
                            <li><a href="{{ route('slider.index') }}"> Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="menu-list"><a href=""><i class="fa fa-user"></i> <span>Thông tin Admin</span></a>
                        <ul class="sub-menu-list" style="">
                            <li><a href="{{ route('users.create') }}"> Thêm Admin</a></li>
                            <li><a href="{{ route('users.index') }}"> Danh sách</a></li>
                        </ul>
                    </li>
                    <li class="menu-list"><a href=""><i class="fa fa fa-cogs"></i> <span>Settings</span></a>
                        <ul class="sub-menu-list" style="">
                            <li><a href="{{ route('settings.edit', 1) }}"> Thông tin Website</a></li>
                            <li><a href="{{ URL::to('/admin/users/changePass/'.Auth::id()) }}"> Đổi mật khẩu</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
                </ul>
                <!--sidebar nav end-->
            </div>
        </div>
        <!-- left side end-->
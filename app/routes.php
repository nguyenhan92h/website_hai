<?php

/*
|--------------------------------------------------------------------------
| quyền cơ bản
|--------------------------------------------------------------------------
*/
RouteGroup::make('auth')->before('guest')->controller('AuthorityController')->go(function ($route) {

    # Logout
    $route->get('logout')->as('logout')->uses('getLogout')->beforeClear();

    # Đăng nhập
    $route->get( 'signin'                   )->as('signin'        )->uses('getSignin'         );
    $route->post('signin'                   )                      ->uses('postSignin'        );
    # đăng ký
    $route->get( 'signup'                   )->as('signup'        )->uses('getSignup'         );
    $route->post('signup'                   )                      ->uses('postSignup'        );
    # Đăng ký thành công người dùng sẽ được nhắc nhở để kích hoạt
    $route->get( 'success/{email}'          )->as('signupSuccess' )->uses('getSignupSuccess'  );
    # kích hoạt tài khoản
    $route->get( 'activate/{activationCode}')->as('activate'      )->uses('getActivate'       );
    # Quên mật khẩu
    $route->get( 'forgot-password'          )->as('forgotPassword')->uses('getForgotPassword' );
    $route->post('forgot-password'          )                      ->uses('postForgotPassword');
    # Đặt lại mật khẩu
    $route->get( 'forgot-password/{token}'  )->as('reset'         )->uses('getReset'          );
    $route->post('forgot-password/{token}'  )                      ->uses('postReset'         );

});

/*
|--------------------------------------------------------------------------
| Administrator
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'admin', 'before' => 'auth|admin'), function () {

    # Back
    RouteGroup::make()->controller('AdminController')->go(function ($route) {
        $route->get('/')->as('admin')->uses('getIndex');
    });

    # Quản lý tài khoản
    RouteGroup::make('users')->as('users')->controller('Admin_User')->go(function ($route) {
        $route->index()
              ->create()->before('adminNoAuth')
              ->store()->before('adminNoAuth')
              ->edit()->before('adminNoAuth')
              ->update()->before('adminNoAuth');
        $route->delete('{id}')->as('destroy')->uses('destroy')->before('adminNoAuth');
        $route->get('/loadDatatable')->as('loadDatatable')->uses('loadDatatable');
        $route->get('/destroyMany/{id}')->as('destroyMany')->uses('destroyMany')->before('adminNoAuth');
        $route->any('/changeEmail/{id}')->as('changeEmail')->uses('changeEmail');
        $route->any('/changePass/{id}')->as('changePass')->uses('changePass');
    });

     # Route Category Management
    RouteGroup::make('category')->as('category')->controller('Admin_Category')->go(function ($route) {
        $route->index()
              ->create()
              ->store()
              ->edit()
              ->update();
        $route->delete('{id}')->as('destroy')->uses('destroy');
        $route->get('/loadDatatable')->as('loadDatatable')->uses('loadDatatable');
        $route->get('/destroyMany/{id}')->as('destroyMany')->uses('destroyMany');
    });

     # Route games Management
    RouteGroup::make('games')->as('games')->controller('Admin_Games')->go(function ($route) {
        $route->index()
              ->create()
              ->store()
              ->edit()
              ->update();
        $route->delete('{id}')->as('destroy')->uses('destroy');
        $route->get('/loadDatatable')->as('loadDatatable')->uses('loadDatatable');
        $route->get('/destroyMany/{id}')->as('destroyMany')->uses('destroyMany');
    });

      # Route games Management
    RouteGroup::make('slider')->as('slider')->controller('Admin_Slider')->go(function ($route) {
        $route->index()
              ->create()
              ->store()
              ->edit()
              ->update();
        $route->delete('{id}')->as('destroy')->uses('destroy');
        $route->get('/loadDatatable')->as('loadDatatable')->uses('loadDatatable');
        $route->get('/destroyMany/{id}')->as('destroyMany')->uses('destroyMany');
    });

     # Route settings Management
    RouteGroup::make('settings')->as('settings')->controller('Admin_Settings')->go(function ($route) {
        $route->edit()
              ->update();
    });


    RouteGroup::make('changevaluecol')->as('changevaluecol')->controller('AdminController')->go(function ($route) {
        $route->get('/')->as('changevaluecol')->uses('changevaluecol');
    });
});

/*
|--------------------------------------------------------------------------
| Blog
|--------------------------------------------------------------------------
*/
RouteGroup::make()->controller('HomeController')->go(function ($route) {

    # Blog Trang chủ
    $route->get( '/')->as('home')->uses('getIndex');
    // route search
    $route->post( '/tim-kiem.html')->as('search')->uses('getSearch');
});

//route video
RouteGroup::make()->controller('VideoController')->go(function ($route) {
	# Filter Video by category Video
    $route->get( '/video.html')->as('video')->uses('getIndex');
   # Filter Video by category Video
    $route->get( '/video/{id}-{slug}')->as('videoCat')->uses('getVideoByCategory');
   # Hiển thị bài đăng trên blog
    $route->get( '/video/{id}-{slug}/{id1}-{title}')->as('videoDetail')->uses('getVideoDetail');
});

//route video
RouteGroup::make()->controller('GamesController')->go(function ($route) {
  # Filter Video by category Video
    $route->get( '/games.html')->as('games')->uses('getIndex');
   # Filter Video by category Video
    $route->get( '/games/{id}-{slug}')->as('videoCat')->uses('getGamesByCategory');
   # Hiển thị bài đăng trên blog
    $route->get( '/games/{id}-{slug}/{id1}-{title}')->as('gamesDetail')->uses('getGamesDetail');
});

// route article
RouteGroup::make()->controller('ArticleController')->go(function ($route) {
	# Filter Video by category Video
    $route->get( '/bai-viet.html')->as('article')->uses('getIndex');
   # Filter Video by category Video
    $route->get( '/bai-viet/{id}-{slug}')->as('articleCat')->uses('getArticleByCategory');
   # Hiển thị bài đăng trên blog
    $route->get( '/bai-viet/{id}-{slug}/{id1}-{title}')->as('articleDetail')->uses('getArticleDetail');
});



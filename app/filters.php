<?php

/*
| ------------------------------------------------- -------------------------
| Đăng ký sự kiện ứng dụng, thực hiện theo trình tự sau:
| ------------------------------------------------- -------------------------
|
| 1. thực hiện các sự kiện ứng dụng App :: trước tham số $ request
| 2. thực hiện của các bộ lọc trước tham số Route :: lọc $ tuyến đường, $ request
|
| 3. thực hiện (trước khi đăng ký vào các tuyến đường) chức năng gọi nặc danh hoặc các phương pháp điều khiển tương ứng và có được những ví dụ phản ứng $ phản ứng
|
| 4. thực hiện sau khi tham số Route lọc :: lọc $ tuyến đường, $ request, $ phản ứng
| 5. thực hiện các sự kiện ứng dụng App :: sau khi tham số $ request, $ phản ứng
|
| 6. trả lại cho các khách hàng để đáp ứng với các trường hợp phản ứng $
|
| 7. thực hiện các sự kiện ứng dụng các thông số App :: thúc $ request, $ phản ứng
| 8. thực hiện các sự kiện ứng dụng App :: shutdown tham số $ ứng dụng
|
*/

# App::before(function ($request) {});

# App::after(function ($request, $response) {});

# App::finish(function ($request, $response) {});

# App::shutdown(function($application) {});


/*
|--------------------------------------------------------------------------
| [Pre] lọc
|--------------------------------------------------------------------------
# Route::filter('beforeFilter', function ($route, $request) {});
|
*/


# Bộ lọc bảo vệ CSRF, để ngăn chặn cuộc tấn công cross-site giả mạo yêu cầu
Route::filter('csrf', function()
{
    if (Session::token() != Input::get('_token'))
        throw new Illuminate\Session\TokenMismatchException;
});

Route::filter('admin', function () {
    if (! Auth::user()->is_admin) return Redirect::back();
});

//is admin cấp 2, chỉ có 1 số quyền
Route::filter('adminNoAuth', function () {
    if (Auth::user()->is_admin != 1) return Redirect::back();
});


Route::filter('auth', function () {
    if (Auth::guest()) return Redirect::guest(route('signin'));
});


Route::filter('auth.basic', function () {
    return Auth::basic();
});


Route::filter('guest', function () {
    // Chặn người dùng đăng nhập
    if (Auth::check()) return Redirect::to('/');
});


Route::filter('not.self', function ($route) {
    // Chặn ID người dùng riêng
    if (Auth::user()->id == $route->parameter('id'))
        return Redirect::back()->with('error', 'Bạn không có quyền thực hiện thao tác này');
});
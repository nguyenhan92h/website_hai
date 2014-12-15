<?php

class AuthorityController extends BaseController
{
    /**
     * Page: Đăng nhập
     * @return Response
     */
    public function getSignin()
    {
        return View::make('authority.signin');
    }

    /**
     * Hành động: Đăng nhập
     * @return Response
     */
    public function postSignin()
    {
        // Voucher
        $credentials = array('email'=>Input::get('email'), 'password'=>Input::get('password'));
        // Remember
        $remember    = Input::get('remember-me', 0);
        // Xác minh đăng nhập
        if (Auth::validate($credentials)) {
            // Xác thực thành công, xác nhận kích hoạt tài khoản
            $user = Auth::getLastAttempted();
            if (is_null($user->activated)) {
                // Không hoạt động, quay trở lại
                return Redirect::back()
                    ->withInput()
                    ->withErrors(array('attempt' => '"E-mail" không được kích hoạt, xin vui lòng mở email kích hoạt hộp thư của bạn để hoàn tất quá trình kích hoạt.'));
            }
            // Kích hoạt bằng tay đăng nhập, nhảy trở lại trang trước chặn
            Auth::login($user, $remember);
            return Redirect::to('/admin');
        } else {
            // Đăng nhập thất bại, quay trở lại
            return Redirect::back()
                ->withInput()
                ->withErrors(array('attempt' => '"E-mail" hoặc "password" sai, xin vui lòng đăng nhập lại.'));
        }
    }

    /**
     * Hành động: Thoát
     * @return Response
     */
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/admin');
    }

    /**
     * Page: Đăng ký
     * @return Response
     */
    public function getSignup()
    {
        return View::make('authority.signup');
    }

    /**
     * Hành động: Đăng ký
     * @return Response
     */
    public function postSignup()
    {
        // Nhận tất cả các dữ liệu mẫu.
        $data = Input::all();
        // Tạo quy tắc xác nhận
        $rules = array(
            'email'    => 'required|email|unique:users',
            'password' => 'required|alpha_dash|between:6,16|confirmed',
        );
        // Tin Nhắn xác nhận tùy chỉnh
        $messages = array(
            'email.required'      => 'Vui lòng nhập địa chỉ email.',
            'email.email'         => 'Xin vui lòng nhập một địa chỉ email hợp lệ.',
            'email.unique'        => 'Email này đã được sử dụng.',
            'password.required'   => 'Vui lòng nhập mật khẩu của bạn.',
            'password.alpha_dash' => 'Định dạng mật khẩu là không chính xác.',
            'password.between'    => 'Độ dài mật khẩu trong khoảng từ 6 - 16 ký tự',
            'password.confirmed'  => 'Mật khẩu nhập lại không đúng',
        );
        // bắt đầu xác minh
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Xác thực thành công, thêm người dùng
            $user = new User;
            $user->email    = Input::get('email');
            $user->password = Input::get('password');
            $user->is_admin = 2;
            if ($user->save()) {
                // thêm thành công
                // tạo mã kích hoạt
                $activation = new Activation;
                $activation->email = $user->email;
                $activation->token = str_random(40);
                $activation->save();
                // Gửi email kích hoạt
                $with = array('activationCode' => $activation->token);
                Mailgun::send('authority.email.activation', $with, function ($message) use ($user) {
                    $message
                        ->to($user->email)
                        ->subject('Email kích hoạt tài khoản'); // Tiêu đề
                });
                //Chuyển đến trang đăng ký thành công, nhắc người dùng để kích hoạt
                return Redirect::route('signupSuccess', $user->email);
            } else {
                // Thêm thất bại
                return Redirect::back()
                    ->withInput()
                    ->withErrors(array('add' => 'Đăng ký không thành công.'));
            }
        } else {
            // Xác nhận thất bại, quay trở lại
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * Page: đăng ký thành công, cho thấy kích hoạt
     * @param  string $email Đăng ký thành viên hộp thư
     * @return Response
     */
    public function getSignupSuccess($email)
    {
        // Xác nhận sự tồn tại của email hoạt động này
        $activation = Activation::whereRaw("email = '{$email}'")->first();
        // Không có cơ sở dữ liệu mailbox, quay về trang 404
        is_null($activation) AND App::abort(404);
        // Kích hoạt
        return View::make('authority.signupSuccess')->with('email', $email);
    }

    /**
     * Hành động: Kích hoạt tài khoản
     * @param  string $activationCode
     * @return Response
     */
    public function getActivate($activationCode)
    {
        // Cơ sở dữ liệu xác thực thẻ
        $activation = Activation::where('token', $activationCode)->first();
        // Cơ sở dữ liệu mà không cần thẻ
        is_null($activation) AND App::abort(404);
        // Cơ sở dữ liệu có một mã thông báo
        // Kích hoạt người sử dụng tương ứng
        $user = User::where('email', $activation->email)->first();
        $user->activated = time();
        $user->save();
        // xóa token
        $activation->delete();
        // Kích hoạt các thủ thuật thành công
        return View::make('authority.activationSuccess');
    }

    /**
     * Page: Quên mật khẩu của bạn, gửi tin nhắn reset mật khẩu
     * @return Response
     */
    public function getForgotPassword()
    {
        return View::make('authority.password.remind');
    }

    /**
     * Hành động: quên mật khẩu, gửi tin nhắn reset mật khẩu
     * @return Response
     */
    public function postForgotPassword()
    {
        // Lớp gọi hệ thống cung cấp
        $response = Password::remind(Input::only('email'), function ($m, $user, $token) {
            $m->to($user->email, $user->email)->subject('Quên mật khẩu');
        });
        // Hộp thư phát hiện và gửi tin nhắn reset mật khẩu
        switch ($response) {
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));
            case Password::REMINDER_SENT:
                return Redirect::back()->with('status', Lang::get($response));
        }
    }

    /**
     * Page: thiết lập lại mật khẩu
     * @return Response
     */
    public function getReset($token)
    {
        // Cơ sở dữ liệu mà không cần thẻ ném 404
        is_null(PassowrdReminder::where('token', $token)->first()) AND App::abort(404);
        return View::make('authority.password.reset')->with('token', $token);
    }

    /**
     * Hành động: Thiết lập lại mật khẩu
     * @return Response
     */
    public function postReset()
    {
        // Gọi hệ thống đi kèm với quá trình thiết lập lại mật khẩu
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );
        $response = Password::reset($credentials, function ($user, $password) {
            // Lưu mật khẩu mới
            $user->password = $password;
            $user->save();
            // đăng nhập tài khoản
            Auth::login($user);
        });

        switch ($response) {
            case Password::INVALID_PASSWORD:
                // no break
            case Password::INVALID_TOKEN:
                // no break
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));
            case Password::PASSWORD_RESET:
                return Redirect::to('/admin');
        }
    }

}

<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface
{
    /**
     * xoá
     * @var boolean
     */
    protected $softDelete = true;

/*
|--------------------------------------------------------------------------
| hỗ trợ Auth
|--------------------------------------------------------------------------
*/
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

/*
|--------------------------------------------------------------------------
| accessor
|--------------------------------------------------------------------------
*/
    /**
     * Thân thiện với thời gian đăng nhập cuối cùng
     * @return string
     */
    public function getFriendlySigninAtAttribute()
    {
        if (is_null($this->signin_at))
            return 'Tài khoản mới không được đăng nhập';
        else
            return friendly_date($this->signin_at);
    }

    /**
     * User avatar (lớn)
     * @return string User avatar URI
     */
    public function getPortraitLargeAttribute()
    {
        if ($this->portrait)
            return asset('portrait/large/'.$this->portrait);
        else
            return with(new Identicon)->getImageDataUri($this->email, 220);
    }

    /**
     * User avatar (in)
     * @return string User avatar URI
     */
    public function getPortraitMediumAttribute()
    {
        if ($this->portrait)
            return asset('portrait/medium/'.$this->portrait);
        else
            return with(new Identicon)->getImageDataUri($this->email, 128);
    }

    /**
     * User avatar (nhỏ)
     * @return string User avatar URI
     */
    public function getPortraitSmallAttribute()
    {
        if ($this->portrait)
            return asset('portrait/small/'.$this->portrait);
        else
            return with(new Identicon)->getImageDataUri($this->email, 64);
    }

/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
*/
    /**
     * mật khẩu
     * @param  string $value Chuỗi mật khẩu không được điều trị
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        // Nếu chuỗi đã được mã hóa đến Hash, không điều trị lặp lại
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }


}

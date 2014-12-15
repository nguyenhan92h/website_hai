@extends('l.admin', array('active' => 'users'))

@section('title') @parent Thay đổi Mật Khẩu @stop
@section('container')

    <div class="page-heading">
      <h3>
          Admin
      </h3>
      <ul class="breadcrumb">
          <li>
              <a href="{{ URL::to('admin/users') }}">Admin</a>
          </li>
          <li class="active"> Cập nhật Mật Khẩu</li>
      </ul>
  </div>
      <div class="row">
            @include('w.notification')
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Form Cập nhật Mật Khẩu
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                {{Form::open(array('class' => 'cmxform form-horizontal adminex-form', 'method' => 'post'))}}
                                    <div class="form-group ">
                                        <label class="control-label col-lg-2" for="password_old">Mật khẩu cũ</label>
                                        <div class="col-lg-10">
                                            <input type="password" name="password_old" id="password_old" class=" form-control">
                                            {{ $errors->first('password_old', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                     <div class="form-group ">
                                        <label class="control-label col-lg-2" for="password">Mật khẩu Mới</label>
                                        <div class="col-lg-10">
                                            <input type="password" name="password" id="password" class=" form-control">
                                            {{ $errors->first('password', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                     <div class="form-group ">
                                        <label class="control-label col-lg-2" for="password_confirmation">Nhập lại Mật khẩu mới</label>
                                        <div class="col-lg-10">
                                            <input type="password" name="password_confirmation" id="password_confirmation" class=" form-control">
                                            {{ $errors->first('password_confirmation', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="hidden" name="_method" value="POST">
                                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                                        <button class="btn btn-default" type="reset">Hủy</button>
                                    </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
@stop
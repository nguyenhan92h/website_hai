@extends('l.admin', array('active' => $resource))

@section('title') @parent Thêm mới {{ $resourceName }} @stop
@section('container')

    <div class="page-heading">
      <h3>
          {{$resourceName}}
      </h3>
      <ul class="breadcrumb">
          <li>
              <a href="{{ route($resource.'.index') }}">{{$resourceName}}</a>
          </li>
          <li class="active"> Thêm {{$resourceName}} </li>
      </ul>
    </div>
    <div class="row">
          @include('w.notification')
              <div class="col-lg-12">
                  <section class="panel">
                      <header class="panel-heading">
                          Form Thêm {{$resourceName}}
                      </header>
                      <div class="panel-body">
                          <div class="form">
                              {{Form::open(array("url" => route($resource.'.store'), 'class' => 'cmxform form-horizontal adminex-form', 'method' => 'post'))}}
                                  <div class="form-group ">
                                      <label for="email" class="control-label col-lg-2">Email</label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="email" name="email" type="text" value="{{Input::old('email')}}">
                                          {{ $errors->first('email', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label for="password" class="control-label col-lg-2">Mật khẩu</label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="password" name="password" type="password">
                                          {{ $errors->first('password', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label for="password_confirmation" class="control-label col-lg-2">Nhập lại Mật khẩu</label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="password_confirmation" name="password_confirmation" type="password">
                                          {{ $errors->first('password_confirmation', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                      </div>
                                  </div>
                                  <div class="col-lg-offset-2 col-lg-10">
                                      <button class="btn btn-primary" type="submit">Thêm</button>
                                      <button class="btn btn-default" type="reset">Hủy</button>
                                  </div>
                              {{Form::close()}}
                          </div>
                      </div>
                  </section>
              </div>
        </div>
@stop
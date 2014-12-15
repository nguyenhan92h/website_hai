@extends('l.admin', array('active' => $resource))

@section('title') @parent Sửa {{ $resourceName }} @stop
@section('beforeStyle')
    {{HTML::style("public/assets/admin/css/square/green.css")}}
    {{HTML::style("public/assets/admin/css/minimal/green.css")}}
    {{HTML::style("public/assets/admin/css/flat/green.css")}}
@parent @stop
@section('container')

    <div class="page-heading">
      <h3>
          {{$resourceName}}
      </h3>
  </div>
      <div class="row">
            @include('w.notification')
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Form Sửa {{$resourceName}}
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                {{Form::open(array("url" => route($resource.'.update', $data->id), 'class' => 'cmxform form-horizontal adminex-form', 'method' => 'post'))}}
                                <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group ">
                                        <label for="name" class="control-label col-lg-2">Tên Website</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="name" name="name" type="text" value="{{Input::old('name', $data->name)}}">
                                            {{ $errors->first('name', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="address" class="control-label col-lg-2">Địa chỉ</label>
                                        <div class="col-lg-10">
                                            <textarea name="address" id="address" class="form-control" rows="10">{{Input::old('address', $data->address)}}</textarea>
                                            {{ $errors->first('address', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-2">E-mail</label>
                                        <div class="col-lg-10">
                                            <input type="email" name="email" class="form-control" id="email" value="{{Input::old('email_send', $data->email_send)}}">
                                            {{ $errors->first('email', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="password" class="control-label col-lg-2">Mật khẩu E-mail</label>
                                        <div class="col-lg-10">
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="phone" class="control-label col-lg-2">Điện thoại bàn</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="phone" name="phone" type="text" value="{{Input::old('phone', $data->phone)}}">
                                            {{ $errors->first('phone', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="mobile" class="control-label col-lg-2">Điện thoại di động</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="mobile" name="mobile" type="text" value="{{Input::old('mobile', $data->mobile)}}">
                                            {{ $errors->first('mobile', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="meta_title" class="control-label col-lg-2">Meta Title</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="meta_title" name="meta_title" type="text" value="{{Input::old('meta_title', $data->meta_title)}}">
                                            {{ $errors->first('meta_title', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="meta_desc" class="control-label col-lg-2">Meta Description</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="meta_desc" name="meta_desc" type="text" value="{{Input::old('meta_desc', $data->meta_desc)}}">
                                            {{ $errors->first('meta_desc', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="meta_key" class="control-label col-lg-2">Meta Keyword</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="meta_key" name="meta_key" type="text" value="{{Input::old('meta_key', $data->meta_key)}}">
                                            {{ $errors->first('meta_key', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label class="control-label col-lg-2">Số Bản ghi trên 1 trang</label>
                                        <div class="col-lg-10">
                                            <div id="spinner1">
                                                <div class="input-group input-small">
                                                    <input type="text" readonly="" value="{{Input::old('per_page', $data->per_page)}}" name="per_page" class="spinner-input form-control">
                                                    <div class="spinner-buttons input-group-btn btn-group-vertical">
                                                        <button class="btn spinner-up btn-xs btn-default" type="button">
                                                            <i class="fa fa-angle-up"></i>
                                                        </button>
                                                        <button class="btn spinner-down btn-xs btn-default" type="button">
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Bảo trì Website</label>
                                        <div class="col-lg-10 icheck ">
                                            <div class="flat-green single-row">
                                                <div class="radio ">
                                                    <div class="icheckbox_flat-green <?=($data->maintenance)?'checked':''?>" ><input type="checkbox" value="1" <?=($data->maintenance)?'checked':''?> name="maintenance" ><ins class="iCheck-helper" ></ins></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                                            <button class="btn btn-default" type="reset">Hủy</button>
                                        </div>
                                    </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
  </div>

@stop

@section('end')
    @parent
    {{ HTML::script('public/assets/admin/js/jquery.icheck.js') }}
    {{ HTML::script('public/assets/admin/js/icheck-init.js') }}
    {{ HTML::script('public/assets/admin/js/spinner.min.js') }}
    {{ HTML::script('public/assets/admin/js/spinner-init.js') }}
@stop
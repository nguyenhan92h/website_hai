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
      <ul class="breadcrumb">
          <li>
              <a href="{{ route($resource.'.index') }}">{{$resourceName}}</a>
          </li>
          <li class="active"> Sửa {{$resourceName}} </li>
      </ul>
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
                                        <label for="title" class="control-label col-lg-2">Tiêu đề Video</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="title" name="title" type="text" value="{{Input::old('title', $data->title)}}">
                                            {{ $errors->first('title', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="content" class="control-label col-lg-2">Content</label>
                                        <div class="col-lg-10">
                                            <textarea name="content" id="content" class="form-control" rows="10">{{Input::old('content', $data->content)}}</textarea>
                                            {{ $errors->first('content', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label class="control-label col-lg-2">Vị trí</label>
                                        <div class="col-lg-10">
                                            <div id="spinner1">
                                                <div class="input-group input-small">
                                                    <input type="text" readonly="" value="{{Input::old('order', $data->order)}}" name="order" class="spinner-input form-control">
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
                                        <label class="col-lg-2 control-label">Kích hoạt</label>
                                        <div class="col-lg-10 icheck ">
                                            <div class="flat-green single-row">
                                                <div class="radio ">
                                                    <div class="icheckbox_flat-green <?=($data->active)?'checked':''?>" ><input type="checkbox" value="1" <?=($data->active)?'checked':''?> name="active" ><ins class="iCheck-helper" ></ins></div>
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
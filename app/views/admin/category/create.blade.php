@extends('l.admin', array('active' => $resource))

@section('title') @parent Thêm mới {{ $resourceName }} @stop
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
                                        <label for="name" class="control-label col-lg-2">Tên danh mục</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="name" name="name" type="text" value="{{Input::old('name')}}">
                                            {{ $errors->first('name', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label class="control-label col-lg-2">Vị trí</label>
                                        <div class="col-lg-10">
                                            <div id="spinner1">
                                                <div class="input-group input-small">
                                                    <input type="text" readonly="" name="order" class="spinner-input form-control">
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
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" type="submit">Thêm</button>
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
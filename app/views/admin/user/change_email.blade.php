@extends('l.admin', array('active' => 'users'))

@section('title') @parent Cập nhật Email @stop
@section('container')

    <div class="page-heading">
      <h3>
          Admin
      </h3>
      <ul class="breadcrumb">
          <li>
              <a href="{{ URL::to('admin/users') }}">Admin</a>
          </li>
          <li class="active"> Cập nhật Email</li>
      </ul>
  </div>
      <div class="row">
            @include('w.notification')
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Form Cập nhật E-mail
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                {{Form::open(array('class' => 'cmxform form-horizontal adminex-form', 'method' => 'post'))}}
                                    <div class="form-group ">
                                        <label class="control-label col-lg-2" for="email">Email</label>
                                        <div class="col-lg-10">
                                            <input type="text" value="{{Input::old('email', $data->email)}}" name="email" id="email" class=" form-control">
                                            {{ $errors->first('email', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
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
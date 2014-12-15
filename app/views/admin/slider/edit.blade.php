@extends('l.admin', array('active' => $resource))

@section('title') @parent Chỉnh sửa {{ $resourceName }} @stop
@section('beforeStyle')
    {{HTML::style("public/assets/admin/css/square/green.css")}}
    {{HTML::style("public/assets/admin/css/minimal/green.css")}}
    {{HTML::style("public/assets/admin/css/flat/green.css")}}
    {{HTML::style("public/assets/admin/css/bootstrap-fileupload.min.css")}}
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
                                {{Form::open(array("url" => route($resource.'.update', $data->id), 'files' => true, 'class' => 'cmxform form-horizontal adminex-form', 'method' => 'post'))}}
                                <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group ">
                                        <label for="title" class="control-label col-lg-2">Tiêu đề</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="title" name="title" value="{{ Input::old('title', $data->title) }}" type="text">
                                            {{ $errors->first('title', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="content" class="control-label col-lg-2 col-sm-3">Nội dung bài viết</label>
                                        <div class="col-lg-10 col-sm-9">
                                            <textarea id="content" class="form-control" name="content">
                                                {{ Input::old('content', $data->content) }}
                                            </textarea>
                                            {{ $errors->first('content', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="link" class="control-label col-lg-2">Link</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" value="{{ Input::old('link', $data->link) }}" id="link" name="link" type="text">
                                            {{ $errors->first('link', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="meta_keywords" class="control-label col-lg-2">Meta Keywords</label>
                                        <div class="col-lg-10">
                                            <input class=" form-control" id="meta_keywords" name="meta_keywords" value="{{ Input::old('meta_keywords', $data->meta_keywords) }}" type="text">
                                            {{ $errors->first('meta_keywords', '<span style="color:#c7254e;margin:0 1em;">:message</span>') }}
                                        </div>
                                    </div>
                                    <div class="form-group last">
                                        <label class="control-label col-lg-2">Ảnh Slide</label>
                                        <div class="col-md-10">
                                            <div data-provides="fileupload" class="fileupload fileupload-new">
                                                <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
                                                {{HTML::image('public/uploads/slider/'.$data->image)}}
                                                </div>
                                                <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                                <div>
                                                       <span class="btn btn-default btn-file">
                                                       <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                       <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                       <input type="file" class="default" name="file_image">
                                                       </span>
                                                    <a data-dismiss="fileupload" class="btn btn-danger fileupload-exists" href="#"><i class="fa fa-trash"></i> Remove</a>
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
     <!-- js img upload -->
    {{ HTML::script('public/assets/admin/js/bootstrap-fileupload.min.js') }}
    {{ HTML::script('public/tinymce/tinymce.min.js') }}
    <!-- place in header of your html document -->
    <script>
        tinymce.init({
            selector: "textarea#content",
            theme: "modern",
            plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                 "save table contextmenu directionality emoticons template paste textcolor"
           ],
           height: 280,
           content_css: "css/content.css",
           toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
           style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
         });
    </script>
@stop
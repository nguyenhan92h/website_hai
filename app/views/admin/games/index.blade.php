@extends('l.admin', array('active' => $resource))
@section('title') @parent {{ $resourceName }} Quản lý @stop
@section('style')

<!--common-->
{{ HTML::style('public/assets/admin/css/demo_page.css') }}
{{ HTML::style('public/assets/admin/css/demo_table.css') }}
{{ HTML::style('public/assets/admin/css/DT_bootstrap.css') }}
@parent @stop
@section('container')
	<div class="page-heading">
      <h3>
          {{$resourceName}}
      </h3>
  </div>
  <div class="row">
    @include('w.notification')
		<div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                {{$resourceName}}
                <span class="tools pull-right">
                    <a href="{{route($resource.'.create')}}"><i class="fa fa-plus fa-lg"></i>Thêm {{$resourceName}}</a>
                    <a href="javascript:void(0)" onClick="onDelAll(&#39;{{URL::to('/').'/admin/games/destroyMany/'}}&#39;)"><i class="fa fa-times-circle fa-lg"></i>Xóa {{$resourceName}}</a>
                 </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table id="dataTable" class="display table table-bordered table-striped dataTable" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="chkMasCheck"
                                           onclick="onCheckAll();"/></th>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên game</th>
                                <th>Danh mục</th>
                                <th>Ngày thêm</th>
                                <th>Kích hoạt</th>
                                <th>Sửa/Xóa</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
        </div>
  </div>
    <?php
        $modalData['modal'] = array(
            'id'      => 'myModal',
            'title'   => 'Thông báo',
            'message' => 'Bạn có muốn xóa không？',
            'footer'  =>
                Form::open(array('id' => 'real-delete', 'method' => 'delete')).'
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>'.
                Form::close(),
        );
    ?>
    @include('w.modal', $modalData)
@stop
@section('end')
    @parent
    {{ HTML::script('public/assets/admin/js/jquery.dataTables.min.js') }}
    {{ HTML::script('public/assets/admin/js/DT_bootstrap.js') }}
    {{ HTML::script('public/assets/admin/js/function.js') }}
    <script>
        function modal(href)
        {
            $('#real-delete').attr('action', href);
            $('#myModal').modal();
        }
    </script>
    <!-- script datatables -->
<script>
    $(document).ready(function() {
        $('#dataTable').dataTable( {
            "processing": false,
            "serverSide": true,
            "ajax": "{{URL::to('/admin/games/loadDatatable')}}",
            "order": [[ 2, "desc" ]],
            "columnDefs": [
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        var icon = '';
                        if(data == 1){
                            icon = '<i class="fa fa-check-square-o fa-lg"></i>';
                        }else{
                            icon = '<i class="fa fa-square-o fa-lg"></i>';
                        }
                        var html = '<label id="active' + row[2] + '"><a href="javascript:void(0)" onclick="changeValueCol(' + row[2] + ', &#39;active&#39;, ' + '&#39;games&#39;, ' + data + ', &#39;id&#39;' + ')">' + icon + '</a></label>';
                        return  html;
                    },
                    "targets": 6
                },
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        var url_edit = "{{URL::to('/admin/games')}}" + '/' + row[2] + '/' + 'edit';
                        var url_del  = "{{ URL::to('/admin/games')}}" + '/' + row[2];
                        return  '<a href="' + url_edit + '"><i class="fa fa-edit fa-lg"></i></a> | <a href="javascript:void(0)" onclick="modal(&#39;'+ url_del +'&#39;)"><i class="fa fa-times-circle fa-lg"></i></a>';
                    },
                    "targets": 7
                },
                { "visible": false, "targets": 2 },
                { "orderable": false, "targets": 0 },
                { "orderable": false, "targets": 7}
            ]
        } );
    } );
</script>
@stop
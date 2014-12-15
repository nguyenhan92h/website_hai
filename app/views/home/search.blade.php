@extends('l.blog', array('active' => 'article'))

@section('title') {{$title_search}} @stop

@section('container')
			<div class="column column_2_3">
				<h4 class="box_header">{{$title_search}}</h4>
				<h5><p>Có {{$total}} kết quả tìm kiếm với từ khóa <span style="color: #ed1c24">"{{$key}}"</span> :</p></h5>
				<div class="row">
					<ul class="blog column column_1_2">
						<?
							if(!empty($dataSearch)){
								$i = 0;
								foreach($dataSearch as $key => $article){
									$link_article = URL::to('/bai-viet/'.$article->cat_id.'-'.Str::slug($article->cat_name).'/'.$article->id.'-'.Str::slug($article->title)).'.html';
									$link_category = URL::to('/bai-viet/'.$article->cat_id.'-'.Str::slug($article->cat_name)).'.html';
						?>
							<li class="post">
								<h4 class="with_number clearfix">
									<a href="{{$link_article}}" title="{{$article->title}}">{{Str::limit($article->title, 28)}}</a>
								</h4>
								<p>{{Str::limit($article->content, 68)}}</p>
								<a class="read_more" href="{{$link_article}}" title="Read more"><span class="arrow"></span><span>Đọc chi tiết</span></a>
							</li>
						<?
							$i++;
							if(ceil(count($dataSearch) / 2) == $i){
						?>
							</ul><ul class="blog column column_1_2">
						<?
							}}}
						?>
					</ul>
				</div>
				<div class="page_margin_top">
           		{{ $dataSearch->links()}}
          	</div>
			</div>
@stop

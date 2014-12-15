@extends('l.blog', array('active' => 'article'))
@section('title') {{$cat_name}} @stop

@section('slideSmall')
	<div class="row page_margin_top">
				<div class="column column_1_1">
					<div class="horizontal_carousel_container">
						<ul class="blog horizontal_carousel autoplay-1 scroll-1 visible-3 navigation-1 easing-easeInOutQuint duration-750">
								<?
									if(!empty($dataArticleSlide)){
										foreach($dataArticleSlide as $article){
											$link_article = URL::to('/bai-viet/'.$article->cat_id.'-'.Str::slug($article->cat_name).'/'.$article->id.'-'.Str::slug($article->title)).'.html';
											$link_category = URL::to('/bai-viet/'.$article->cat_id.'-'.Str::slug($article->cat_name)).'.html';
								?>
									<li class="post">
										<a title="{{$article->title}}" href="{{$link_article}}">
											<span class="icon small gallery"></span>
											<img src="{{$article->image}}" alt="img">
										</a>
										<h5><a title="{{$article->title}}" href="{{$link_article}}">{{Str::limit($article->title, 32)}}</a></h5>
										<ul class="post_details simple">
											<li class="category"><a title="{{$article->cat_name}}" href="{{$link_category}}">{{$article->cat_name}}</a></li>
											<li class="date">
												{{date('H:i A, M d',strtotime($article->created))}}
											</li>
										</ul>
									</li>
								<?}}?>
								</ul>
					</div>
				</div>
			</div>
@stop

@section('container')
			<div class="column column_2_3">
				<h4 class="box_header">{{$cat_name}}</h4>
				<div class="row">
					<ul class="blog column column_1_2">
						<?
							if(!empty($dataArticle)){
								$i = 0;
								foreach($dataArticle as $key => $article){
									$link_article = URL::to('/bai-viet/'.$article->cat_id.'-'.Str::slug($article->cat_name).'/'.$article->id.'-'.Str::slug($article->title)).'.html';
									$link_category = URL::to('/bai-viet/'.$article->cat_id.'-'.Str::slug($article->cat_name)).'.html';
						?>
							<li class="post">
								<a title="Struggling Nuremberg Sack Coach Verbeek" href="{{$link_article}}">
									<span class="icon small gallery"></span>
									<img src="{{$article->image}}" alt="img">
								</a>
								<h4 class="with_number">
									<a href="{{$link_article}}" title="{{$article->title}}">{{Str::limit($article->title, 28)}}</a>
								</h4>
								<a class="read_more" href="{{$link_article}}" title="Read more"><span class="arrow"></span><span>Đọc chi tiết</span></a>
							</li>
						<?
							$i++;
							if(ceil(count($dataArticle) / 2) == $i){
						?>
							</ul><ul class="blog column column_1_2">
						<?
							}}}
						?>
					</ul>
				</div>
				<div class="page_margin_top">
           		{{ $dataArticle->links()}}
          	</div>
			</div>
@stop

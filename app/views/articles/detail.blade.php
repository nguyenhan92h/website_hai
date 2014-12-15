@extends('l.blog', array('active' => 'article'))

@section('title') {{$title}} @stop

@section('container')
		<div class="column column_2_3">
			<div class="row">
				<div class="post single">
						<?
							if(!empty($dataArticle)){
								$link_category = URL::to('/bai-viet/'.$dataArticle->cat_id.'-'.Str::slug($dataArticle->cat_name)).'.html';
						?>
							<h1 class="post_title">
								{{$dataArticle->title}}
							</h1>
							<ul class="post_details clearfix">
								<li class="detail category"><a title="{{$dataArticle->cat_name}}" href="{{$link_category}}">{{$dataArticle->cat_name}}</a></li>
								<li class="detail date">{{date('H:i A, M d',strtotime($dataArticle->created))}}</li>
							</ul>
							<a title="{{$dataArticle->title}}" class="post_image page_margin_top prettyPhoto" href="{{$dataArticle->image}}">
								<img alt="img" src="{{$dataArticle->image}}" style="display: block;">
							</a>
							<div class="post_content page_margin_top clearfix">
							<div class="content_box">
								<div class="text">
									{{$dataArticle->content}}
								</div>
							</div>
						</div>
						<?}?>
				</div>
			</div>
			<div class="row page_margin_top_section">
			<h4 class="box_header">Bài viết Khác</h4>
			<div class="horizontal_carousel_container page_margin_top">
				<a title="prev" href="#" class="slider_control left slider_control_0 slideRightBack" style="display: block;"></a>
				<div class="caroufredsel_wrapper caroufredsel_wrapper_hortizontal_carousel">
					<ul class="blog horizontal_carousel autoplay-1 scroll-1 navigation-1 easing-easeInOutQuint duration-750">
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
								<h5><a title="{{$article->title}}" href="{{$link_article}}">{{Str::limit($article->title, 22)}}</a></h5>
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
	</div>
@stop

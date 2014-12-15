@extends('l.blog', array('active' => 'video'))

@section('title') {{$title}} @stop

@section('container')
		<div class="column column_2_3">
			<div class="row">
				<div class="post single">
						<?
							if(!empty($dataVideo)){
								$arr_link_video = explode('?v=', $dataVideo->content);
								$link_category = URL::to('/video/'.$dataVideo->cat_id.'-'.Str::slug($dataVideo->cat_name)).'.html';
								$link_video = "//www.youtube.com/embed/" . $arr_link_video[1];
						?>
							<h1 class="post_title">
								{{$dataVideo->title}}
							</h1>
							<ul class="post_details clearfix">
								<li class="detail category"><a title="{{$dataVideo->cat_name}}" href="{{$link_category}}">{{$dataVideo->cat_name}}</a></li>
								<li class="detail date">{{date('H:i A, M d',strtotime($dataVideo->created))}}</li>
							</ul>
							<iframe allowfullscreen="" src="{{$link_video}}" class="iframe_video page_margin_top"></iframe>
						<?}?>
				</div>
			</div>
			<div class="row page_margin_top_section">
			<h4 class="box_header">Video Khác</h4>
			<div class="horizontal_carousel_container page_margin_top">
				<a title="prev" href="#" class="slider_control left slider_control_0 slideRightBack" style="display: block;"></a>
				<div class="caroufredsel_wrapper caroufredsel_wrapper_hortizontal_carousel">
					<ul class="blog horizontal_carousel autoplay-1 scroll-1 navigation-1 easing-easeInOutQuint duration-750">
						<?
							if(!empty($dataVideoSlide)){
								foreach($dataVideoSlide as $video){
									$arr_link_video = explode('?v=', $video->content);
									$link_video = URL::to('/video/'.$video->cat_id.'-'.Str::slug($video->cat_name).'/'.$video->id.'-'.Str::slug($video->title)).'.html';
									$link_img = "http://i1.ytimg.com/vi/" . $arr_link_video[1] . "/hqdefault.jpg"
						?>
							<li class="post">
								<a title="{{$video->title}}" href="{{$link_video}}">
									<span class="icon video"></span>
									<img src="{{$link_img}}" alt="img">
								</a>
								<h5><a title="{{$video->title}}" href="{{$link_video}}">{{Str::limit($video->title, 22)}}</a></h5>
								<ul class="post_details simple">
									<li class="category"><a title="{{$video->cat_name}}" href="#">{{$video->cat_name}}</a></li>
									<li class="date">
										{{date('H:i A, M d',strtotime($video->created))}}
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

@extends('l.blog', array('active' => 'video'))

@section('title') {{$cat_name}} @stop

@section('slideSmall')
	<div class="row page_margin_top">
				<div class="column column_1_1">
					<div class="horizontal_carousel_container">
						<ul class="blog horizontal_carousel autoplay-1 scroll-1 visible-3 navigation-1 easing-easeInOutQuint duration-750">
								<?
									if(!empty($dataVideoSlide)){
										foreach($dataVideoSlide as $video){
											$arr_link_video = explode('?v=', $video->content);
											$link_video = URL::to('/video/'.$video->cat_id.'-'.Str::slug($video->cat_name).'/'.$video->id.'-'.Str::slug($video->title)).'.html';
											$link_img = "http://i1.ytimg.com/vi/" . $arr_link_video[1] . "/hqdefault.jpg";
								?>
									<li class="post">
										<a title="{{$video->title}}" href="{{$link_video}}">
											<span class="icon video"></span>
											<img src="{{$link_img}}" alt="img">
										</a>
										<h5><a title="{{$video->title}}" href="{{$link_video}}">{{Str::limit($video->title, 32)}}</a></h5>
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
@stop

@section('container')
			<div class="column column_2_3">
				<h4 class="box_header">{{$cat_name}}</h4>
				<div class="row">
					<ul class="blog column column_1_2">
						<?
							if(!empty($dataVideo)){
								$i = 0;
								foreach($dataVideo as $key => $video){
									$arr_link_video = explode('?v=', $video->content);
									$link_video = URL::to('/video/'.$video->cat_id.'-'.Str::slug($video->cat_name).'/'.$video->id.'-'.Str::slug($video->title)).'.html';
									$link_img = "http://i1.ytimg.com/vi/" . $arr_link_video[1] . "/hqdefault.jpg";
						?>
							<li class="post">
								<a title="Struggling Nuremberg Sack Coach Verbeek" href="{{$link_video}}">
									<span class="icon video"></span>
									<img src="{{$link_img}}" alt="img">
								</a>
								<h4 class="with_number">
									<a href="{{$link_video}}" title="{{$video->title}}">{{Str::limit($video->title, 28)}}</a>
								</h4>
								<a class="read_more" href="{{$link_video}}" title="Read more"><span class="arrow"></span><span>Xem chi tiết</span></a>
							</li>
						<?
							$i++;
							if(ceil(count($dataVideo) / 2) == $i){
						?>
							</ul><ul class="blog column column_1_2">
						<?
							}}}
						?>
					</ul>
				</div>
				<div class="page_margin_top">
           		{{ $dataVideo->links()}}
          	</div>
			</div>
@stop

<div class="column column_1_3">
	<h4 class="box_header">Video nổi bật</h4>
	<ul class="blog small_margin clearfix">
		<?
			if(!empty($dataVideoRight)){
			foreach($dataVideoRight as $video){
				$arr_link_video = explode('?v=', $video->content);
				$link_video = URL::to('/video/'.$video->cat_id.'-'.Str::slug($video->cat_name).'/'.$video->id.'-'.Str::slug($video->title)).'.html';
				$link_category = URL::to('/video/'.$video->cat_id.'-'.Str::slug($video->cat_name)) . '.html';
				$link_img = "http://i1.ytimg.com/vi/" . $arr_link_video[1] . "/hqdefault.jpg"

		?>
		<li class="post">
			<a title="{{$video->title}}" href="{{$link_video}}">
				<span class="icon video"></span>
				<img alt="img" src="{{$link_img}}" style="display: block;">
			</a>
			<div class="post_content">
				<h5>
					<a title="{{$video->title}}" href="{{$link_video}}">{{$video->title}}</a>
				</h5>
				<ul class="post_details simple">
					<li class="category"><a title="{{$video->cat_name}}" href="{{$link_category}}">{{$video->cat_name}}</a></li>
					<li class="date">
						{{date('H:i A, M d',strtotime($video->created))}}
					</li>
				</ul>
			</div>
		</li>
		<?}}?>
	</ul>
	<h4 class="box_header page_margin_top_section">Bài viết nổi bật</h4>
	<div class="vertical_carousel_container clearfix">
			<ul class="blog small vertical_carousel autoplay-1 scroll-1 navigation-1 easing-easeInOutQuint duration-750">
				<?
					if(!empty($dataArticleRight)){
						foreach($dataArticleRight as $val){
							$link_article = URL::to('/bai-viet/'.$val->cat_id.'-'.Str::slug($val->cat_name).'/'.$val->id.'-'.Str::slug($val->title)).'.html';
							$link_category = URL::to('/bai-viet/'.$val->cat_id.'-'.Str::slug($val->cat_name)) . '.html';
				?>
					<li class="post">
						<a href="{{$link_article}}" title="{{$val->title}}">
							<span class="icon small gallery"></span>
							<img src="{{$val->image}}" alt="img">
						</a>
						<div class="post_content">
							<h5>
								<a href="{{$link_article}}" title="{{$val->title}}">{{$val->title}}</a>
							</h5>
							<ul class="post_details simple">
								<li class="category"><a href="{{$link_category}}" title="{{$val->cat_name}}">{{$val->cat_name}}</a></li>
								<li class="date">
									{{date('H:i A, M d',strtotime($val->created))}}
								</li>
							</ul>
						</div>
					</li>
				<?}}?>
			</ul>
		</div>
		<h4 class="box_header page_margin_top_section">{{$cat_name_right}}</h4>
			<ul class="blog small clearfix">
			<?
				if(!empty($dataCatArticleRight)){
					foreach($dataCatArticleRight as $art_right){
						$link_article = URL::to('/bai-viet/'.$val->cat_id.'-'.Str::slug($val->cat_name).'/'.$val->id.'-'.Str::slug($val->title)).'.html';
						$link_category = URL::to('/bai-viet/'.$val->cat_id.'-'.Str::slug($val->cat_name)) . '.html';
			?>
				<li class="post">
					<a title="{{$art_right->title}}" href="{{$link_article}}">
						<span class="icon small gallery"></span>
						<img alt="img" src="{{$art_right->image}}">
					</a>
					<div class="post_content">
						<h5>
							<a title="{{$art_right->title}}" href="{{$link_article}}">{{$art_right->title}}</a>
						</h5>
						<ul class="post_details simple">
							<li class="category"><a title="{{$art_right->cat_name}}" href="{{$link_category}}">{{$art_right->cat_name}}</a></li>
							<li class="date">
								{{date('H:i A, M d',strtotime($art_right->created))}}
							</li>
						</ul>
					</div>
				</li>
			<?}}?>
			</ul>
			<a href="{{$link_category}}" class="more page_margin_top">ĐỌC TẤT CẢ TIN TỨC {{$cat_name_right}}</a>
</div>
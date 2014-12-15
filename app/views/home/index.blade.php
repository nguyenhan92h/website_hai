@extends('l.blog', array('active' => 'home'))

<?if(!empty($dataSlider)){?>
@section('slideBig')
        <!-- start slider -->
        <ul class="slider" id="slider_4">
            <?
                $i = 0;
                foreach($dataSlider as $slide){
            ?>
            <li class="slide" id="slide_4_{{$i}}">
                {{HTML::image('public/uploads/slider/' . $slide->image)}}
                <div class="slider_content_box">
                    <ul class="post_details simple">
                        <li class="date">
                            {{date('H:i A, M d', $slide->created)}}
                        </li>
                    </ul>
                    <h2><a href="{{!empty($slide->link)?$slide->link:'#'}}" title="{{$slide->title}}">{{$slide->title}}</a></h2>
                    <p class="clearfix">{{Str::limit($slide->content, 48)}}</p>
                </div>
            </li>
            <?$i++;}?>
        </ul>
    <!-- End slide -->
@stop
<?}?>
@section('container')
    @section('slideSmall')
        <div class="slider_posts_list_container">
        </div>
    @stop
            <div class="column column_2_3">
                <h4 class="box_header">Bài viết mới</h4>
                <div class="row">
                    <ul class="blog column column_1_2">
                    <?
                        if(!empty($articles)){
                            $i = 0;
                            foreach($articles as $art){
                                $link_article = URL::to('/bai-viet/'.$art->cat_id.'-'.Str::slug($art->cat_name).'/'.$art->id.'-'.Str::slug($art->title)).'.html';
                                $link_category = URL::to('/bai-viet/'.$art->cat_id.'-'.Str::slug($art->cat_name)).'.html';
                    ?>
                        <li class="post">
                            <a href="{{$link_article}}" title="{{$art->title}}">
                                <span class="icon small gallery"></span>
                                <img src="{{$art->image}}" alt="img" style="display: block;">
                            </a>
                            <h4 class="with_number">
                                <a href="{{$link_article}}" title="{{$art->title}}">{{Str::limit($art->title, 28)}}</a>
                            </h4>
                            <ul class="post_details">
                                <li class="category"><a href="{{$link_category}}" title="{{$art->cat_name}}">{{$art->cat_name}}</a></li>
                                <li class="date">
                                    {{date('H:i A, M d',strtotime($art->created))}}
                                </li>
                            </ul>
                            <p>{{Str::limit($art->content, 128)}}</p>
                            <a class="read_more" href="{{$link_article}}" title="Read more"><span class="arrow"></span><span>ĐỌC TIẾP</span></a>
                        </li>
                    <?$i++;if(ceil(count($articles) / 2 == $i)){?>
                        </ul><ul class="blog column column_1_2">
                    <?}}}?>
                   </ul>
                </div>
                <div class="row page_margin_top_section">
                    <h4 class="box_header">Bài viết mới nhất của {{$dataCat['cat_name']}}</h4>
                    <div class="row">
                        <?
                            if(!empty($articleCat)){
                                $i = 1;
                                foreach($articleCat as $art){
                                    $link_article = URL::to('/bai-viet/'.$art->cat_id.'-'.Str::slug($art->cat_name).'/'.$art->id.'-'.Str::slug($art->title)).'.html';
                                    $link_category = URL::to('/bai-viet/'.$art->cat_id.'-'.Str::slug($art->cat_name)) . '.html';
                                    if($i == 1){
                                        $i++;
                        ?>
                        <ul class="blog column column_1_2">
                            <li class="post">
                                <a title="{{$art->title}}" href="{{$link_article}}">
                                    <span class="icon small gallery"></span>
                                    <img alt="img" src="{{$art->image}}" style="display: block;">
                                </a>
                                <h4 class="with_number">
                                    <a title="{{$art->title}}" href="{{$link_article}}">{{$art->title}}</a>
                                </h4>
                                <ul class="post_details">
                                    <li class="category"><a title="{{$art->cat_name}}" href="{{$link_category}}">{{$art->cat_name}}</a></li>
                                    <li class="date">
                                        {{date('H:i A, M d',strtotime($art->created))}}
                                    </li>
                                </ul>
                                <p>{{Str::limit($art->content, 128)}}</p>
                                <a title="Read more" href="{{$link_article}}" class="read_more"><span class="arrow"></span><span>ĐỌC TIẾP</span></a>
                            </li>
                        </ul>
                        <div class="column column_1_2">
                            <ul class="blog small clearfix">
                        <?}else{?>
                                <li class="post">
                                    <a title="{{$art->title}}" href="{{$link_article}}">
                                        <span class="icon small gallery"></span>
                                        <img alt="img" src="{{$art->image}}">
                                    </a>
                                    <div class="post_content">
                                        <h5>
                                            <a title="{{$art->title}}" href="{{$link_article}}">{{$art->title}}</a>
                                        </h5>
                                        <ul class="post_details simple">
                                            <li class="category"><a title="{{$art->cat_name}}" href="{{$link_category}}">{{$art->cat_name}}</a></li>
                                            <li class="date">
                                                {{date('H:i A, M d',strtotime($art->created))}}
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            <?}}}?>
                                </ul>
                            <a href="{{$link_category}}" class="more page_margin_top">ĐỌC TẤT CẢ TIN TỨC {{$dataCat['cat_name']}}</a>
                        </div>
                    </div>
                </div>
                <div class="row page_margin_top_section">
                    <h4 class="box_header">Videos</h4>
                    <?if(!empty($videoCat)){?>
                    <div class="tabs no_scroll margin_top_10 clearfix">
                        <ul class="tabs_navigation small clearfix">
                            <?
                                $k = 1;
                                foreach($videoCat as $key => $tag){
                            ?>
                            <li>
                                <a title="{{$tag->cat_name}}" href="#{{Str::slug($tag->cat_name)}}" class="ui-tabs-anchor" role="presentation" tabindex="{{($k)?'0':'-1'}}" id="ui-id-{{$k}}">
                                    {{$tag->cat_name}}
                                </a>
                            </li>
                            <?$k++;}?>
                        </ul>
                        <?
                            $i = 1;
                            foreach($videoCat as $key => $video){
                        ?>
                        <div id="{{Str::slug($video->cat_name)}}">
                            <div class="horizontal_carousel_container page_margin_top">
                                <ul class="blog horizontal_carousel page_margin_top autoplay-1 scroll-1 navigation-1 easing-easeInOutQuint duration-750">
                                    <?
                                        $j = 1;
                                        foreach($video as $val){
                                            $arr_link_video = explode('?v=', $val->content);
                                            $link_video = URL::to('/video/'.$val->cat_id.'-'.Str::slug($val->cat_name).'/'.$val->id.'-'.Str::slug($val->title)).'.html';
                                            $link_category = URL::to('/video/'.$val->cat_id.'-'.Str::slug($val->cat_name)) . '.html';
                                            $link_img = "http://i1.ytimg.com/vi/" . $arr_link_video[1] . "/hqdefault.jpg";
                                    ?>
                                        <li class="post">
                                            <a title="{{$val->title}}" href="{{$link_video}}">
                                                <span class="icon video"></span>
                                                <img alt="img" src="{{$link_img}}" style="display: block;">
                                            </a>
                                            <h5><span class="number">{{$j}}.</span><a title="{{$val->title}}" href="{{$link_video}}">{{Str::limit($val->title, 28)}}</a></h5>
                                            <ul class="post_details simple">
                                                <li class="category"><a title="{{$val->cat_name}}" href="{{$link_category}}">{{$val->cat_name}}</a></li>
                                                <li class="date">
                                                    {{date('H:i A, M d',strtotime($val->created))}}
                                                </li>
                                            </ul>
                                        </li>
                                        <?$j++;}?>
                                    </ul>
                                </div>
                            </div>
                        <?$i++;}?>
                    </div>
                    <?}?>
                </div>
            </div>
@stop

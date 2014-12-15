@extends('l.blog', array('active' => 'video'))
@section('title') Video @stop

@section('container')
    <div class="column column_2_3">
        <h4 class="box_header">Video tổng hợp</h4>
        <div class="row">
            <ul class="blog column column_1_2">
            <?
                if(!empty($videos)){
                    $i = 0;
                    foreach($videos as $video){
                        $arr_link_video = explode('?v=', $video->content);
                        $link_video = URL::to('/'.$video->cat_id.'-'.Str::slug($video->cat_name).'/'.$video->id.'-'.Str::slug($video->title)).'.html';
                        $link_category = URL::to('/'.$video->cat_id.'-'.Str::slug($video->cat_name)).'.html';
                        $link_img = "http://i1.ytimg.com/vi/" . $arr_link_video[1] . "/hqdefault.jpg";
            ?>
                <li class="post">
                    <a href="{{$link_video}}" title="{{$video->title}}">
                        <span class="icon video"></span>
                        <img src="{{$link_img}}" alt="img" style="display: block;">
                    </a>
                    <h4 class="with_number">
                        <a href="{{$link_video}}" title="{{$video->title}}">{{Str::limit($video->title, 28)}}</a>
                    </h4>
                    <ul class="post_details">
                        <li class="category"><a href="{{$link_category}}" title="{{$video->cat_name}}">{{$video->cat_name}}</a></li>
                        <li class="date">
                            {{date('H:i A, M d',strtotime($video->created))}}
                        </li>
                    </ul>
                </li>
            <?$i++;if(ceil(count($videos) / 2 == $i)){?>
                </ul><ul class="blog column column_1_2">
            <?}}}?>
           </ul>
        </div>
        <div class="page_margin_top">
            {{ $videos->links()}}
        </div>
    </div>
@stop

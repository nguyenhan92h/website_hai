<div class="header_top_bar_container clearfix">
    <div class="header_top_bar">
        {{Form::open(array('url' => route('search'), 'class' => 'search', 'method' => 'post'))}}
            <input type="text" name="skey" placeholder="Search..." value="Search..." class="search_input hint">
            <input type="submit" class="search_submit" value="">
        {{Form::close()}}
        <ul class="social_icons clearfix dark">
            <li>
                <a target="_blank" href="http://facebook.com" class="social_icon facebook" title="facebook">
                    &nbsp;
                </a>
            </li>
            <li>
                <a target="_blank" href="https://twitter.com" class="social_icon twitter" title="twitter">
                    &nbsp;
                </a>
            </li>
            <li>
                <a href="mailto:contact@gmail.com" class="social_icon mail" title="mail">
                    &nbsp;
                </a>
            </li>
        </ul>
        <div class="latest_news_scrolling_list_container">
            <ul>
                <? if(!empty($dataArticleRight)){?>
                <li class="category">Bài Nổi Bật</li>
                <li class="left"><a href="#"></a></li>
                <li class="right"><a href="#"></a></li>
                <li class="posts">
                    <ul class="latest_news_scrolling_list">
                        <?
                                foreach($dataArticleRight as $art_top){
                                    $link_article = URL::to('/bai-viet/'.$art_top->cat_id.'-'.Str::slug($art_top->cat_name)).'/'.$art_top->id.'-'.Str::slug($art_top->title).'.html';
                        ?>
                            <li>
                                <a href="{{$link_article}}" title="{{$art_top->title}}">{{Str::limit($art_top->title, 58)}}</a>
                            </li>
                        <?}?>
                    </ul>
                </li>
                <li class="date">
                <? $i = 1;foreach($dataArticleRight as $date){ ?>
                    <abbr title="{{date('d M Y', strtotime($date->created))}}" class="timeago {{($i==1)?'current':''}}">{{date('d M Y', strtotime($date->created))}}</abbr>
                <?$i++;}?>
                </li>
            <?}?>
            </ul>
        </div>
    </div>
    </div>
<div class="header_container">
    <div class="header clearfix">
        <div class="logo">
            <h1><a href="{{URL::to('/')}}" title="Pressroom">Nóng từng phút</a></h1>
            <h3>Tin tức Video nóng nhất</h3>
        </div>
    </div>
</div>
<div class="menu_container clearfix">
    <nav>
    <ul class="sf-menu">
        <li>
            <a href="{{URL::to('/').'/'}}" title="Home">
                Trang chủ
            </a>
        </li>
        <li class="submenu">
            <a href="{{URL::to('/video').'.html'}}" title="Video">
                Video
            </a>
            <ul>
                 <?
                    if(!empty($dataCatVideoHeader)){
                        foreach($dataCatVideoHeader as $video){
                            $linkCatVideo = URL::to('/video/'.$video->cat_id.'-'.Str::slug($video->cat_name)).'.html';
                ?>
                    <li>
                        <a href="{{$linkCatVideo}}" title="{{$video->cat_name}}">
                            {{$video->cat_name}}
                        </a>
                    </li>
                <?}}?>
            </ul>
        </li>
        <?
            if(!empty($dataNavHeader)){
                foreach($dataNavHeader as $nav){
                    $link_category = URL::to('/bai-viet/'.$nav->cat_id.'-'.Str::slug($nav->cat_name)).'.html';
        ?>
            <li>
                <a href="{{$link_category}}" title="{{$nav->cat_name}}">
                    {{$nav->cat_name}}
                </a>
            </li>
        <?}}?>
         <li class="submenu">
            <a href="{{URL::to('/games').'.html'}}" title="games">
                Games
            </a>
            <ul>
                 <?
                    if(!empty($dataCatGameHeader)){
                        foreach($dataCatGameHeader as $games){
                            $linkCatGames = URL::to('/games/'.$games->id.'-'.Str::slug($games->name)).'.html';
                ?>
                    <li>
                        <a href="{{$linkCatGames}}" title="{{$games->name}}">
                            {{$games->name}}
                        </a>
                    </li>
                <?}}?>
            </ul>
        </li>
    </ul>
</nav>
<div class="mobile_menu_container">
    <a href="http://quanticalabs.com/Pressroom/Template/#" class="mobile-menu-switch">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </a>
    <div class="mobile-menu-divider"></div>
    <nav>
    <ul class="mobile-menu">
        <li>
            <a href="{{URL::to('/').'/'}}" title="Home">
                Trang chủ
            </a>
        </li>
        <li class="submenu">
            <a href="{{URL::to('/video').'.html'}}" title="Home">
                Video
            </a>
            <ul>
                 <?
                    if(!empty($dataCatVideoHeader)){
                        foreach($dataCatVideoHeader as $video){
                            $linkCatVideo = URL::to('/video/'.$video->cat_id.'-'.Str::slug($video->cat_name)).'.html';
                ?>
                    <li>
                        <a href="{{$linkCatVideo}}" title="{{$video->cat_name}}">
                            {{$video->cat_name}}
                        </a>
                    </li>
                <?}}?>
            </ul>
        </li>
        <?
            if(!empty($dataNavHeader)){
                foreach($dataNavHeader as $nav){
                    $link_category = URL::to('/bai-viet/'.$nav->cat_id.'-'.Str::slug($nav->cat_name)).'.html';
        ?>
            <li>
                <a href="{{$link_category}}" title="{{$nav->cat_name}}">
                    {{$nav->cat_name}}
                </a>
            </li>
        <?}}?>
          <li class="submenu">
            <a href="{{URL::to('/games').'.html'}}" title="games">
                Games
            </a>
            <ul>
                 <?
                    if(!empty($dataCatGameHeader)){
                        foreach($dataCatGameHeader as $game){
                            $linkCatGames = URL::to('/games/'.$game->id.'-'.Str::slug($game->name)).'.html';
                ?>
                    <li>
                        <a href="{{$linkCatGames}}" title="{{$game->name}}">
                            {{$game->name}}
                        </a>
                    </li>
                <?}}?>
            </ul>
        </li>
    </ul>
    </nav>
</div>
</div>
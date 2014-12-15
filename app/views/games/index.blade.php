@extends('l.blog', array('active' => 'game'))
@section('title') Games @stop

@section('style')
    @parent
    {{HTML::style('public/assets/css/reveal.css')}}
@stop

@section('container')
    <div class="column column_8_8">
        <h4 class="box_header">Game Mới nhất</h4>
        <div class="row">
            <ul class="blog column column_8_8">
            <?
                if(!empty($dataGamesNew)){
                    $i = 0;
                    foreach($dataGamesNew as $game){
                        $link_game = URL::to('/'.$game->cat_id.'-'.Str::slug($game->cat_name).'/'.$game->id.'-'.Str::slug($game->title)).'.html';
                        $link_category = URL::to('/'.$game->cat_id.'-'.Str::slug($game->cat_name)).'.html';
            ?>
                <li>
                    <a href="javascript:void(0)" title="{{$game->name}}" onclick="show_popup({{$game->id}})">
                        <img src="{{URL::to('public/uploads/games/'.$game->image)}}" alt="img">
                    </a>
                    <div id="modal_{{$game->id}}" class="modal">
                        <div class="heading">
                            {{$game->name}}
                        </div>

                        <div class="content">
                            <ul>
                                <li class="title"><img src="{{URL::to('public/uploads/games/'.$game->image)}}" alt=""></li>
                                <li class="detail">
                                    <ul>
                                        <li><h4>{{$game->name}}</h4></li>
                                        <li class="category">{{$game->cat_name}} - {{date('d/m/Y', $game->created)}}</li>
                                        <li>{{html_entity_decode($game->content)}}</li>
                                        <li><a href="{{$game->link_download}}" class="button green">Download</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h5 class="with_number">
                        <a href="{{$link_game}}" title="{{$game->name}}">{{Str::limit($game->name, 20)}}</a>
                    </h5>
                    <ul class="post_details_game">
                        <li class="category"><a href="{{$link_category}}" title="{{$game->cat_name}}">{{$game->cat_name}}</a></li>
                        <li class="date">
                            {{date('H:i A, M d',strtotime($game->created))}}
                        </li>
                    </ul>
                </li>
            <?$i++;}}?>
           </ul>
        </div>
        <?
            if(!empty($dataCatGame)){
                foreach($dataCatGame as $key => $cat){
        ?>
        <div class="page_margin_top">
            <h4 class="box_header">{{$nameCat[$key]}}</h4>
            <div class="row">
                <ul class="blog column column_8_8">
                <?
                        $i = 0;
                        foreach($cat as $game){
                            $link_game = URL::to('/games/'.$game->cat_id.'-'.Str::slug($game->cat_name).'/'.$game->id.'-'.Str::slug($game->name)).'.html';
                            $link_category = URL::to('/games/'.$game->cat_id.'-'.Str::slug($game->cat_name)).'.html';
                ?>
                    <li>
                        <a href="javascript:void(0)" title="{{$game->name}}" onclick="show_popup({{$game->id}})">
                            <img src="{{URL::to('public/uploads/games/'.$game->image)}}" alt="img">
                        </a>
                        <div id="modal_{{$game->id}}" class="modal">
                             <div class="heading">
                                {{$game->name}}
                            </div>

                            <div class="content">
                                <ul>
                                    <li class="title"><img src="{{URL::to('public/uploads/games/'.$game->image)}}" alt=""></li>
                                    <li class="detail">
                                        <ul>
                                            <li><h4>{{$game->name}}</h4></li>
                                            <li class="category">{{$game->cat_name}} - {{date('d/m/Y', $game->created)}}</li>
                                            <li>{{html_entity_decode($game->content)}}</li>
                                            <li><a href="{{$game->link_download}}" class="button green">Download</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h5 class="with_number">
                            <a href="{{$link_game}}" title="{{$game->name}}">{{Str::limit($game->name, 20)}}</a>
                        </h5>
                        <ul class="post_details_game">
                            <li class="category"><a href="{{$link_category}}" title="{{$game->cat_name}}">{{$game->cat_name}}</a></li>
                            <li class="date">
                                {{date('H:i A, M d',strtotime($game->created))}}
                            </li>
                        </ul>
                    </li>
                <?$i++;}?>
               </ul>
            </div>
        </div>
        <?}}?>
    </div>
@stop
@section('end')
    @parent
    {{HTML::script('public/assets/js/jquery.reveal.js')}}
    <script type="text/javascript">
        function show_popup(id){
            $('#modal_' + id).reveal({ // The item which will be opened with reveal
                animation: 'fade',                   // fade, fadeAndPop, none
                animationspeed: 300,                       // how fast animtions are
                closeonbackgroundclick: true,              // if you click background will modal close?
                dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
            });
        }
    </script>
@stop
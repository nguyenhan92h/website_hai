<?php

class GamesController extends BaseController
{
    /**
     * Homepage
     * @return Respanse
     */
    public function getIndex()
    {
        $dataGames = Games::select(array('cat_id', 'cat_name'))->where('active', '=', 1)->orderBy('created', 'desc')->groupBy('cat_id')->get();
        foreach($dataGames as $cat){
            $nameCat[$cat->cat_id] = $cat->cat_name;
        }
        $i = 0;
        $dataGamesNew = Games::where('active', '=', 1)->orderBy('created', 'desc')->limit(16)->get();
        $dataCatGame = array();
        foreach($dataGames as $game){
            $dataCatGame[$game->cat_id] = Games::where('cat_id', '=', $game->cat_id)->where('active', '=', 1)->orderBy('created', 'desc')->limit(16)->get();
            $i++;
        }
        $hide_right = 1;
        return View::make('Games.index')->with(compact('dataCatGame', 'dataGamesNew', 'hide_right', 'nameCat'));
    }

    /**
     * [getVideoDetail description]
     * @return [type] [description]
     */
    public function getGamesDetail($id1){
        $dataGames      = Games::find($id1);
        $title = $dataGames->title;
        $dataGamesSlide = Games::where('cat_id', $dataGames->cat_id)->orderBy('created', 'desc')->limit(6)->get();
        return View::make('Games.detail')->with(compact('dataGames', 'dataGamesSlide', 'title'));
    }
}

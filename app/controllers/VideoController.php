<?php

class VideoController extends BaseController
{
    /**
     * Homepage
     * @return Respanse
     */
    public function getIndex()
    {
        $videos = Video::orderBy('created', 'desc')->paginate(12);
        return View::make('video.index')->with(compact('videos'));
    }

    /**
     * [getVideoDetail description]
     * @return [type] [description]
     */
    public function getVideoDetail($id1){
        $dataVideo = Video::find($id1);
        $title = $dataVideo->title;
        $dataVideoSlide = Video::where('cat_id', $dataVideo->cat_id)->orderBy('created', 'desc')->limit(6)->get();
        return View::make('video.detail')->with(compact('dataVideo', 'dataVideoSlide', 'title'));
    }
}

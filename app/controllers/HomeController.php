<?php

class HomeController extends BaseController
{
    /**
     * Homepage
     * @return Respanse
     */
    public function getIndex()
    {
        $articles            = Article::orderBy('created', 'desc')->limit(4)->get();
        $articleCat          = Article::where('cat_id', 1)->orderBy('created', 'desc')->limit(5)->get();
        $datavideoCat        = Video::select(array('cat_id', 'cat_name'))->groupBy('cat_id')->get();
        $dataSlider          = Slider::where('active', '=', 1)->orderBy('created')->limit(5)->get();
        $dataCat             = array();
        $dataCat['cat_name'] = 'Video';
        foreach($datavideoCat as $video){
            $videoCat[$video->cat_id]           = Video::where('cat_id', $video->cat_id)->orderBy('created', 'desc')->limit(6)->get();
            $videoCat[$video->cat_id]->cat_name = $video->cat_name;
        }
        foreach($articleCat as $val){
            $dataCat['cat_id']   = $val->cat_id;
            $dataCat['cat_name'] = $val->cat_name;
        }
        return View::make('home.index')->with(compact('articles', 'dataCat', 'articleCat', 'videoCat', 'dataSlider'));
    }

    public function getSearch(){
        if (Input::has('skey'))
        {
            $value = Input::get('skey');
            Session::put('key_search', $value);
        }
        elseif(!Input::has('page')){
            Session::forget('key_search');
        }
        $key = Session::get('key_search');
        // $dataSearch = DB::select("SELECT * FROM article, video WHERE article.title LIKE %{$key}% OR video.title LIKE %{$key}% ");
        // var_dump($dataSearch);die;
        $dataSearch = Article::where('title', 'LIKE', '%'.$key.'%')->orderBy('created', 'desc')->paginate(6);
        // $dataArticle = DB::table('article')->where('title', 'LIKE', '%'.$key.'%')->orderBy('created', 'desc');
        // $dataVideo = DB::table('video')->where('title', 'LIKE', '%'.$key.'%')->orderBy('created', 'desc')->union($dataArticle)->get();
        // var_dump($dataSearch);die;
        $total = $dataSearch->getTotal();
        $title_search = 'Kết quả tìm kiếm';
        return View::make('home.search')->with(compact('dataSearch', 'title_search', 'total', 'key'));
    }
}

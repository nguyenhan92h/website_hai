<?php

class ArticleController extends BaseController
{
    /**
     * Homepage
     * @return Respanse
     */
    public function getIndex()
    {
        $artcles = Article::orderBy('created', 'desc')->paginate(12);
        return View::make('articles.index')->with(compact('artcles'));
    }

    /**
     * Video By Category List
     * @return Respanse
     */
    public function getArticleByCategory($cat_id)
    {
        $dataArticleSlide = Article::where('cat_id', $cat_id)->orderBy('created', 'desc')->limit(6)->get();
        foreach($dataArticleSlide as $val){
            $cat_name = $val->cat_name;
            break;
        }
        $dataArticle          = Article::where('cat_id', $cat_id)->orderBy('created', 'desc')->paginate(12);
        return View::make('articles.article_cat')->with(compact('dataArticle', 'dataArticleSlide', 'cat_name'));
    }

    /**
     * [getVideoDetail description]
     * @return [type] [description]
     */
    public function getArticleDetail($id1){
        $dataArticle      = Article::find($id1);
        $title = $dataArticle->title;
        $dataArticleSlide = Article::where('cat_id', $dataArticle->cat_id)->orderBy('created', 'desc')->limit(6)->get();
        return View::make('articles.detail')->with(compact('dataArticle', 'dataArticleSlide', 'title'));
    }
}

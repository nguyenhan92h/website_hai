<?php

class BaseController extends Controller {
	/**
	 * Message Object
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messages = null;

	/**
	 * Initialization
	 * @return void
	 */
	public function __construct()
	{
		// CSRF Protection
		$this->beforeFilter('csrf', array('on' => 'post|put|delete'));
		// Examples of message objects
		$this->messages = new Illuminate\Support\MessageBag;
		$dataSetting = Settings::select(array('meta_title', 'meta_desc', 'meta_key'))->find(1);
		$dataCatGameHeader = Category::select(array('id', 'name'))->orderBy('order')->get();
		$dataArticleRight = Article::orderBy('created', 'desc')->limit(8)->get();
		$dataVideoRight = Video::orderBy('created', 'desc')->limit(3)->get();
		$dataCatArticleRight = Article::where('cat_id', 2)->orderBy('created', 'desc')->limit(5)->get();
		$cat_name_right= 'Tin tức';
		foreach($dataCatArticleRight as $cat){
			$cat_name_right = $cat->cat_name;
			break;
		}
		$dataNavHeader = Article::select(array('cat_id', 'cat_name'))->orderBy('cat_name', 'desc')->limit(6)->groupBy('cat_id')->get();
		$dataCatVideoHeader = Video::select(array('cat_id', 'cat_name'))->orderBy('cat_name', 'desc')->groupBy('cat_id')->get();
		View::share(compact('dataSetting', 'dataArticleRight', 'dataVideoRight', 'dataCatArticleRight', 'cat_name_right', 'dataNavHeader', 'dataCatVideoHeader', 'dataCatGameHeader'));
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}

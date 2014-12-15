<?php

class Admin_Article extends BaseResource
{
    /**
     * Resource View catalog
     * @var string
     */
    protected $resourceView = 'admin.article';

    /**
     * Resource model name, after initialization into model instances
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Article';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = 'articles';

    /**
     * Resource database table
     * @var string
     */
    protected $resourceTable = 'articles';

    /**
     * Resource Name
     * @var string
     */
    protected $resourceName = 'Bài viết';

    /**
     * Custom validation message
     * @var array
     */
    protected $validatorMessages = array(
        'title.required'   => 'Bạn không được bỏ trống trường này.',
        'title.unique'   => 'Tiêu đề bài viết này đã được sử dụng.',
        'meta_description.required'     => 'Bạn không được bỏ trống trường này.',
        'meta_title.required'     => 'Bạn không được bỏ trống trường này.',
        'meta_keywords.required'     => 'Bạn không được bỏ trống trường này.',
        'content.required' => 'Bạn không được bỏ trống trường này.',
        'content_short.required' => 'Bạn không được bỏ trống trường này.',
        'category.exists'  => 'Chọn danh mục cho bài viết',
    );

    /**
     * Resource List page
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        return View::make($this->resourceView.'.index');
    }

    /**
     * Resources to create a page
     * GET         /resource/create
     * @return Response
     */
    public function create()
    {
        $categoryLists = Category::lists('cat_name', 'id');
        return View::make($this->resourceView.'.create')->with(compact('categoryLists'));
    }

    /**
     * Resources to create an action
     * POST        /resource
     * @return Response
     */
    public function store()
    {
        // Get all the form data.
        $data   = Input::all();
        // Create validation rules
        $unique = $this->unique();
        $rules  = array(
            'title'    => 'required|'.$unique,
            'content'  => 'required',
            'content_short'  => 'required',
            'meta_title'  => 'required',
            'meta_description'  => 'required',
            'meta_keywords'  => 'required',
            'category' => 'required',
        );
        // Custom validation message
        $messages = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Verify success
             // create a new image directly from Laravel file upload
            if (Input::hasFile('file_image'))
            {
                $file     = Input::file('file_image');
                $filename = time().'_article.' . $file->getClientOriginalExtension();
                $path     = public_path('uploads/articles/' . $filename);
                $img      = Image::make($file->getRealPath())->save($path);
            } else {
                $filename = 'no_image.gif';
            }
            $model                   = $this->model;
            $model->user_id          = Auth::user()->id;
            $model->category_id      = $data['category'];
            $model->title            = e($data['title']);
            $model->slug             = e(Str::slug($data['title']));
            $model->content          = e($data['content']);
            $model->content_short    = e($data['content_short']);
            $model->meta_title       = e($data['meta_title']);
            $model->meta_description = e($data['meta_description']);
            $model->meta_keywords    = e($data['meta_keywords']);
            $model->active           = (isset($data['active']))?$data['active']:'0';
            $model->image            = $filename;
            $model->created          = time();
            if ($model->save()) {
                // Added successfully
                return Redirect::back()
                    ->with('success', 'Thêm bài viết thành công.');
            } else {
                // Add Failed
                return Redirect::back()
                    ->withInput()
                    ->with('error', 'Thất bại');
            }
        } else {
            // verify fail
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Resource Editor page
     * GET         /resource/{id}/edit
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->model->find($id);
        $categoryLists = Category::lists('cat_name', 'id');
        return View::make($this->resourceView.'.edit')->with(compact('data', 'categoryLists'));
    }

    /**
     * Action Resource Editor
     * PUT/PATCH   /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // Get all the form data.
        $data = Input::all();
        // Create validation rules
        $rules = array(
            'title'    => 'required|'.$this->unique('title', $id),
            'content'  => 'required',
            'content_short'  => 'required',
            'meta_title'  => 'required',
            'meta_description'  => 'required',
            'meta_keywords'  => 'required',
            'category' => 'required',
        );
        // Custom validation message
        $messages  = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Verify success
            $model                   = $this->model->find($id);

            // create a new image directly from Laravel file upload
            if (Input::hasFile('file_image'))
            {
                $file     = Input::file('file_image');
                $filename = time().'_article.' . $file->getClientOriginalExtension();
                $path     = public_path('uploads/articles/' . $filename);
                $img      = Image::make($file->getRealPath())->save($path);
            } else {
                $filename = $model->image;
            }
            $model->category_id      = $data['category'];
            $model->title            = e($data['title']);
            $model->slug             = e(Str::slug($data['title']));
            $model->content          = e($data['content']);
            $model->meta_title       = e($data['meta_title']);
            $model->meta_description = e($data['meta_description']);
            $model->meta_keywords    = e($data['meta_keywords']);
            $model->active           = (isset($data['active']))?$data['active']:'0';
            $model->image            = $filename;
            $model->updated          = time();
            if ($model->save()) {
                // Update success
                return Redirect::back()
                    ->with('success', 'Sửa bài viết thành công');
            } else {
                // Update fail
                return Redirect::back()
                    ->withInput()
                    ->with('error', 'Sửa bài viết thất bại');
            }
        } else {
            // verify fail
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Resources delete action
     * DELETE      /resource/{id}
     * @param  int, arr, str  $id
     * @return Response
     */
    public function destroyMany($id = '')
    {
        $id = explode(',', $id);
        if ($this->model->destroy($id))
            return Redirect::back()->with('success', 'Bạn đã xóa thành công');
        else
            return Redirect::back()->with('warning', 'Thất bại');
    }

    /**
     * [loadDatatable description]
     * @return [type] [description]
     */
    public function loadDatatable(){
        // Table's primary key
        $primaryKey = 'articles.id';

        // Join condition
        $myJoin = "LEFT JOIN `category` ON `category`.`id` = `articles`.`category_id`
                      LEFT JOIN `users` ON `users`.`id` = `articles`.`user_id`";

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => '`articles`.`id`', 'dt' => 2 ),
            array( 'db' => '`articles`.`title`',
                   'dt' => 3,
                   'formatter' => function($d, $row){
                        return html_entity_decode($d);
                    }
                ),
            array( 'db' => '`category`.`cat_name`', 'dt' => 4 ),
            array( 'db' => '`users`.`email`',  'dt' => 5 ),
            array(
                'db'        => '`articles`.`created`',
                'dt'        => 6,
                'formatter' => function( $d, $row ) {
                    return date( 'd/m/Y H:i:s', $d);
                }
            ),
            array('db' => '`articles`.`active`', 'dt' => 7)
        );

        // SQL server connection information
        $sql_details = array(
            'user' => \Config::get('database.connections.mysql.username'),
            'pass' => \Config::get('database.connections.mysql.password'),
            'db'   => \Config::get('database.connections.mysql.database'),
            'host' => \Config::get('database.connections.mysql.host')
        );

        require(dirname(__FILE__).'/../../models/SSP.php');

        echo json_encode(
            \SSP::simpleJoin( $_GET, $sql_details, $this->resourceTable, $primaryKey, $columns, $myJoin, "")
        );
    }
}

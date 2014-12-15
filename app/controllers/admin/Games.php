<?php

class Admin_Games extends BaseResource
{
    /**
     * Resource View catalog
     * @var string
     */
    protected $resourceView = 'admin.games';

    /**
     * Resource model name, after initialization into model instances
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Games';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = 'games';

    /**
     * Resource database table
     * @var string
     */
    protected $resourceTable = 'games';

    /**
     * Resource Name
     * @var string
     */
    protected $resourceName = 'Games';

    /**
     * Custom validation message
     * @var array
     */
    protected $validatorMessages = array(
        'name.required'   => 'Bạn không được bỏ trống trường này.',
        'name.unique'   => 'Tên game này đã được sử dụng.',
        'content.required'     => 'Bạn không được bỏ trống trường này.',
        'link_download.required'     => 'Bạn không được bỏ trống trường này.'
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
        $categoryLists = Category::lists('name', 'id');
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
            'name'    => 'required|'.$unique,
            'content'  => 'required',
            'link_download'  => 'required'
        );
        // Custom validation message
        $messages = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            $catName = Category::select('name')->find($data['cat_id']);
            // Verify success
             // create a new image directly from Laravel file upload
            if (Input::hasFile('file_image'))
            {
                $file     = Input::file('file_image');
                $filename = time().'_games.' . $file->getClientOriginalExtension();
                $path     = public_path('uploads/games/' . $filename);
                $img      = Image::make($file->getRealPath())->save($path);
            } else {
                $filename = 'no_image.gif';
            }
            $model                = $this->model;
            $model->cat_id        = $data['cat_id'];
            $model->cat_name      = $catName['name'];
            $model->name          = e($data['name']);
            $model->content       = e($data['content']);
            $model->link_download = $data['link_download'];
            $model->active        = (isset($data['active']))?$data['active']:'0';
            $model->image         = $filename;
            $model->created       = time();
            if ($model->save()) {
                // Added successfully
                return Redirect::back()
                    ->with('success', 'Bạn đã thêm thành công.');
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
        $categoryLists = Category::lists('name', 'id');
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
            'name'    => 'required|'.$this->unique('name', $id),
            'content'  => 'required',
            'link_download'  => 'required'
        );
        // Custom validation message
        $messages  = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            $catName = Category::select('name')->find($data['cat_id']);
            // Verify success
            $model                   = $this->model->find($id);

            // create a new image directly from Laravel file upload
            if (Input::hasFile('file_image'))
            {
                $file     = Input::file('file_image');
                $filename = time().'_games.' . $file->getClientOriginalExtension();
                $path     = public_path('uploads/games/' . $filename);
                $img      = Image::make($file->getRealPath())->save($path);
            } else {
                $filename = $model->image;
            }
            $model->cat_id        = $data['cat_id'];
            $model->cat_name      = $catName['name'];
            $model->name          = e($data['name']);
            $model->content       = e($data['content']);
            $model->link_download = $data['link_download'];
            $model->active        = (isset($data['active']))?$data['active']:'0';
            $model->image         = $filename;
            $model->updated       = time();
            if ($model->save()) {
                // Update success
                return Redirect::back()
                    ->with('success', 'Bạn đã sửa thành công');
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
        $primaryKey = 'games.id';

        // Join condition
        $myJoin = "LEFT JOIN `category_game` ON `category_game`.`id` = `games`.`cat_id`";

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => '`games`.`id`', 'dt' => 2 ),
            array( 'db' => '`games`.`name`',
                   'dt' => 3,
                   'formatter' => function($d, $row){
                        return html_entity_decode($d);
                    }
                ),
            array( 'db' => '`category_game`.`name`', 'dt' => 4 ),
            array(
                'db'        => '`games`.`created`',
                'dt'        => 5,
                'formatter' => function( $d, $row ) {
                    return date( 'd/m/Y H:i:s', $d);
                }
            ),
            array('db' => '`games`.`active`', 'dt' => 6)
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

<?php

class Admin_Slider extends BaseResource
{
    /**
     * Resource View catalog
     * @var string
     */
    protected $resourceView = 'admin.slider';

    /**
     * Resource model name, after initialization into model instances
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Slider';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = 'slider';

    /**
     * Resource database table
     * @var string
     */
    protected $resourceTable = 'slider';

    /**
     * Resource Name
     * @var string
     */
    protected $resourceName = 'Slide';

    /**
     * Custom validation message
     * @var array
     */
    protected $validatorMessages = array(
        'title.required'   => 'Bạn không được bỏ trống trường này.',
        'title.unique'   => 'Tiêu đề này đã được sử dụng.',
        'content.required' => 'Bạn không được bỏ trống trường này.'
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
        return View::make($this->resourceView.'.create');
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
            'content'  => 'required'
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
                $filename = time().'_slider.' . $file->getClientOriginalExtension();
                $path     = public_path('uploads/slider/' . $filename);
                $img      = Image::make($file->getRealPath())->save($path);
            } else {
                $filename = 'NULL';
            }
            $model          = $this->model;
            $model->title   = e($data['title']);
            $model->content = e($data['content']);
            $model->link    = $data['link'];
            $model->active  = (isset($data['active']))?$data['active']:'0';
            $model->image   = $filename;
            $model->created = time();
            if ($model->save()) {
                // Added successfully
                return Redirect::back()
                    ->with('success', 'Thêm Slide thành công.');
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
        return View::make($this->resourceView.'.edit');
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
            'content'  => 'required'
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
                $filename = time().'_slider.' . $file->getClientOriginalExtension();
                $path     = public_path('uploads/_slider/' . $filename);
                $img      = Image::make($file->getRealPath())->save($path);
            } else {
                $filename = $model->image;
            }
            $model->title   = e($data['title']);
            $model->content = e($data['content']);
            $model->link    = e($data['link']);
            $model->active  = (isset($data['active']))?$data['active']:'0';
            $model->image   = $filename;
            if ($model->save()) {
                // Update success
                return Redirect::back()
                    ->with('success', 'Sửa slide thành công');
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
        $primaryKey = 'slider.id';

        // Join condition
        $myJoin = "";

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => '`slider`.`id`', 'dt' => 2 ),
            array( 'db' => '`slider`.`title`',
                   'dt' => 3,
                   'formatter' => function($d, $row){
                        return html_entity_decode($d);
                    }
                ),
            array( 'db' => '`slider`.`content`', 'dt' => 4 ),
            array( 'db' => '`slider`.`link`', 'dt' => 5 ),
            array( 'db' => '`slider`.`image`',  'dt' => 6 ),
            array(
                'db'        => '`slider`.`created`',
                'dt'        => 7,
                'formatter' => function( $d, $row ) {
                    return date( 'd/m/Y H:i:s', $d);
                }
            ),
            array('db' => '`slider`.`active`', 'dt' => 8)
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

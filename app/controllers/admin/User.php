<?php

class Admin_User extends BaseResource
{
    /**
     * Resource View catalog
     * @var string
     */
    protected $resourceView = 'admin.user';

    /**
     * Resource model name, after initialization into model instances
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'User';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = 'users';

    /**
     * Resource database table
     * @var string
     */
    protected $resourceTable = 'users';

    /**
     * Resource Name
     * @var string
     */
    protected $resourceName = 'Admin';

    /**
     * Custom validation message
     * @var array
     */
    protected $validatorMessages = array(
        'email.required'      => 'Bạn không được bỏ trống trường này.',
        'email.email'         => 'E-mail không đúng định dạng',
        'email.unique'        => 'E-mail đã tồn tại.',
        'password.required'   => 'Bạn không được bỏ trống trường này.',
        'password.alpha_dash' => 'Định dạng mật khẩu không đúng.',
        'password.between'    => 'Độ dài mật khẩu từ 6 - 20 ký tự',
        'password.confirmed'  => 'Mật khẩu nhập lại không đúng.',
        'password_old.required'  => 'Bạn không được bỏ trống trường này.',
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
            'email'    => 'required|email|'.$unique,
            'password' => 'required|alpha_dash|between:6,20|confirmed'
        );
        // Custom validation message
        $messages = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Authentication is successful
            $model           = $this->model;
            $model->email    = Input::get('email');
            $model->password = Input::get('password');
            $model->is_admin = 2;
            $model->activated = time();
            $model->created = time();
            if ($model->save()) {
                // Added successfully
                return Redirect::back()
                    ->with('success', 'Thêm User thành công.');
            } else {
                // Add Failed
                return Redirect::back()
                    ->withInput()
                    ->with('error', 'Lỗi, bạn hãy thử lại');
            }
        } else {
            // Validation fails
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }
    /**
     * [edit description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id){
        $data = $this->model->find($id);
        return View::make($this->resourceView.'.edit')->with(compact('data'));
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
            'email'    => 'required|email|'.$this->unique('email', $id),
            'password' => 'alpha_dash|between:6,20|confirmed'
        );
        // Custom validation message
        $messages  = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Authentication is successful
            $model = $this->model->find($id);
            $model->email    = Input::get('email');
            if(!empty($data['password'])){
                $model->password = Hash::make($data['password']);
            }
            $model->updated = time();
            if ($model->save()) {
                // Update successful
                return Redirect::back()
                    ->with('success', 'Cập nhật thành công.');
            } else {
                // Update Failed
                return Redirect::back()
                    ->withInput()
                    ->with('error', 'Cập nhật thất bại');
            }
        } else {
            // Validation fails
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    public function changeEmail($id){
        $data = User::find($id);
        if(Input::has('_method')){
            $email = Input::all('email');
            // Create validation rules
            $rules = array(
                'email'    => 'required|email|'.$this->unique('email', $id),
            );
            // Custom validation message
            $messages  = $this->validatorMessages;
            // Begin verification
            $validator = Validator::make($email, $rules, $messages);
            if ($validator->passes()) {
                 // Authentication is successful
                    $model = $this->model->find($id);
                    $model->email    = Input::get('email');
                    if ($model->save()) {
                        // Update successful
                        return Redirect::back()
                            ->with('success', 'Cập nhật thành công.');
                    } else {
                        // Update Failed
                        return Redirect::back()
                            ->withInput()
                            ->with('error', 'Cập nhật thất bại');
                    }
            } else {
                // Validation fails
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }
        return View::make($this->resourceView.'.change_email')->with(compact('data'));
    }

    /**
     * [changePass description]
     * @return [type] [description]
     */
    public function changePass($id){
        if(Input::has('_method')){
             // Get all the form data.
            $data = Input::all();
            // Create validation rules
            $rules = array(
                'password_old' => 'required',
                'password' => 'required|alpha_dash|between:6,20|confirmed'
            );
            // Custom validation message
            $messages  = $this->validatorMessages;
            // Begin verification
            $validator = Validator::make($data, $rules, $messages);
            $model = $this->model->find($id);
            $messages = $validator->errors();
            if(!Hash::check($data['password_old'], $model->password)){
                $messages->add('password_old', 'Mật khẩu cũ không đúng');
            }
            if ($validator->passes()) {
                // Authentication is successful
                $model->password   = Hash::make(Input::get('password'));
                if ($model->save()) {
                    // Update successful
                    return Redirect::back()
                        ->with('success', 'Cập nhật thành công.');
                } else {
                    // Update Failed
                    return Redirect::back()
                        ->withInput()
                        ->with('error', 'Cập nhật thất bại');
                }
            } else {
                // Validation fails
                return Redirect::back()->withInput()->withErrors($messages);
            }
        }
        return View::make($this->resourceView.'.change_pass');
    }

    /**
     * [loadDatatable description]
     * @return [type] [description]
     */
    public function loadDatatable(){
        // Table's primary key
        $primaryKey = 'id';

        // Join condition
        $myWhere = "is_admin = 2 AND id <> " . Auth::id();

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => '`id`', 'dt' => 2 ),
            array( 'db' => '`email`',
                   'dt' => 3,
                   'formatter' => function($d, $row){
                        return html_entity_decode($d);
                    }
                ),
            array( 'db' => '`created`',
                   'dt' => 4,
                   'formatter' => function($d, $row){
                        return date('d-m-Y H:i:s', $d);
                    }
                )
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
            \SSP::simple( $_GET, $sql_details, $this->resourceTable, $primaryKey, $columns, $myWhere)
        );
    }
}

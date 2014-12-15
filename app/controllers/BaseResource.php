<?php

class BaseResource extends BaseController
{
    /**
     * Resource View catalog
     * @var string
     */
    protected $resourceView = '';

    protected $timestamps = 'false';

    /**
     * Resource model name, after initialization into model instances
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = '';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = '';

    /**
     * Resource database table
     * @var string
     */
    protected $resourceTable = '';

    /**
     * Resource Name
     * @var string
     */
    protected $resourceName = '';

    /**
     * Custom validation message
     * @var array
     */
    protected $validatorMessages = array();

    /**
     * Initialization
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // Examples of resource models
        $this->model  = App::make($this->model);
        // View synthesizer
        $resource     = $this->resource;
        $resourceName = $this->resourceName;
        View::composer(array(
            $this->resourceView.'.index',
            $this->resourceView.'.create',
            $this->resourceView.'.edit',
        ), function ($view) use ($resource, $resourceName) {
            $view->with(compact('resource', 'resourceName'));
        });
    }

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
            # --- --- --- --- --- --- --- --- --- --- Here to add validation rules #
        );
        // Custom validation message
        $messages = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            //Authentication is successful
            $model = $this->model;
            # --- --- --- --- --- --- --- --- --- --- Attribute assignment model object here #
            if ($model->save()) {
                // Added successfully
                return Redirect::back()
                    ->with('success', 'Bạn đã thêm thành công');
            } else {
                // Add Failed
                return Redirect::back()
                    ->withInput()
                    ->with('error', 'Thất bại');
            }
        } else {
            // Validation fails
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Resource display page
     * GET         /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
        return View::make($this->resourceView.'.edit')->with('data', $data);
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
            # --- --- --- --- --- --- --- --- --- --- Here to add validation rules #
        );
        // Custom validation message
        $messages  = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // Verify success
            $model = $this->model->find($id);
            # --- --- --- --- --- --- --- --- --- --- Attribute assignment model object here #
            if ($model->save()) {
                // Update successful
                return Redirect::back()
                    ->with('success', 'Bạn đã thêm thành công');
            } else {
                // Update Failed
                return Redirect::back()
                    ->withInput()
                    ->with('error', 'Thất bại');
            }
        } else {
            // Validation fail
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Resources delete action
     * DELETE      /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->model->find($id);
        if (is_null($data))
            return Redirect::back()->with('error', 'Không tìm thấy dữ liệu');
        elseif ($data->delete())
            return Redirect::back()->with('success', 'Bạn đã xóa thành công');
        else
            return Redirect::back()->with('warning', 'Thất bại');
    }


     /**
     * Resources delete action
     * DELETE      /resource/{id}
     * @param  int, arr, str  $id
     * @return Response
     */
    public function destroyMany($id)
    {
        var_dump($id);die;
        if ($this->model->destroy($id))
            return Redirect::back()->with('success', 'Bạn đã xóa thành công');
        else
            return Redirect::back()->with('warning', 'Thất bại');
    }

    /**
     * Resource Recycle Bin
     * GET      /resource/recycled
     * @param  int  $id
     * @return Response
     */
    public function recycled()
    {
        //
    }

    /**
     * Resource reduction action
     * PATCH      /resource/{id}
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        //
    }

    /**
     * Unique structure validation rules
     * @param  string $column Field Name
     * @param  int    $id  Exclude specified ID
     * @return string
     */
    protected function unique($column = null, $id = null)
    {
        if (is_null($column))
            return 'unique:'.$this->resourceTable;
        else
            return 'unique:'.$this->resourceTable.','.$column.','.$id;
    }


}
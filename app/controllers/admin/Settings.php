<?php
class Admin_Settings extends BaseResource
{
    /**
     * Resource View catalog
     * @var string
     */
    protected $resourceView = 'admin.settings';

    /**
     * Resource model name, after initialization into model instances
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Settings';

    /**
     * Resource identification
     * @var string
     */
    protected $resource = 'settings';

    /**
     * Resource database table
     * @var string
     */
    protected $resourceTable = 'settings';

    /**
     * Resource Name
     * @var string
     */
    protected $resourceName = 'Settings';

    /**
     * Custom validation message
     * @var array
     */
    protected $validatorMessages = array(
        'name.required'   => 'Bạn không được bỏ trống trường này.',
        'address.required'   => 'Bạn không được bỏ trống trường này.',
        'meta_title.required'   => 'Bạn không được bỏ trống trường này.',
        'meta_desc.required'   => 'Bạn không được bỏ trống trường này.',
        'meta_key.required'   => 'Bạn không được bỏ trống trường này.',
        'email.required'   => 'Bạn không được bỏ trống trường này.',
        'email.email'   => 'E-mail không đúng định dạng.'
    );

    /**
     * Resource Editor page
     * GET         /resource/{id}/edit
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
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
        $rules  = array(
            'name'  => 'required',
            'email'  => 'required|email',
            'address'  => 'required',
            'meta_title'  => 'required',
            'meta_desc'  => 'required',
            'meta_key'  => 'required'
        );
        // Custom validation message
        $messages  = $this->validatorMessages;
        // Begin verification
        $validator = Validator::make($data, $rules, $messages);
        $password = Crypt::encrypt($data['password']);
        if ($validator->passes()) {
            // Verify success
            $model          = $this->model->find($id);
            $model->name   = e($data['name']);
            $model->email_send   = e($data['email']);
            if(!empty(Input::get('password'))){
                $model->password_email   = "'" . $password . "'";
            }
            $model->address = e($data['address']);
            $model->meta_title   = e($data['meta_title']);
            $model->meta_desc   = e($data['meta_desc']);
            $model->meta_key   = e($data['meta_key']);
            $model->phone   = $data['phone'];
            $model->mobile   = $data['mobile'];
            $model->per_page   = $data['per_page'];
            $model->maintenance  = (isset($data['maintenance']))?$data['maintenance']:'0';
            if ($model->save()) {
                // Update success
                return Redirect::back()
                    ->with('success', 'Cập nhật thành công');
            } else {
                // Update fail
                return Redirect::back()
                    ->withInput()
                    ->with('error', 'Cập nhật thất bại');
            }
        } else {
            // verify fail
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }
}

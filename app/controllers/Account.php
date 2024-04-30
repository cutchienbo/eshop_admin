<?php
class Account extends Controller
{

    private $model;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('AccountModel');
    }

    // public function update_image(){
    //     $cloud = new Image();
    //     $image_list = $this -> model -> getListImageee();

    //     foreach($image_list as $key => $value){

    //         $url = $cloud -> upload(
    //             './assest/images/product/'.$value['id_image'],
    //             $value['id_image'],
    //             'product'
    //         );

    //         $this -> model -> updateImageee($url, $value['id_image']);
    //     }

    //     echo '<pre>';
    //     print_r($image_list);
    //     echo '</pre>';
    // }

    public function index($type = 'staff', $params = 1)
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $max_records = 10;

        if(isset($_POST['name'])){
            $account_data = $this -> model -> getAccountByName(($params - 1) * $max_records, $max_records, $type, $_POST['name']);
            $account = $account_data['account'];
            $records = $account_data['count'];

            $_SESSION['account_search'] = $_POST['name'];
        }
        else{
            $account = $this->model->getAccountLimit(($params - 1) * $max_records, $max_records, $type);
            $records = $this->model->countAccount($type);

            $_SESSION['account_search'] = '';
        }

       

        if($type == 'customer'){
            foreach($account as $key => $value){
                $location = $this -> model -> getCustomerDefaultAddress($value['id']);

                $account[$key]['address'] = $location;
            }
        }


        $pagination = $this->model->pagination($params, $records, $max_records);

        $this->data = array(
            'title' => 'Eshop Admin - Account',
            'content' => 'account/account',
            'data' => [
                'account' => $account,
                'pagination' => $pagination,
                'type' => $type
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function add_account($params = '')
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $this->data = array(
            'title' => 'Eshop Admin - Add Customer',
            'content' => 'account/add_account',
            'data' => [
                'role' => $params
            ]
        );

        $this->render('layout/layout', $this->data);

        if(isset($_SESSION['add_errors'])){
            unset($_SESSION['add_errors']);
        }
    }

    public function handle_add_account($role = '')
    {
        $data_insert = [];
        $column = [];

        $column[] = 'image';

        if ($_FILES['image']['error'] == 4) {
            if ($role == 'admin') {
                $data_insert[] = 'admin.png';
            } else {
                $data_insert[] = 'staff.png';
            }
        } else {
            $data_insert[] = $_FILES['image']['name'];

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                '.' . IMG_PATH . $role .'/' . $_FILES['image']['full_path']
            );
        }

        foreach ($_POST as $key => $value) {
            if ($value != '') {
                $data_insert[] = $value;
                $column[] = $key;
            }
        }

        $errors = [];

        print_r($data_insert);
        
        if(isset($data_insert['4'])){
            $check_email = $this -> model -> checkEmail($role, $data_insert['4']);
            print_r($check_email);
            if($check_email){
                $errors[] = '- Email existed !';
            }
        }

        if(isset($data_insert['5'])){
            $check_phone = $this -> model -> checkPhone($role, $data_insert['5']);

            if($check_phone){
                $errors[] = '- Phone existed !';
            }
        }

        if(isset($data_insert['2'])){
            $check_account = $this -> model -> checkAccount($role, $data_insert['2']);
            
            if($check_account){
                $errors[] = '- Account existed !';
            }
        }

        if(!empty($errors)){
            $_SESSION['add_errors'] = $errors;

            header('Location:'._WEB_ROOT.'/account'.'/add_account'.'/'.$role);
        }
        else{
            $column[] = 'status';
            $data_insert[] = '1';

            $this->model->addAccount($column, $data_insert, $role);

            header("Location:" . _WEB_ROOT . '/account' . '/' . $role);
        }
    }

    public function edit_account($id = '', $type = '')
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $account = $this -> model -> getAccount($id, $type);

        $this->data = array(
            'title' => 'Eshop Admin - Edit Customer',
            'content' => 'account/edit_account',
            'data' => [
                'account' => $account,
                'type' => $type
            ]
        );

        $this->render('layout/layout', $this->data);

        if(isset($_SESSION['edit_errors'])){
            unset($_SESSION['edit_errors']);
        }
    }

    public function handle_edit_account($id = '', $type = ''){
        $data_update = [];

        foreach($_POST as $key => $value){
            if($value){
                $data_update[$key] = $value;
            }
        }

        if($_FILES['image']['error'] == 0){
            $data_update['image'] = $_FILES['image']['name'];

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                '.' . IMG_PATH . $type .'/' . $_FILES['image']['full_path']
            );
        }

        $errors = [];
        
        if(isset($data_update['email'])){
            $check_email = $this -> model -> checkEmail($type, $data_update['email']);
            print_r($check_email);
            if($check_email){
                $errors[] = '- Email existed !';
            }
        }

        if(isset($data_update['phone_number'])){
            $check_phone = $this -> model -> checkPhone($type, $data_update['phone_number']);

            if($check_phone){
                $errors[] = '- Phone existed !';
            }
        }

        if(isset($data_update['account'])){
            $check_account = $this -> model -> checkAccount($type, $data_update['account']);
            
            if($check_account){
                $errors[] = '- Account existed !';
            }
        }

        if(!empty($errors)){
            $_SESSION['edit_errors'] = $errors;

            header('Location:'._WEB_ROOT.'/account'.'/edit_account'.'/'.$id.'/'.$type);
        }
        else{
            $this -> model -> updateAccount($id, $data_update, $type);

            header('Location:'._WEB_ROOT.'/account'.'/'.$type);
        }
    }

    public function change_status($params = '', $type = '')
    {
        $this->model->updateStatus($params, $type);

        header("Location:" . _WEB_ROOT . '/account' . '/' . $type);
    }

    public function address($id_customer = '', $name = ''){
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $address = $this -> model -> getAllCustomerAddress($id_customer);

        $this->data = array(
            'title' => 'Eshop Admin - Customer Address',
            'content' => 'account/address',
            'data' => [
                'address' => $address,
                'customer_name' => $name,
                'customer_id' => $id_customer
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function delete_address($id_address = '', $id_customer = '', $name = ''){
        $this -> model -> deleteAddress($id_address, $id_customer);

        header('Location:'._WEB_ROOT.'/account/address'.'/'.$id_customer.'/'.$name);
    }

    public function set_default_address($id_address = '', $id_customer = '', $name = ''){
        $this -> model -> setDefaultAddress($id_address, $id_customer);

        header('Location:'._WEB_ROOT.'/account/address'.'/'.$id_customer.'/'.$name);
    }

    public function add_address($id_customer = '', $name = ''){
        if(isset($_POST['address'])){
            $this -> model -> addCustomerAddress($id_customer, $_POST['address']);
        }

        header('Location:'._WEB_ROOT.'/account/address/'.$id_customer.'/'.$name);
    }

    public function edit_address($id_address = '', $id_customer = '', $name = ''){
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $address = $this -> model -> getCustomerAddress($id_address, $id_customer);

        $this->data = array(
            'title' => 'Eshop Admin - Customer Address',
            'content' => 'account/edit_address',
            'data' => [
                'address' => $address,
                'customer_id' => $id_customer,
                'address_id' => $id_address,
                'name' => $name
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function handle_edit_address($id_customer = '', $id_address = '', $name = ''){
        $this -> model -> updateCustomerAddress($id_customer, $id_address, $_POST['address']);

        header('Location:'._WEB_ROOT.'/account/address/'.$id_customer.'/'.$name);
    }
}

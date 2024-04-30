<?php
class Product extends Controller
{

    private $model;

    public $data = [], $view;

    function __construct()
    {
        $this->model = $this->model('ProductModel');
        $this->view = new View();
    }

    public function index($fisrt_params = '1', $second_params = '')
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $size_list = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];

        $price = $this->model->getRangeProductPrice($second_params);

        $max_records = 8;

        $product_type = $this->model->getProductType();

        $pagination = $fisrt_params;

        if (isset($_POST['name']) && $second_params == 'search') {
            $_SESSION['product_search'] = $_POST;

            if(!isset($_POST['deleted'])){
                $_SESSION['product_search']['deleted'] = '1';
            }
            else{
                $_SESSION['product_search']['deleted'] = '0';
            }
        }

        if ($second_params == 'search') {
            if (isset($_POST['char_size'])) {
                $_SESSION['product_search']['char_size'] = $_POST['char_size'];
            } else {
                $_SESSION['product_search']['char_size'] = [];
            }

            $search_data = $this->model->searchProduct(
                $_SESSION['product_search']['name'],
                $_SESSION['product_search']['min_price'],
                $_SESSION['product_search']['max_price'],
                $_SESSION['product_search']['type'],
                $_SESSION['product_search']['char_size'],
                $_SESSION['product_search']['min_size'],
                $_SESSION['product_search']['max_size'],
                $_SESSION['product_search']['quantity'],
                $_SESSION['product_search']['star'],
                $_SESSION['product_search']['discount'],
                $_SESSION['product_search']['deleted'],
                ($pagination - 1) * $max_records,
                $max_records
            );

            $product = $search_data['product'];
            $records = $search_data['count'];
        } else if ($second_params == '') {
            $product = $this->model->getProduct(($pagination - 1) * $max_records, $max_records);
            $records = $this->model->countProduct();

            $_SESSION['product_search']['name'] = '';
            $_SESSION['product_search']['min_price'] = $price['min'];
            $_SESSION['product_search']['max_price'] = $price['max'];
            $_SESSION['product_search']['type'] = '';
            $_SESSION['product_search']['char_size'] = [];
            $_SESSION['product_search']['min_size'] = 0;
            $_SESSION['product_search']['max_size'] = 0;
            $_SESSION['product_search']['quantity'] = '';
            $_SESSION['product_search']['star'] = '';
            $_SESSION['product_search']['discount'] = '';
            $_SESSION['product_search']['deleted'] = '1';
        } else {
            $product = $this->model->getProductByType($second_params);
            $records = $this->model->countProductType($second_params);
            
            $_SESSION['product_search']['name'] = '';
            $_SESSION['product_search']['min_price'] = $price['min'];
            $_SESSION['product_search']['max_price'] = $price['max'];
            $_SESSION['product_search']['type'] = '';
            $_SESSION['product_search']['char_size'] = [];
            $_SESSION['product_search']['min_size'] = 0;
            $_SESSION['product_search']['max_size'] = 0;
            $_SESSION['product_search']['quantity'] = '';
            $_SESSION['product_search']['star'] = '';
            $_SESSION['product_search']['discount'] = '';
            $_SESSION['product_search']['deleted'] = '1';
        }

        $pagination = $this->model->pagination($pagination, $records, $max_records);

        $pagination['path'] = $second_params == '' ? '' : '/' . $second_params;

        foreach ($product as $key => $value) {
            $id_image = $this->model->getProductImage($value['id']);

            $product[$key]['id_image'] = $id_image;
        }

        foreach ($product as $key => $value) {
            $id_size = $this->model->getProductSize($value['id']);

            $product[$key]['size'] = $id_size;
        }

        $this->data = array(
            'title' => 'Eshop Admin - Product',
            'content' => 'product/product',
            'data' => [
                'product_type' => $product_type,
                'product' => $product,
                'active' => $second_params == '' ? '' : $second_params,
                'pagination' => $pagination,
                'size_list' => $size_list
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function add_product_type($params = [])
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $this->data = array(
            'title' => 'Eshop Admin - Add Product Type',
            'content' => 'product/add_product_type',
        );

        $this->render('layout/layout', $this->data);
    }

    public function handle_add_product_type($params = '')
    {
        if (isset($_POST['type_name']) && !$_FILES['type_image']['error']) {
            move_uploaded_file(
                $_FILES['type_image']['tmp_name'],
                realpath('./') . IMG_PATH . 'product_type/' . $_FILES['type_image']['name']
            );

            $id = substr($_POST['type_name'], 0, 3);

            $this->model->addProductType($id, $_POST['type_name'], $_FILES['type_image']['full_path']);

            header('Location:' . _WEB_ROOT . '/product');
        } else {
            header('Location:' . _WEB_ROOT . '/product');
        }
    }

    public function edit_product_type($id_type = '')
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $product_type = $this->model->getProductTypeById($id_type);

        $this->data = array(
            'title' => 'Eshop Admin - Edit Product Type',
            'content' => 'product/edit_product_type',
            'data' => [
                'product_type' => $product_type
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function handle_edit_product_type($id_type = '')
    {
        $edit_data = [];

        $product_type = $this->model->getProductTypeById($id_type);

        $edit_data['name_type'] = $product_type['name_type'];
        $edit_data['image'] = $product_type['image'];

        if (isset($_POST['new_name'])) {
            $edit_data['name_type'] = $_POST['new_name'];
        }

        if (!$_FILES['new_image']['error']) {
            $edit_data['image'] = $_FILES['new_image']['name'];

            move_uploaded_file(
                $_FILES['new_image']['tmp_name'],
                realpath('./') . IMG_PATH . 'product_type/' . $_FILES['new_image']['name']
            );

            unlink(realpath('./') . IMG_PATH . 'product_type/' . $product_type['image']);
        }

        $this->model->updateProductType($edit_data, $id_type);

        header('Location:' . _WEB_ROOT . '/product');
    }

    public function handle_delete_product_type($id_type = '', $image = '')
    {
        $count = $this->model->countProductType($id_type);

        if ($count == 0) {
            $this->model->deleteProductType($id_type);
        }

        header('Location:' . _WEB_ROOT . '/product');
    }

    public function add_product($params = '')
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $product_type = $this->model->getProductType();

        $this->data = array(
            'title' => 'Eshop Admin - Add Product',
            'content' => 'product/add_product',
            'data' => [
                'product_type' => $product_type,
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function handle_add_product()
    {
        $cloudinary = new Image();

        $size = [];
        $color = [];
        $image['id'] = $_FILES['image']['full_path'];
        $image['url'] = [];

        $name = $_POST['name'];
        $type = $_POST['type'];
        $quantity = $_POST['quantity'];
        $cost = $_POST['cost'];
        $content = $_POST['content'];
        $new_item = $_POST['new_item'];
        $trending_item = $_POST['trending_item'];
        $discount = '';

        $data_insert = [
            $name,
            $type,
            $quantity,
            $cost,
            $content,
            '0',
            '0',
            '1'
        ];

        if (isset($_POST['size'])) {
            $size = explode('-', $_POST['size']);
        }

        if (isset($_POST['color'])) {
            foreach ($_POST['color'] as $key => $value) {
                if (!$value) {
                    break;
                }
                $color[] = $value;
            }
        }

        foreach ($_FILES['image']['tmp_name'] as $key => $value) {
            if ($value) {
                $res = $cloudinary -> upload($value, $_FILES['image']['name'][$key], 'product');

                $image['url'][] = $res;
            }
        }

        if (isset($_POST['discount'])) {
            $discount = $_POST['discount'];
        }

        $this->model->addProduct($data_insert, $size, $color, $image, $new_item, $trending_item, $discount);

        header('Location:' . _WEB_ROOT . '/product');
    }

    public function best_seller(){
        $product = $this -> model -> getBestSeller($_POST['year'], $_POST['precious'], $_POST['month']);

        echo json_encode($product);
    }

    public function edit_product($params = '1')
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $product = $this->model->getProductById($params);

        $product['image'] = $this->model->getProductImage($params);

        $product['size'] = $this->model->getProductSize($params);

        $product_type = $this->model->getProductType();

        $this->data = array(
            'title' => 'Eshop Admin - Edit Product',
            'content' => 'product/edit_product',
            'data' => [
                'product' => $product,
                'product_type' => $product_type
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function handle_edit_product($id = '')
    {
        $cloudinary = new Image();

        $data_update = [];

        if ($_POST['name']) {
            $data_update['name'] = $_POST['name'];
        }

        if ($_POST['type']) {
            $data_update['id_type'] = $_POST['type'];
        }

        if ($_POST['quantity']) {
            $data_update['quantity'] = $_POST['quantity'];
        }

        if ($_POST['cost']) {
            $data_update['cost'] = $_POST['cost'];
        }

        if ($_POST['content']) {
            $data_update['content'] = $_POST['content'];
        }

        if ($_POST['discount']) {
            $this->model->updateDiscount($id, $_POST['discount']);
        }

        $new_size =  explode('-', $_POST['size']);

        if (!empty($new_size[0])) {
            $old_size = $this->model->getProductSize($id);

            foreach ($old_size as $key => $value) {
                $old_size[$key] = $value['id_size'];
            }

            $size_add = array_diff($new_size, $old_size);
            $size_del = array_diff($old_size, $new_size);

            $this->model->addSize($id, $size_add);
            $this->model->deleteSize($id, $size_del);
        }

        if (!empty($data_update)) {
            $this->model->updateProduct($id, $data_update);
        }

        if (isset($_SESSION['delete_image'])) {

            foreach ($_SESSION['delete_image'] as $key => $value) {
                $this->model->deleteImage($value['id_product'], $value['id_image'], $value['color']);

                $cloudinary->delete('uploads/product/'.$value['id_image']);
            }

            unset($_SESSION['delete_image']);
        }

        foreach ($_FILES['image']['error'] as $key => $value) {
            if ($value == 0) {
               
                $res = $cloudinary -> upload(
                    $_FILES['image']['tmp_name'][$key], 
                    $_FILES['image']['name'][$key], 
                    'product'
                );

                $this->model->addImage($_FILES['image']['name'][$key], $res, $_POST['color'][$key], $id);
            }
        }
    
        header('Location:' . _WEB_ROOT . '/product');
    }

    public function delete_product()
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        foreach ($_POST['check'] as $key => $value) {
            $this->model->deleteProduct($value);
        }

        header('Location:' . _WEB_ROOT . '/product');
    }

    public function delete_product_image($id_product = '')
    {
        $_SESSION['delete_image'] = [];
        $_SESSION['delete_image'][] = [
            'id_product' => $id_product,
            'id_image' => $_POST['id_image'],
            'color' => $_POST['color']
        ];
    }
}

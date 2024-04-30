<?php
class Store extends Controller
{

    private $model;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('StoreModel');
    }

    public function index($status = '1', $page = 1)
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $max_record = 5;

        if (isset($_POST['store_submit'])) {
            $orders_data = $this -> model -> getOrdersByDate(
                ($page - 1) * $max_record, 
                $max_record, 
                $status, 
                $_POST['year'], 
                $_POST['month'], 
                $_POST['day']
            );

            $orders = $orders_data['orders'];
            $records = $orders_data['count'];

            $_SESSION['orders_search'] = $_POST;
        } 
        else {
            $orders = $this->model->getOrders(($page - 1) * $max_record, $max_record, $status);
            $records = $this->model->countOrders($status);

            $_SESSION['orders_search']['year'] = '';
            $_SESSION['orders_search']['month'] = '';
            $_SESSION['orders_search']['day'] = '';
        }


        $pagination = $this->model->pagination($page, $records, $max_record);

        $this->data = array(
            'title' => 'Eshop Admin - Store',
            'content' => 'store/store',
            'data' => [
                'orders' => $orders,
                'status' => $status,
                'pagination' => $pagination
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function change_status($id_cart = '', $id_customer = '', $status = '', $page = 1)
    {
        $this->model->updateStatus($id_cart, $id_customer, $status);

        if ($status + 1 == 4) {
            $this->model->updateProductQuantity($id_cart, $id_customer);
        }

        header('Location:' . _WEB_ROOT . '/store' . '/' . $status . '/' . $page);
    }

    public function detail_order($id_cart = '', $id_customer = '', $page = 1)
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $max_record = 5;

        $product = $this->model->getProductInDetailOrder($id_cart, $id_customer);
        $records = $this->model->countProductInDetailOrder($id_cart, $id_customer);

        $pagination = $this->model->pagination($page, $records, $max_record);

        foreach ($product as $key => $value) {
            $id_image = $this->model->getProductImage($value['id']);

            $product[$key]['id_image'] = $id_image;
        }

        $this->data = array(
            'title' => 'Eshop Admin - Detail Oder',
            'content' => 'store/detail_order',
            'data' => [
                'product' => $product,
                'pagination' => $pagination
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function cancel_order($id_cart = '', $id_customer = '', $status = '', $page = ''){
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $this -> model -> cancelOrder($id_cart, $id_customer);

        header('Location:' . _WEB_ROOT . '/store' . '/' . $status . '/' . $page);
    }

    public function edit_order($id_cart = '', $id_customer = '', $status = '', $page = 1)
    {
        if (!isset($_SESSION['account'])) {
            header('Location:' . _WEB_ROOT . '/login');
        }

        $location = $this->model->getOrderLocation($id_cart, $id_customer);

        $this->data = array(
            'title' => 'Eshop Admin -Edit Oder Location',
            'content' => 'store/edit_oder',
            'data' => [
                'location' => $location,
                'id_cart' => $id_cart,
                'id_customer' => $id_customer,
                'status' => $status,
                'page' => $page
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function handle_edit_order($id_cart = '', $id_customer = '', $status = '', $page = '')
    {
        if ($_POST['location'] != '') {
            $this->model->updateLocation($_POST['location'], $id_cart, $id_customer);
        }

        header('Location:' . _WEB_ROOT . '/store' . '/' . $status . '/' . $page);
    }
}

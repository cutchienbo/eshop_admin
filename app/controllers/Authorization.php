<?php
class Authorization extends Controller
{
    private $model;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('AuthorizationModel');
    }

    public function index(){
        $this->data = array(
            'title' => 'Eshop Admin - Account',
            'content' => 'authorization/authorization',
            'data' => [
                // 'account' => $account,
                // 'pagination' => $pagination,
                // 'type' => $type
            ]
        );

        $this->render('layout/layout', $this->data);
    }
}
?>

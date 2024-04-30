<?php
class Login extends Controller
{

    private $model;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('LoginModel');
    }

    public function index($params = [])
    {
        $this->data = array(
            'have_layout' => false,
            'title' => 'Eshop Admin - Login',
            'content' => 'login/login',
        );

        $this->render('layout/layout', $this->data);

        if (isset($_SESSION['login_error'])) {
            unset($_SESSION['login_error']);
        }
    }

    public function handle_login()
    {
        $account = $_POST['account'];
        $password = $_POST['password'];

        $check_super_admin = $this->model->checkSuperAdmin($account, $password);
        $check_admin = $this->model->checkAdmin($account, $password);
        $check_staff = $this->model->checkStaff($account, $password);

        if ($check_super_admin) {
            $_SESSION['account']['role'] = $check_super_admin[0]['role'];
            header('Location:' . _WEB_ROOT . '/product');
        }
        else if ($check_admin) {
            $_SESSION['account']['role'] = 'admin';
            $_SESSION['account']['name'] = $check_admin[0]['name'];
            $_SESSION['account']['image'] = $check_admin[0]['image'];
            header('Location:' . _WEB_ROOT . '/product');
        }
        else if ($check_staff) {
            $_SESSION['account']['role'] = 'staff';
            $_SESSION['account']['name'] = $check_staff[0]['name'];
            $_SESSION['account']['image'] = $check_staff[0]['image'];
            header('Location:' . _WEB_ROOT . '/product');
        }
        else{
            $_SESSION['login_error'] = '- Account or password was wrong !';
            header('Location:' . _WEB_ROOT . '/login');
        }
    }

    public function log_out(){
        unset($_SESSION['account']);
        header('Location:'._WEB_ROOT.'/login');
    }
}

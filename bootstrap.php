
<?php
define('_DIR_ROOT_', __DIR__);

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

$web_root = $web_root . '/Eshop_Admin_mvc';

define('_WEB_ROOT', $web_root);

require_once('./lib/vendor/autoload.php');
require_once('./configs.php');
require_once('./configs/routes.php');
require_once('./configs/database.php');
require_once('./app/App.php');
require_once('./core/Connection.php');
require_once('./core/Image.php');
require_once('./core/QueryBuilder.php');
require_once('./core/Database.php');
require_once('./core/View.php');
require_once('./core/Route.php');
require_once('./core/Model.php');
require_once('./core/Mail.php');
require_once('./core/Controller.php');

?>
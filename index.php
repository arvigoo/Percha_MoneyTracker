<?php
$view = isset($_GET['view']) ? $_GET['view'] : 'views/auth/login';

switch ($view) {
    case 'auth/register':
        require_once 'controllers/AuthController.php';
        $authController = new AuthController();
        $authController->register();
        break;
    case 'auth/login':
        require_once 'controllers/AuthController.php';
        $authController = new AuthController();
        $authController->login();
        break;
    case 'auth/logout':
        require_once 'controllers/AuthController.php';
        $authController = new AuthController();
        $authController->logout();
        break;
    case 'transaction/index':
        require_once 'controllers/TransactionController.php';
        $transactionController = new TransactionController();
        $transactionController->index();
        break;
    case 'transaction/create':
        require_once 'controllers/TransactionController.php';
        $transactionController = new TransactionController();
        $transactionController->create();
        break;
    case 'category/index':
        require_once 'controllers/CategoryController.php';
        $categoryController = new CategoryController();
        $categoryController->index();
        break;
    case 'category/create':
        require_once 'controllers/CategoryController.php';
        $categoryController = new CategoryController();
        $categoryController->create();
        break;
    default:
        require_once 'views/auth/login.php';
        break;
}
?>

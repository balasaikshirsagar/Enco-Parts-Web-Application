<?php
require_once 'config/dbconfig.php';
require_once 'models/UserModel.php';
require_once 'models/ProductModel.php';
require_once 'models/CategoryModel.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CategoryController.php';


$db = new Database();
$pdo = $db->getPdo();


$userModel = new UserModel($pdo);
$productModel = new ProductModel($pdo);
$categoryModel = new CategoryModel($pdo);



$userController = new UserController($userModel);
$productController = new ProductController($pdo);
$categoryController = new CategoryController($pdo);


$action = $_GET['action'] ?? '';

switch ($action) {
    case 'register':
        $userController->register();
        break;
    case 'login':
        $userController->login();
        break;
    case 'addproduct':
        $productController->addProduct();
        break;

    case 'addcategory':
        $categoryController->addCategory();    
    default:
      
        header('Location: views/register.php');
        exit();
}
?>

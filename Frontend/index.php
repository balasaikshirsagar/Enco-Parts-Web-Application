<?php
require_once 'config/dbconfig.php';
require_once 'models/Customer.php';
require_once 'models/ProductModel.php';
require_once 'models/CartModel.php';
require_once 'controllers/CustomerController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CartController.php';
require_once 'models/OrderModel.php';
require_once 'controllers/OrderController.php'; // Add this line for OrderController

$db = new Database();
$pdo = $db->getPdo();

$customerController = new CustomerController($pdo);
$productController = new ProductController($pdo);
$cartController = new CartController($pdo);
$orderController = new OrderController($pdo); // Instantiate OrderController



$action = $_GET['action'] ?? '';

switch ($action) {
    case 'register':
        $customerController->register();
        break;

    case 'login':
        $customerController->login();
        break;

    case 'addToCart':
        $cartController->addToCart();
        break;

    case 'getCartItemCount':
        $cartController->getCartItemCount();
        break;

    case 'getCartItems':
        $cartController->getCartItems();
        break;

    case 'createOrder': 
        $orderController->createOrder();
        break;

    default:
        header('Location: views/indexNew.php');
        exit();
}
?>

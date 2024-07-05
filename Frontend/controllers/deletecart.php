<?php

require_once '../config/dbconfig.php';
require_once '../models/CartModel.php';


$database = new Database();
$db = $database->getPdo();
$cartModel = new CartModel($db);


if (isset($_POST['product_id'])) {
    
    $product_id = $_POST['product_id'];

    
    $deleted = $cartModel->deleteCartItem($product_id);

    if ($deleted) {
        
        echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);
    } else {
       
        echo json_encode(['success' => false, 'message' => 'Failed to delete product']);
    }
} else {
   
    echo json_encode(['success' => false, 'message' => 'Product ID not provided']);
}
?>

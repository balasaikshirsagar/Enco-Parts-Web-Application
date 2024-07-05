<?php

require_once '../config/dbconfig.php';
require_once '../models/ProductModel.php';


$database = new Database();
$db = $database->getPdo();
$productModel = new ProductModel($db);


if (isset($_POST['productId'])) {
    
    $productId = $_POST['productId'];

    
    $deleted = $productModel->deleteProduct($productId);

    if ($deleted) {
        
        echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);
    } else {
       
        echo json_encode(['success' => false, 'message' => 'Failed to delete product']);
    }
} else {
   
    echo json_encode(['success' => false, 'message' => 'Product ID not provided']);
}
?>

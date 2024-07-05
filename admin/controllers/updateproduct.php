<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    exit();
}

require_once '../config/dbconfig.php';
require_once '../models/ProductModel.php';

$database = new Database();
$db = $database->getPdo();
$productModel = new ProductModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? null;
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $cat_id = $_POST['cat_id'] ?? '';
    $active = $_POST['active'] ?? '';
    $color = $_POST['color'] ?? '';
    $size = $_POST['size'] ?? '';
    $price = $_POST['price'] ?? '';

    
    $image = $_FILES['image'] ?? null;
    $imagePath = ''; 

    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        
        $targetDirectory = '../assets/images/';

        
        $imageFileName = uniqid() . '_' . $image['name'];
        $targetPath = $targetDirectory . $imageFileName;

        
        if (move_uploaded_file($image['tmp_name'], $targetPath)) {
            $imagePath = $targetPath;  
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to move uploaded image.']);
            exit();
        }
    }

    if ($product_id) {
        
        $result = $productModel->updateProduct($product_id, $name, $description, $cat_id, $active, $imagePath, $color, $size, $price);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Product updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update product.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID.']);
    }
}
?>

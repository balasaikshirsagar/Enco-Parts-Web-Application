<?php

include_once('../models/ProductModel.php');

class ProductController {
    public $ProductModel;

    public function __construct($db) {
        $this->ProductModel = new ProductModel($db);
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $response = ['success' => false];

            
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
               
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                
                $newFileName = md5($fileName) . '.' . $fileExtension;

                
                $uploadFileDir = './assets/images/';
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                }

                $dest_path = $uploadFileDir . $newFileName;

               
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $imagePath = '../assets/images/' . $newFileName;
                } else {
                    $response['message'] = 'There was an error moving the uploaded file.';
                    echo json_encode($response);
                    return;
                }
            } else {
                $response['message'] = 'No file uploaded or there was an upload error.';
                echo json_encode($response);
                return;
            }

            $data = [
                'name' => htmlspecialchars(strip_tags($_POST['name'])),
                'description' => htmlspecialchars(strip_tags($_POST['description'])),
                'cat_id' => htmlspecialchars(strip_tags($_POST['cat_id'])),
                'active' => isset($_POST['active']) ? 1 : 0,
                'image' => htmlspecialchars(strip_tags($imagePath)),
                'color' => htmlspecialchars(strip_tags($_POST['color'])),
                'size' => htmlspecialchars(strip_tags($_POST['size'])),
                'price' => htmlspecialchars(strip_tags($_POST['price']))
            ];

            try {
                if ($this->ProductModel->addProduct($data)) {
                    $response['success'] = true;
                    $response['message'] = "Product added successfully!";
                    echo "<script>alert(Product Added Successfully);</script>";
                    header("Location: ./views/dashboard.php");
                    exit;
                }
            } catch (Exception $e) {
                $response['error'] = $e->getMessage();
            }

            echo json_encode($response);
        } else {
            http_response_code(405); 
            echo json_encode(array("success" => false, "message" => "Only POST requests are allowed"));
        }
    }

    public function fetchProducts() {
        if ($_SERVER["REQUEST_METHOD"] != "GET") {
            http_response_code(400); 
            echo json_encode(array("success" => false, "message" => "Invalid request method"));
            exit();                                                             
        }
    
        try {
            $products = $this->ProductModel->getProducts();
            $response = array("success" => true, "message" => "Products fetched successfully", "data" => $products);
            echo json_encode($response);
        } catch (PDOException $e) {
            http_response_code(500); 
            $errorResponse = array("success" => false, "message" => "Database error: " . $e->getMessage());
            echo json_encode($errorResponse);
        }
    }

    public function deleteProduct() {
        $data = json_decode(file_get_contents("php://input"), true);
        $result = $this->ProductModel->deleteProduct($data['product_id']);
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }
}

?>

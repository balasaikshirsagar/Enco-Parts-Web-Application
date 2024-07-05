<?php
// include_once('../config/dbconfig.php');
// include_once('../models/ProductModel.php');
// require_once '../models/ProductModel.php';


class ProductController {
    private $ProductModel;
    

    public function __construct($db) {
        $this->ProductModel = new ProductModel($db);
        
    }

    public function fetchProducts() {
        if ($_SERVER["REQUEST_METHOD"] !== "GET") {
            http_response_code(400);
            echo json_encode(array("success" => false, "message" => "Invalid request method"));
            exit();
        }

        // Sanitize and validate inputs
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
        $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 4;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $categories = isset($_GET['categories']) ? json_decode($_GET['categories'], true) : [];

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(array("success" => false, "message" => "Invalid categories parameter"));
            exit();
        }

        try {
            // Fetch products and total count
            $products = $this->ProductModel->getProducts($sort, $offset, $limit, $search, $categories);
            $total = $this->ProductModel->getTotalProducts($search, $categories);

            // Prepare response
            $response = array(
                "success" => true,
                "message" => "Products fetched successfully",
                "data" => $products,
                "total" => $total
            );

            echo json_encode($response);
        } catch (Exception $e) {
            // Handle exceptions
            http_response_code(500);
            $errorResponse = array(
                "success" => false,
                "message" => "Server error: " . $e->getMessage()
            );
            echo json_encode($errorResponse);
        }
    }

   
}

<?php


include_once('../models/CategoryModel.php'); 


class CategoryController {
    private $CategoryModel;

    public function __construct($db) {
        $this->CategoryModel = new CategoryModel($db);
    }

    public function fetchCategories() {
        if ($_SERVER["REQUEST_METHOD"] !== "GET") {
            http_response_code(400);
            return array("success" => false, "message" => "Invalid request method");
        }

        try {
            $categories = $this->CategoryModel->getAllCategories();

            // Prepare response
            return array(
                "success" => true,
                "message" => "Categories fetched successfully",
                "data" => $categories
            );
        } catch (Exception $e) {
            // Handle exceptions
            return array(
                "success" => false,
                "message" => "Server error: " . $e->getMessage()
            );
        }
    }

    
}
?>

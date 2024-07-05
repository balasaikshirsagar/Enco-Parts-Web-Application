<?php

include_once('../models/CategoryModel.php');

class CategoryController {
    public $CategoryModel;

    public function __construct($db) {
        $this->CategoryModel = new CategoryModel($db);
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $response = ['success' => false];

            $data = [
                'categname' => htmlspecialchars(strip_tags($_POST['categname'])),
                'categdesc' => htmlspecialchars(strip_tags($_POST['categdesc']))
            ];

            try {
                if ($this->CategoryModel->addCategory($data)) {
                    $response['success'] = true;
                    $response['message'] = "Category added successfully!";
                    echo "<script>alert(Category Added Successfully)</script>";
                    header("Location: ./views/addcategory.php");
                    exit;
                    // $response['redirect'] = './views/addcategory.php';

                } else {
                    $response['message'] = "Failed to add category.";
                }
            } catch (Exception $e) {
                $response['message'] = $e->getMessage();
            }

            echo json_encode($response);
        } else {
            http_response_code(405); 
            echo json_encode(["success" => false, "message" => "Only POST requests are allowed"]);
        }
    }
}
?>

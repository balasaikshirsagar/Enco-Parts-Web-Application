<?php


class CartController {
    private $CartModel;

    public function __construct($db) {
        $this->CartModel = new CartModel($db);
    }

    public function addToCart() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(400);
            echo json_encode(array("success" => false, "message" => "Invalid request method"));
            exit();
        }

        $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        $categname = isset($_POST['categname']) ? $_POST['categname'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $image = isset($_POST['image']) ? $_POST['image'] : '';

        if (empty($product_id) || empty($name) || empty($price) || empty($categname) || empty($description) || empty($image)) {
            http_response_code(400);
            echo json_encode(array("success" => false, "message" => "Missing required parameters"));
            exit();
        }

        try {
            $this->CartModel->addToCart($product_id, $name, $price, $quantity, $categname, $description, $image);
            echo json_encode(array("success" => true, "message" => "Product added to cart successfully"));
            header("Location: ../Frontend/views/indexNew.php");
            exit();
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array("success" => false, "message" => "Server error: " . $e->getMessage()));
        }
    }

    public function getCartItems() {
        try {
            $items = $this->CartModel->getCartItems();
            echo json_encode(array("success" => true, "data" => $items));
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array("success" => false, "message" => "Server error: " . $e->getMessage()));
        }
    }

    public function getCartItemCount() {
        try {
            $count = $this->CartModel->getCartItemCount();
            echo json_encode(array("success" => true, "count" => $count));
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array("success" => false, "message" => "Server error: " . $e->getMessage()));
        }
    }

    
}

<?php

class OrderController {
    private $orderModel;

    public function __construct($db) {
        $cartModel = new CartModel($db); // Initialize CartModel
        $this->orderModel = new OrderModel($db, $cartModel); // Pass CartModel to OrderModel
    }

    public function createOrder() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Extract order details from POST data
            $user_id = $_POST['user_id'];
            $total_amount = $_POST['total_amount'];
            $cust_email = $_POST['cust_email'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $company = $_POST['company'];
            $phone = $_POST['phone'];
            $products = json_decode($_POST['products'], true); // Decode JSON products data

            // Check if all necessary fields are present
            if (!$user_id || !$total_amount || !$cust_email || !$firstname || !$lastname || !$company || !$phone || empty($products)) {
                echo "Incomplete order data.";
                return;
            }

            // Call insertOrder method in OrderModel
            if ($this->orderModel->insertOrder($user_id, $total_amount, $cust_email, $firstname, $lastname, $company, $phone, $products)) {
                echo "Order created successfully.";
                // Redirect to success page after order creation
                header('Location: http://localhost/adminphp/Frontend/views/success.php');
                exit();
            } else {
                echo "Failed to create order.";
            }
        }
    }
}

?>

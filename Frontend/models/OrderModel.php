<?php

class OrderModel {
    private $db;
    private $cartModel;

    public function __construct($db, $cartModel) {
        $this->db = $db;
        $this->cartModel = $cartModel;
    }

    public function insertOrder($user_id, $total_amount, $cust_email, $firstname, $lastname, $company, $phone, $products) {
        try {
            // Insert order details into orders table
            $stmtOrder = $this->db->prepare("INSERT INTO orders (user_id, total_amount, cust_email, firstname, lastname, company, phone, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmtOrder->execute([$user_id, $total_amount, $cust_email, $firstname, $lastname, $company, $phone]);

            // Retrieve the newly inserted order_id
            $order_id = $this->db->lastInsertId();

            // Insert order items into order_items table
            foreach ($products as $product) {
                $product_id = $product['product_id'];
                $quantity = $product['quantity'];
                $price = $product['price'];
                $description = $product['description'];

                $stmtItem = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, description, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
                $stmtItem->execute([$order_id, $product_id, $quantity, $price, $description]);
            }

            // Clear the cart after placing the order
            $this->cartModel->clearCart();

            // Insert order data into Zoho CRM
            return $this->insertIntoZohoCRM($order_id, $user_id, $total_amount, $cust_email, $firstname, $lastname, $company, $phone, $products);
        } catch (PDOException $e) {
            echo 'Database Error: ' . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    private function insertIntoZohoCRM($order_id, $user_id, $total_amount, $cust_email, $firstname, $lastname, $company, $phone, $products) {
        try {
            
            $orderData = [
                "data" => [
                    [
                        "Order_ID" => $order_id,
                        "User_ID" => $user_id,
                        "Total_Amount" => $total_amount,
                        "Email" => $cust_email,
                        "First_Name" => $firstname,
                        "Last_Name" => $lastname,
                        "Company" => $company,
                        "Phone" => $phone,
                        "Line_Items" => []
                    ]
                ]
            ];
    
            // Add line items to order data
            foreach ($products as $product) {
                $orderData['data'][0]['Line_Items'][] = [
                    "Product_ID" => $product['product_id'],
                    "Quantity" => $product['quantity'],
                    "Price" => $product['price'],
                    "Description" => $product['description']
                ];
            }
    
            // Convert orderData to JSON
            $orderJson = json_encode($orderData);
    
            // Zoho CRM API endpoint and access token
            $apiUrl = "https://www.zohoapis.com/crm/v2/Leads";
            $accessToken = "1000.93a9d5bfa26ed448698a7da0c76d3e3f.fb959b1cb5125d20d75789186ce201a0"; // Replace with your actual access token
    
            // Initialize CURL session
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Zoho-oauthtoken ' . $accessToken,
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $orderJson);
    
            // Execute CURL session
            $response = curl_exec($ch);
            if ($response === false) {
                throw new Exception('Error in making request to Zoho CRM: ' . curl_error($ch));
            }
    
            // Decode response
            $responseData = json_decode($response, true);
    
            // Check response status
            if (isset($responseData['data'][0]['status']) && $responseData['data'][0]['status'] === 'success') {
                // Successfully inserted into Zoho CRM
                curl_close($ch);
                return true;
            } else {
                // Error in Zoho CRM API response
                throw new Exception('Error in Zoho CRM API response: ' . json_encode($responseData));
            }
        } catch (Exception $e) {
            echo 'Zoho CRM Error: ' . $e->getMessage();
            return false;
        }
    }






























    // private function insertIntoZohoCRM($order_id, $user_id, $total_amount, $cust_email, $firstname, $lastname, $company, $phone, $products) {
    //     try {
    //         // Prepare order data for Zoho CRM
    //         $orderData = [
    //             "data" => [
    //                 [
    //                     "Subject" => "New Sales Order",  // Replace with your subject
    //                     "Ordered_Items" => [],  // Initialize empty array for product details
    //                     "Order_Number" => $order_id,
    //                     "Customer_No" => $user_id,
    //                     "Total" => $total_amount,
    //                     "Customer_Email" => $cust_email,
    //                     "First_Name" => $firstname,
    //                     "Last_Name" => $lastname,
    //                     "Company" => $company,
    //                 ]
    //             ]
    //         ];

    //         // Add line items to order data
    //         foreach ($products as $product) {
    //             $orderData['data'][0]['Ordered_Items'][] = [
    //                 "Product_Name" => $product['name'],
    //                 "Quantity" => $product['quantity'],
    //                 "Amount" => $product['price'],
    //                 "Description" => $product['description']
    //             ];
    //         }

    //         // Convert orderData to JSON
    //         $orderJson = json_encode($orderData);

    //         // Zoho CRM API endpoint and access token
    //         $apiUrl = "https://www.zohoapis.com/crm/v2/Sales_Orders";
    //         $accessToken = "1000.d9018b109b5dd2183ecf5ed5fbbd9c46.e7a2b9b5f552a726e9f7622843f13646"; // Replace with your actual access token

    //         // Initialize CURL session
    //         $ch = curl_init($apiUrl);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //             'Authorization: Zoho-oauthtoken ' . $accessToken,
    //             'Content-Type: application/json'
    //         ]);
    //         curl_setopt($ch, CURLOPT_POST, true);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $orderJson);

    //         // Execute CURL session
    //         $response = curl_exec($ch);
    //         if ($response === false) {
    //             throw new Exception('Error in making request to Zoho CRM: ' . curl_error($ch));
    //         }

    //         // Decode response
    //         $responseData = json_decode($response, true);

    //         // Check response status
    //         if (isset($responseData['data'][0]['status']) && $responseData['data'][0]['status'] === 'success') {
    //             // Successfully inserted into Zoho CRM
    //             curl_close($ch);
    //             return true;
    //         } else {
    //             // Error in Zoho CRM API response
    //             throw new Exception('Error in Zoho CRM API response: ' . json_encode($responseData));
    //         }
    //     } catch (Exception $e) {
    //         echo 'Zoho CRM Error: ' . $e->getMessage();
    //         return false;
    //     }
    // }
}

?>

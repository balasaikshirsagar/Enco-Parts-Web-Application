<?php


class CartModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addToCart($product_id, $name, $price, $quantity, $categname, $description, $image) {
        try {
            // Check if the product already exists in the cart
            $stmt = $this->db->prepare("SELECT quantity, price FROM cart WHERE product_id = :product_id");
            $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingProduct) {
                
                $newQuantity = $existingProduct['quantity'] + $quantity;
                $newPrice = ($existingProduct['price'] / $existingProduct['quantity']) * $newQuantity; // Recalculate price based on the new quantity

                $updateStmt = $this->db->prepare("UPDATE cart SET quantity = :quantity, price = :price WHERE product_id = :product_id");
                $updateStmt->bindValue(':quantity', $newQuantity, PDO::PARAM_INT);
                $updateStmt->bindValue(':price', $newPrice, PDO::PARAM_STR);
                $updateStmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
                $updateStmt->execute();
            } else {
              
                $stmt = $this->db->prepare("INSERT INTO cart (product_id, name, price, quantity, categname, description, image) VALUES (:product_id, :name, :price, :quantity, :categname, :description, :image)");
                $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->bindValue(':price', $price, PDO::PARAM_STR);
                $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindValue(':categname', $categname, PDO::PARAM_STR);
                $stmt->bindValue(':description', $description, PDO::PARAM_STR);
                $stmt->bindValue(':image', $image, PDO::PARAM_STR);
                $stmt->execute();
            }
            return true;
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }
    public function getCartItems() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM cart");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }

    public function getCartItemCount() {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM cart");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['count'];
                
            } else {
                throw new Exception("Failed to fetch cart item count");
            }
        } catch (Exception $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    public function deleteCartItem($product_id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM cart WHERE product_id = ?");
            $stmt->execute([$product_id]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function clearCart() {
        try {
            $stmt = $this->db->prepare("DELETE FROM cart");
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }
    
}

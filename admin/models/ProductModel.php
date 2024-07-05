<?php

class ProductModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addProduct($data) {
        try {
            $stmt = $this->db->prepare("INSERT INTO products (name, description, cat_id, active, image, color, size, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $data['name'], 
                $data['description'], 
                $data['cat_id'], 
                $data['active'], 
                $data['image'], 
                $data['color'], 
                $data['size'], 
                $data['price']
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getProducts() {
        try {
            $stmt = $this->db->query("SELECT * FROM products");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteProduct($productId) {
        try {
            $stmt = $this->db->prepare("DELETE FROM products WHERE product_id = ?");
            return $stmt->execute([$productId]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateProduct($product_id, $name, $description, $cat_id,  $active, $image, $color, $size, $price) {
        $sql = "UPDATE products SET name = ?, description = ?, cat_id = ?, active = ?, image = ?, color = ?, size = ?, price = ? WHERE product_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $description, $cat_id,  $active, $image, $color, $size, $price, $product_id]);
    }
}
?>

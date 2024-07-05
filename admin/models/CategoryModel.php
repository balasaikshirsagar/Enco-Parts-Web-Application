<?php

class CategoryModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addCategory($data) {
        try {
            $stmt = $this->db->prepare("INSERT INTO categories (categname, categdesc) VALUES (?, ?)");
            return $stmt->execute([
                $data['categname'], 
                $data['categdesc']
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }


    public function getAllCategories() {
        try {
            $stmt = $this->db->prepare("SELECT categ_id, categname FROM categories");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>

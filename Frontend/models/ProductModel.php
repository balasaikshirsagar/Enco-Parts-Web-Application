<?php
class ProductModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getProducts($sort, $offset, $limit, $search, $categories) {
        try {
            $orderBy = '';
            switch ($sort) {
                case 'sort-a-z':
                    $orderBy = 'name ASC';
                    break;
                case 'sort-z-a':
                    $orderBy = 'name DESC';
                    break;
                default:
                    $orderBy = 'product_id ASC';
            }

            $conditions = [];
            $params = [];

            if (!empty($search)) {
                $conditions[] = "products.name LIKE :search";
                $params[':search'] = '%' . $search . '%';
            }

            if (!empty($categories)) {
                $categoryPlaceholders = implode(', ', array_map(function($cat) { return ':cat_' . $cat; }, $categories));
                $conditions[] = "products.cat_id IN ($categoryPlaceholders)";
                foreach ($categories as $index => $category) {
                    $params[':cat_' . $category] = $category;
                }
            }

            $whereClause = '';
            if (count($conditions) > 0) {
                $whereClause = 'WHERE ' . implode(' AND ', $conditions);
            }

            $stmt = $this->db->prepare("SELECT products.*, categories.categname FROM products INNER JOIN categories ON products.cat_id = categories.categ_id $whereClause ORDER BY $orderBy LIMIT :offset, :limit");
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

            foreach ($params as $key => &$value) {
                $stmt->bindValue($key, $value);
            }

            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $products;
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }

    public function getTotalProducts($search, $categories) {
        try {
            $conditions = [];
            $params = [];

            if (!empty($search)) {
                $conditions[] = "name LIKE :search";
                $params[':search'] = '%' . $search . '%';
            }

            if (!empty($categories)) {
                $categoryPlaceholders = implode(', ', array_map(function($cat) { return ':cat_' . $cat; }, $categories));
                $conditions[] = "cat_id IN ($categoryPlaceholders)";
                foreach ($categories as $index => $category) {
                    $params[':cat_' . $category] = $category;
                }
            }

            $whereClause = '';
            if (count($conditions) > 0) {
                $whereClause = 'WHERE ' . implode(' AND ', $conditions);
            }

            $stmt = $this->db->prepare("SELECT COUNT(*) FROM products $whereClause");
            foreach ($params as $key => &$value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            $total = $stmt->fetchColumn();

            return $total;
        } catch (PDOException $e) {
            throw new Exception('Database error: ' . $e->getMessage());
        }
    }
}
?>

<?php
require_once 'db.php';

class Product {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db->getConnection();
    }
    

    public function addProduct($name, $price, $image_url, $added_by) {
        $stmt = $this->db->prepare("INSERT INTO products (name, price, image, added_by) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $name, $price, $image_url, $added_by);
        return $stmt->execute();
    }


    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getProducts() {
        $result = $this->db->query("SELECT id, name, price, image FROM products ORDER BY id DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

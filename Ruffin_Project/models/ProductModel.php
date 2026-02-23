<?php
class ProductModel {

    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function getProducts() {
        return mysqli_query($this->conn,
            "SELECT product_id, product_name, product_description, price, created_at
             FROM products ORDER BY product_id");
    }

    public function getUsers() {
        return mysqli_query($this->conn,
            "SELECT user_id, first_name, last_name, email, created_at
             FROM users ORDER BY user_id");
    }
}
?>
<?php
require_once "config.php";
require_once "models/ProductModel.php";

$model = new ProductModel($conn);

$productsResult = $model->getProducts();
$usersResult    = $model->getUsers();
?>
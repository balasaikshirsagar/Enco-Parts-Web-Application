<?php

require_once("../config/dbconfig.php");
require_once("./ProductController.php");


$db = new Database();


$productController = new ProductController($db->getPdo());


$productController->fetchProducts();

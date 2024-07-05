<?php

require_once("../config/dbconfig.php");
require_once("./ProductController.php");
// require_once("./CartController.php");

require_once('../models/ProductModel.php');
// require_once('../models/CartModel.php');


$db = new Database();


$productController = new ProductController($db->getPdo());


$productController->fetchProducts();

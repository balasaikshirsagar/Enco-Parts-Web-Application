<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');  // Redirect to your login page
    exit();
}
?>

<?php 
include('../includes/headers.php');
include('../includes/sidebar.php');
include_once('../config/dbconfig.php');
include_once('../models/CategoryModel.php');


// Initialize database connection and category model
$database = new Database();
$db = $database->getPdo();
$categoryModel = new CategoryModel($db);

// Fetch all categories with IDs and names
$categories = $categoryModel->getAllCategories();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD PRODUCT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/eb66556e4c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
    .addproduct{
        margin-left: 220px;
    }

    .form{
        margin-left: 220px;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5 addproduct">
        <a class="navbar-brand ps-5" href="#">ADD PRODUCT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pe-5">
                <li class="nav-item active">
                    <a class="nav-link fw-bold" href="dashboard.php">HOME</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-3">
        <form action="../index.php?action=addproduct" method="post" class="form" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-4 w-50">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" required>
                </div>
                <br>
                <br>
                <div class="form-group col-4 w-75 mt-3">
                    <label for="productDescription">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter Product Description" rows="3" required></textarea>
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="form-group col-md-6 w-50">
                    <label for="category">Category</label>
                    <select class="form-control" id="cat_id" name="cat_id" required>
    <option value="">Select Category</option>
    <?php foreach ($categories as $category): ?>
        <option value="<?php echo htmlspecialchars($category['categ_id'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($category['categname'], ENT_QUOTES, 'UTF-8'); ?>
        </option>
    <?php endforeach; ?>
</select>

                </div>
            </div>
            <div class="form-row mt-2">
                <div class="form-group col-md-4">
                    <label for="active">Active</label>
                    <select class="form-control" id="active" name="active" required>
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="productImage">Image</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="Upload Image" required>
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="form-group col-md-4">
                    <label for="productColor">Color</label>
                    <input type="text" class="form-control" id="color" name="color" placeholder="Enter Product Color" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="productSize">Size</label>
                    <input type="text" class="form-control" id="size" name="size" placeholder="Enter Product Size" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="productPrice">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter Product Price" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3 mb-4 float-end px-3">Save</button>
        </form>
    </div>

    <script>
    document.getElementById('price').addEventListener('input', function (e) {
        let value = e.target.value;
        e.target.value = value.replace(/\D/g, '');
    });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>

<?php
session_start();


if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');  
    exit();
}
?>


<?php 
include('../includes/headers.php');
include('../includes/sidebar.php');
include_once('../config/dbconfig.php');
include_once('../models/CategoryModel.php');

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD CATEGORY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/eb66556e4c.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
    .addcategory{
        margin-left: 220px;
    }

    .form{
        margin-left: 220px;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5 addcategory">
        <a class="navbar-brand ps-5" href="#">ADD CATEGORY</a>
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
        <form action="../index.php?action=addcategory" method="post" class="form">
            <div class="row">
                <div class="form-group col-4 w-50">
                    <label for="categname">Category Name</label>
                    <input type="text" class="form-control" id="categname" name="categname" placeholder="Enter Category Name" required>
                </div>
                <br>
                <br>
                <div class="form-group col-4 w-75 mt-3">
                    <label for="categdesc">Category Description</label>
                    <textarea class="form-control" id="categdesc" name="categdesc" placeholder="Enter Category Description" rows="3" required></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3 mb-4 float-end px-3">Submit</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>

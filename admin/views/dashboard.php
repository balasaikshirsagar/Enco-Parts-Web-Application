
<?php 
session_start();
include_once('../includes/headers.php');
include_once('../includes/sidebar.php');


if (!isset($_SESSION['user'])) {
    header('Location: ./index.php');
    exit();
}

$user = $_SESSION['user'];
?>

<style>
    .table-margin {
        margin-left: 100px;
    }

    .navbar {
        margin-left: 250px;
    }

    .custom-font-size {
        font-size: 1.4rem; 
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    
   
</head>
<body class="ms-5 margin">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <span class="nav-link"> <h5 class="text-dark">Welcome! <?php echo $user['name'];?></h5> </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-dark text-white me-5" style="margin-right: 20px;" href="addProduct.php">Add Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-warning text-white ms-5" href="login.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

   




    <div class="container mt-5 ">
        <table class="table table-bordered table-striped text-center align-middle table-margin">
            <thead>
                <tr>
                    
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category ID</th>
                    <!-- <th scope="col">User ID</th> -->
                    <th scope="col">Active</th>
                    <th class="px-5" scope="col">Image</th>
                    <th scope="col">Color</th>
                    <th scope="col">Size</th>
                    <th scope="col">Price</th>
                    <th class="px-3" scope="col">Created At</th>
                    <th scope="col ">Edit/Delete</th>
                </tr>
            </thead>
            <tbody id="product-table">
            </tbody>
        </table>
    </div>

   
    
    <script>
       
    $(document).ready(function() {
    $.ajax({
        url: '../controllers/fetchproducts.php',
        method: 'GET',
        success: function(response) {

            console.log(response);
            try {
                const data = JSON.parse(response);

                if (data.success) {
                    callClient(data.data);
                } else {
                    alert(data.message);
                }
            } catch (e) {
                alert('Error parsing JSON response: ' + e.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('An error occurred while fetching products: ' + textStatus);
        }
    });
});

function callClient(products) {
    let tableBody = '';
    products.forEach(product => {
        tableBody += `
            <tr>
                
                <td>${product.name}</td>
                <td>${product.description}</td>
                <td>${product.cat_id}</td>
               
                <td>${product.active}</td>
                <td class="px-3"><img src="${product.image}" alt="${product.name}" style="max-height: 120px; max-width: 160px; object-fit: cover;" /></td>
                <td>${product.color}</td>
                <td>${product.size}</td>
                <td>${product.price}</td>
                <td class="px-3">${product.created_at}</td>
                <td class="ms-4 text-center px-5">
                <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal" 
            data-product-id= "${product.product_id}"    
        data-name="${product.name}"
        data-description="${product.description}"
        data-cat-id="${product.cat_id}"
        
        data-active="${product.active}"
        data-image="${product.image}"
        data-color="${product.color}"
        data-size="${product.size}"
        data-price="${product.price}"
        onclick="populateUpdateModal(this)">UPDATE</button>
            <button type="button" class="btn btn-danger" onclick="deleteProduct(${product.product_id})">DELETE</button>
        </td>
            </tr>
        `;
    });
    $('#product-table').html(tableBody);
}

</script>


<script src="../assets/js/deleteproduct.js"></script>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
               
                        <h1 class="modal-title w-100 text-center  custom-font-size" id="exampleModalLabel">UPDATE PRODUCTS</h1>
                   
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form method="post" class="form">
                    
                        <div class="form-group mb-3">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="productDescription">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Enter Product Description" rows="3" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="categoryId">Category ID</label>
                            <input type="number" class="form-control" id="cat_id" name="cat_id" placeholder="Enter Category ID" required>
                        </div>
                      
                        <div class="form-group mb-3">
                            <label for="active">Active</label>
                            <select class="form-control" id="active" name="active" required>
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="productImage">Image URL</label>
                            <input type="file" class="form-control" id="image" name="image"  required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="productColor">Color</label>
                            <input type="text" class="form-control" id="color" name="color" placeholder="Enter Product Color" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="productSize">Size</label>
                            <input type="text" class="form-control" id="size" name="size" placeholder="Enter Product Size" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="productPrice">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter Product Price" required>
                        </div>
                        <input type="hidden" id="product_id" name="product_id">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CLOSE</button>
                    <button type="button" onclick="updateProduct()" class="btn btn-success">UPDATE</button>
                </div>
            </div>
        </div>
    </div>


<script src="../assets/js/updateproduct.js"></script>

</body>
</html>
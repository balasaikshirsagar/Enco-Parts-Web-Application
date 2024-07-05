

<?php
session_start();
// if (!isset($_SESSION['email'])) {
//     header('Location: login.php');
//     exit();
// }
$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : 'Guest';
?>

<?php


include_once('../config/dbconfig.php'); // Adjust the path as needed
include_once('../controllers/CategoryController.php');
include_once('../controllers/CartController.php');
include_once('../models/CartModel.php');
include_once('../models/CategoryModel.php');
include_once('../controllers/ProductController.php');
include_once('../models/ProductModel.php');
// include_once('../controllers/deletecart.php');


try {
    // Initialize database connection
    $database = new Database();
    $db = $database->getPdo();

    // Initialize controller with database connection
    $controller = new CategoryController($db);

    $cartController = new CartController($db);

    $productController = new ProductController($db);

  

    // Fetch categories
    $response = $controller->fetchCategories();

   

    
;
    // Check if categories were fetched successfully
    if ($response['success']) {
        $categories = $response['data'];
    } else {
        $categories = []; // Initialize as empty array if fetch failed
        echo "<script>alert('Error fetching categories: " . $response['message'] . "');</script>";
    }
} catch (Exception $e) {
    // Handle any exceptions
    echo 'Error: ' . $e->getMessage();
    $categories = [];
}
?>



<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/common.css" />
    <link rel="stylesheet" type="text/css" href="../css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <script async src="https://www.googletagmanager.com/gtag/js?id=YOUR_TRACKING_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'YOUR_TRACKING_ID', {
            'cookie_flags': 'SameSite=None;Secure'
        });
    </script>

    <style>
        #prodname{
            max-width: fit-content;
            display: flex;
            width: 100%;
            justify-content: space-evenly;
            align-items: flex-start;
            margin-right: 100px;
        }

        #proddescription{
            max-width: max-content;
            width: 100%;
            justify-content: space-evenly;
            align-items: flex-start;
            margin-right: 70px;
        }

        #prodprice{
            max-width: max-content;
            width: 100%;
            justify-content: space-evenly;
            align-items: flex-start;
            margin-right: 40px;
        }

        .display-contents{
            gap: 10px;
        }
    </style>




</head>

<body>
    <div class="enco-1">
        <div class="enco-2">
            <div class="enco-3">
                <div class="enco-4 me-5">Western Canada, Saudi Arabia & MENA Region</div>
                <div class="enco-5">
                    <div class="enco-6 me-5">Quality Yellow Line OEM Parts</div>
                    <div class="enco-7">
                        <div class="enco-8 "><img class="icon4" height="15px" src="../assets/yellow_angle_brackets.png" alt="alt text" /></div>
                        <div class="enco-9 me-5">1 800 801 6515</div>
                    </div>
                    <a class="enco-10">
                        <div class="enco-11"><img class="image5" height="15px" src="../assets/yellow_v_shape.png" alt="alt text" /></div>
                        <div class="enco-12 me-5">info@encoenterprises.com</div>
                    </a>
                    <a class="enco-13" <?php if (!isset($_SESSION['email'])) echo 'onclick="openModal(\'myModal3\')"'; ?>>
                        <div class="enco-14">
                            <img class="icon5" height="15px" src="../assets/yellow_chevron_upward.png" alt="alt text" />
                        </div>
                        <div class="enco-15"><?php echo htmlspecialchars($firstname); ?></div>
                    </a>
                    <div class="logout">
                        <button class="btn-sm btn-warning" onclick="window.location.href='./logout.php'">Logout</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-lg-5 px-4">
            <div class="row">
                <div class="col-xl-3 col-md-12 z-1">
                    <div class="logo"><img decoding="async" src="../assets/Logo.png" alt="Logo Image"></div>
                </div>
                <div class="col-xl-9 col-md-12">
                    <nav>
                        <div class="hamburger">
                            <div class="bars1"></div>
                            <div class="bars2"></div>
                            <div class="bars3"></div>
                        </div>

                
                        <ul class="nav-links">
                            <li><a class="enco-20">Home</a></li>
                            <li><a class="enco-21">Yellow Line OEM Parts</a></li>
                          
                            <li><a class="enco-22">About us</a></li>
                            <li><a class="enco-23">Clients</a></li>
                            <li><a class="enco-24">FAQ</a></li>
                            <li><a class="enco-25">Contact us</a></li>
                            <li>
                                <a class="enco-26" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                    <span class="enco-relative">
                                        <img height="15px" src="../assets/dbf5ca1ede626c67f00b3fd79312f03f.png" alt="alt text" />
                                        <div class="enco-27">
                                            <span class="enco-center"></span>
                                        </div>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a class="enco-28" onclick="openModal('myModal1')">
                                    <div class="enco-29"><img height="15px" class="enco-center" src="../assets/382ac40a96fed7a1417133b00675d805.png" alt="alt text" /></div>
                                    <div class="enco-30"></div>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>



    <div class="enco-31">
      <div class="enco-32">
        <div class="column">
          <div class="enco-33">


          <style>
            
          </style>
          
            
            <div class="enco-40">Filter by category</div>
<div class="enco-41">
    <?php foreach ($categories as $category): ?>
        <label class="display-contents d-flex">
            <input type="checkbox" class="categoryCheckbox" value="<?php echo $category['categ_id']; ?>" />
            
            <?php echo $category['categname']; ?>
        </label>
    <?php endforeach; ?>
</div>

          </div>
        </div>
        <div class="column-2">
          <div class="enco-49">
            <div class="enco-50">
              <a style="color: rgba(250, 187, 59, 1)">Home</a>
              <a style="color: rgba(0, 0, 0, 1)">/ Yellow Line OEM Parts</a>
            
            <div class="enco-51">YELLOW LINE OEM PARTS</div>
            <div class="navbar">
    <!-- Other navbar content -->

</div>

            <div class="enco-52">
              <div class="enco-53">
                <a class="enco-48 enco-48-grid">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-grid-3x3-gap-fill" viewBox="0 0 16 16">
                    <path
                      d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z" />
                  </svg></a>
                <a class="enco-48 enco-48-table active">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-list-task" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                    <path
                      d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                    <path fill-rule="evenodd"
                      d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
                  </svg></a>
                <div class="enco-56">Showing 1-4 of 8 results</div>
              </div>

              <span class="select-wrapper">
    <select name="sort" id="sort" class="form-control no-radius">
        <option value="default">Default Sort</option>
        <option value="sort-a-z">Sort A-Z</option>
        <option value="sort-z-a">Sort Z-A</option>
    </select>
</span>

            </div>


            <script>

let offset = 0;
const limit = 4;
let totalProducts = 10;
let loading = false;

$(document).ready(function () {
    $('#sort').change(function () {
        offset = 0;
        totalProducts = 10;
        loadProducts(true);
    });

    $('#searchInput').on('input', function () {
        offset = 0;
        totalProducts = 10;
        loadProducts(true);
    });

    $('#searchButton').click(function (e) {
        e.preventDefault();
        offset = 0;
        totalProducts = 10;
        loadProducts(true);
        $('#myModal1').modal('hide');
    });

    $('.categoryCheckbox').change(function () {
    offset = 0;
    totalProducts = 10;
    loadProducts(true);
});

    // Initial load
    loadProducts();

    // Infinite scroll
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !loading && offset < totalProducts) {
            loadProducts();
        }
    });
});

function loadProducts(clear = false) {
    if (loading || offset >= totalProducts) return;
    loading = true;

    const sort = $('#sort').val();
    const search = $('#searchInput').val();
    const selectedCategories = $('.categoryCheckbox:checked').map(function () {
        return this.value;
    }).get();

    // Show loader
    $('.enco-loader').show();

    $.ajax({
        url: '../controllers/fetchproducts.php',
        method: 'GET',
        data: { sort: sort, offset: offset, limit: limit, search: search, categories: JSON.stringify(selectedCategories) },
        success: function (response) {
            try {
                const data = JSON.parse(response);
                if (data.success) {
                    if (clear) {
                        $('.product_container').empty();
                        totalProducts = parseInt(data.total);
                    }
                    offset += limit;
                    updateProductCount(offset, totalProducts);
                    callClient(data.data, clear);
                } else {
                    alert(data.message);
                }
            } catch (e) {
                console.error('Error parsing JSON response:', e);
                alert('Error parsing JSON response: ' + e.message);
            } finally {
                loading = false;
                // Hide loader if all products are loaded
                if (offset >= totalProducts) {
                    $('.enco-loader').hide();
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('AJAX error:', textStatus, errorThrown);
            alert('An error occurred while fetching products: ' + textStatus);
            loading = false;
            // Hide loader on error
            $('.enco-loader').hide();
        }
    });
}


$('.categoryCheckbox').change(function () {
    offset = 0;
    totalProducts = 10;
    loadProducts(true);
});


function callClient(products, clear = false) {
    const productContainer = $('.product_container');
    if (clear) {
        productContainer.empty();
    }

    if (!Array.isArray(products)) {
        console.error('Expected an array but received:', products);
        alert('Unexpected response format.');
        return;
    }

    products.forEach(product => {
        const productHtml = `
        <div class="col-lg-12 col-md-12 col-sm-12 product-grid-layout offset-md-0 offset-sm-0 divider-line">
            <div class="enco-61">
                <div class="image-box display-contents">
                    <img loading="lazy" src="${product.image}" class="img-table object-fit-contain" />
                </div>
                <div class="enco-62">
                    <div class="enco-63">${product.name}</div>
                </div>
                <div class="enco-65 px-lg-5 d-flex justify-content-center">${product.categname}</div>
                <div class="enco-66 px-lg-4 d-flex justify-content-center align-items-center">${product.description}</div>
                <div class="enco-67">
                    <div class="enco-68 px-3 d-flex justify-content-center align-items-center">$ ${product.price} (AUD)</div>
                    <div class="enco-69">Price excludes Australian GST</div>

                    <form class="addToQuoteForm" method="POST" action="../index.php?action=addToCart">
                        <input type="hidden" name="product_id" value="${product.product_id}">
                        <input type="hidden" name="name" value="${product.name}">
                        <input type="hidden" name="price" value="${product.price}">
                        <input type="hidden" name="categname" value="${product.categname}">
                        <input type="hidden" name="description" value="${product.description}">
                        <input type="hidden" name="image" value="${product.image}">
                        <input type="hidden" name="quantity" value="1">
                    </form>
                </div>
                <div class="enco-70">
                    <a class="enco-71 addToQuote d-flex justify-content-center" href="#">Add to quote</a>
                </div>
            </div>
        </div>
        `;
        productContainer.append(productHtml);
    });

    // Add event listeners for the "Add to quote" buttons
    $('.addToQuote').on('click', function(event) {
        event.preventDefault();
        $(this).closest('.product-grid-layout').find('.addToQuoteForm').submit();
    });
}


//hello
function updateProductCount(displayed, total) {
    $('.enco-56').text(`Showing ${Math.min(displayed, total)} of ${total} results`);
}

function openModal(modalId) {
    $('#' + modalId).modal('show');
}

$('#closeIcon').click(function() {
    $('#myModal1').modal('hide');
});





</script>




            <section id="products" class="product-grid">
              <div class="enco-table-view">
                <div class="row product_container cvf_universal_container">
        




                  
                  
                </div>
              </div>


              <div class="enco-grid-view">
                <div class="row product_contain cvf_universal_container">
                 
         
                 
         
                  
                    
                  </div>
                </div>

                
<script>

  
$(document).ready(function() {
    let offset = 0;
    const limit = 4; 
    let totalProducts = 10; 
    let loading = false; 

    // Event listener for sorting
    $('#sort').change(function() {
        offset = 0; 
        totalProducts = 10; 
        loadProducts(true);
    });

    // Event listener for category checkboxes
    $('.categoryCheckbox').change(function() {
        offset = 0; 
        totalProducts = 10; 
        loadProducts(true);
    });

    // Event listener for search input
    $('#searchInput').on('input', function() {
        offset = 0; 
        totalProducts = 10; 
        loadProducts(true);
    });

    // Event listener for search button
    $('#searchButton').click(function(e) {
        e.preventDefault(); 
        offset = 0; 
        totalProducts = 10; 
        loadProducts(true); 
        $('#myModal1').modal('hide'); 
    });

    // Initial load
    loadProducts();

    // Infinite scroll
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !loading && offset < totalProducts) {
            loadProducts(); 
        }
    });

    // Function to load products via AJAX
    function loadProducts(clear = false) {
        if (loading || offset >= totalProducts) return;
        loading = true;
        
        const sort = $('#sort').val(); 
        const search = $('#searchInput').val(); 
        const selectedCategories = $('.categoryCheckbox:checked').map(function() {
            return this.value;
        }).get();
      
        $.ajax({
            url: '../controllers/fetchproducts.php',
            method: 'GET',
            data: { sort: sort, limit: limit, offset: offset, categories: JSON.stringify(selectedCategories), search: search },
            success: function(response) {
                console.log(response);
                try {
                    const data = JSON.parse(response);
                    console.log(data);
                    if (data.success) {
                        renderProducts(data.data, clear);
                        offset += limit; 
                        totalProducts = parseInt(data.total); 
                    } else {
                        alert(data.message); 
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    alert('Error parsing JSON response: ' + e.message); 
                } finally {
                    loading = false;
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
                alert('An error occurred while fetching products: ' + textStatus); // Alert if AJAX request fails
                loading = false; 
            }
        });
    }

    // Function to render products
    function renderProducts(products, clear = false) {
        const productContainerGrid = $('.enco-grid-view .product_contain');
        if (clear) {
            productContainerGrid.empty(); 
        }

        if (!Array.isArray(products)) {
            console.error('Expected an array but received:', products);
            alert('Unexpected response format.');
            return;
        }

        products.forEach(product => {
    const productHtmlGrid = `
        <div class="col-lg-3 col-md-12 col-sm-12 product-grid-layout offset-md-0 offset-sm-0">
            <div class="card border-0">
                <div class="image-box display-contents mt-3">
                    <img loading="lazy" src="${product.image}" class="img-grid mt-4 object-fit-fill img-fluid" />
                </div>
                <div class="card-body display-contents px-0">
                    <div class="enco-grid-4">${product.name}</div>
                    <div class="enco-grid-5">${product.categname}</div>
                    <div class="enco-grid-6">${product.description}</div>
                    <div class="enco-grid-7">$ ${product.price} (AUD)</div>
                    <div class="enco-grid-8">Price excludes Australian GST</div>
                    <form class="addToQuoteForm" method="POST" action="../index.php?action=addToCart">
                        <input type="hidden" name="product_id" value="${product.product_id}">
                        <input type="hidden" name="name" value="${product.name}">
                        <input type="hidden" name="price" value="${product.price}">
                        <input type="hidden" name="categname" value="${product.categname}">
                        <input type="hidden" name="description" value="${product.description}">
                        <input type="hidden" name="image" value="${product.image}">


                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"  class="enco-grid-9 ">Add to quote</button>
                    </form>
                </div>
            </div>
        </div>
    `;
    productContainerGrid.append(productHtmlGrid);
});


        // Attach event listener to Add to Quote buttons
       
    }
});



</script>
              </div>
              <div class="enco-loader"></div>
            </section>
          </div>
        </div>
      </div>
    </div>
    <div class="enco-74"></div>
    <div class="enco-75">
      <div class="enco-76">
        <div class="column-3">
          <div class="enco-77">
            <div class="enco-78">
              <div class="column-4">
                <div class="enco-79">
                  <img loading="lazy" src="../assets/Logos.png" class="img-7" />
                  <div class="enco-80">
                    Enco® is a supplier of Yellow Line OEM parts and components,
                    sourced directly through strategic Original Equipment
                    Manufacturer partnerships.
                  </div>
                </div>
              </div>
              <div class="column-5">
                <div class="enco-81">
                  <div class="enco-82">NAVIGATION</div>
                  <div class="enco-83">Yellow Line OEM Parts</div>
                  <div class="enco-84">About us</div>
                  <div class="enco-85">Clients</div>
                  <div class="enco-86">FAQ</div>
                  <div class="enco-87">Contact us</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="column-6">
          <div class="enco-88">Recently viewed parts</div>
        </div>
        <div class="column-7">

          <img loading="lazy" src="../assets/brochure-mock-up-2023.png" class="img-22" />
          <a class="enco-37">
            <div class="enco-38"><img class="image-file" src="../assets/f62e94146954c75ea5380c29546034ab.png"
                alt="alt text"></div>
            <div class="enco-39">Download Brochure</div>
          </a>
        </div>
      </div>
    </div>
    <div class="enco-92">
      <div class="enco-93">
        <div class="enco-94">
          © Enco | Website by
          <span style="color: rgba(250, 187, 59, 1)">KSHIRSAGAR BALASAI</span>
        </div>
        <div class="enco-95">
          <span style="color: rgba(250, 187, 59, 1)">Privacy Policy</span>
          |
          <span style="color: rgba(250, 187, 59, 1)">Terms of use</span>
        </div>
      </div>
    </div>
   
<div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="serachParts" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <span class="close-icon" id="closeIcon">&times;</span>
            <div class="wrapper">
                <div class="search-input">
                    <input type="text" id="searchInput" placeholder="Type to search.." name="searchInput">
                    <div class="autocom-box">
                        <!-- here list are inserted from javascript -->
                    </div>
                    <div class="icon" id="searchButton"><i class="fa fa-search"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="myModal3" tabindex="-1" aria-labelledby="login" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <span class="close-icon" id="closeIcon">&times;</span>
          <!-- Tab Buttons -->
          <div id="tab-btn">
            <a href="#" class="login-tab active"><span>Login</span></a>
            <a href="#" class="register-tab"><span>REGISTER</span></a>
          </div>
          <!-- Login Form -->
          <div class="login-box">
            <form action="../index.php?action=login" method="post" id="login-form">
              <div class="my-3 enco-96">
                <label class="form-label required">Username</label>
                <input type="text" name="email" placeholder="email" class="form-control" required autofocus />
              </div>
              <div class="my-3 enco-96">
                <label class="form-label required">Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control" required />
              </div>
              
              <input type="submit" name="submit" value="Login" class="sub-btn" />
            </form>
          </div>
          <!-- Registration Form -->
          <div class="register-box">
            <form  method="post" action="../index.php?action=register" id="reg-form">
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="my-3 enco-96">
                    <label class="form-label required">Email Address</label>
                    <input type="text" id="email" name="email" placeholder="Email Address" class="form-control" required autofocus />
                  </div>
                  <div class="my-3 enco-96">
                    <label class="form-label required">First name</label>
                    <input type="text" id="firstname" name="firstname" placeholder="First name" class="form-control" required autofocus />
                  </div>
                  <div class="my-3 enco-96">
                    <label class="form-label required">Company name</label>
                    <input type="text" id="companyname" name="companyname" placeholder="Company name" class="form-control" required />
                  </div>
                  <div class="my-3 enco-96">
                    <label class="form-label required">Password</label>
                    <input type="password" id="password" name="password" autocomplete="off" placeholder="Password" class="form-control" required />
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="my-3 enco-96">
                    <label class="form-label required">Confirm Email Address</label>
                    <input type="text" id="reemail" name="reemail" placeholder="Confirm Email Address" class="form-control" required />
                  </div>
                  <div class="my-3 enco-96">
                    <label class="form-label required">Last name</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Last name" class="form-control" required autofocus />
                  </div>
                  <div class="my-3 enco-96">
                    <label class="form-label required">Phone</label>
                    <input type="text"  name="phone"  placeholder="Phone" id="phone" class="form-control" required autofocus />
                  </div>
                  <div class="my-3 enco-96">
                    <label class="form-label required">Confirm Password</label>
                    <input type="password" id="cpass" name="cpass" autocomplete="off" placeholder="Confirm Password" class="form-control" required />
                  </div>
                </div>
              </div>
             
              <input type="submit" name="submit" value="REGISTER" id="register-btn" class="sub-btn" />
            </form>
          </div>

          <script src="../js/email.js"></script>
        </div>
      </div>
    </div>



    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header divider-line-black">
        <h5 id="offcanvasRightLabel">Parts List</h5>
        <button type="button" class="btn-close opacity-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
        <script>
 function updateCartItemCount() {
        $.ajax({
            url: '../index.php?action=getCartItemCount',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('.enco-center').text(response.count);
                } else {
                    console.error('Failed to fetch cart item count:', response.message);
                }
            },
            error: function(error) {
                console.error('Error fetching cart item count:', error);
            }
        });
    }

    
  

    $(document).ready(function() {
        updateCartItemCount();

    function fetchCartItems() {
        $.ajax({
            url: '../index.php?action=getCartItems',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
              console.log(response);
                if (response.success) {
                    const cartItems = response.data;
                    const cartContainer = $('#offcanvasRight .offcanvas-body ul');
                    cartContainer.empty(); // Clear existing items
                    let totalPrice = 0;

                    cartItems.forEach(item => {
                        const itemHtml = `
                            <li class="d-flex align-items-start flex-column bd-highlight mb-3 divider-line">
                                <div class="enco-cart-61">
                                    <div class="image-box display-contents">
                                        <img loading="lazy" src="${item.image}" class="img-table" />
                                    </div>
                                    <div class="p-2 bd-highlight mr-auto">
                                        <div class="enco-62">
                                            <div class="product-title-cart">${item.name}</div>
                                            

                                            <div class="product-title-cart"> Quantity: ${item.quantity}</div>

                                            
                                           
                                            <div class="product-category-cart">${item.categname}</div>
                                            <div class="product-description-cart">${item.description}</div>
                                            <div class="product-price-cart"> ${item.price}(AUD)</div>
                                            
                                        </div>
                                    </div>
                                    <div class="p-2 bd-highlight">

                                    <a href="" data-dz-remove class="btn-floating ph red white-text waves-effect waves-light" onclick="deleteCartItem(${item.product_id})">
                  <i class="fa fa-times-circle-o"></i>
                </a>
                                   
                                        
                                    
                                    </div>
                                </div>
                            </li>
                        `;
                        cartContainer.append(itemHtml);
                        totalPrice += parseFloat(item.price);
                    });

                    $('.totals .amount').text(`$ ${totalPrice.toFixed(2)}(AUD)`);
                } else {
                    console.error('Failed to fetch cart items:', response.message);
                }
            },
            error: function(error) {
                console.error('Error fetching cart items:', error);
            }
        });
    }

    // Ensure fetchCartItems is called when the offcanvas is shown
    $('#offcanvasRight').on('shown.bs.offcanvas', function() {
        fetchCartItems();
    });
});

</script>
      <div class="offcanvas-body">

      <div id="loader" class="d-none position-fixed top-50 start-50 translate-middle">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>


        <div id="alertContainer" class="alert alert-success d-none" role="alert">
            Item deleted successfully.
        </div>
        <ul>
      

       
          
          
         
          
         
        </ul>
        <div class="totals">
          <div class="subtotal">
            <span class="label">TOTAL</span> <span class="amount">$ 54.00(AUD)</span>
          </div>
          <div class="gst-text">Price excludes Australian GST</div>
        </div>
        <div class="action-buttons">

        <a href="checkout.php"> <button class="btn enco-37" onclick="">
            <i class="fa fa-lock" aria-hidden="true"></i>
            CHECKOUT</button></a>
         
          
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="csvUpload" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title enco-97" >Upload File</h5>
            <span class="close-icon" id="closeIcon">&times;</span>
          </div>
          <div class="modal-body">
            <!-- Uploader Dropzone -->
            <form action="upload.php" id="zdrop" class="fileuploader center-align">
              <div id="upload-label">
                <i class="fa fa-upload" aria-hidden="true"></i>
              </div>
              <span class="tittle">Select a CSV, Excel or Doc file to upload <br> or drag and drop it here</span>
            </form>
            <div class="my-3 enco-96">
              <label for="csvUploadURL" class="form-label">Or upload from URL</label>
              <input type="text" class="form-control" id="csvUploadURL"
                value="https://sharepointlikename.com/csv-file.csv">
            </div>
            <!-- Preview collection of uploaded documents -->
            <div class="preview-container">
              <div class="collection card" id="previews">
                <div class="collection-item clearhack valign-wrapper item-template" id="zdrop-template">
                  <div class="left pv zdrop-info" data-dz-thumbnail>
                    <div>
                      <span data-dz-name></span>
                    </div>
                    <!-- <div class="progress">
                        <div class="determinate" style="width:0" data-dz-uploadprogress></div>
                      </div> -->
                    <!-- <div class="dz-error-message"><span data-dz-errormessage></span></div> -->
                  </div>
                  <div class="secondary-content actions">
                    <a href="#!" data-dz-remove class="btn-floating ph red white-text waves-effect waves-light">
                      <i class="fa fa-times-circle-o"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/deletecart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script>
    $(document).ready(function () {
      // getting all required elements
      let suggestions = [
        "Channel",
        "CodingLab",
        "CodingNepal",
        "YouTube",
        "YouTuber",
        "YouTube Channel",
        "Blogger",
        "Bollywood",
        "Vlogger",
        "Vechiles",
        "Facebook",
        "Freelancer",
        "Facebook Page",
        "Designer",
        "Developer",
        "Web Designer",
        "Web Developer",
        "Login Form in HTML & CSS",
        "How to learn HTML & CSS",
        "How to learn JavaScript",
        "How to became Freelancer",
        "How to became Web Designer",
        "How to start Gaming Channel",
        "How to start YouTube Channel",
        "What does HTML stands for?",
        "What does CSS stands for?",
        "Web Designer1",
        "Web Developer2",
        "Web Designer3",
        "Web Developer4",
        "Web Designer5",
        "Web Developer6",
        "Web Designer7",
        "Web Developer8",
        "Web Designer9",
        "Web Developer0",
        "Web Designer11",
        "Web Developer13",
        "Web Designer12",
        "Web Developer14",
      ];// getting all required elements
      const searchWrapper = document.querySelector(".search-input");
      const inputBox = searchWrapper.querySelector("input");
      const suggBox = searchWrapper.querySelector(".autocom-box");
      const icon = searchWrapper.querySelector(".icon");
      let linkTag = searchWrapper.querySelector("a");
      let webLink;

      // if user press any key and release
      inputBox.onkeyup = (e) => {
        let userData = e.target.value; //user enetered data
        let emptyArray = [];
        if (userData) {
          icon.onclick = () => {
            webLink = ` `;
            linkTag.setAttribute("href", webLink);
            linkTag.click();
          }
          emptyArray = suggestions.filter((data) => {
            //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
          });
          emptyArray = emptyArray.map((data) => {
            // passing return data inside li tag
            return data = `<li><div>Title</div><div>${data}</div></li>`;
          });
          searchWrapper.classList.add("active"); //show autocomplete box
          showSuggestions(emptyArray);
          let allList = suggBox.querySelectorAll("li");
          for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick", "select(this)");
          }
        } else {
          searchWrapper.classList.remove("active"); //hide autocomplete box
        }
      }

      function select(element) {
        let selectData = element.textContent;
        inputBox.value = selectData;
        icon.onclick = () => {
          webLink = `https://www.google.com/search?q=${selectData}`;
          linkTag.setAttribute("href", webLink);
          linkTag.click();
        }
        searchWrapper.classList.remove("active");
      }

      function showSuggestions(list) {
        let listData;
        if (!list.length) {
          userValue = inputBox.value;
          listData = `<li>${userValue}</li>`;
        } else {
          listData = list.join('');
        }
        suggBox.innerHTML = listData;
      }
      const hamburger = document.querySelector(".hamburger");
      const navLinks = document.querySelector(".nav-links");
      const links = document.querySelectorAll(".nav-links li");

      hamburger.addEventListener('click', () => {
        //Links
        navLinks.classList.toggle("open");
        links.forEach(link => {
          link.classList.toggle("fade");
        });

        //Animation
        hamburger.classList.toggle("toggle");
      });

      $(".register-tab").click(function () {
        $(".register-box").show();
        $(".login-box").hide();
        $(".register-tab").addClass("active");
        $(".login-tab").removeClass("active");
      });
      $(".login-tab").click(function () {
        $(".login-box").show();
        $(".register-box").hide();
        $(".login-tab").addClass("active");
        $(".register-tab").removeClass("active");
      });

      $(".enco-grid-view").hide();

      $(".enco-48-table").on('click', function () {
        $(".enco-48-grid").removeClass('active');
        $(".enco-48-grid").css('background-color', 'rgba(250, 187, 59, 1)');
        $(".enco-48-grid svg").css('color', 'black');
        $(".enco-table-view").show();
        $(".enco-grid-view").hide();
        $(".enco-48-table").addClass('active');
        $(".enco-48-table").css('background-color', 'black');
        $(".enco-48-table svg").css('color', 'rgba(250, 187, 59, 1)');
      });
      $(".enco-48-grid").on('click', function () {
        $(".enco-48-table").removeClass('active');
        $(".enco-48-table").css('background-color', 'rgba(250, 187, 59, 1)');
        $(".enco-48-table svg").css('color', 'black');
        $(".enco-table-view").hide();
        $(".enco-grid-view").show();
        $(".enco-48-grid").css('background-color', 'black');
        $(".enco-48-grid svg").css('color', 'rgba(250, 187, 59, 1)');
      });
    });
    // JavaScript and jQuery to handle modal interactions
    function initializeModal(modalId) {
      var modalElement = $('#' + modalId);
      var myModal = new bootstrap.Modal(modalElement[0]);

      modalElement.on('shown.bs.modal', function () {
        modalElement.find('.close-icon').show();
      });

      modalElement.on('hidden.bs.modal', function () {
        modalElement.find('.close-icon').hide();
      });

      modalElement.find('.close-icon').on('click', function () {
        myModal.hide();
      });

      return myModal;
    }

    function openModal(modalId) {
      var myModal = initializeModal(modalId);
      myModal.show();
    }

    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
      utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    initFileUploader("#zdrop");
    function initFileUploader(target) {
      var previewNode = document.querySelector("#zdrop-template");
      previewNode.id = "";
      var previewTemplate = previewNode.parentNode.innerHTML;
      previewNode.parentNode.removeChild(previewNode);


      var zdrop = new Dropzone(target, {
        url: 'upload.php',
        maxFiles: 1,
        maxFilesize: 30,
        previewTemplate: previewTemplate,
        previewsContainer: "#previews",
        clickable: "#upload-label"
      });

      zdrop.on("addedfile", function (file) {
        $('.preview-container').css('visibility', 'visible');
      });

      zdrop.on("totaluploadprogress", function (progress) {
        var progr = document.querySelector(".progress .determinate");
        if (progr === undefined || progr === null)
          return;

        progr.style.width = progress + "%";
      });

      zdrop.on('dragenter', function () {
        $('.fileuploader').addClass("active");
      });

      zdrop.on('dragleave', function () {
        $('.fileuploader').removeClass("active");
      });

      zdrop.on('drop', function () {
        $('.fileuploader').removeClass("active");
      });

    }
  </script>

</body>

</html>
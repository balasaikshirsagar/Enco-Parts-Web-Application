<?php 
session_start();
$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : 'Guest';
$customer = isset($_SESSION['customer']) ? $_SESSION['customer'] : null;

$user_id = isset($_SESSION['customer']['id']) ? $_SESSION['customer']['id'] : null;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="../css/checkout.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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
                    <a class="enco-13" >
                        <div class="enco-14 text-decoration-none">
                            <?php echo htmlspecialchars($firstname); ?>
                            <img class="icon5" height="15px" src="../assets/yellow_chevron_upward.png" alt="alt text" />
                        </div>
                        <div class="enco-15"></div>
                    </a>
                    <div class="logout">
                        <button class="btn-sm btn-warning" onclick="window.location.href='logout.php'">Logout</button>
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
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="enco-31 pb-20">
        <form action="../index.php?action=createOrder" method="POST" id="submit_order" name="submit_order">
            <div class="enco-32">
                <div class="column column-checkout">            
                    <div class="row cart-checkout">
                        <div class="col-12">
                            <div class="enco-51 d-lg-flex align-content-end justify-content-between enco-relative"> 
                                <span class="enco-checkout-51">Customer Information</span>
                            </div>
                            <div class="my-3 enco-96">
                                <label class="form-label required">Email Address</label>
                                <input type="email" name="cust_email" placeholder="Email Address" class="form-control" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" required autofocus />
                            </div>
                            <div class="my-3 enco-96">
                                <label class="form-label required">First name</label>
                                <input type="text" name="firstname" placeholder="First name" class="form-control" value="<?php echo htmlspecialchars($_SESSION['firstname'] ?? ''); ?>" required />
                            </div>
                            <div class="my-3 enco-96">
                                <label class="form-label required">Last name</label>
                                <input type="text" name="lastname" placeholder="Last name" class="form-control" value="<?php echo htmlspecialchars($customer['lastname'] ?? ''); ?>" required />
                            </div>
                            <div class="my-3 enco-96">
                                <label class="form-label required">Company name</label>
                                <input type="text" name="company" placeholder="Company name" class="form-control" value="<?php echo htmlspecialchars($customer['companyname'] ?? ''); ?>" required />
                            </div>
                            <div class="my-3 enco-96 d-inline-grid width-100">
                                <label class="form-label required">Phone</label>
                                <input type="text" name="phone" placeholder="Phone" id="phone" class="form-control" value="<?php echo htmlspecialchars($customer['phone'] ?? ''); ?>" required />
                                <span class="phoneerr"></span>
                            </div>
                            <div class="my-3 enco-96">
                                <label class="form-label">Note</label>
                                <div>Your personal information will be used to process your quotation, support your experience throughout this website, and for other purposes described in our <a href="#">privacy policy</a>.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column-2 column-checkout-list">
                    <div class="enco-49">
                        <div class="enco-51">Parts List</div>
                        <section id="csvproducts" class="product-grid">                    
                            <div class="table-responsive table-scroll">
                                <table class="table border border-bottom-item ">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="border border-bottom-item part-list-body cd-checkout-items">
                                    </tbody>
                                    <tfoot class="border-0">
                                        <tr>
                                            <th scope="row" colspan="6" class="border border-bottom-item">
                                                <div class="d-flex justify-content-end gap-4">
                                                    <div class="enco-68">Total:</div>
                                                    <div class="enco-68 total_row">$0 (AUD)</div>
                                                </div>
                                                <div class="enco-69 d-flex justify-content-end">Price excludes Australian GST</div>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>                    
                        </section>
                    </div>
                </div>
            </div>

            <div class="action-main">        
                
                <input type="hidden" name="total_amount" value="0" id="total_amount" /> <!-- Set default total_amount to 0 -->
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>" />

                <input type="hidden" name="products" id="products" /> <!-- Hidden field for products data -->
                <button class="btn btn-warning enco-37 uppercase py-3"><i class="fa fa-lock" aria-hidden="true"></i>SUBMIT</button>
                <a class="btn btn-dark enco-37-outline uppercase py-3" href="indexNew.php">Back</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            fetchCartItems();

            function fetchCartItems() {
                $.ajax({
                    url: '../index.php?action=getCartItems',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            displayCartItems(response.data);
                        } else {
                            console.error('Failed to fetch cart items:', response.message);
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching cart items:', error);
                    }
                });
            }

            function displayCartItems(items) {
                let cartItemsHTML = '';
                let totalAmount = 0;
                let productsData = [];

                items.forEach(item => {
                    cartItemsHTML += `
                        <tr>
                            <td><img src="${item.image}" class="img-table" /></td>
                            <td>${item.name}</td>
                            <td>${item.categname}</td>
                            <td>${item.description}</td>
                            <td>${item.quantity}</td>
                            <td>${item.price} (AUD)</td>
                        </tr>
                    `;
                    totalAmount += item.price * item.quantity;
                    productsData.push({
                        product_id: item.product_id,
                        name: item.name,
                        quantity: item.quantity,
                        price: item.price,
                        description: item.description
                    });
                });

                $('.cd-checkout-items').html(cartItemsHTML);
                $('.total_row').text(`$${totalAmount.toFixed(2)} (AUD)`);
                $('#total_amount').val(totalAmount.toFixed(2)); 
                $('#products').val(JSON.stringify(productsData)); 
            }
        });
    </script>
</body>
</html>

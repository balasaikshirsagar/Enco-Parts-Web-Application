function deleteCartItem(product_id) {
    

    // Show the loader
    $('#loader').removeClass('d-none');

    $.ajax({
        url: 'http://localhost/adminphp/Frontend/controllers/deletecart.php',
        type: 'POST',
        data: { product_id: product_id },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                console.log('Item deleted successfully.');
                updateCartItemCount();
                fetchCartItems(); // Refresh cart items
                
                // Show success alert
                $('#navbarAlert').removeClass('show').addClass('show');
                setTimeout(function() {
                    $('#navbarAlert').removeClass('show').addClass('d-none');
                }, 3000); // Hide after 3 seconds
            } else {
                console.error('Failed to delete product:', response.message);
            }
        },
        error: function(error) {
            console.error('Error deleting product:', error);
        },
        complete: function() {
            // Hide the loader
            $('#loader').addClass('d-none');
        }
    });
}

$(document).ready(function() {
    updateCartItemCount();

    // Ensure fetchCartItems is called when the offcanvas is shown
    $('#offcanvasRight').on('shown.bs.offcanvas', function() {
        fetchCartItems();
    });
});

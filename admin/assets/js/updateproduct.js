function updateProduct() {
   
    var product_id = $('#product_id').val();
    var name = $('#name').val();
    var description = $('#description').val();
    var cat_id = $('#cat_id').val();
    var active = $('#active').val();
    var image = $('#image')[0].files[0]; 
    var color = $('#color').val();
    var size = $('#size').val();
    var price = $('#price').val();

    
    var formData = new FormData();
    formData.append('product_id', product_id);
    formData.append('name', name);
    formData.append('description', description);
    formData.append('cat_id', cat_id);
    formData.append('active', active);
    formData.append('image', image); 
    formData.append('color', color);
    formData.append('size', size);
    formData.append('price', price);

    // Send the AJAX request
    $.ajax({
        url: '../controllers/updateproduct.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            var data = JSON.parse(response);
            if (data.success) {
                Swal.fire(
                    'Updated!',
                    data.message,
                    'success'
                ).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire('Error', 'An error occurred while updating the product.', 'error');
        }
    });
}


function populateUpdateModal(button) {
    const product_id = $(button).data('product-id');
    const name = $(button).data('name');
    const description = $(button).data('description');
    const catId = $(button).data('cat-id');
    const active = $(button).data('active');
    const image = $(button).data('image');
    const color = $(button).data('color');
    const size = $(button).data('size');
    const price = $(button).data('price');

    $('#product_id').val(product_id);
    $('#name').val(name);
    $('#description').val(description);
    $('#cat_id').val(catId);
    $('#active').val(active);
    $('#color').val(color);
    $('#size').val(size);
    $('#price').val(price);

    
    if (image) {
       
        $('#image').attr('src', image);
    }
}



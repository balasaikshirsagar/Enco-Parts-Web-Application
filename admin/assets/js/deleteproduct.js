function deleteProduct(productId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../controllers/deleteproduct.php',
                method: 'POST',
                data: { productId: productId },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your product has been deleted.',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false 
                    }).then(() => {
                        setTimeout(() => {
                            location.reload();
                        }, 1000); 
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error deleting product:', textStatus, errorThrown);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while deleting product.',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false 
                    });
                }
            });
        }
    });
}

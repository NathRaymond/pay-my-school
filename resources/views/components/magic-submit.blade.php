<script>
    $(document).ready(function() {
        $('.magicFormSubmit').submit(function(e) {
            e.preventDefault(); // Prevent form submission
            var formData = $(this).serialize(); // Serialize form data
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // Handle success response
                    
                    thisMessage =response.message?? "Form submitted successfully";
                    new swal("Well done", response.message, 'success');
                    //reload datatable
                    $('.btn-close').click();
                    $(this).trigger('reset');
                    loadPageDatatable();
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.log(xhr, status, error);
                    console.error(xhr.responseText);
                    new swal("Oops", xhr.responseText, 'error');
                    // You can show an error message here
                }
            });
        });
    });
</script>

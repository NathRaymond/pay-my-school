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
                    loadPageDatatable();
                    $('.btn-close').click();
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.log(xhr, status, error);
                    console.error(xhr.responseText);
                    // You can show an error message here
                }
            });
        });
    });
</script>

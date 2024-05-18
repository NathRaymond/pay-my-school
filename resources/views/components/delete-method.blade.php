<script>
    $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        /* When click delete button */
        $('body').on('click', '#deleteRecord', function() {
            event.preventDefault();         
        // Get the URL of the clicked <a> element
        var url = $(this).attr('href');
        var recordID = $(this).data('id');   
        var action = $(this).data('action');  
        var token = $("meta[name='csrf-token']").attr("content");
        var el = this;

        resetAccount(el, recordID,url,action);
    });


    async function resetAccount(el, recordID,url,action) {
        const willUpdate = await swal({
            title: "Confirm Record Delete",
            text: `Are you sure you want to delete this record?`,
            icon: "warning",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes!",
            showCancelButton: true,
            buttons: ["Cancel", "Yes, Delete"]
        });
        if (willUpdate) {
            //performReset()
            performDelete(el, recordID,url,action);
        } else {
            swal("Record will not be deleted  :)");
        }
    } 

    function performDelete(el, recordID,url,action) {
     
        try {
            $.get(url,
                function(data, status) {       
                    console.log(data,status, action);        
                 
                    if (status === "success") {
                        new swal("Record deleted successfully!.");
                        if(action==="reload"){
                            window.location.reload();
                        }else{
                            loadPageDatatable();   
                        }
                    }else{
                        new swal('Oops','An error has occured', 'error');
                    }

                }
            );
        } catch (e) {
            let alert = swal(e.message);
        }
    }

});
</script>
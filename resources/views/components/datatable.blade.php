<script>
    function loadPageDatatable(dataUrl) {
        // Call the destroy function before reinitializing DataTable
        destroyDataTable();

        $('#specialTable').DataTable({
            // "processing": true,            
            "ajax": {
                "url": dataUrl,
                "type": "GET",
                "dataSrc": ""
            },
            "columns": columns
        });
    }

    // Function to destroy the DataTable
    function destroyDataTable() {
        if ($.fn.DataTable.isDataTable('#specialTable')) {
            $('#specialTable').DataTable().destroy();
        }
    }
</script>

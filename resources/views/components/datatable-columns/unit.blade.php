<script>
    //specify columns for the data
    var columns = [{
            "data": "id"
        },
        {
            "data": "description"
        },
        {
            "data": "id",
            "render": function(data, type, row) {
                unitcategory = row.unitcategory.description?? "";
                return unitcategory;
            }
        },
        {
            "data": "id",
            "render": function(data, type, row) {
                buttons = `<div> 
                    <button class="btn btn-info flex-end m-1 btn-sm" id="edit-unit" data-id="${data}" data-bs-toggle="modal" data-bs-target="#modal-edit">Edit</button>
                              
                              <button class="btn btn-danger  btn-sm" id="deleteRecord" data-id="" href=""
                              data-myaction="loadDatatable">Delete</button>
                        
                                            </div>`;

                return buttons;
            }
        }
        // Add more column definitions if needed
    ];

    var dataUrl = "{{ route('unit') }}";

    loadPageDatatable();
</script>
<script>
    //specify columns for the data
    var columns = [
        {"data": "id" },
        {"data": "description"},
        {
            "data": "id",
            "render": function(data, type, row) {
                created_by = row.created_by.name?? "";
                return created_by;
            }
        },
        {
            "data": "id",
            "render": function(data, type, row) {
                buttons = `<div>  <button class="btn btn-info flex-end m-1 btn-sm" id="edit-category"
                                                    data-id="${row.id}" data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit">Edit</button>
                                                <a class="btn btn-danger  btn-sm" id="deleteRecord"
                                                    data-id="${row.id}"
                                                    href="/admin/unit/delete/${row.id}" data-myaction="loadDatatable"
                                                    >Delete</a>
                                            </div>`;

                return buttons;
            }
        }
    ];
    var dataUrl = "{{ route('get_category_data') }}";
    loadPageDatatable();
</script>
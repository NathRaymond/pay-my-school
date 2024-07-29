<script>
    //specify columns for the data
    var columns = [
        {"data": "id" },
        {"data": "description"},
        {
            "data": "id",
            "render": function(data, type, row) {
                if(row.active==0){
                    active = `<span class="badge badge-pill badge-danger">Inactive</span>`;
                }else{
                    active = `<span class="badge badge-pill badge-success">Active</span>`;
                }
                return active;
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
                                                    href="/admin/term/delete/${row.id}" data-myaction="loadDatatable"
                                                    >Delete</a>
                                                    <a href="/admin/activate_academic_term?id=${row.id}" onclick="return confirm('Are sure you want to active this term?')" class="btn btn-success flex-end m-1 btn-sm">Activate</a>
                                            </div>  `;

                return buttons;
            }
        }
    ];
    var dataUrl = "{{ route('academic_term.index') }}";
    loadPageDatatable();
</script>
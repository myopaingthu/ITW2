$(function () {
    var user_list = $("#user_list").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $("#index_route").val(),
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "email",
                name: "email"
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
                class: "text-center",
                width: "160px",
            },
        ],
        scrollCollapse: true,
        scrollX: true,
    });
});

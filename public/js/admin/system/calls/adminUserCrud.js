$(document).ready(function(){

    if ($('#frmStoreAdminUser').length > 0) {
        let rules = {
            admin_type: {
                required: true,
            },
            name: {
                required: true,
                maxlength: 253
            },
            email: {
                required: true,
                maxlength: 253,
                email: true,
            },
            mobile_number: {
                required: true,
                maxlength: 253
            },
            image: {
                required: true,
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreAdminUser',
            validation: true,
            script: 'admin/system/user',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateAdminUser').length > 0) {
        let rules = {
            admin_type: {
                required: true,
            },
            name: {
                required: true,
                maxlength: 253
            },
            email: {
                required: true,
                maxlength: 253,
                email: true,
            },
            mobile_number: {
                required: true,
                maxlength: 253
            },
            status: {
                required: true,
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateAdminUser',
            validation: true,
            script: 'admin/system/user/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtAdminUser").length > 0) {
        let col_draft = [
            {
                data: 'id',
                title: 'ID'
            },
            {
                data: 'image',
                title: 'Name'
            },
            {
                data: 'name',
                title: 'Name'
            },
            {
                data: 'email',
                title: 'Email'
            },
            {
                data: 'mobile_number',
                title: 'Mobile Number'
            },
            {
                data: 'status',
                title: 'Status'
            },
            {
                data: 'created_at',
                title: 'Created At'
            },

            {
                data: null,
                title: 'Actions',
                class: 'text-end',
                render: function (data, type, row) {
                    return `<a href="${baseurl}admin/system/user/${data.id}/edit"
                        <span class="badge rounded-pill bg-info cursor-pointer me-2">
                            <span class="bx bxs-edit text-white fw-bold fs-14"></span>
                        </span>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtAdminUser', {
            select: true,
            url: 'admin/system/user/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtAdminUser(table, api, op) {
    PX.deleteAll({
        element: "deleteAllAdminUser",
        script: "admin/system/user/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllAdminUser",
        script: "admin/system/user/update-list",
        confirm: true,
        dataCols: {
            key: "ids",
            items: [
                {
                    index: 1,
                    name: "ids",
                    type: "input",
                    data: [],
                },
                {
                    index: 1,
                    name: "serial",
                    type: "input",
                    data: []
                }
            ]
        },
        api,
        afterSuccess: {
            type: "inflate_response_data"
        }
    });
    // PX?.dowloadPdf({ ...op, btn: "downloadAdminUserPdf", dataTable: "yes" })
    // PX?.dowloadExcel({ ...op, btn: "downloadAdminUserExcel", dataTable: "yes" })
}

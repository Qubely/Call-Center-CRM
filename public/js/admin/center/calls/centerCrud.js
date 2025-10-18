$(document).ready(function(){

    if ($('#frmStoreCenter').length > 0) {
        let rules = {
            name: {
                required: true,
                minlength: 3
            },
            center_address: {
                required: true
            },
            owner_name: {
                required: true,
            },
            owner_email: {
                required: true,
                email: true
            },
            owner_mobile: {
                required: true,
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreCenter',
            validation: true,
            script: 'admin/center/list',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateCenter').length > 0) {
        let rules = {
            name: {
                required: true,
                minlength: 3
            },
            center_address: {
                required: true
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateCenter',
            validation: true,
            script: 'admin/center/list/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_redirect_response_data',
            }
        });
    }

    if ($("#dtCenter").length > 0) {
        const {pageLang={}} = PX?.config;
        const {table={}} = pageLang;
        let col_draft = [
            {
                data: 'id',
                title: table?.id
            },
            {
                data: 'image',
                title: table?.image
            },
            {
                data: 'name',
                title: table?.name
            },
            {
                data: 'center_address',
                title: table?.center_address
            },
            {
                data: 'user_count',
                title: table?.user_count
            },

            {
                data: 'created_at',
                title: table?.created
            },
            {
                data: null,
                title: table?.action,
                class: 'text-end',
                render: function (data, type, row) {
                    return `<a href="${baseurl}admin/center/list/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtCenter', {
            select: true,
            url: 'admin/center/list/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtCenter(table, api, op) {
    PX.deleteAll({
        element: "deleteAllCenter",
        script: "admin/center/list/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllCenter",
        script: "admin/center/list/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadCenterPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadCenterExcel", dataTable: "yes" })
}

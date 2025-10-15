$(document).ready(function(){

    if ($('#frmStoreClient').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreClient',
            validation: true,
            script: 'admin/client/client-list',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateClient').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateClient',
            validation: true,
            script: 'admin/client/client-list/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtClient").length > 0) {
        const {pageLang={}} = PX?.config;
        const {table={}} = pageLang;
        let col_draft = [
            {
                data: 'id',
                title: table?.id
            },
            /*{
                data: null,
                title: table?.serial,
                class: 'text-center',
                width: '200px',
                render: function (data, type, row) {
                    return `<input type="number" value="` + data.serial + `" class="form-control serial"><input type="hidden" value="` + data.id + `" class="form-control ids">`;
                }
            },*/
            {
                data: 'name',
                title: table?.name
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
                    return `<a href="${baseurl}admin/client/client-list/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtClient', {
            select: true,
            url: 'admin/client/client-list/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtClient(table, api, op) {
    PX.deleteAll({
        element: "deleteAllClient",
        script: "admin/client/client-list/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllClient",
        script: "admin/client/client-list/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadClientPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadClientExcel", dataTable: "yes" })
}

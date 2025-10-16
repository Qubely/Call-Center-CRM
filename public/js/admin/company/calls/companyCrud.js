$(document).ready(function(){

    if ($('#frmStoreCompany').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            country: {
                required: true,
                maxlength: 253
            },
            time_zone: {
                required: true,
                maxlength: 253
            },
            address: {
                required: true,
                maxlength: 253
            },
            tax_id: {
                required: true,
                maxlength: 253
            },
            email: {
                required: true,
                maxlength: 253,
                email: true
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreCompany',
            validation: true,
            script: 'admin/company/list',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateCompany').length > 0) {
        let rules = {
             name: {
                required: true,
                maxlength: 253
            },
            country: {
                required: true,
                maxlength: 253
            },
            time_zone: {
                required: true,
                maxlength: 253
            },
            address: {
                required: true,
                maxlength: 253
            },
            tax_id: {
                required: true,
                maxlength: 253
            },
            email: {
                required: true,
                maxlength: 253,
                email: true
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateCompany',
            validation: true,
            script: 'admin/company/list/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtCompany").length > 0) {
        const {pageLang={}} = PX?.config;
        const {table={}} = pageLang;
        let col_draft = [
            {
                data: 'id',
                title: table?.id
            },
            {
                data: null,
                title: table?.serial,
                class: 'text-center',
                width: '200px',
                render: function (data, type, row) {
                    return `<input type="number" value="` + data.serial + `" class="form-control serial"><input type="hidden" value="` + data.id + `" class="form-control ids">`;
                }
            },
            {
                data: 'name',
                title: table?.name
            },
            {
                data: 'email',
                title: table?.email
            },
            {
                data: 'country',
                title: table?.country
            },
            {
                data: 'time_zone',
                title: table?.time_zone
            },
            {
                data: 'address',
                title: table?.address
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
                    return `<a href="${baseurl}admin/company/list/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtCompany', {
            select: true,
            url: 'admin/company/list/list',
            columns: col_draft,
            pdf: [2,3,4,5,6,7]
        });
    }
})

function dtCompany(table, api, op) {
    PX.deleteAll({
        element: "deleteAllCompany",
        script: "admin/company/list/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllCompany",
        script: "admin/company/list/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadCompanyPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadCompanyExcel", dataTable: "yes" })
}

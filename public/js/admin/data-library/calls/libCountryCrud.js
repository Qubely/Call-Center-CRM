$(document).ready(function(){

    if ($('#frmStoreLibCountry').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            code: {
                required: true,
                maxlength: 4,
                minlength: 2
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreLibCountry',
            validation: true,
            script: 'admin/data-library/country',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateLibCountry').length > 0) {
        let rules = {
            name: {
                required: true,
                maxlength: 253
            },
            code: {
                required: true,
                maxlength: 4,
                minlength: 2
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateLibCountry',
            validation: true,
            script: 'admin/data-library/country/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtLibCountry").length > 0) {
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
                data: 'code',
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
                    return `<a href="${baseurl}admin/data-library/country/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtLibCountry', {
            select: true,
            url: 'admin/data-library/country/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtLibCountry(table, api, op) {
    PX.deleteAll({
        element: "deleteAllLibCountry",
        script: "admin/data-library/country/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllLibCountry",
        script: "admin/data-library/country/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadLibCountryPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadLibCountryExcel", dataTable: "yes" })
}

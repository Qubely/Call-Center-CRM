$(document).ready(function(){

    PX?.utils?.dp();

    if ($('#frmStoreCampaign').length > 0) {
        let rules = {
            name: {
                required: true,
                minlength: 3
            },
            client_id: {
                required: true,
                digits: true
            },
            type: {
                required: true
            },
            country: {
                required: true
            },
            billing_rate: {
                required: true,
                number: true,
                min: 0
            },
            payout_rate: {
                required: true,
                number: true,
                min: 0
            },
            validity: {
                required: true,
                date: true
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreCampaign',
            validation: true,
            script: 'admin/campaign/list',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateCampaign').length > 0) {
        let rules = {
           name: {
                required: true,
                minlength: 3
            },
            client_id: {
                required: true,
                digits: true
            },
            type: {
                required: true
            },
            country: {
                required: true
            },
            billing_rate: {
                required: true,
                number: true,
                min: 0
            },
            payout_rate: {
                required: true,
                number: true,
                min: 0
            },
            validity: {
                required: true,
                date: true
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateCampaign',
            validation: true,
            script: 'admin/campaign/list/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_response_data',
            }
        });
    }

    if ($("#dtCampaign").length > 0) {
        const {pageLang={}} = PX?.config;
        const {table={}} = pageLang;
        let col_draft = [
            {
                data: 'id',
                title: table?.id
            },
            {
                data: 'type',
                title: table?.type
            },
            {
                data: 'name',
                title: table?.name
            },
            {
                data: 'country',
                title: table?.country
            },
            {
                data: 'billing_rate',
                title: table?.billing_rate
            },
            {
                data: 'payout_rate',
                title: table?.payout_rate
            },
             {
                data: 'validity',
                title: table?.validity
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
                    return `<a href="${baseurl}admin/campaign/list/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                }
            },
        ];
        PX.renderDataTable('dtCampaign', {
            select: true,
            url: 'admin/campaign/list/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtCampaign(table, api, op) {
    PX.deleteAll({
        element: "deleteAllCampaign",
        script: "admin/campaign/list/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllCampaign",
        script: "admin/campaign/list/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadCampaignPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadCampaignExcel", dataTable: "yes" })
}

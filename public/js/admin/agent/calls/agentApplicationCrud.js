$(document).ready(function(){

    if ($('#frmStoreAgentApplication').length > 0) {
        let rules = {
            name: {
                required: true,
                minlength: 2
            },
            mobile_number: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            image: {
                required: true,
            },
            address: {
                required: true,
                minlength: 5
            }
        };
        PX.ajaxRequest({
            element: 'frmStoreAgentApplication',
            validation: true,
            script: 'admin/agent/application',
            rules,
            afterSuccess: {
                type: 'inflate_reset_response_data',
            }
        });
    }

    if ($('#frmUpdateAgentApplication').length > 0) {
        let rules = {
            name: {
                required: true,
                minlength: 2
            },
            mobile_number: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            address: {
                required: true,
                minlength: 5
            }
        };
        PX.ajaxRequest({
            element: 'frmUpdateAgentApplication',
            validation: true,
            script: 'admin/agent/application/'+$("#patch_id").val(),
            rules,
            afterSuccess: {
                type: 'inflate_redirect_response_data',
            }
        });
    }

    if ($("#dtAgentApplication").length > 0) {
        const {pageLang={},policy={}} = PX?.config;
        const {table={}} = pageLang;
        let trigManageDoc = {
            body: {},
            modalCallback: 'afterManageAgentDocModal',
            element: 'afterManageAgentDocModal',
            script: 'admin/agent/application/crud/mange-agent-doc/display',
            title: 'Add Document ',
            globLoader: false
        };
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
                data: 'email',
                title: table?.email
            },
             {
                data: 'mobile_number',
                title: table?.mobile_number
            },
            {
                data: 'status',
                title: table?.status
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
                    trigManageDoc = {
                        ...trigManageDoc,
                        body: {id: data?.id},
                        title: `Manage document for ${data?.name}`
                    };
                    let str = ``;
                    if(policy?.agent_application_modal_view) {
                        str += ` <span data-bs-toggle='modal' data-bs-target='.editmodal' data-edit-prop='${JSON.stringify(trigManageDoc)}' class="btn btn-outline-info btn-sm" title="Add Doc">
                                Add Document
                        </span>`
                    }
                    str += `<a href="${baseurl}admin/agent/application/${data.id}/edit" class="btn btn-outline-secondary btn-sm edit ms-2" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>`;
                    return str;
                }
            },
        ];
        PX.renderDataTable('dtAgentApplication', {
            select: true,
            url: 'admin/agent/application/list',
            columns: col_draft,
            pdf: [1, 2]
        });
    }
})

function dtAgentApplication(table, api, op) {
    PX.deleteAll({
        element: "deleteAllAgentApplication",
        script: "admin/agent/application/delete-list",
        confirm: true,
        api,
    });
    PX.updateAll({
        element: "updateAllAgentApplication",
        script: "admin/agent/application/update-list",
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
    PX?.dowloadPdf({ ...op, btn: "downloadAgentApplicationPdf", dataTable: "yes" })
    PX?.dowloadExcel({ ...op, btn: "downloadAgentApplicationExcel", dataTable: "yes" })
}

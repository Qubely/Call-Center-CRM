$(document).ready(function(){

});
function afterManageAgentDocModal(op) {
    deleteApplicatDoc();
    if ($('#frmAddAgentDoc').length > 0) {
        let rules = {
            lib_agent_doc_id: {
                required: true,
            },
            document: {
                required: true,
            },
        };
        PX?.ajaxRequest({
            element: 'frmAddAgentDoc',
            validation: true,
            script: 'admin/agent/application/crud/mange-agent-doc/store',
            rules,
            afterSuccess: {
                type: 'api_response',
                afterLoad: (req,res) => {
                     PX?.utils?.fReset('frmAddAgentDoc');
                    $("#loadAgentApplicationDoc").html(res?.extraData?.view);
                    deleteApplicatDoc();
                }
            }
        });
    }

}

function deleteApplicatDoc(){

    $(".deleteDocument").on("click",function(){
        let id = $(this).attr('data-id');
        PX?.ajaxRequest({
           element: 'deleteDocument',
           dataType: 'json',
           body: {id},
           type: 'request',
           confirm: true,
           script: 'admin/agent/application/crud/mange-agent-doc/delete',
           afterSuccess: {
               type: 'api_response',
               afterLoad: (req,res) => {
                  $("#agent_app_doc_"+res?.extraData?.id).remove();
               }
           }
        });

    });
}

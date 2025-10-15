$(document).ready(function(){

    if ($('#frmUpdateAdminUserPermission').length > 0) {
        let rules = {
        };
        PX?.ajaxRequest({
            element: 'frmUpdatePermission',
            validation: true,
            script: 'admin/system/user/user-policy',
            rules,
            afterSuccess: {
                type: 'inflate_redirect_response_data',
            }
        });
    }
});

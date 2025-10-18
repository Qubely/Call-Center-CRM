<div class="tool-box d-flex flex-row justify-content-end align-items-center bread-cum">
    @can('agent_application_crud_store')
        <button data-prop='{"page": "addPage","server": "no"}' class="btn btn-primary btn-soft-primary waves-effect waves-light d-flex justify-items-center align-items-center viewAction fw-bold me-2">
            <span class="bx bx-plus fw-bold"></span> <span class="d-none d-md-block ms-1"> {{pxLang($data['lang'],'','common.btns.crud_add')}} </span>
        </button>
    @endcan
    @if(count($data['items']) > 0)
        @can('agent_application_crud_bulk_update')
            {{-- <button class="btn btn-success btn-soft-success waves-effect waves-light d-flex justify-items-center align-items-center  fw-bold  me-2 updateAllAgentApplication"><span class="bx bx-save"></span> <span class="d-none d-md-block ms-1"> {{pxLang($data['lang'],'','common.btns.crud_update')}}   </span> </button> --}}
        @endcan
        @can('agent_application_crud_delete')
            <button class="btn btn-danger btn-soft-danger waves-effect waves-light waves-light d-flex justify-items-center align-items-center  fw-bold me-2 deleteAllAgentApplication"><span class="bx bx-trash"></span> <span class="d-none d-md-block ms-1">  {{pxLang($data['lang'],'','common.btns.crud_delete')}}   </span> </button>
        @endcan
        @can('agent_application_crud_pdf')
            <button class="btn btn-info btn-soft-info waves-effect waves-light d-flex justify-items-center align-items-center  fw-bold  me-2" id="downloadAgentApplicationPdf"  data-pdf-op='{"file_name":"{{ config('i.service_domain').'_agentapplication_list'  }}"}'><span class="bx bxs-file-pdf"></span> <span class="d-none d-md-block ms-1"> {{pxLang($data['lang'],'','common.btns.crud_pdf')}}  </span> </button>
        @endcan
        @can('agent_application_crud_excel')
            <button class="btn btn-warning btn-soft-warning waves-effect waves-light d-flex justify-items-center align-items-center  fw-bold" id="downloadAgentApplicationExcel"  data-excel-op='{"file_name":"{{ config('i.service_domain').'_agentapplication_list'  }}"}'><span class="bx bxs-file-export"></span> <span class="d-none d-md-block ms-1"> {{pxLang($data['lang'],'','common.btns.crud_excel')}}  </span> </button>
        @endcan
    @endif
</div>

